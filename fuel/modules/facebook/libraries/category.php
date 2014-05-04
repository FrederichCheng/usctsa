<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of category
 *
 * @author Shao-yen(Frederich) Cheng 
 */
abstract class Category {
    public abstract function getWordOccurence($word);
    public abstract function getTotalWords();
    
    protected $id;
    protected $name;
    protected $tag;
    public function __construct($id,$name,$tag){
        $this->id = $id;
        $this->name = $name;
        $this->tag = $tag;
    }
    
    public function getName(){
        return $this->name;
    }
    
        
    public function getId(){
        return $this->id;
    }
    
    public function getTag(){
        return $this->tag;
    }
    
}

