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


        $APP_ID = '445984512214350';
        $GROUP_ID = '12171823426';

        $facebook = new Facebook(array(
            'appId' => $APP_ID,
            'secret' => '650f341095028ad446dafd7c57c258f2',
        ));
        $uri = $GROUP_ID.'/feed';
        
        $response = $facebook->api($uri);
        $users = array();

        foreach ($response['data'] as $feed) {
                $users[] = $feed['from']['id'];
        }

        //if(!empty($users)){
            $queries = array();
            $count = 1;
            foreach($users as $user){
                $queries[$user] = sprintf("SELECT pic_big , pic_cover, sex from user where uid='%s'", $user);
                $count++;
            }

            $param = array(
                'method' => 'fql.multiquery',
                'queries' => $queries
            );

            $user_response = $facebook->api($param);
            printStructure($user_response);
        //}

        return ;
        $params = array('method' => 'fql.query',
                    'query' => sprintf('SELECT attachment FROM stream WHERE post_id="%s"', '12171823426_10152368107943427'));
        $response = $facebook->api($params);
        printStructure($response);
//        foreach($response[0] as $attachment){
//            foreach($attachment as $media){
//                if(is_array($media)){
//                    foreach($media as $element){
//                        var_dump($element);
//                        echo '<br>';
//                    }
//                }
//                else{
//                    var_dump($media);
//                }
//                echo '<br>';
//            }
//            echo '<br>';
//        }
        
        return;
        
        $records = array();

        foreach ($response['data'] as $feed) {
            $record = array();
            $record['facebook_id'] = $feed['id'];
            $record['user_id'] = $feed['from']['id'];
            $record['username'] = $feed['from']['name'];
            $record['post_link'] = $feed['actions'][0]['link'];
            foreach ($fields as $field) {
                if (array_key_exists($field, $feed)) {
                    $record[$field] = $feed[$field];
                }
            }
            $user_feed = $facebook->api('/'.$record['user_id'].'?fields=picture,link,gender,cover');
            $record['user_picture'] = isset($user_feed['picture']) ? $user_feed['picture']['data']['url'] : NULL;
            $record['user_cover'] = isset($user_feed['cover']) ? $user_feed['cover']['source'] : NULL;
            $record['gender'] = isset($user_feed['gender']) ? $user_feed['gender'] : NULL;
            $record['user_link'] = 'http://www.facebook.com/' . $record['user_id'];
            
            $records[] = $record;
        }
        var_dump($records);
    }
    
}
