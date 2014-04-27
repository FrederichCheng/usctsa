function isExternal(url) {
    var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
    if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol) return true;
    if (typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(":("+{"http:":80,"https:":443}[location.protocol]+")?$"), "") !== location.host) return true;
    return false;
}

(
        function initialize($) {
            $("#nav").ready(
                    function() {
                        $("#nav").load('nav.html');
                    });
            
            
            $(document).ready(function() {
                var current = 0;
                var previous = 0;
                $(window).scroll(function() {
                    previous = current;
                    current = $(window).scrollTop();
                    if (current > 138) {
                        $('#nav_bar').addClass('navbar-fixed');
                        if(previous < current){
                            $('#nav_bar').css("display","none");
                        }
                        else{
                            $('#nav_bar').css("display","block");
                        }
                    }
                    if (current < 135) {
                        $('#nav_bar').removeClass('navbar-fixed');
                        $('#nav_bar').css("display","block");
                    }
                });
            });
            
            
            $(document).ready(function() {
            	$(".acc-trigger").siblings().hide();
                $(".acc-trigger").click(function() {
	            	if ($(this).siblings().is(":hidden"))
	            	{
	              		$(this).siblings().slideToggle(250);
	              	   	$(this).children().css("background", "url(assets/images/accordion-minus.png) no-repeat right 55%");
	              	} 
	            	else 
	            	{
	              		$(this).siblings().slideToggle(250);
	              	 	$(this).children().css("background", "url(assets/images/accordion-plus.png) no-repeat right 55%");
	              	}
                });
                
                $("nav ul li a").click(
                        function(){
                            var link = $(this).attr('href');
                            if(isExternal(link)){
                                var div = $('<div>').html('You are leaving this website, are you sure ?');
                                div.dialog({
                                      title:'Are you leaving now?',
                                      resizable: false,
                                      height:200,
                                      modal: true,
                                      buttons: {
                                        "Leave": function() {
                                          window.location.href = link;
                                        },
                                        "Stay here": function() {
                                          $( this ).dialog( "close" );
                                        }
                                      }
                                    });
                                return false;
                            }
                            else{
                                return true;
                            }
                        }
                );
                
            });
            
              
        }
)(jQuery);
