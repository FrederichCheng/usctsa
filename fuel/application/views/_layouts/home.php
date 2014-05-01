<!-- Last Modified Date: Apr 17, 2014 By Sky -->

<?php $this->load->view('_blocks/header') ?>


	<link rel="stylesheet" type="text/css" href="<?= assets_path('css/home.css"') ?>">


	<div id="wrapper">
	
	    <!-- Cover Photo -->
	    <div class="pagewidth">
	
	        <!-- Start WOWSlider.com BODY section id=wowslider-container1 -->
	        <div id="wowslider-container1">
	            <div class="ws_images"><ul>
                            <li><img src='<?=img_path(fuel_var('cover_photo_1', 'cover_photo_1.jpg'))?>' id="wows1_0"/></li>
	                    <li><img src='<?=img_path(fuel_var('cover_photo_2', 'cover_photo_2.jpg'))?>' id="wows1_1"/></li>
	                    <li><img src='<?=img_path(fuel_var('cover_photo_3', 'cover_photo_3.jpg'))?>' id="wows1_2"/></li>
	                    <li><img src='<?=img_path(fuel_var('cover_photo_4', 'cover_photo_4.jpg'))?>' id="wows1_3"/></li>
	                </ul></div>
	            <div class="ws_bullets"><div>
                            <a href="#wows1_0" ><img src='<?=assets_path('data1/tooltips/'.fuel_var('cover_photo_1', 'cover_photo_1.jpg'))?>' />1</a>
	                    <a href="#wows1_1" ><img src='<?=assets_path('data1/tooltips/'.fuel_var('cover_photo_2', 'cover_photo_2.jpg'))?>' />2</a>
	                    <a href="#wows1_2" ><img src='<?=assets_path('data1/tooltips/'.fuel_var('cover_photo_3', 'cover_photo_3.jpg'))?>' />3</a>
	                    <a href="#wows1_3" ><img src='<?=assets_path('data1/tooltips/'.fuel_var('cover_photo_4', 'cover_photo_4.jpg'))?>' />4</a>
	                </div></div>
	            <!-- <span class="wsl"><a href="http://wowslider.com">Slideshow CSS3</a> by WOWSlider.com v5.0m</span> -->
	            <a href="#" class="ws_frame"></a>
	            <div class="ws_shadow"></div>
	        </div>
	        <script type="text/javascript" src="<?=assets_path('js/engine1/wowslider.js')?>"></script>
	        <script type="text/javascript" src="<?=assets_path('js/engine1/script.js')?>"></script>
	        <!-- End WOWSlider.com BODY section -->
	
	    </div>
	
		<div id="main">
		
		    <!-- Announcements -->
		    <div class="section">
				<!-- Headline -->
		        <h1><?=fuel_var('heading', lang('tsa_default_announcement_heading'))?></h1>
		
		        <!-- Accordion -->
		        <?php foreach($sections as $section){ ?>
		        <div class="acc-container">
		        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
		            <div class="content">
		                <p><?= $section['content'] ?></p>
		            </div>
		 		</div>
				<?php } ?>
		    </div>
		    
		</div><!-- [END] #main -->

        </div>
<?php $this->load->view('_blocks/footer') ?>