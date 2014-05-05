<?php
/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 *
 * @author Shao-yen(Frederich) Cheng
 */
class Naive_Bayes_Classifier{

    private $wordModel;

    public function __construct($model) {
        $this->wordModel = $model;
    }

    public function classify($str) {
        $index = 0;
        if(is_array($str)){
            $tokens = $str;
        }
        else if(is_string($str)){
            $tokens = preg_split("/\s+/", $str);
        }
        else{
            return NULL;
        }

        $categories = $this->wordModel->getCategories();
        $probs = array();
        $last = NULL;
        foreach ($categories as $c) {
            $pc = $this->wordModel->getTotalSampleCount() > 0 ? log($this->wordModel->getCategoryOccurence($c) / $this->wordModel->getTotalSampleCount()) : 0; // P(c)
            
            foreach ($tokens as $token) {
                $wordProb = // P(wi|c) with add-one smoothing
                        ($c->getWordOccurence($token) + 1) / ($c->getTotalWords() + $this->wordModel->getVocabularySize());
                $pc += log($wordProb); // P(c) * P(d|c)
            }
            
            $probs[$c->getTag()] = $pc;
            $index++;
            $last = $c;
        }

        $max = $last->getTag();
        foreach ($probs as $tag => $prob) {
            if ($prob > $probs[$max]) {
                $max = $tag;
            }
        }
        
        return $categories[$max]->getId();
    }

}
