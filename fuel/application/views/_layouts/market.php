<?php 
    require_once(FACEBOOK_PATH . 'models/facebook_posts_model.php');
    require_once(FACEBOOK_PATH . 'models/facebook_categories_model.php');
    require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php'); 
    require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');

    $this->load->view('_blocks/header');
    $CI->load->model('facebook/facebook_posts_model','facebook_posts_model');
    $CI->load->model('facebook/facebook_categories_model','facebook_categories_model');
    $category = $this->input->get('category');

    $limit = $post_per_page;
    
    $page = $this->input->get('page');
    $first_page = false;
    if(!isset($page) || !is_numeric($page) || $page<=1){
        $page = 1;
        $first_page = true;
    }

    if(!isset($category) || !is_numeric($category) || $category<=0){
        $category = 0;
    }

    $categories = $CI->facebook_categories_model->find_all_published_array();

    $exists = FALSE;
    foreach($categories as $cat){
        if($cat['id'] == $category){
            $exists = TRUE;
            $categoryName = $cat['name'];
            break;
        }
    }

    if($category > 0 && $exists){
        $records = $CI->facebook_posts_model->find_all_published_array(array('category'=>$category), 'created_time desc', $limit, $first_page? NULL:($page-1)*$limit);
    }
    else{
        $category = 0;
        $records = $CI->facebook_posts_model->find_all_published_array(array(), 'created_time desc', $limit,$first_page? NULL: ($page-1)*$limit);
    }

?>

<script>

    function showPostDialog(id) {
        //id = id.substring(id.indexOf("_")+1);
            FB.api({
                method: 'fql.query',
                query: 'SELECT attachment FROM stream WHERE post_id="'+id+'"',
                return_ssl_resources: 1
            }, function(response){

                alert(JSON.stringify(response));

            });
            
//        FB.api(id, function(response) {
//            if (!response || response.error) {
//                alert(JSON.stringify(response.error));
//                return;
//            }
//
//            var post = new Array();
//            post['id'] = response['id'];
//            post['user_id'] = response['from']['id'];
//            post['username'] = response['from']['name'];
//            post['message'] = response['message'];
//            post['link'] = response['link'];
//            post['type'] = response['type'];
//            post['comments'] = new Array();
//            var comments = response['comments']['data'];
//            for (var index in comments) {
//                var arr = new Array();
//                post['comments'].push(arr);
//                arr['user_id'] = comments[index]['from']['id'];
//                arr['username'] = comments[index]['from']['name'];
//                arr['message'] = comments[index]['message'];
//                arr['created_time'] = comments[index]['created_time'];
//            }
//
////                FB.api({
////                    method: 'fql.query',
////                    query: 'SELECT attachment FROM stream WHERE post_id='+post['id']+"'",
////                    return_ssl_resources: 1
////                }, function(response){
////                    
////                    
////                    
////                });
//
//            $('<div>').html(JSON.stringify(response)).css({width: '600px', height: '400px', overflow: 'scroll'}).dialog({
//                dialogClass: "no-close",
//                maxHeight: 400,
//                width: 600,
//                title: response.name,
//                buttons: [
//                    {
//                        text: "Close",
//                        click: function() {
//                            $(this).dialog("close");
//                        }
//                    }
//                ],
//                close: function() {
//                    var index = dialogs.indexOf(id);
//                    dialogs.splice(index, 1);
//                }
//            });
//            dialogs[dialogs.length] = id;
//        });
    }


    $(document).ready(function() {
        $(".image").each(function() {
            var theImage = new Image();
            var img = $(this).find("img");

            theImage.onload = function() {
                return function(img, theImage) {
                    var width = theImage.width;
                    var height = theImage.height;
                    if (width > height)
                        img.addClass("wide");
                    else
                        img.addClass("long");
                }(img, theImage);
            };

            theImage.src = img.attr("src");

        });
        
        $(".text").each(function(){
            var msg = makeAllLinksA($(this).html()).replace('\n','<br/>');
            var pos = msg.indexOf('<br/>');
            if(pos < 0)
                pos = msg.search(/([.?!。！]|[<]br\/[>])|$/i);
            if(pos >= 0){
                var title = '<b>'+msg.substring(0,pos)+'</b>';
                msg = msg.substring(pos, msg.length);
                $(this).html(title+msg);
            }
            else{
                $(this).html(msg);
            }
        });
        
        $(".imageFrame").click(function() {
            //showPostDialog($(this).parent('.post').attr('id'));
            window.open($(this).attr('link'),'_blank');
            //window.open(url,'_blank');
//            $('<div>').html('').css({width: '640px', height: '480px', overflow: 'scroll', display: 'block'}).dialog({
//                dialogClass: "no-close",
//                height: 480,
//                width: 640,
//                title: $(this).siblings('.info').find('.text').html(),
//                buttons: [
//                    {
//                        text: "Save to Favorites",
//                        click: function() {
//                            $(this).dialog("close");
//                        }
//                    },
//                    {
//                        text: "Close",
//                        click: function() {
//                            $(this).dialog("close");
//                        }
//                    }
//                ]
//            });
        });
    });

