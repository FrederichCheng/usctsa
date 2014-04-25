<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once( FACEBOOK_PATH . 'libraries/phpanalysis/phpanalysis.class.php');
require_once( FACEBOOK_PATH . 'libraries/CKIP.php');
require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_words_model.php');
require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
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
    public function __construct() {
        parent::__construct(FALSE);
        $this->view_location = 'fuel';
        $this->load->model('facebook_words_model','words');
        $this->load->model('facebook_categories_model','categories');
        $this->load->model('facebook_posts_model','posts');
    }
    
    function partition($str){
        
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
    
    public function printDB(){
        $categories = $this->words->getCategories();
        $cats = array();
        foreach($categories as $cat){
            $cats[$cat->getId()] = $cat;
        }
        $result = $this->posts->find_all_array(array('manual_set'=>TRUE));
        
        foreach($result as $record){
            $str = $record['message'];
            if($str === NULL)
                $str = $record['description'];
            
                $str = str_replace('u\'', '', $str);
                $str = str_replace('\\t', '', $str);
                $str = str_replace('\\n', '', $str);
                $words = preg_split('/\s/', $str);

                if(count($words) < 40){
                    $words = $this->partition($str);
                }
            
            echo $cats[$record['category']]->getName().' ';
 
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
    
//    public function file(){
//        foreach($this->files(assets_server_path('data')) as $file){
//            $handle = fopen(assets_server_path('data/'.$file), "r");
//            if ($handle) {
//                while (($line = fgets($handle)) !== false) {
//                    $arr = explode(' ',$line);
//                    $label = $arr[0];
//                    $db = $this->categories->db;
//                    $db->set('count', 'count+1', FALSE);
//                    $db->where('name', $label);
//                    $db->update('facebook_categories');
//                    //echo $label.':';
//                    $str = substr($line, strrpos($line, ' '));
//                    $cat_id = $this->words->getCategory($label)->getId();
//                    $str = str_replace('u\'', '', $str);
//                    $str = str_replace('\\t', '', $str);
//                    $str = str_replace('\\n', '', $str);
//                    $words = preg_split('/\s/', $str);
//                    
//                    if(count($words) < 40){
//                        $words = $this->partition($str);
//                    }
//                    
//                    $db = $this->words->db;
//                    if(is_array($words)){
//                        foreach($words as $word){
//                            if(strlen(trim($word)) == 0)
//                                continue;
//                            if($this->words->hasWord($word, $cat_id)){
//                                $db->set('count', 'count+1', FALSE);
//                                $db->where(array('category'=> $cat_id, 'word'=> $word));
//                                $db->update('facebook_words');
//                                //echo $word.',';
//                            }
//                            else{
//                                $this->words->save(array('word'=>$word, 'category' => $cat_id, 'count'=> 1));
//                            }
//                        }
//                    }
//                    //echo "<br/>";
//                }
//                echo $file.' Complete!';
//            } else {
//                // error opening the file.
//            } 
//            fclose($handle);
//        }
//    }

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
    
    public function analyze() {
        
        $str = '日期：anytime-七月31日 地址：2660 Magnolia Ave, Los Angeles, CA 90007 '
                . '房子出租 現有一位女室友 跟學校距離很近 步行至學校只需5-7分鐘 已有床 衣櫥 跟各種傢俱 '
                . '廚具 電器 剛剛有housekeeper大掃除 可以馬上入住 $800/一個月 （一個房間）$1600/一個月'
                . '（整個房子） 全包！ 男女均可 急租 價錢可商議 請inbox/短信8186813200 謝謝';
        /*
        $ckip = new CKIP();
        $ckip->username = 'hses83081';
        $ckip->password = 'usctsa';
        $ckip->serverIP = '140.109.19.104';
        $ckip->serverPort = '1501';
        $ckip->rawText = $str;
        $ckip->send();
        $ckip->getTerm();
        foreach($ckip->term as $term){
            echo $term->term.':'.$term->tag.'<br/>';
        }
        */
        
        
        $br = (php_sapi_name() == "cli")? "":"<br>";

        $module = 'opencc';
        $functions = get_extension_funcs($module);
        //print_r($functions);

        $od = opencc_open("zht2zhs.ini");
        $str = opencc_convert($od, $str);

        opencc_close($od);

        //echo $text;

        

        $do_fork = $do_unit = true;
        $do_multi = $do_prop = $pri_dict = false;

        if ($str != '') {
            //岐义处理
            $do_fork = empty($_POST['do_fork']) ? false : true;
            //新词识别
            $do_unit = empty($_POST['do_unit']) ? false : true;
            //多元切分
            $do_multi = empty($_POST['do_multi']) ? false : true;
            //词性标注
            $do_prop = empty($_POST['do_prop']) ? true : true;
            //是否预载全部词条
            $pri_dict = empty($_POST['pri_dict']) ? false : true;

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
            
            echo var_dump(explode(' ', $okresult));
        }
    }
}
