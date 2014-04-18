<?php require_once(APPPATH . 'models/facebook_posts_model.php'); ?>
<?php require_once(FACEBOOK_PATH . 'libraries/HTMLhelper.php'); ?>
<?php $this->load->view('_blocks/header') ?>
<?php
$this->load->model('facebook_posts_model');
$arr = [];
$arr['limits'] = 25;
//$feeds = $CI->facebook_posts_model->find_all_array(array(), 'created_time desc', 16, 0);

$APP_ID = '445984512214350';
$GROUP_ID = '12171823426';
require_once(FUEL_FOLDER . '/FacebookSDK/facebook.php');
$facebook = new Facebook(array(
    'appId' => $APP_ID,
    'secret' => '650f341095028ad446dafd7c57c258f2',
        ));

$prev_uri = null;
$uri = '/' . $GROUP_ID . '/feed?limit=17';
$page = 1;
$feeds = array();
$fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture');

$response = $facebook->api($uri);
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

    $user_response = $facebook->api('/' . $record['user_id'] . '?fields=picture,link,gender,cover&limits=15');
    $record['user_picture'] = isset($user_response['picture']) ? $user_response['picture']['data']['url'] : NULL;
    $record['cover'] = isset($user_response['cover']) ? $user_response['cover']['source'] : NULL;
    $record['gender'] = isset($user_response['gender']) ? $user_response['gender'] : 'Unknown';
    $record['user_link'] = 'http://www.facebook.com/' . $record['user_id'];
    $records[] = $record;
}
?>

<script>

    function showPostDialog($id) {
        FB.api('/' + $id, function(response) {
            if (!response || response.error) {
                alert(response.error);
                return;
            }

            var post = new Array();
            post['id'] = response['id'];
            post['user_id'] = response['from']['id'];
            post['username'] = response['from']['name'];
            post['message'] = response['message'];
            post['link'] = response['link'];
            post['type'] = response['type'];
            post['comments'] = new Array();
            var comments = response['comments']['data'];
            for (var index in comments) {
                var arr = new Array();
                post['comments'].push(arr);
                arr['user_id'] = comments[index]['from']['id'];
                arr['username'] = comments[index]['from']['name'];
                arr['message'] = comments[index]['message'];
                arr['created_time'] = comments[index]['created_time'];
            }

//                FB.api({
//                    method: 'fql.query',
//                    query: 'SELECT attachment FROM stream WHERE post_id='+post['id']+"'",
//                    return_ssl_resources: 1
//                }, function(response){
//                    
//                    
//                    
//                });

            $('<div>').html(response.description).css({width: '600px', height: '400px', overflow: 'scroll'}).dialog({
                dialogClass: "no-close",
                maxHeight: 400,
                width: 600,
                title: response.name,
                buttons: [
                    {
                        text: "Close",
                        click: function() {
                            $(this).dialog("close");
                        }
                    }
                ],
                close: function() {
                    var index = dialogs.indexOf(id);
                    dialogs.splice(index, 1);
                }
            });
            dialogs[dialogs.length] = id;
        });
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
        $(".imageFrame").click(function() {
            $('<div>').html('').css({width: '640px', height: '480px', overflow: 'scroll', display: 'block'}).dialog({
                dialogClass: "no-close",
                height: 480,
                width: 640,
                title: $(this).siblings('.info').find('.text').html(),
                buttons: [
                    {
                        text: "Save to Favorites",
                        click: function() {
                            $(this).dialog("close");
                        }
                    },
                    {
                        text: "Close",
                        click: function() {
                            $(this).dialog("close");
                        }
                    }
                ]
            });
        })
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
    }
    .posts{
        width:840px;
        margin: 0 auto;
        //border-width: 1px;
        //border-style: solid;
        padding: 10px;
        display:table-cell;
        border-radius: 10px;
        text-align: center;
        /*        border-style: solid;
                border-width:1px;
                border-color: #999;*/
    }

    .post{
        margin:37px;
        height:240px;
        width:198px;
        float:left;
        overflow:hidden;
        border-width: 1px;
        border-style: solid;
        border-color: #999;
        background-color: white;
        box-shadow: 0px 1px 3px 1px #eee;
        border-radius: 6px;
    }

    .post:hover{
        border-color: #e38d13;
        box-shadow: 0px 1px 3px 5px #eee;
    }

    .text{
        float:right;
        width:124px;
        height:60px;
        overflow: hidden;
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
        float:left;
        cursor:default;
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
        z-index:100;
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

</style>
<div id="wrapper">
    <div class="pagewidth">
        <div id="postWrapper">


            <div class="posts">
                <?php
                foreach ($records as $feed) {
                    if (!isset($feed['username']))
                        continue;
                    ?>
                    <div class="post">
                        <?php //if (isset($feed['picture'])) {  ?>
                        <div class="imageFrame">
                            <div class="image">
                                <?=
                                isset($feed['picture']) ?
                                        image($feed['picture'], array('class' => 'picture')) :
                                        image(img_path('no_image_thumb.gif'), array('class' => 'picture'))
                                ?></div>
                        </div>
                        <div class="info">
                            <div class="content">
                                <div class="posted">
                                    <?= isset($feed['user_picture']) ? 
                                        image($feed['user_picture'], array('class' => 'picture')) : 
                                            image(img_path('no-available-cover.png'), array('class' => 'picture')) 
                                    ?>
                                    <div class="userProfile">
                                        <div class="cover"> <?= isset($feed['cover']) ? image($feed['cover'], array('class' => 'picture')) : '' ?> </div>
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
                                                <?= alink($feed['user_link'], 
                                                        image(img_path('fb_icon.gif'), array('class' => 'fb_icon')),
                                                        array('target'=>'_blank', 'id'=>$feed['user_id'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($feed['message'])) {
                                    $cut = strrpos($feed['message'], '\n');
                                } else {
                                    $feed['message'] = '';
                                }
                                ?>
                                <div class="text"><?= isset($cut) && $cut > 0 ? mb_substr($feed['message'], 0, $cut) : mb_substr($feed['message'], 0, 80) ?></div>
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


            </div>
            <div class="paging">
                <ul class="pagination">
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>	
</div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<?php $this->load->view('_blocks/footer') ?>
