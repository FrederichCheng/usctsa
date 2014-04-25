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
        $this->db->select('id, name ,count as sample_count, published');
        $this->db->where('id > 0');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }
    
    function exists($id){
        $query = $this->db->get_where('facebook_categories', array('id' => $id));
        $count= $query->num_rows();
        return $count > 0;
    }
    
}
 
class Facebook_category_model extends Base_module_record {

}
