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
            });
            
              
        }
)(jQuery);
