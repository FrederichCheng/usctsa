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
    
    public function __construct($id, $name, $tag, $published, $postModel) {
        parent::__construct($id,$name,$tag);
        $this->wordModel = $postModel;
        $this->published = $published;
    }

    public function getWordOccurence($word) { 
        
        $this->wordModel->db->select('count');
        $this->wordModel->db->from('facebook_words');
        $this->wordModel->db->where(array('word'=> $word, 'category'=> $this->id));
        $query = $this->wordModel->db->get();
        $rows = $query->num_rows();
        if($rows == 0){
            return 0;
        }
        
        foreach ($query->result() as $row)
        {
            $occ = $row->count;
            break;
        }

        $query->free_result();
        return $occ;
    }

    public function getTotalWords() {
        
        if(NULL === $this->totalWords){
            $this->wordModel->db->where(array('category'=> $this->id));
            $this->wordModel->db->select_sum('count');
            $query = $this->wordModel->db->get('facebook_words');
            $rows = $query->num_rows();
            if($rows == 0){
                return 0;
            }
            foreach ($query->result() as $row)
            {
                $this->totalWords = $row->count;
                break;
            }
            
            $query->free_result();
        }
        
        return $this->totalWords;
    }
    
    public function isPublished(){
        return $this->published;
    }
}
