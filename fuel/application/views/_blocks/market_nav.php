<?php 
/* 
 *  Copyright 2014 Frederich.
 *  All rights reserved.
 *
 */

if(!isset($categories)){
    require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
    $CI->load->model('facebook/facebook_categories_model','facebook_categories_model');
    $categories = $CI->facebook_categories_model->find_all_published_array();
}

if(!isset($category)){
    $category = 0;
    
    if(isset($categoryName)){
        foreach($categories as $cat){
            if( strtolower($cat['name']) === strtolower($categoryName)){
                $category = $cat['id'];
                break;
            }
        }
    }
}

?>

<style>
    .standardNav{
            position: fixed !important;
            overflow: visible;
            top: 50%;
            left: 50%;
            padding: 5px;
            margin: -100px 0 0 -630px;
            width: 140px;
            z-index: 9999;
            text-transform:capitalize;
            opacity: 0.90;
    }

    .standardNav ul{
            display: block;
            margin: 0;
            padding: 6px;
            list-style: none;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            background: #fff;
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .3);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .3);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .3);
    }

    .standardNav.left{
            margin-left: -45px;
    }

    .standardNav li{
            display: block;
    }

    .standardNav li a{
            display: block;	
            font-weight: normal;
            padding: 8px 10px;
            text-decoration: none;
            color: #666;
            font-size: 12px;
    }	

    .standardNav li a:hover{
            color: #333;
    }

    .standardNav li.active a{
            font-weight: bold;
            color:rgb(255,204,68);
    }	
    
    .standardNav ul li.active{
        background-color:transparent;
    }
    
    .standardNav ul li.active a{
        background-color: #b92c28;
        border-radius: 6px;
    }
    
    .standardNav ul
    {
            background: rgb(153,29,32);	
    }

    .standardNav ul li a
    {
            background: rgb(153,29,32);	
            color: rgb(255,204,68);
            text-decoration: none;
            /*font: 12px Arial, sans-serif;*/
            font-size: 14px;
    }	

    .standardNav ul li a:hover
    {
            /*background: rgb(143,19,22);*/
            color: rgb(245,245,245);
            font: 18px Arial, sans-serif;
    }


    
</style>

<div class=" standardNav pageScrollerNav right dark">
        <ul>
            <li class='<?= 0 == $category? 'active' :'' ?>' ><a href="market">all</a></li>
            <?php 
            foreach ($categories as $record){ ?>
            <li class='<?= $record['id'] == $category? 'active' :'' ?>' >
                <?php if($record['redirect'] === NULL){ ?>
                <a href="<?='market?category='.$record['id']?>"><?=$record['name']?></a>
                <?php }else{ ?>
                <a href="<?=$record['redirect']?>"><?=$record['name']?></a>
                <?php }?>
            </li>
            <?php }?>
        </ul>
</div>