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

 
class Facebook_categories_model extends Base_module_model {

    function __construct(){
        parent::__construct('facebook_categories');
        $this->hidden_fields = array('count');
    }
    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->select('id, name ,count as sample_count, redirect, published');
        $this->db->where('id > 0');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }
    
    function _common_query($display_unpublished_if_logged_in = NULL) {
        parent::_common_query($display_unpublished_if_logged_in);
    }
    
    function isAvailable($id){
        $query = $this->db->get_where('facebook_categories', array('id' => $id, 'published' => 'yes'));
        $count= $query->num_rows();
        return $count > 0;
    }
    
    function find_all_published_array($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL) {
        $this->db->where('id != 0');
        $this->db->where(array('published' => 'yes'));
        return parent::find_all_array($where, $order_by, $limit, $offset);
    }
    
}
 
class Facebook_category_model extends Base_module_record {

}