</script>

<style>
    html{
        font-family: monospace Tahoma Geogria San-serif;
    }

    #postWrapper{
        text-align: center;
        display:table;
        margin:0 auto;
        background-image: url('<?= img_path('white-wall.png')?>');
        box-shadow: 0px 0px 20px 1px #ddd ;
        border-radius: 5px;
    }
   
    .posts{
        width:840px;
        margin: 0 auto;
        padding: 10px;
        display:table-cell;
        text-align: center;
    }

    .post{
        background-image: url('<?= img_path('postit.png')?>');
        width:250px;
        height:235px;
        float:left;
        overflow:hidden;
        margin: 10px;
        
    }
/*
    .post:hover{
        border-color: #e38d13;
        box-shadow: 0px 1px 3px 5px #eee;
    }*/

    .text{
        float:left;
        width:180px;
        height:120px;
        overflow: auto;
        margin-left:30px;
        text-align:left;
/*        transform:rotate(-3deg);
        -webkit-transform:rotate(-3deg);*/
    }


    .time{
        font-size: 12px;
        display: table-cell;
        vertical-align: middle;
        border-top-width: 1px;
        border-top-style: dashed;
        border-top-color: #999;
        height:25px;
        color: #666;
        display:none;
    }

    .info{
        width: 180px;
        height: 80px;
        word-break:break-all;
        margin: 0 auto;
        display: table;
        margin-top:30px;
    }

    .image img{
        /*        width:180px;
                height:135px;*/
        margin: 0 auto;
        display:table;
        text-align: center;
    }

    .wide{
        height: 135px;
    }

    .long{
        width:180px;
    }

    .image{
        width:180px;
        height:135px;
        overflow:hidden;
        border-width: 3px;
        border-style: solid;
        border-color: #eee;
    }

    .imageFrame{
        width:190px;
        height:152px;
        padding:4px;

        float:top;
        margin: 0 auto;
        margin-top:6px;
        background-color:white;
        cursor: pointer;
    }

    .paging{
        display:table-row;
    }

    .posted{
        float:right;
        cursor:default;
        margin-bottom:10px;
    }

    .posted>img:hover{
        border-width:2px;
        border-style:solid;
        border-color:#d9534f;
    }

    .posted>img{
        width: 54px;
        height:54px;
        border-radius: 50%;
        behavior: url(PIE.htc); /* remove if you don't care about IE8 */
        border-width:1px;
        border-style:solid;
        border-color: #e38d13;
    }

    .content{
        display:table-row;
        padding-bottom: 5px;
    }

    .posted:hover .userProfile{
        display:block;
    }

    .userProfile{
        position:absolute;
        display:none;
        background-color: white;
        padding: 4px 4px 0px 4px;
        box-shadow: 0px 0px 2px 1px #333;
        z-index:9999;
        height:200px;
        margin-left:-330px;
        margin-top:-30px;
        opacity: 0.6;
    }
    .userProfile:hover{
        opacity: 1.0;
    }

    .userProfile .cover{
        width:360px;
        height:150px;
        overflow:hidden;
        border-width:1px;
        border-style:solid;
        border-color:#ccc;
    }

    .userProfile .cover img{
        width:360px;
        margin-top:-50px;
    }

    .userProfile .personal{
        margin-top:-90px;
        width:100%;
        display:table;
    }

    .userProfile .info{
        display:table-cell;
        vertical-align: bottom;
        font-size:16px;
        font-weight: bold;
    }

    .personal .name{
        display:inline-block;
        width:140px;
        text-align: left;
        overflow:hidden;
    }

    .personal .picture{
        width:120px;
        display:table-cell;
    }

    img.gender{
        width:20px;
        height:20px;
        margin-top:-16px;
    }

    .userProfile .info .fb_icon{
        width:38px;
        background-color: white;
    }

    .toolbar .fb_icon{
        width:16px;
    }

    #search{
        position:absolute;
        top:200px;
        right:400px;
    }
    
    h2{
        text-transform:capitalize;
    }
    
    .post-link{
        width:25px;
        float:left;
        margin-left:20px;
    }
