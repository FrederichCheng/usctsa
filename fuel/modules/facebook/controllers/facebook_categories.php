<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once( FACEBOOK_PATH . 'libraries/phpanalysis/phpanalysis.class.php');
require_once( FACEBOOK_PATH . 'libraries/CKIP.php');
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
class facebook_categories extends Module {

    private $_importing = FALSE;
    public $view_location = 'facebook';

    public function __construct() {
        parent::__construct(FALSE);
        $this->view_location = 'fuel';
        mb_internal_encoding("UTF-8"); 
        mb_regex_encoding("UTF-8");
    }

    public function upload() {
        $this->load->helper('file');
        $this->load->helper('security');
        $this->load->library('form_builder');
        $this->load->library('upload');
        $this->load->model('facebook_categories_model','categories');
        $this->load->model('facebook_words_model','words');
        

        if (!empty($_POST) AND ! empty($_FILES)) {
            $params['upload_path'] = sys_get_temp_dir();
            $params['allowed_types'] = 'txt';

            // to ensure we check the proper mime types
            $this->upload->initialize($params);

            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                if($this->check_format($upload_data['full_path'])){
                    $handle = fopen($upload_data['full_path'], "r");
                    $records = 0;
                    $this->db->trans_start();
                    while (($line = fgets($handle)) !== false) {
                        if(strlen(trim($line)) == 0){
                            continue;
                        }

                        $arr = explode(' ', $line);

                        if(empty($arr) || count($arr) < 2){
                            continue;
                        }

                        $tag = $arr[0];
                        $words = getSegments($arr[1]);

                        $category = $this->words->getCategory($tag);
                        $cat_id = $category->getId();
                        
                        if(is_array($words)){
                            $this->save_words($words, $cat_id);
                        }

                        $this->categories->incrementCategory($cat_id);
                        $records++;
                    }
                    $this->db->trans_complete();
                    fclose($handle);

                    if ($records == 0) {
                        add_error(lang('error_upload'));
                    }
                }
            } else {
                $error_msg = $this->upload->display_errors('', '');
                add_error($error_msg);
            }
            
            if(!has_errors()){
                $this->fuel->admin->set_notification($records.' records are imported!', Fuel_admin::NOTIFICATION_SUCCESS);
                redirect(fuel_url('facebook/facebook_categories'));
            }
        } 
        
        $fields = array();

        $fields['file'] = array('type' => 'file', 'accept' => 'txt');
        $this->form_builder->hidden = array();
        $this->form_builder->set_fields($fields);
        $this->form_builder->set_field_values($_POST);
        $this->form_builder->submit_value = '';
        $this->form_builder->use_form_tag = FALSE;
        $vars['instructions'] = 'Select a training file to upload';
        $vars['form'] = $this->form_builder->render();
        $vars['back_action'] = ($this->fuel->admin->last_page() AND $this->fuel->admin->is_inline()) ? $this->fuel->admin->last_page() : fuel_uri($this->module_uri);

        $crumbs = array($this->module_uri => $this->module_name, '' => lang('action_upload'));
        $this->fuel->admin->set_titlebar($crumbs);
        $this->fuel->admin->render('upload', $vars);
    }
    
    private function check_format($file){
        $handle = fopen($file, "r");
        $lineNo = 0;
        $has_error = FALSE;
        while (($line = fgets($handle)) !== false) {
            $lineNo++;
            if(strlen(trim($line)) == 0){
                continue;
            }

            $arr = explode(' ', $line);

            if(empty($arr)){
                add_error(sprintf('line %d: can\'t process [%s].', $lineNo, $line));
                $has_error = TRUE;
                break;
            }

            $tag = $arr[0];
            $category = $this->words->getCategory($tag);

            if(empty($category)){
                add_error( sprintf('line %d: %s is not defined in categories.', $lineNo, $tag));
                $has_error = TRUE;
                break;
            }
        }
        fclose($handle);
        return !$has_error;
    }
    
    private function save_words($words, $cat_id){
        foreach ($words as $word) {
            if (strlen(trim($word)) == 0){
                continue;
            }
            $this->words->addWord($word, $cat_id);
        }
    }
}
