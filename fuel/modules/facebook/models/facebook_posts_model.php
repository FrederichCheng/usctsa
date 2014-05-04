<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(FUEL_PATH . 'models/base_module_model.php');
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

    public $foreign_keys = array('category' => 'facebook_categories_model');
    private $categories;

    function __construct() {
        parent::__construct('facebook_posts');
    }

    function ajax_change_post_category($params) {
        $query = $this->db->get_where('facebook_categories', array('id' => $params['category']));
        $count = $query->num_rows();
        if ($count > 0) {
            $this->db->where('id', $params['post_id']);
            $this->db->update('facebook_posts', array('category' => $params['category'], 'manual_set' => $params['category'] > 0));
            $rows = $this->db->affected_rows();
            $this->output->set_content_type('application/json');
            return json_encode(array(
                'status' => $rows === 0 ? 'fail' : 'success'
            ));
        } else {
            return json_encode(array(
                'status' => 'Illegal Value'
            ));
        }
    }
    
    public function find_all_published_array($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL) {
        $this->db->join('facebook_categories', 'facebook_categories.id = category', 'left');
        $this->db->where('category != 0');
        $this->db->where(array('published' => 'yes'));
        return parent::find_all_array($where, $order_by, $limit, $offset);
    }

    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        
        if ($this->categories === NULL) {
            $this->load->model('facebook_categories_model');
            $this->categories = $this->facebook_categories_model->find_all_array();
        }

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

                $_record['category'] = sprintf('<select id="%s" class="category">%s</select>', $_record['id'], $options);
                $js = sprintf('<script> 
                        (function(){
                            $("#%s").change(
                                changePostCategory("%d")
                            );
                        })();
                        </script> ', $_record['id'], $_record['category']);
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

}

class Facebook_post_model extends Base_module_record {
    
}
