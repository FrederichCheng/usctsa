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


function image($src, $attrs = array()){
            if(isset($src) || strlen($src) == 0){
                return sprintf('<img src="%s" %s/>', $src, makeAttrStr($attrs));
            }
            return '';
        }
        
function text($message, $limit=30, $attrs = array()){
    if(isset($message)){
        return sprintf('<span %s>%s</span>', makeAttrStr($attrs), mb_substr($message,0,$limit));
    }
    return '';
}

function alink($href, $text, $attrs=array()){
    if(isset($href)){
        return sprintf('<a href="%s" %s>%s</a>', $href, makeAttrStr($attrs), $text);
    }
}

function makeAttrStr($attrs){
    $attrStr = '';
    foreach($attrs as $key=>$value){
        $attrStr .= $key.'="'.urlencode($value).'" ';
    }
    return $attrStr;
}