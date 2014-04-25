<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of word_bag_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */
interface word_bag_model {

    public abstract function getCategoryCount();

    public abstract function getCategoryOccurence($category);

    public abstract function getCategories();

    public abstract function getCategory($name);
    
    public abstract function getTotalSampleCount();

    public abstract function getTotalWords();
    
    public abstract function getVocabularySize();
   
}