</style>
<div id="wrapper">
    <?= fuel_block(array('view' => 'market_nav', 'vars' => array('categories' => $categories, 'category' => $category))); ?>
    <div class="pagewidth">
        
        <h2>
            <?php if (isset($categoryName)) : ?>
            <?=$categoryName?>
            <?php endif; ?>
        </h2>
        
        <div id="postWrapper">
            <div class="posts">
                <?php foreach ($records as $feed) { ?>
                    <div class="post" id="<?=$feed['facebook_id']?>">
                        <?php //if (isset($feed['picture'])) {  ?>
                        
                        <div class="info">
                            
                            <div class="content">
                                <a href="<?=$feed['post_link']?>" target="_blank">
                                <img src='<?=img_path('fb_icon.gif')?>' class="fb_icon post-link" />
                                </a>
                                <div class="posted">
                                    <?= isset($feed['user_picture']) ? 
                                        image($feed['user_picture'], array('class' => 'picture')) : 
                                            image(img_path('no-available-cover.png'), array('class' => 'picture')) 
                                    ?>
                                    <a href='<?=$feed['user_link']?>' target='_blank' id="<?=$feed['user_id']?>">
                                        <div class="userProfile">
                                            <div class="cover"> <?= isset($feed['user_cover']) && $feed['user_cover']!== NULL  ? image($feed['user_cover'], array('class' => 'picture')) : '' ?> </div>
                                            <div class="personal" >
                                                <div class="picture"> 
                                                    <?= isset($feed['user_picture']) ? 
                                                        image('https://graph.facebook.com/' . $feed['user_id'] . '/picture?width=120&height=120',array('class' => 'img-thumbnail')) : 
                                                            image(img_path('no_image_thumb.gif'),array('class' => 'img-thumbnail')) 
                                                    ?> 
                                                </div>
                                                <div class="info">
                                                    <?= $feed['gender'] === 'male' ? image(img_path('male.gif'), array('class' => 'gender')) : image(img_path('female.gif'), array('class' => 'gender')) ?>
                                                    <span class="name"><?= $feed['username'] ?></span>
                                                    <img src='<?=img_path('fb_icon.gif')?>' class="fb_icon" />
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="text"> <?= $feed['message'] ?> </div>
                            </div>
                            <div class="time"><?= isset($feed['updated_time']) ? $feed['updated_time'] : $feed['created_time'] ?></div>
                        </div>

                    </div>
                    <?php
//            $params = array('method' => 'fql.query',
//                        'query' => sprintf('SELECT attachment FROM stream WHERE post_id="%s"', $feed->id));
//            //echo var_dump($facebook->api($params));
//            $photo = new PhotoFeed($facebook->api($params)[0]['attachment']);
//
//            foreach($photo->images as $image){
//                echo $image;
//            }
                }
                ?>

                <?php
                    $page_count = 5;
                    $where = $category > 0 ? array('category'=>$category) : array();
                    $total = $CI->facebook_posts_model->publushed_record_count($where);
                    $total_pages =  ceil($total/$limit);
                    $current_start = floor($page/$page_count)*$page_count;
                ?>

            </div>
            <div class="paging">
                <ul class="pagination">
                    <li class="<?=$page < $page_count? 'disabled' : ''?>">
                        <a href="<?= $page < $page_count ? '#':'market?page='.($current_start-1).'&category='.$category?>">&laquo;</a>
                    </li>
                    
                    <?php for($i = $current_start; $i <= $current_start+$page_count && $i <= $total_pages; $i++){ 
                        if($i > 0){
                    ?>
                    
                    <li class="<?= $i == $page? 'active':'' ?>"><a href="<?='market?page='.$i.'&category='.$category?>"><?=$i?></a></li>
                    
                        <?php }
                    }?>
                    <li class="<?=$current_start+$page_count+1 >= $total_pages? 'disabled' : ''?>">
                        <a href="<?= $current_start+$page_count+1 >= $total_pages? '#' : 'market?page='.($current_start+$page_count).'&category='.$category?>">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>	
</div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<?php $this->load->view('_blocks/footer') ?>
