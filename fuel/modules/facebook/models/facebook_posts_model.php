<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'core/Model.php');
require_once(FUEL_PATH . 'models/base_module_model.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
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

    public $foreign_keys = array('category' => 'facebook_categories_model');
    private $categories;

    function __construct() {
        parent::__construct('facebook_posts');
    }

    function ajax_change_post_category($params) {
        $this->output->set_content_type('application/json');
        
        try{
            $query = $this->db->get_where('facebook_categories', array('id' => $params['category']));
            $count = $query->num_rows();
            $query->free_result();
            $query2 = $this->db->get_where('facebook_categories', array('id' => $params['old_category']));
            $count2 = $query2->num_rows();
            $query2->free_result();
            
            $result = $this->find_all_array(array('id'=> $params['post_id']));
            $exist = !empty($result);

            if($exist){
                $record = NULL;
                foreach($result as $rec){
                    $record = $rec;
                }
            }
            
            if ($count > 0 && $count2 > 0 && $exist) {

                $str = '';
                if(!(empty($record['message']) || empty($record['description']))){
                    $str = $record['message'].' '.$record['description'];
                }
                else if(!empty($record['message'])){
                    $str = $record['message'];
                }
                else if(!empty($record['description'])){
                    $str = $record['description'];
                }

                $words = getSegments($str);
                
                $manual_set = $record['manual_set'];
                $this->load->model('facebook_words_model');
                $this->load->model('facebook_categories_model');
                
                $this->db->trans_start();
                
                if($manual_set > 0 && $params['old_category'] > 0){
                    $this->facebook_words_model->deleteWords($words, $params['old_category']);
                    $this->facebook_categories_model->decrementCategory($params['old_category']);
                }

                if($params['category'] > 0){
                    $this->facebook_words_model->addWords($words, $params['category']);
                    $this->facebook_categories_model->incrementCategory($params['category']);
                }
                $this->db->where('id', $params['post_id']);
                
                $this->db->update('facebook_posts', array('category' => $params['category'], 'manual_set' => $params['category'] > 0));
                $rows = $this->db->affected_rows();
                
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    return json_encode(array(
                        'status' => 'fail: transaction fails'
                    ));
                }
                
                return json_encode(array(
                    'status' => $rows === 0 ? 'fail' : 'success'
                ));
            } else {
                return json_encode(array(
                    'status' => 'Illegal Value'
                ));
            }
        }
        catch(Exception $e){
            return json_encode(array(
                'status' => 'fail',
                'message' => $e->getMessage()
            ));
        }
    }
    
    public function find_all_published_array($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL) {
        $this->db->where('category != 0');
        $this->db->where(array('published' => 'yes'));
        return parent::find_all_array($where, $order_by, $limit, $offset);
    }

    public function _common_query($display_unpublished_if_logged_in = NULL) {
        $this->db->join('facebook_categories', 'facebook_categories.id = category', 'left');
        $this->db->select('facebook_posts.*,facebook_categories.*');
        return parent::_common_query($display_unpublished_if_logged_in);
    }
    
    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        
        $this->resetCategories();

        if (is_array($data)) {
            foreach ($data as &$_record) {
                $options = '';
                foreach ($this->categories as $cat) {
                    $selected = '';
                    if ($cat['id'] === $_record['category']) {
                        $selected = 'selected';
                    }
                    $options.= sprintf('<option value="%s" %s>%s</option>', $cat['id'], $selected, $cat['name']);
                }

                $cat_id = $_record['category'];
                
                $_record['category'] = sprintf('<select id="%s" class="category" category="%d">%s</select>', $_record['id'], $cat_id, $options);
                $js = sprintf('<script> 
                        (function(){
                            $("#%s").change(
                                changePostCategory()
                            );
                        })();
                        </script> ', $_record['id']);
                $_record['category'].=$js;

                if (isset($_record['link'])) {
                    $link = $_record['link'];
                    $_record['link'] = sprintf('<a href="%s" target="_blank">', $link);
                    if (isset($_record['picture'])) {
                        $_record['link'] .= sprintf('<img src="%s" alt="%s" />', $_record['picture'], isset($_record['description']) ? html_entity_decode($_record['description']) : '');
                    } else {
                        $_record['link'] .= html_entity_decode($link);
                    }
                    $_record['link'] .= '</a>';
                } else if (isset($_record['picture'])) {
                    $_record['link'] = sprintf('<img src="%s" alt="%s" />', $_record['picture'], isset($_record['description']) ? $_record['description'] : '');
                } else {
                    $matches = NULL;
                    $matched = preg_match('!(http|ftp|scp)(s)?:\/\/.+(\s|$)!', $_record['message'], $matches);
                    if ($matched) {
                        $newStr = $matches[0];
                        if (isset($newStr) && strlen($newStr) > 0) {
                            $_record['link'] = sprintf('<a href="%s" target="_blank"> %s </a>', $newStr, $newStr);
                        }
                    }
                }
                $_record['post_link'] = alink($_record['post_link'], 'link', array('target' => '_blank'));
            }
        }
        return $data;
    }
    
    function filters($filters = array()){
        $options = array();
        
        $this->resetCategories();
                
        $options['0'] = 'Select a category...';
        foreach($this->categories as $cat){
            if($cat['id'] > 0){
                $options[$cat['id']] = $cat['name'];
            }
        }
        
        $filters['category'] = array(
        'label' => 'Category', 
        'type' => 'select', 
        'options' => $options
        );
        return $filters;
    }
    private function resetCategories(){
        if ($this->categories === NULL) {
            $this->load->model('facebook_categories_model');
            $this->categories = $this->facebook_categories_model->find_all_array();
        }
    }
}

class Facebook_post_model extends Base_module_record {
    
}
