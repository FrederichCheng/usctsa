<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'controllers/module.php');
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
class facebook_categories extends Module{
	private $_importing = FALSE;
	public $view_location = 'facebook';
        
	public function __construct()
	{
            parent::__construct(FALSE);
            $this->view_location = 'fuel';
	}
        
        
}
