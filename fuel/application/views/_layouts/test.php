<?php 

require_once(APPPATH.'models/facebook_posts_model.php');

class Feed{
    var $data;
    var $user_id;
    var $username;
    var $type;  //status, photo, link, video
    
    function __construct($feed){
        $this->data = $feed;
        $this->id = $feed['id'];
        $this->user_id = $feed['from']['id'];
        $this->username = $feed['from']['name'];
        
        
        $this->type = $feed['type'];
        
        if($this->type === 'photo'){
            $this->link = $feed['link'];
            $this->created_time = $feed['created_time'];
            $this->object_id = $feed['object_id'];
            if(array_key_exists('description', $feed)){
                $this->description = $feed['description'];
            }
            if(array_key_exists('message', $feed)){
                $this->message = $feed['message'];
            }
        }
        else if($this->type === 'link'){
            $this->link = $feed['link'];
            
            if(array_key_exists('message', $feed)){
                $this->message = $feed['message'];
            }
            
            if(array_key_exists('description', $feed)){
                $this->description = $feed['description'];
            }
            //$this->icon = $feed['icon'];
            //$this->name = $feed['name'];
            if(array_key_exists('picture', $feed)){
                $this->picture = $feed['picture'];
            }
            $this->created_time = $feed['created_time'];
        }
        
        else if($this->type === 'status'){
            if(array_key_exists('message', $feed)){
                $this->message = $feed['message'];
            }
            else{
                $this->message = 'None';
            }
            $this->updated_time = $feed['updated_time'];
        }
        else if($this->type === 'video'){
            
        }
        else if($this->type === 'checkin'){
            
        }
        else if($this->type === 'question'){
            
        }
        else if($this->type === 'review'){
            
        }
        else if($this->type === 'offer'){
            
        }
    }
}


class PhotoFeed{
    var $data;
    var $user_id;
    var $username;
    var $type;  //status, photo, link, video
    
    function __construct($feed){
        $this->data = $feed;
        $this->images = array();
        
        foreach($feed['media'] as $media){
            $this->images[]= sprintf('<img src="%s" />', 
                    $media['src']);
        }
        
    }
}

$this->load->view('_blocks/header')?>
	
	<section id="main_inner">
		<?php echo fuel_var('body', 'This is a default layout. To change this layout go to the fuel/application/views/_layouts/main.php file.'); ?>
	</section>
	<?php
            $CI->load->model('facebook_posts_model');

            require_once(FUEL_FOLDER.'/FacebookSDK/facebook.php');
            $facebook = new Facebook(array(
                'appId'  => '258287400999278',
                'secret' => 'a993a2c7a87605ed6efa9877e6641112',
              ));
            
            $prev_uri = null;
            $uri = '/12171823426/feed';
            $page = 1;
            $feeds = array();
            $fields = array('description', 'message', 'created_time', 'updated_time', 'link', 'picture');
            while($prev_uri !== $uri){
                $response = $facebook->api($uri);  
                foreach($response['data'] as $feed){
                    $record = array();
                    $record['facebook_id'] = $feed['id'];
                    $record['user_id'] = $feed['from']['id'];
                    $record['username'] = $feed['from']['name'];
                    foreach($fields as $field){
                        if(array_key_exists($field, $feed)){
                            $record[$field] = $feed[$field];
                        }
                    }
                    $CI->facebook_posts_model->save($record);
                }
                $prev_uri = $uri;
                if(!isset($response['paging'])){
                    break;
                }
                $uri = str_replace('https://graph.facebook.com/', '',$response['paging']['next']);
                $page++;
            }
        ?>
<table style="border-width:1px; border-style: solid;">
        <!--?php foreach($feeds as $feed){ ?>
        <tr style="border-width:1px; border-style: solid;">
            <td>
        
            $record = array();
            $record['facebook_id'] = $feed->id;

            if(array_key_exists('description', $feed)){
                $record['description'] = $feed->description;
                echo $feed->description;
            }

            if(array_key_exists('message', $feed)){
                $record['message'] = $feed->message;
                echo $feed->message;
            }
            
            if(array_key_exists('created_time', $feed)){
                $record['created_time'] = $feed->created_time;
                echo $feed->created_time;
            }
            if(array_key_exists('updated_time', $feed)){
                $record['updated_time'] = $feed->updated_time;
                echo $feed->updated_time;
            }
            if(array_key_exists('link', $feed)){
                $record['link'] = $feed->link;
                 echo 'link: <a href="'.$feed->link.'">'.$feed->link.'</a><br/>';
            }
            if(array_key_exists('picture', $feed)){
                echo 'img:<img src="'.$feed->picture.'" /><br/>';
                $record['picture'] = $feed->picture;
            }
           
            
            
//                    $params = array('method' => 'fql.query',
//                                'query' => sprintf('SELECT attachment FROM stream WHERE post_id="%s"', $feed->id));
//                    //echo var_dump($facebook->api($params));
//                    $photo = new PhotoFeed($facebook->api($params)[0]['attachment']);
//                    
//                    foreach($photo->images as $image){
//                        echo $image;
//                    }
                //$CI->facebook_posts_model->save($record);
                ?>
                
            </td>
            </tr> -->
            
</table>
<?php $this->load->view('_blocks/footer')?>
