<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once( FACEBOOK_PATH . 'libraries/phpanalysis/phpanalysis.class.php');
require_once( FACEBOOK_PATH . 'libraries/CKIP.php');
require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
require_once(FACEBOOK_PATH . 'libraries/naive_bayes_classifier.php');
require_once(FACEBOOK_PATH . 'helpers/classifier_helper.php');
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');
/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of facebook_posts
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class facebook_posts extends Module {

    private $_importing = FALSE;
    public $view_location = 'facebook';
    private $classifier = NULL;
    public function __construct() {
        parent::__construct(FALSE);
        mb_internal_encoding("UTF-8"); 
        mb_regex_encoding("UTF-8");
        $this->view_location = 'fuel';
        $this->load->model('facebook_words_model','words');
        $this->load->model('facebook_categories_model','categories');
        $this->load->model('facebook_posts_model','posts');
        $this->classifier = new Naive_Bayes_Classifier($this->words);
    }
    
    function sql(){
        $result = $this->posts->find_all_array();
        foreach($result as $record){
            if($record['category'] != 0){
                echo sprintf("Update facebook_posts set category=%d, manual_set=%d where facebook_id='%s';" , $record['category'], $record['manual_set'], $record['facebook_id']);
                echo '<br />';
            }
        }
    }
    private $ckip = NULL;
    private function partition($str){
        $this->ckip = new CKIP();  
        $this->ckip->username = 'hses83081';
        $this->ckip->password = 'usctsa';
        $this->ckip->serverIP = '140.109.19.104';
        $this->ckip->serverPort = '1501';

        $this->ckip->rawText = $str;
        $this->ckip->send();
        $this->ckip->getTerm();
        $words = [];
        foreach($this->ckip->term as $term){
            $words[]= $term->term;
        }
        
        return $words;
        
//        $do_fork = $do_unit = true;
//        $do_multi = $do_prop = $pri_dict = false;
//
//        if ($str != '') {
//
//            //初始化类
//            PhpAnalysis::$loadInit = false;
//            $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
//            //载入词典
//            $pa->LoadDict();
//
//            //执行分词
//            $pa->SetSource($str);
//            $pa->differMax = $do_multi;
//            $pa->unitWord = $do_unit;
//
//            $pa->StartAnalysis($do_fork);
//
//            $okresult = $pa->GetFinallyResult(' ', $do_prop);
//
//            //$pa_foundWordStr = $pa->foundWordStr;
//
//            //$slen = strlen($str);
//            //$slen = sprintf('%0.2f', $slen / 1024);
//            
//            return preg_split('/\s/', $okresult);
//        }
    }
    
    private function partition2($str){
        
        $do_fork = $do_unit = true;
        $do_multi = $do_prop = $pri_dict = false;

        if ($str != '') {

            //初始化类
            PhpAnalysis::$loadInit = false;
            $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
            //载入词典
            $pa->LoadDict();

            //执行分词
            $pa->SetSource($str);
            $pa->differMax = $do_multi;
            $pa->unitWord = $do_unit;

            $pa->StartAnalysis($do_fork);

            $okresult = $pa->GetFinallyResult(' ', $do_prop);

            //$pa_foundWordStr = $pa->foundWordStr;

            //$slen = strlen($str);
            //$slen = sprintf('%0.2f', $slen / 1024);
            
            return preg_split('/\s/', $okresult);
        }
    }
    
    function files($directory) {
        $files = array();
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (!is_dir($directory. "/" . $file)) {
                        $files[]=$file;
                    }
                }
            }
            closedir($handle);
        }
        return $files;
    }
    
    public function part(){
        
        $handle = fopen(assets_server_path('data/tsa_training_chi.txt'), "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $arr = explode(' ',$line);
                $label = $arr[0];
                echo $label;
                echo ' ';
                $str = substr($line, strpos($line, ' '));
                
                $words = preg_split('/\s/', $str);

                if(count($words) < 40){
                    $words = $this->partition($str);
                }

                if(is_array($words)){
                    foreach($words as $word){
                        echo $word;
                        echo ' ';
                    }
                }
                echo "<br/>";
            }
            echo ' Complete!';
        } else {
            // error opening the file.
        } 
        fclose($handle);

    }
    
    private function retrieveEnglish($str){
        $pattern = '/\[?[A-Za-z]+\]?/';
        $result = [];
        $matches = [];
        preg_match_all($pattern, $str, $result, PREG_PATTERN_ORDER);
        foreach($result as $match){
            foreach($match as $token){
                $matches[]=$token;
            }
        }
        return $matches;
    }
    
    private function retrieveChinese($str){
        $pattern = '/[\x{4e00}-\x{9fa5}]+/um';
        $result = [];
        $matches = [];
        preg_match_all($pattern, $str, $result, PREG_PATTERN_ORDER);
        foreach($result as $match){
            foreach($match as $token){
                $matches[]=$token;
            }
        }
        return $matches;
    }
    
    
    public function printDB2(){
        $categories = $this->words->getCategories();
        $cats = array();
        foreach($categories as $cat){
            $cats[$cat->getId()] = $cat;
        }
        $result = $this->posts->find_all_array(array('manual_set'=>TRUE));
        
        foreach($result as $record){
            $str = '';
            if($record['message'] !== NULL && $record['description'] != NULL)
                $str = $record['message'].' '.$record['description'];
            else if($record['message'] !== NULL)
                $str = $record['message'];
            else if($record['description'] !== NULL)
                $str = $record['description'];
            
            //$str = $this->translate($str);

            $str = str_replace('\n', ' ', $str);
            $str = str_replace('\r', ' ', $str);
            $str = str_replace('\t', ' ', $str);
            $str = str_replace('u\'', '', $str);
            $str = str_replace('\\t', '', $str);
            $str = str_replace('\\n', '', $str);
//            $str = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/','[link]',$str);
//            $str = preg_replace('/\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\./','[address]',$str);
//            $str = preg_replace('/[0-9\-\+]{9,15}/','[phone]',$str);
            $eng = $this->retrieveEnglish($str);
            $chi = $this->retrieveChinese($str);
            
            $words=[];
            
            if(is_array($eng)){
                foreach($eng as &$part){
                    $words[] = $part;
                }
                if(count($eng) > 200){
                    $words[]= '[LONG_ENGLISH]';
                }
            }
            
            
            if(is_array($chi)){
                foreach($chi as &$part){
                    $tokens = $this->partition2($part);
                    if(is_array($tokens)){
                        foreach($tokens as $token){
                            $words[]=$token;
                        }
                    }
                }
                if(count($chi) > 100){
                    $words[]= '[LONG_CHINESE]';
                }
            }
            

                //if(count($words) < 40){
                
                //}
            
            
            //echo $str;
            if(is_array($words)){
                foreach($words as $word){
                    if(strlen(trim($word)) == 0)
                        continue;
                    echo $word;
                    echo ' ';
                }
            }
            echo '<br>';
        }
    }
    
    public function printDB(){
        $count = 0;
        $categories = $this->words->getCategories();
        $cats = array();
        foreach($categories as $cat){
            $cats[$cat->getId()] = $cat;
        }
        $result = $this->posts->find_all_array(array('manual_set'=>TRUE));
        
        foreach($result as $record){
            $str = '';
            if($record['message'] !== NULL && $record['description'] != NULL)
                $str = $record['message'].' '.$record['description'];
            else if($record['message'] !== NULL)
                $str = $record['message'];
            else if($record['description'] !== NULL)
                $str = $record['description'];
            
            //$str = $this->translate($str);

            $str = str_replace('\n', ' ', $str);
            $str = str_replace('\r', ' ', $str);
            $str = str_replace('\t', ' ', $str);
            $str = str_replace('u\'', '', $str);
            $str = str_replace('\\t', '', $str);
            $str = str_replace('\\n', '', $str);

            $eng = $this->retrieveEnglish($str);
            $chi = $this->retrieveChinese($str);
            
            $words=[];

            
            if(is_array($eng)){
                foreach($eng as &$part){
                    $words[] = $part;
                }
                if(count($eng) > 200){
                    $words[]= '[LONG_ENGLISH]';
                }
            }
            
            if(is_array($chi) && !empty($chi)){
                $chStr='';
                foreach($chi as $part){
                    $chStr.=' '.$part;
                }
                if(strlen(trim($chStr)) == 0)
                    continue;
                
                $tokens = $this->partition($chStr);
                if(is_array($tokens)){
                    foreach($tokens as $token){
                        $words[]=$token;
                    }
                }
                if(count($tokens) > 100){
                    $words[]= '[LONG_CHINESE]';
                }
            }
            

                //if(count($words) < 40){
                
                //}
            
            echo $cats[$record['category']]->getTag().' ';
            //echo $str;
            if(is_array($words)){
                foreach($words as $word){
                    if(strlen(trim($word)) == 0)
                        continue;
                    echo $word;
                    echo ' ';
                }
            }
            echo '<br>';
        }
    }
    
    public function file(){
        foreach($this->files(assets_server_path('data')) as $file){
            $handle = fopen(assets_server_path('data/'.$file), "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $arr = explode(' ',$line);
                    $label = $arr[0];
                    $str = substr($line, strpos($line, ' '));
                    
                    $str = $this->translate($str);
                    $eng = $this->retrieveEnglish($str);
                    $chi = $this->retrieveChinese($str);

                    $words=[];

                    if(is_array($eng)){
                        foreach($eng as &$part){
                            $words[] = $part;
                        }
                        if(count($eng) > 200){
                            $words[]= '[LONG_ENGLISH]';
                        }
                    }


                    if(is_array($chi)){
                        foreach($chi as &$part){
                            $tokens = $this->partition2($part);
                            if(is_array($tokens)){
                                foreach($tokens as $token){
                                    $words[]=$token;
                                }
                            }
                        }
                        if(count($chi) > 100){
                            $words[]= '[LONG_CHINESE]';
                        }
                    }


                        //if(count($words) < 40){

                        //}

                    echo $label.' ';
                    //echo $str;
                    if(is_array($words)){
                        foreach($words as $word){
                            if(strlen(trim($word)) == 0)
                                continue;
                            echo $word;
                            echo ' ';
                        }
                    }
                    echo '<br>';
                }
            } else {
                // error opening the file.
            } 
            fclose($handle);
        }
    }

    public function proxy($id){
    $graph_url= "http://www.facebook.com/".$id;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $graph_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        echo $output = curl_exec($ch);

        curl_close($ch);
        
    }
    
    private function translate($str){
        //print_r($functions);

        $od = opencc_open("zht2zhs.ini");
        $str = opencc_convert($od, $str);

        opencc_close($od);
        return $str;
    }
    
    public function analyze() {
        $str = '日期：anytime-七月31日 地址：2660 Magnolia Ave, Los Angeles, CA 90007 '
                . '房子出租 現有一位女室友 跟學校距離很近 步行至學校只需5-7分鐘 已有床 衣櫥 跟各種傢俱 '
                . '廚具 電器 剛剛有housekeeper大掃除 可以馬上入住 $800/一個月 （一個房間）$1600/一個月'
                . '（整個房子） 全包！ 男女均可 急租 價錢可商議 請inbox/短信8186813200 謝謝';
        
        echo $this->classifier->classify($str);
    }
    
}
