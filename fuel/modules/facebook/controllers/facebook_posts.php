<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once( FACEBOOK_PATH . 'libraries/phpanalysis/phpanalysis.class.php');
require_once( FACEBOOK_PATH . 'libraries/CKIP.php');
require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
require_once(FACEBOOK_PATH . 'libraries/naive_bayes_classifier.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');
/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of facebook_posts
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class facebook_posts extends Module {
    private $_importing = FALSE;
    public $view_location = 'facebook';
    private $classifier = NULL;
    public function __construct() {
        parent::__construct(FALSE);
        mb_internal_encoding("UTF-8"); 
        mb_regex_encoding("UTF-8");
        $this->view_location = 'fuel';
        $this->load->model('facebook_words_model','words');
        $this->load->model('facebook_categories_model','categories');
        $this->load->model('facebook_posts_model','posts');
        $this->classifier = new Naive_Bayes_Classifier($this->words);
    }
}
