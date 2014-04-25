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

    function FBState() {
        var _this = this;
        this.init = function(){
            _this.fbUri = '/' + <?= $GROUP_ID ?> + '/feed';
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
        if (typeof (state.cachedResponse['paging']) === 'undefined') {
            state.running = false;
            $("#update").css('display', 'block');
            $("#stop").css('display', 'none');
            $("#completed").css('display', 'block');
        }

        state.fbUri = state.cachedResponse['paging']['next'].replace('https://graph.facebook.com/', '');
        state.cachedResponse = null;
        state.index = 0;
    }
    
    function retrieveNextPost(state, callback) {
        if(!state.running)
            return;

        if (null === state.cachedResponse) {
            FB.api(state.fbUri,
                    (function(state, callback) {
                        return function(response){
                            if (!response || response.error) {
                                alert(response.error);
                                return;
                            }

                            state.cachedResponse = response;
                            var data = state.cachedResponse['data'][state.index++];
                            if(typeof(data) === 'undefined'){
                                nextPage(state);
                                retrieveNextPost(state, callback);
                            }
                            else{
                                callback(data);
                            }
                        };
                    })(state,callback));
        }
        else {
            var data = state.cachedResponse['data'][state.index++];
            if(typeof(data) === 'undefined'){
                nextPage(state);
                retrieveNextPost(state, callback);
            }
            else
                callback(data);
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
    
    function retrieveUser(id,data, callback){
        FB.api('/'+id+'?fields=picture,link,gender,cover',  (function(id,data,callback){
            return function(response){
                data['user_picture'] = checkDefined(response,'picture') ? response['picture']['data']['url'] : null;
                data['user_cover'] = checkDefined(response,'cover') ? response['cover']['source'] : null;
                data['gender'] = checkDefined(response,'gender') ? response['gender'] : null;
                data['user_link'] = 'http://www.facebook.com/' + id;
                callback(data);
            };
        })(id,data,callback));
    }

    function sendPost(data, action){
        var request = {
            option : action,
            data : data
        };
        
        $.post('<?= uri_path('facebook_post_import.php')?>', request, 
        (function(data){
            return function(response) {
                var msg = 'fails to import';
                response = JSON.parse(response);
                
                if(response && response['msg']){
                    msg = response['msg'];
                }
                
                var link = $('<a class="post_link">').attr('href',data['actions'][0]['link']).attr('target','_blank').text((data['id']));
                var span = $('<span class="response">').text("["+msg+"]");
                $('<div>').append(link).append(span).appendTo($('#status'));
            };
        })(data));
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
                FB.init({
                    appId: '<?= $APP_ID ?>', // App ID
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true  // parse XFBML
                });

                
                var state = new FBState();

                $("#stop").click(function(){
                    state.running = false;
                    $("#update").css('display', 'block');
                    $(this).css('display', 'none');
                });

                $('#status').bind("imported", function(){
                    retrieveNextPost(state, 
                        function(data){
                            retrieveUser(data['from']['id'], data,
                            function(data){
                                sendPost(data,'import');
                                if(state.running)
                                    $("#status").trigger("imported");
                            });
                        }
                    );
                });

                $("#update").click(function() {
                    state.init();
                    $("#status").trigger("imported");
                    $(this).css('display', 'none');
                    $('#stop').css('display', 'block');
                    $('#completed').css('display','none');
                    $('#status').html('');
                });
            }
        );
    })();


</script>

<script src="http://connect.facebook.net/en_US/all.js"></script>