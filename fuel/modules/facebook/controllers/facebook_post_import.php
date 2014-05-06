<?php

require_once(FUEL_PATH . '/libraries/Fuel_base_controller.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FACEBOOK_PATH . 'libraries/naive_bayes_classifier.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');

class Facebook_post_import extends Fuel_base_controller {

    public $nav_selected = 'facebook/facebook_post_import';
    private $APP_ID = '445984512214350';
    private $GROUP_ID = '12171823426';
    private $SECRET = '650f341095028ad446dafd7c57c258f2';
    private $classifier = NULL;
    private $facebook = NULL;
    
    function __construct() {
        parent::__construct();
        $this->load->model('facebook_posts_model');
        $this->load->model('facebook_words_model', 'words');
        
        $this->facebook = new Facebook(array(
            'appId' => $this->APP_ID,
            'secret' => $this->SECRET
        ));
        
        $this->facebook->setAccessToken($this->APP_ID.'|'.$this->SECRET);   //PREVENT app access token from expiration. Facebook API sucks!
        $this->classifier = new Naive_Bayes_Classifier($this->words);
    }

    function fetchPosts(){
        if(is_ajax()&& !empty($_POST)){
            $uri = $this->GROUP_ID.'/feed'; //$this->input->post('uri');
            $fetchUser = TRUE;//$this->input->post('uri');
            
            $fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture');

            $response = $this->facebook->api($uri);
            $records = array();
            $users = array();
            
            foreach ($response['data'] as $feed) {
                
                //if post from other group
                if((!empty($feed['name']))&&
                        (!empty($feed['link'])&&
                        preg_match('/.+www\.facebook\.com\/groups.+/', $feed['link']))){
                    $matches = array();
                    if(preg_match('/\/[0-9]+\/$/', $feed['link'], $matches)){
                        $feed = $this->facebook->api($matches[0]);
                    }
                    
                }
                
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
                
                $user_response = $this->facebook->api($param);
                $user_records = array();
                
                foreach($user_response as $user){
                    $user_records[$user['name']] = $user['fql_result_set'][0];
                }
                
                foreach($records as &$record){
                    $user_record = $user_records[$record['user_id']];
                    $record = array_merge($record,$this->formatUserResponse($user_record));
                }
                
            }
            
            $result = array();
            
            if(!(empty($response['paging']) || empty($response['paging']['next']))){
                $result['nextPage'] = str_replace('https://graph.facebook.com/','', $response['paging']['next']);
            }
            $result['data'] = $records;
            //printStructure($result);
            $this->output->set_content_type('application/json');
            echo json_encode($result);
        }

    }
    
    private function formatUserResponse($user_feed){
        $record = array();
        $record['user_picture'] = isset($user_feed['pic_big']) ? $user_feed['pic_big']: NULL;
        $record['user_cover'] = isset($user_feed['pic_cover']) ? $user_feed['pic_cover']['source'] : NULL;
        $record['gender'] = isset($user_feed['sex']) ? $user_feed['sex'] : NULL;
        $record['user_link'] = 'http://www.facebook.com/' . $user_feed['uid'];
        return $record;
    }
    
//    private function fetchAttachment($postId){
//        if(is_ajax()){
//            
//        }
//        $params = array('method' => 'fql.query',
//                    'query' => sprintf('SELECT attachment FROM stream WHERE post_id="%s"', '12171823426_10152368506298427'));
//        $response = $facebook->api($params);
//    }
    
    function index() {
        $this->_validate_user('facebook');
        $this->load->helper('security');


        if (!empty($_POST)) {
            if ($this->input->post('option') === 'import') {
                    $this->output->set_content_type('application/json');
                
                //$fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture','user_picture','user_cover','gender','user_link');
                $record = $this->input->post('data');
//                $record = array();
//                $record['facebook_id'] = $feed['id'];
//                $record['user_id'] = $feed['from']['id'];
//                $record['username'] = $feed['from']['name'];
//                $record['post_link'] = $feed['actions'][0]['link'];
//                foreach ($fields as $field) {
//                    if (array_key_exists($field, $feed) && !empty($feed[$field]) && $feed[$field] !== 'null') {
//                        $record[$field] = $feed[$field];
//                    }
//                }
                
                $exist = $this->facebook_posts_model->record_exists(
                            array('facebook_id'=>$record['facebook_id'], 
                                'updated_time'=> $record['updated_time'],
                                'user_link' => $record['user_link'],
                                'post_link' => $record['post_link']
                            )
                        );
                
                if($exist){
                    echo json_encode(array(
                        'status' => 'none',
                        'msg' => 'post is unchanged'
                    ));
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
                    
                    if($this->facebook_posts_model->record_exists($where)){
                        
                        $this->facebook_posts_model->update($record, $where);     
                        echo json_encode(array(
                            "status" => "update",
                            "msg" => "post is updated"
                        ));
                    }
                    
                    else{
                        $segments = getSegments($str);
                        $record['category'] = $this->classifier->classify($segments);
                        $this->facebook_posts_model->insert($record);
                        
                        echo json_encode(array(
                            'status' => 'insert',
                            "msg" => "post is inserted"
                        ));
                    }
                }

            } else if ($this->input->post('option') === 'update') {
                
            }
        }
        else{
            $crumbs = array('Facebook' => 'Import Facebook Posts');
            $this->fuel->admin->set_titlebar($crumbs, 'ico_facebook_import');
            $this->fuel->admin->render('_admin/facebook_import', array('APP_ID' => $this->APP_ID, 'GROUP_ID'=>$this->GROUP_ID), Fuel_admin::DISPLAY_NO_ACTION);
        }
    }

}

/* End of file cronjobs.php */
/* Location: ./fuel/modules/cronjobs/controllers/cronjobs.php */
