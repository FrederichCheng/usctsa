<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');
/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of Facebook_posts_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */

 
class Facebook_posts_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('facebook_posts');
    }
}
 
class Facebook_post_model extends Base_module_record {
 
}
