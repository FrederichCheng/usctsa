<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of category_impl
 *
 * @author Shao-yen(Frederich) Cheng 
 */

class category_impl extends Category{
    private $totalWords;
    
    public function __construct($name, $totalWords) {
        parent::__construct($name);
        $this->totalWords = $totalWords;
    }

    public function getWordOccurence($word) {       
        $sql = sprintf("select count from facebook_words where "
                . "word='%s' and "
                . "category='%s' ",
                $word, $this->name);    //might have SQL injection issue.
        
        $result = mysql_query($sql) or die('MySQL query error');
        $row = mysql_fetch_array($result);

        return $row['count'];
    }

    public function getTotalWords() {
        return $this->totalWords;
    }
}
