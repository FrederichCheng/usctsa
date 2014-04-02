<?php

/* 
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */


// page module init values
$config['modules']['facebook_posts'] = array(
        'module_uri' => 'facebook/facebook_posts',
	'module_name' => 'Facebook Posts',
	'model_location' => 'facebook',
	'model_name' => 'facebook_posts_model',
        'rows_selectable' => TRUE,
        'table_actions' => array('EDIT','DELETE'),
	'display_field' => 'id',
	'table_headers' => array(
                'id',
		'message', 
		'name', 
                'link',
		'created_time', 
	),
	'default_col' => 'created_time',
	'default_order' => 'desc',
//	'js_controller' => 'fuel.controller.PageController',
//	'js_controller_params' => array('import_field' => 'vars--body'),
	'preview_path' => '',
//	'permission' => array('facebook', 'items', 'create', 'edit', 'pages/upload' => 'pages/create', 'publish', 'delete'),
//	'instructions' => lang('pages_instructions'),
//	'archivable' => TRUE,
	'sanitize_input' => array('template','php'),
	'list_actions' => array(),
	'item_actions' => array('save','view', 'delete'),
);

$config['modules']['facebook_categories'] = array(
        'module_uri' => 'facebook/facebook_categories',
	'module_name' => 'Post Categories',
	'model_location' => 'facebook',
    
	'model_name' => 'facebook_categories_model',
        'rows_selectable' => FALSE,
        'table_actions' => array('EDIT','DELETE'),
	'display_field' => 'name',
	'default_col' => 'name',
	'default_order' => 'desc',
//	'js_controller' => 'fuel.controller.PageController',
//	'js_controller_params' => array('import_field' => 'vars--body'),
//	'preview_path' => '{location}',
	'permission' => array('facebook', 'items', 'create', 'edit', 'pages/upload' => 'pages/create', 'publish', 'delete'),
//	'instructions' => lang('pages_instructions'),
//	'archivable' => TRUE,
	'sanitize_input' => array('template','php'),
	'list_actions' => array(),
//	'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'replace', 'create', 'others' => array('pages/upload' => lang('btn_upload'))),
);