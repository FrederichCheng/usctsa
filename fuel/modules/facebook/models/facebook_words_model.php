<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

require_once '../libraries/word_bag_model.php';

/**
 * Description of facebook_words_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class facebook_words_model extends Base_module_model implements word_bag_model {
    
    function __construct()
    {
        parent::__construct('facebook_words');
    }

    public function getCategories() {
        $categories = array();
        $this->db()->select()->from("facebook_categories");
        $query = $this->db->get();
        foreach ($query->result() as $row){
            $c = new category_impl($row->name);
        }
    }

    public function getCategory($name) {
        
    }

    public function getCategoryCount() {
        
    }

    public function getCategoryOccurence($category) {
        
    }

    public function getTotalSampleCount() {
        
    }

    public function getTotalWords() {
        
    }

    public function getVocabularySize() {
        
    }

}
 
class Facebook_word_model extends Base_module_record {

}

