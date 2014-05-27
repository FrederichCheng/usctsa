<?php  // put your helper functions here


    function fetchPosts($facebook, $uri=NULL){
            $fetchUser = $uri;
            $fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture');

            $response = $facebook->api($uri);
            $records = array();
            $users = array();
            
            foreach ($response['data'] as $feed) {
                
                //if post from other group
                if((!empty($feed['name']))&&
                        (!empty($feed['link'])&&
                        preg_match('/.+www\.facebook\.com\/groups.+/', $feed['link']))){
                    $matches = array();
                    if(preg_match('/\/[0-9]+\/$/', $feed['link'], $matches)){
                        $feed = $facebook->api($matches[0]);
                    }
                    
                }
                
                if(empty($feed['from']))
                    continue;
                
                $record = array();
                $record['facebook_id'] = $feed['id'];
                $record['user_id'] = $feed['from']['id'];
                $record['username'] = $feed['from']['name'];
                $record['post_link'] = $feed['actions'][0]['link'];

                foreach ($fields as $field) {
                    if (array_key_exists($field, $feed)) {
                        $record[$field] = $feed[$field];
                    }
                }

                if(!empty($fetchUser)){
                    $users[] = $record['user_id'];
                }

                $records[] = $record;
            }
            
            if(!empty($users)){
                $queries = array();
                foreach($users as $user){
                    $queries[$user] = sprintf("SELECT pic_big , pic_cover, sex, uid from user where uid='%s'", $user);
                }
                
                $param = array(
                    'method' => 'fql.multiquery',
                    'queries' => $queries
                );
                
                $user_response = $facebook->api($param);
                $user_records = array();
                
                foreach($user_response as $user){
                    $user_records[$user['name']] = $user['fql_result_set'][0];
                }
                
                foreach($records as &$record){
                    $user_record = $user_records[$record['user_id']];
                    $record = array_merge($record,formatUserResponse($user_record));
                }
                
            }
            
            $result = array();
            
            if(!(empty($response['paging']) || empty($response['paging']['next']))){
                $result['nextPage'] = str_replace('https://graph.facebook.com/','', $response['paging']['next']);
            }
            $result['data'] = $records;
            //printStructure($result);
            return $result;
    }
    
    function formatUserResponse($user_feed){
        $record = array();
        $record['user_picture'] = isset($user_feed['pic_big']) ? $user_feed['pic_big']: NULL;
        $record['user_cover'] = isset($user_feed['pic_cover']) ? $user_feed['pic_cover']['source'] : NULL;
        $record['gender'] = isset($user_feed['sex']) ? $user_feed['sex'] : NULL;
        $record['user_link'] = 'http://www.facebook.com/' . $user_feed['uid'];
        return $record;
    }
    
    function import_record($model, $classifier, $record){
        $exist = $model->record_exists(
            array('facebook_id'=>$record['facebook_id'], 
                'updated_time'=> $record['updated_time'],
                'user_link' => $record['user_link'],
                'post_link' => $record['post_link']
            )
        );

        if($exist){
            return array(
                'status' => 'none',
                'msg' => 'post is unchanged'
            );
        }
        else{
            $str = '';
            if(!(empty($record['message']) || empty($record['description']))){
                $str = $record['message'].' '.$record['description'];
            }
            else if(!empty($record['message'])){
                $str = $record['message'];
            }
            else if(!empty($record['description'])){
                $str = $record['description'];
            }                    

            $where = array('facebook_id'=> $record['facebook_id']);

            if($model->record_exists($where)){

                $model->update($record, $where);     
                return array(
                    "status" => "update",
                    "msg" => "post is updated"
                );
            }

            else{
                $segments = getSegments($str);
                $record['category'] = $classifier->classify($segments);
                $model->insert($record);

                return array(
                    'status' => 'insert',
                    "msg" => "post is inserted"
                );
            }
        }
    }
