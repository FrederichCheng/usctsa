<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of HTMLhelper
 *
 * @author Shao-yen(Frederich) Cheng 
 */


function image($src,$class=""){
            if(isset($src) || strlen($src) == 0){
                return sprintf('<img class="%s" src="%s"/>', $class, $src);
            }
            return '';
        }
        
function text($message, $description, $class="message", $limit=150){
    $text = isset($message)? $message : $description;
    if(isset($text)){
        return sprintf('<span class="%s">%s</span>', $class, mb_substr($text,0,20));
    }
    return '';
}

