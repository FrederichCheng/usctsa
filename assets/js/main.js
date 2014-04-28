function isExternal(url) {
    var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
    if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol) return true;
    if (typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(":("+{"http:":80,"https:":443}[location.protocol]+")?$"), "") !== location.host) return true;
    return false;
}

function makeAllLinksA(str){
    return str.replace(/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:/~+#-]*[\w@?^=%&amp;/~+#-])?/g,'<a href="$&" target="_blank">$&</a>');
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
                var top = $('#nav_bar').position().top;
                var nav = $('#nav_bar');
                var fixedNav = nav.clone(false);
                fixedNav.addClass('navbar-fixed');
                fixedNav.css('display','none');
                fixedNav.appendTo(nav);
                var animating = false;
                var height = fixedNav.height();
                $(window).scroll(function() {
                    previous = current;
                    current = $(window).scrollTop();
                    
                    if (current-height > top) {
                        //nav.css('display','none');
                        fixedNav.css('display','block');
                        if(previous < current && !animating){
                            fixedNav.animate({top:-height}, 300, function(){animating = false;});
                            animating = true;
                        }
                        else if (previous > current && !animating){
                            fixedNav.animate({top:0}, 300, function(){animating = false;});
                            animating = true;
                        }
                    }
                    if (current < top ) {
                        fixedNav.css("display","none");
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
                            var alink = '<span style="color:blue">'+link+'</span>';
                            if(isExternal(link)){
                                var div = $('<div>').html('You will be redirected to <br/> '+alink+' <br/> Continue?');
                                div.dialog({
                                      title:'Are you leaving now?',
                                      resizable: false,
                                      height:200,
                                      width:400,
                                      modal: true,
                                      buttons: {
                                        "Go to the website": function() {
                                          $( this ).dialog( "close" );
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
