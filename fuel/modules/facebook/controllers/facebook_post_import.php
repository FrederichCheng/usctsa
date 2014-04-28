<?php

require_once(FUEL_PATH . '/libraries/Fuel_base_controller.php');
require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');

class Facebook_post_import extends Fuel_base_controller {

    public $nav_selected = 'facebook/facebook_post_import';
    private $APP_ID = '445984512214350';
    private $GROUP_ID = '12171823426';
    
    function __construct() {
        parent::__construct();
        $this->load->model('facebook_posts_model');
    }

    function index() {
        $this->_validate_user('facebook');
        $this->load->helper('security');


        if (!empty($_POST)) {
            if ($this->input->post('option') === 'import') {
                    $this->output->set_content_type('application/json');
                
                $fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture','user_picture','user_cover','gender','user_link');
                $feed = $this->input->post('data');
                $record = array();
                $record['facebook_id'] = $feed['id'];
                $record['user_id'] = $feed['from']['id'];
                $record['username'] = $feed['from']['name'];
                $record['post_link'] = $feed['actions'][0]['link'];
                foreach ($fields as $field) {
                    if (array_key_exists($field, $feed) && !empty($feed[$field]) && $feed[$field] !== 'null') {
                        $record[$field] = $feed[$field];
                    }
                }
                $exist = $this->facebook_posts_model->record_exists(
                            array('facebook_id'=>$record['facebook_id'], 
                                'updated_time'=> $record['updated_time'],
                                'user_link' => $record['user_link'],
                                'post_link' => $record['post_link']
                            )
                        );
                
                if($exist){
                    echo json_encode(array(
                        'status' => 'none',
                        'msg' => 'post is unchanged'
                    ));
                }
                else{
                    //$record['category'] = rand(3,5);
                    $where = array('facebook_id'=> $record['facebook_id']);
                    if($this->facebook_posts_model->record_exists($where)){
                        
                        $this->facebook_posts_model->update($record, $where);     
                        echo json_encode(array(
                            "status" => "update",
                            "msg" => "post is updated"
                        ));
                    }
                    else{
                        $this->facebook_posts_model->insert($record);
                        echo json_encode(array(
                            'status' => 'insert',
                            "msg" => "post is inserted"
                        ));
                    }
                }

            } else if ($this->input->post('option') === 'update') {
                
            }
        }
        else{
            $crumbs = array('Facebook' => 'Import Facebook Posts');
            $this->fuel->admin->set_titlebar($crumbs, 'ico_facebook_import');
            $this->fuel->admin->render('_admin/facebook_import', array('APP_ID' => $this->APP_ID, 'GROUP_ID'=>$this->GROUP_ID), Fuel_admin::DISPLAY_NO_ACTION);
        }
    }

}

/* End of file cronjobs.php */
/* Location: ./fuel/modules/cronjobs/controllers/cronjobs.php */
