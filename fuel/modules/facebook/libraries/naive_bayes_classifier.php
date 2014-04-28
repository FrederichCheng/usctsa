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
class Naive_Bayes_Classifier implements Classifier {

    private $wordModel;

    public function __construct($model) {
        parent::__construct();
        $this->wordModel = $model;
    }

    public function classify($str) {
        $index = 0;
        $tokens = preg_split("\\s+", $str);
        $categories = $this->wordModel->getCategories();
        $probs = array(sizeof($categories));
        foreach ($categories as $c) {
            $pc = $this->wordModel->getTotalSampleCount() > 0 ? log($this->wordModel->getClassOccurence(c) / $this->wordModel->getTotalSampleCount()) : 0; // P(c)
            foreach ($tokens as $token) {
                $wordProb = // P(wi|c) with add-one smoothing
                        ($c->getWordOccurence($token) + 1) / ($c->getTotalWords() + $this->wordModel->getVocabularySize());

                $pc += log($wordProb); // P(c) * P(d|c)
            }
            $probs[$index] = $pc;
            $index++;
        }
        
        $max = index - 1;
        for ($i = 0; i < $index-1; $i++) {
            if ($probs[$i] > $probs[$max]) {
                $max = $i;
            }
        }
        
        return $categories[$max]->getName();
    }

}
