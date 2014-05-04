<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */
require_once(FUEL_PATH.'models/base_module_model.php');
require_once ( FACEBOOK_PATH.'libraries/category_impl.php');

/**
 * Description of facebook_words_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class facebook_words_model extends Base_module_model{
    
    private $categories = NULL;
    private $totalWords = NULL;
    private $totalSamples = NULL;
    private $vocSize = NULL;
    private $categoryOccur = array();
    
    function __construct()
    {
        parent::__construct('facebook_words');
        $this->db->save_queries = false;
    }

    private function resetCache(){
        $this->totalWords = NULL;
        $this->totalSamples = NULL;
        $this->vocSize = NULL;
    }
    
    public function resetCategories(){
        $this->categories = array();
        $query = $this->db->get('facebook_categories');
        foreach ($query->result() as $row){
            $c = new category_impl($row->id,$row->name, $row->tag, $row->published ,$this);
            $this->categories[$row->tag] = $c;
        }
        $query->free_result();
        $this->categoryOccur = array();
    }
    
    public function getCategories() {
        if($this->categories === NULL){
            $this->resetCategories();
        }
        
        return $this->categories;
    }

    public function getCategory($tag) {
        $categories = $this->getCategories();
        return $categories[$tag];
    }

    public function getCategoryCount() {
        $categories = $this->getCategories();
        return count($categories);
    }

    public function hasWord($word, $cat_id){
        $num = $this->record_count(array('word' => $word, 'category' => $cat_id));
        return $num != 0;
    }
    
    public function addWord($word, $cat_id){
        $db = $this->words->db;
        if($this->hasWord($word, $cat_id)){
            $db->set('count', 'count+1', FALSE);
            $db->where(array('category'=> $cat_id, 'word'=> $word));
            $db->update('facebook_words');
        }
        else{
            $this->insert(array('word'=>$word, 'category' => $cat_id, 'count'=> 1));
        }
        $this->resetCache();
    }
    
    public function getCategoryOccurence($category) {
        
        if(empty($category) || !in_array($category, $this->categories)){
                return 0;
        }
        if(!isset($this->categoryOccur[$category->getTag()])){
            $query = $this->db->get_where('facebook_categories', array('id' => $category->getId()));
            $count = $query->result()[0]->count;
            $query->free_result();
            $this->categoryOccur[$category->getTag()] = $count;
        }
        return $this->categoryOccur[$category->getTag()];
    }

    public function getTotalSampleCount() {
        if($this->totalSamples === NULL){
            $this->db->select_sum('count');
            $query = $this->db->get('facebook_categories');
            $count = $query->result()[0]->count;
            $query->free_result();
            $this->totalSamples = $count;
        }
        return $this->totalSamples;
    }

    public function getTotalWords() {
        if($this->totalWords === NULL){
            $this->db->select_sum('count');
            $query = $this->db->get('facebook_words');
            $count = $query->result()[0]->count;
            $query->free_result();
            $this->totalWords = $count;
        }
        
        return $this->totalWords ;
    }

    public function getVocabularySize() {
        if($this->vocSize === NULL){
            $this->db->select('count(*) as `count` from (select `word` from `facebook_words` group by `word`) as t1');
            $query = $this->db->get();
            $count = $query->result()[0]->count;
            $query->free_result();
            $this->vocSize = $count;
        }
        return $this->vocSize;
    }
}
 
class Facebook_word_model extends Base_module_record {

}

