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
    
    protected $name;
    public function __construct($name){
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
}

