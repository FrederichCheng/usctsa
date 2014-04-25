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
    public function __construct($id,$name){
        $this->id = $id;
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
    
        
    public function getId(){
        return $this->id;
    }
}

