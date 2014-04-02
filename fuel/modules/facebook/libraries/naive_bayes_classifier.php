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
class Naive_Bayes_Classifier implements Classifier{
    private $model;
    
    public function __construct($model) {
        parent::__construct();
        $this->model = $model;
    }
    
    public function classify($str){
        $index = 0;
        $tokens = preg_split("\\s+",$str);
        $categories = $this->model->getCategories();
        $probs = array(sizeof($categories));
        foreach($categories as $c) {
            $pc = $this->model->getTotalSampleCount() > 0? Math.log($this->model->getClassOccurence(c)
                    / $this->model->getTotalSampleCount()): 0; // P(c)
            foreach ($tokens as $token) {
                $wordProb = // P(wi|c) with add-one smoothing
                        ($c->getWordOccurence($token) + 1)
                        / ($c->getTotalWords() + $this->model->getVocabularySize());

                $pc += log($wordProb); // P(c) * P(d|c)
            }
            $probs[$index] = $pc;
            $index++;
        }
        $max = index-1;
        for($i = 0; i < $index; $i++){
            if($probs[$i] > $probs[$max]){
                $max = $i;
            }
        }
        return $categories[$max]->getName();
    }
}
