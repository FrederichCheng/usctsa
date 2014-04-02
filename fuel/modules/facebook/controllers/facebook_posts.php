<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH . 'controllers/module.php');
require_once( FACEBOOK_PATH . 'libraries/phpanalysis/phpanalysis.class.php');
require_once( FACEBOOK_PATH . 'libraries/CKIP.php');
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
    }

    public function analyze() {
        
        $str = '大家快來看看USC TSA年度最大活動的第一支宣傳片!!! 大家知道是什麼活動嗎? 接下來的幾天USC TSA還會陸續公布新的宣傳片! 請大家隨時關注我們USC TSA 的Facebook! ';
        /*$ckip = new CKIP();
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
            $do_prop = empty($_POST['do_prop']) ? false : true;
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
