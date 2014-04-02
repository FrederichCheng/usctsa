(
        function initialize($) {
            $("#nav").ready(
                    function() {
                        $("#nav").load('nav.html');
                    });
            
            
            $(document).ready(function() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() > 138) {
                        $('#nav_bar').addClass('navbar-fixed');
                    }
                    if ($(window).scrollTop() < 135) {
                        $('#nav_bar').removeClass('navbar-fixed');
                    }
                });
            });
            
            
            $(document).ready(function() {
            	$(".acc-trigger").siblings().hide();
                $(".acc-trigger").click(function() {
	            	if ($(this).siblings().is(":hidden"))
	            	{
	              		$(this).siblings().slideToggle(250);
	              	   	$(this).children().css("background", "url(images/accordion-minus.png) no-repeat right 55%");
	              	} 
	            	else 
	            	{
	              		$(this).siblings().slideToggle(250);
	              	 	$(this).children().css("background", "url(images/accordion-plus.png) no-repeat right 55%");
	              	}
                });
            });
              
        }
)(jQuery);
