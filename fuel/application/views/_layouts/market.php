<?php require_once(APPPATH.'models/facebook_posts_model.php'); ?>
<?php $this->load->view('_blocks/header') ?>

<style>
    html{
        font-family:Tahoma Geogria San-serif;
    }
    .post{
        height:140px;
        border-width: 1px;
        border-style: solid;
        overflow:hidden;
    }
    .image{
        padding:10px;
        float:left;
        width:180px;
        height:120px;
        overflow:hidden;
    }
    .text{
        //float:right;
        margin-top: 20px;
        margin-left:20px;
    }
    .time{
        float:right;
    }
    
    .image img {

        margin: auto; 
    }

</style>
<div id="wrapper">
    <?php 
        $CI->load->model('facebook_posts_model');
        $arr = [];
        $arr['limits'] = 25;
        $feeds = $CI->facebook_posts_model->find_all_array(array(), 'created_time desc',25,0);
        
        function image($feed, $field='picture'){
            if(isset($feed[$field])){
                return sprintf('<img src="%s" height="120" />', $feed[$field]);
            }
            return '';
        }
        
        function text($feed){
            if(isset($feed['message'])){
                return sprintf('<span>%s</span>', $feed['message']);
            }
            else if(isset($feed['description'])){
                return sprintf('<span>%s</span>', $feed['description']);
            }
            return '';
        }
        
        function created_time($feed){
            if(isset($feed['updated_time'])){
                return sprintf('<span>%s</span>', $feed['updated_time']);
            }
            else if(isset($feed['created_time'])){
                return sprintf('<span>%s</span>', $feed['created_time']);
            }
            return '';
        }
        
    ?>

    <div class="pagewidth">
       <table>
        <?php foreach($feeds as $feed){ ?>
        <tr>
            <td>
                <div class="post">
                    <div class="image"><?=image($feed)?></div>
                    <div class="text"><?=text($feed)?></div>
                    <div class="time"><?=created_time($feed)?></div>
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
        } ?>
                
            </td>
        </tr>
            
    </table>
    </div>	
</div>
<?php $this->load->view('_blocks/footer') ?>
