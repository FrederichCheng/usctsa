<?php

require_once(FUEL_PATH . '/libraries/Fuel_base_controller.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FACEBOOK_PATH . 'helpers/facebook_helper.php');
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
    
    function fetchOnePage(){
        echo 'Hello';
//        $uri = $this->GROUP_ID. '/feed';
//        $result = $this->fetchPosts($uri);
//        $records = $result['data'];
//        
//        foreach($records as $record){
//            $response = $this->import_record($record);
//        }
    }

    function fetchPosts(){
        if(!empty($_POST)){
            $this->output->set_content_type('application/json');
            $uri = $this->input->post('uri');
            $result = fetchPosts($this->facebook, $uri);
            echo json_encode($result);
       }
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
                $record = $this->input->post('data');
                $response = import_record($this->facebook_posts_model, $this->classifier, $record);
                echo json_encode($response);

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
