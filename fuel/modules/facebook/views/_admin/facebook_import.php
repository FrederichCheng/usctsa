<div id="fuel_main_content_inner">
    <style>
        #status{
            width:100%;
            height:600px;
            border-width: 1px;
            overflow:scroll;
            border-style: solid;
        }
        
        #completed{
            display:none;
            color:red;
        }
        .response{
            
        }
    </style>
    <div id="container">
        <div id="status"></div>

        <div class="buttonbar">
            <ul>
                <li class="unattached"><a href="#" class="ico ico_yes" id="update">Update Posts</a></li>
                <li class="unattached"><a href="#" class="ico ico_no" id="stop" style="display: none">STOP</a></li>
            </ul>
        </div>
        <div id="completed">Import Completed!</div>
        <?= $this->form->close() ?>
    </div>
</div>
<script>


    function confirmLeaving(){
        return 'Are you sure you want to leave?';
    }

    function FBState() {
        var _this = this;
        this.init = function(){
            _this.fbUri = <?= $GROUP_ID ?> + '/feed';
            _this.prevUri = '';
            _this.cachedResponse = null;
            _this.index = 0;
            _this.running = true;
        };
        this.init();
    }

    

    function updatePost(post) {
        $.post('facebook_post_import.php', JSON.stringify(post), function(response) {
            if (response['success']) {
            }
        });
    }
    
    function nextPage(state){
        state.prevUri = state.fbUri;
        if (typeof (state.cachedResponse['nextPage']) === 'undefined') {
            state.running = false;
            $("#update").css('display', 'block');
            $("#stop").css('display', 'none');
            $("#completed").css('display', 'block');
        }

        state.fbUri = state.cachedResponse['nextPage'];
        state.cachedResponse = null;
        state.index = 0;
    }
    
    function retrieveNextPost(state, callback) {
        if(!state.running)
            return;

        if (null === state.cachedResponse) {
            $('<div>').text('Retrieving posts from Facebook......').appendTo($('#status'));
            $.post('facebook_post_import/fetchPosts', {uri:state.fbUri, fetchUser: true},
                    (function(state, callback) {
                        return function(response){
                            response = JSON.parse(response);
                            if (!response || response.error) {
                                alert("Error happens!");
                                return;
                            }

                            state.cachedResponse = response;
                            var post = state.cachedResponse['data'][state.index++];
                            if(typeof(post) === 'undefined'){
                                nextPage(state);
                                retrieveNextPost(state, callback);
                            }
                            else{
                                callback(post);
                            }
                        };
                    })(state,callback));
        }
        else {
            var post = state.cachedResponse['data'][state.index++];
            if(typeof(post) === 'undefined'){
                nextPage(state);
                retrieveNextPost(state, callback);
            }
            else
                callback(post);
        }
    }
    
    function checkDefined(obj, index){
        if(typeof(obj) === 'undefined')
            return false;
        if(typeof(index) !== 'undefined'){
            if(typeof(obj[index]) === 'undefined')
                return false;
        }
        return true;
    }

    function sendPost(post, action){
        
        var request = {
            option : action,
            data : post
        };
        
        $.post('<?= uri_path('facebook_post_import.php')?>', request, 
        (function(post){
            return function(response) {
                var msg = 'fails to import';
                response = JSON.parse(response);
                
                if(response && response['msg']){
                    msg = response['msg'];
                }
                
                var link = $('<a class="post_link">').attr('href',post['post_link']).attr('target','_blank').text((post['id']));
                var span = $('<span class="response">').text("["+msg+"]");
                $('<div>').append(link).append(span).appendTo($('#status'));
            };
        })(post));
    }

    
////                FB.api({
////                    method: 'fql.query',
////                    query: 'SELECT attachment FROM stream WHERE post_id='+post['id']+"'",
////                    return_ssl_resources: 1
////                }, function(response){
////                    
////                    
////                    
////                });
//                });
//    }


    (function() {
        $(document).ready(
            

            function() {
//                FB.init({
//                    appId: '<?= $APP_ID ?>', // App ID
//                    status: true, // check login status
//                    cookie: true, // enable cookies to allow the server to access the session
//                    xfbml: true  // parse XFBML
//                });

                
                var state = new FBState();

                $("#stop").click(function(){
                    state.running = false;
                    $("#update").css('display', 'block');
                    $(this).css('display', 'none');
                    $(window).off('beforeunload', confirmLeaving);
                });

                $('#status').bind("imported", function(){
                    retrieveNextPost(state, 
                        function(data){
                            sendPost(data,'import');
                            if(state.running)
                                $("#status").trigger("imported");
                        }
                    );
                });

                $("#update").click(function() {
//                    $.post('facebook_post_import/fetchPosts',{uri:'12171823426/feed'},function(data){
//                        alert(JSON.stringify(data));
//                    });
                
                    state.init();
                    $(this).css('display', 'none');
                    $('#stop').css('display', 'block');
                    $('#completed').css('display','none');
                    $('#status').html('');
                    $(window).on('beforeunload', confirmLeaving);
                    $("#status").trigger("imported");
                });
                
            }
        );
    })();


</script>
<!--
<script src="http://connect.facebook.net/en_US/all.js"></script>-->