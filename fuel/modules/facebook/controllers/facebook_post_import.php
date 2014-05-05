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
            'secret' => $this->SECRET,
        ));
        $this->classifier = new Naive_Bayes_Classifier($this->words);
    }

    function fetchPosts(){
        if(is_ajax()&& !empty($_POST)){
            $uri = $this->input->post('uri');
            $fetchUser = $this->input->post('uri');
            
            $fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture');

            $response = $this->facebook->api($uri);
            $records = array();

            foreach ($response['data'] as $feed) {

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
                    $record = array_merge($record, $this->fetchUser($record['user_id']));
                }

                $records[] = $record;
            }
            
            $result = array();
            
            if(!(empty($response['paging']) || empty($response['paging']['next']))){
                $result['nextPage'] = str_replace('https://graph.facebook.com/','', $response['paging']['next']);
            }
            $result['data'] = $records;
            echo json_encode($result);
        }

    }
    
    private function fetchUser($userId){
        $record = array();
        $user_feed = $this->facebook->api('/'.$userId.'?fields=picture,link,gender,cover');
        $record['user_picture'] = isset($user_feed['picture']) ? $user_feed['picture']['data']['url'] : NULL;
        $record['user_cover'] = isset($user_feed['cover']) ? $user_feed['cover']['source'] : NULL;
        $record['gender'] = isset($user_feed['gender']) ? $user_feed['gender'] : NULL;
        $record['user_link'] = 'http://www.facebook.com/' . $userId;
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
