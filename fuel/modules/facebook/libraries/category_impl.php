<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

require_once ( FACEBOOK_PATH.'libraries/category.php');
/**
 * Description of category_impl
 *
 * @author Shao-yen(Frederich) Cheng 
 */

class category_impl extends Category{
    private $totalWords = NULL;
    private $wordModel;
    private $published;
    
    public function __construct($id, $name, $published, $postModel) {
        parent::__construct($id,$name);
        $this->wordModel = $postModel;
        $this->published = $published;
    }

    public function getWordOccurence($word) { 
        
        $this->wordModel->db->select('count');
        $this->wordModel->db->from('facebook_words');
        $this->wordModel->db->where(array('word'=> $word, 'category'=> $this->id));
        $query = $this->wordModel->db->get();
        $occ = $query->result()[0]->count;
        return $occ;
    }

    public function getTotalWords() {
        
        if(NULL === $this->totalWords){
            $sql = sprintf("select sum(facebook_words.count) as sum "
                    . "from facebook_words, facebook_categories"
                    . " where facebook_categories.name='%s' and facebook_categories.id = category group by category", $this->name);

            $this->wordModel->db->select($sql);
            $query = $this->wordModel->db->get();
            $this->totalWords = $query->result()[0]->sum;
            $query->free_result();
        }
        
        return $this->totalWords;
    }
    
    public function isPublished(){
        return $this->published;
    }
}
