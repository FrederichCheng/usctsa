<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
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
    
    function ajax_change_post_category($params){
        $query = $this->db->get_where('facebook_categories', array('id' => $params['category']));
        $count= $query->num_rows();
        if($count > 0){
            $this->db->where('id', $params['post_id']);
            $this->db->update('facebook_posts', array('category'=>$params['category']));
            $rows = $this->db->affected_rows();
            $this->output->set_content_type('application/json');
            return json_encode(array(
                'status' => $rows === 0? 'fail':'success'
            ));
        }
        else{
            return json_encode(array(
                'status' => 'Illegal Value'
            ));
        }
    }
    
    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->join('facebook_categories','facebook_categories.id = category', 'left');
        $this->db->select('facebook_posts.*,facebook_categories.name as category, facebook_categories.id as category_id');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        
        
        if(is_array($data)){
            $this->load->model('facebook_categories_model');
            
            foreach($data as &$_record){
                $categories = $this->facebook_categories_model->find_all_array();
                
                $options = '';
                foreach($categories as $cat){
                    $selected = '';
                    if($cat['id'] === $_record['category_id']){
                        $selected = 'selected';
                    }
                    $options.= sprintf('<option value="%s" %s>%s</option>', $cat['id'], $selected, $cat['name']);
                }
                
                $_record['category'] = sprintf('<select id="%s" class="category">%s</select>', $_record['id'], $options);
                $js = sprintf('<script> 
                        (function(){
                            $("#%s").change(
                                changePostCategory("%s")
                            );
                        })();
                        </script> ', $_record['id'], $_record['category_id']);
                
                $_record['category'].=$js;
                
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
