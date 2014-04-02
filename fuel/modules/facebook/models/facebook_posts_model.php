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
 
    public $foreign_keys  = array('category' => 'facebook_categories_model');
    function __construct()
    {
        parent::__construct('facebook_posts');
    }
        
    function _common_query($display_unpublished_if_logged_in = NULL) {
        parent::_common_query($display_unpublished_if_logged_in);
        
    }
    
    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->join('facebook_categories','facebook_categories.id = category', 'left');
        $this->db->select('facebook_posts.*,facebook_categories.name as name');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        //var_dump($d);
        if(is_array($data)){
            foreach($data as &$_record){
                if(isset($_record['link'])){
                    $link = $_record['link'];
                    $_record['link'] = sprintf('<a href="%s" target="_blank">', $link);
                    if(isset($_record['picture'])){
                        $_record['link'] .= sprintf('<img src="%s" alt="%s" />', $_record['picture'], isset($_record['description'])? $_record['description']: '');
                    }
                    else{
                        $_record['link'] .= $link;
                    }
                    $_record['link'] .= '</a>';
                }
                else if(isset($_record['picture'])){
                    $_record['link'] = sprintf('<img src="%s" alt="%s" />', $_record['picture'], isset($_record['description'])? $_record['description']: '');
                }
                else{
                    $matched = preg_match('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', $_record['message'], $matches);
                    //var_dump($mathes);
                    if($matches){
                        $newStr = $matches[0];
                        if(isset($newStr) && strlen($newStr) > 0){
                            $_record['link'] = sprintf('<a href="%s" target="_blank"> %s </a>', $newStr, $newStr);
                        }
                    }
                }
            }
        }
        return $data;
    }
}
 
class Facebook_post_model extends Base_module_record {
 
}
