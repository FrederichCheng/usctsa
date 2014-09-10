<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FACEBOOK_PATH . 'helpers/facebook_helper.php');
require_once(FACEBOOK_PATH . 'libraries/naive_bayes_classifier.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');
/*
 *  Copyright 2014 Frederich.
 *  All rights reserved.
 *
 */

/**
 * Description of facebook_auto_imort
 *
 * @author Frederich
 */
class facebook_auto_import extends CI_Controller{
    
    private $APP_ID = '445984512214350';
    private $GROUP_ID = '12171823426';
    private $SECRET = 'f2feee82fd2c8d25bd2d11f421e59347';
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
        $uri = $this->GROUP_ID. '/feed';
        $result = fetchPosts($this->facebook, $uri);
        $records = $result['data'];
        
        foreach($records as $record){
            $response = import_record($this->facebook_posts_model, $this->classifier, $record);
            echo $response['msg'];
            echo "\n";
        }
    }
    
}
