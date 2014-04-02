<!DOCTYPE html> <!-- HTML5 declaration -->

<html>

	<head>
        <meta charset="UTF-8">
        <title>USC TSA</title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/jobs.css">
        
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/jquery.pagescroller.lite.js"></script><!-- link pagescroller lite js file -->

		<script type="text/javascript">
			$(document).ready(function(){
				// initiate page scroller plugin
				$('body').pageScroller({
					navigation: '#navscroll'
				});
			});
		</script>
	</head>
	
	<body>
		<!-- top nav template -->
		<div id="nav"></div> <!-- using javascript to load nav.html -->   		
		
		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#">Top</a></li>
				<li><a href="#">Job Opportunity</a></li>
				<li><a href="#">Experience Sharing</a></li>
				<li><a href="#">Useful Websites</a></li>
			</ul>
		</div>
	
		<!-- nav content -->
		<div id="wrapper">
			<div id="main">
			
				<!-- Top -->
				<div class="section">
					<div class="cover_photo">
						
					</div>
				</div>

				<!-- Job Opportunity -->
				<div class="section">
					<h1>Jop Opportunity</h1>
				</div>
			
				<!-- Experience Sharing -->
				<div class="section">
					<h1>Experience Sharing</h1>
				</div>
				
				<!-- Useful Websites -->
				<div class="section">
					<h1>Useful Websites</h1>
					<ul>
						<li><a href="http://www.usc.edu/student-affairs/OIS/" target="_blank">Office of International Services</a></li>
						
						<li><a href="http://itservices.usc.edu" target="_blank">Information Technology Services</a></li>
						
						<li><a href="http://dornsife.usc.edu/ali/" target="_blank">American Language Institute</a></li>
						
						<li><a href="http://transportation.usc.edu" target="_blank">USC Transportation</a></li>
						
						<li><a href="http://web-app.usc.edu/maps/" target="_blank">USC Maps</a></li>
						
						<li><a href="http://dailytrojan.com/" target="_blank">Daily Trojan</a></li>
					
						<li><a href="http://scampus.usc.edu/" target="_blank">SCampus</a></li>
					</ul>
				</div>
			
			</div><!-- [END] #main -->
			
			
            <!-- footer -->
            <footer>
                <div class="footer">
                    <p> Copyright &copy; 2014 The University of Southern California Taiwanese Student Association </p>
                </div>
            </footer>			
			
		</div><!-- [END] #wrapper -->
		
	</body>
</html>