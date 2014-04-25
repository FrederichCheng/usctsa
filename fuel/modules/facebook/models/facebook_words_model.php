<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

require_once ( FACEBOOK_PATH.'libraries/category_impl.php');

/**
 * Description of facebook_words_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class facebook_words_model extends Base_module_model{
    
    private $categories = array();
    
    function __construct()
    {
        parent::__construct('facebook_words');
        $query = $this->db->get('facebook_categories');
        foreach ($query->result() as $row){
            $c = new category_impl($row->id,$row->name,$this);
            $this->categories[$row->name] = $c;
        }
        $query->free_result();
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getCategory($name) {
        return $this->categories[$name];
    }

    public function getCategoryCount() {
        return count($this->categories);
    }

    public function hasWord($word, $category){
        $query = $this->db->get_where('facebook_words', array('word' => $word, 'category'=> $category));
        $result = !empty($query->result());
        $query->free_result();
        return $result;
    }
    
    public function getCategoryOccurence($category) {
        $query = $this->db->get_where('facebook_categories', array('category' => $category->id));
        $count = $query->result()[0]->count;
        $query->free_result();
        return $count;
    }

    public function getTotalSampleCount() {
        $this->db->select_sum('count');
        $query = $this->db->get('facebook_categories');
        $count = $query->result()[0]->count;
        $query->free_result();
        return $count;
    }

    public function getTotalWords() {
        $this->db->select_sum('count');
        $query = $this->db->get('facebook_words');
        $count = $query->result()[0]->count;
        $query->free_result();
        return $count;
    }

    public function getVocabularySize() {
        $this->db->select('select count(*) as `count` from (select `word` from `facebook_words` group by `word`) as t1');
        $query = $this->db->get();
        $count = $query->result()[0]->count;
        $query->free_result();
        return $count;
    }
}
 
class Facebook_word_model extends Base_module_record {

}

