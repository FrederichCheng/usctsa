<!-- last modified date: Apr 3, 2014 by sky -->

<?php $this->load->view('_blocks/header') ?>


		<link rel="stylesheet" type="text/css" href="<?= assets_path('css/newstudents.css') ?>">
		
		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#"><?=fuel_var('top_scroller', 'Top')?></a></li>
				<li><a href="#"><?=fuel_var('tw_office_scroller', 'Taiwan Office')?></a></li>
				<li><a href="#"><?=fuel_var('recv_scroller', 'Materials Receiving')?></a></li>
				<li><a href="#"><?=fuel_var('important_scroller', 'Important Notes')?></a></li>
				<li><a href="#"><?=fuel_var('experience_scroller', 'Experience Sharing')?></a></li>
				<li><a href="#"><?=fuel_var('useful_scroller', 'Useful Websites')?></a></li>
			</ul>
		</div>
	
		<!-- nav content -->
		<div id="wrapper">
			<div id="main">
				
				<!-- Top -->
				<div class="section">
		        	<h1><?=fuel_var('top_heading', 'Top')?></h1>
		        	<p><?=fuel_var('top_description', '')?></p>
					<p><?=fuel_var('top_sections')?></p>
				</div> <!-- End of section -->
				
				
				<!--  USC Taiwan Office -->				
				<div class="section">
		        	<h1><?=fuel_var('tw_office_heading', 'USC Taiwan Office')?></h1>
		        	<p><?=fuel_var('tw_office_description', '')?></p>
					<p><?=fuel_var('tw_office_sections')?></p>
				</div> <!-- End of section -->			
				
				
				<!-- Materials You Will Receive -->
				<div class="section">
			        <h1><?=fuel_var('recv_heading', 'Materials You Will Receive')?></h1>
					<p><?=fuel_var('recv_description', '')?></p>
			
			        <!-- Accordion -->
			        <?php foreach($recv_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p><?= $section['content'] ?></p>
			            </div>
			 		</div>
					<?php } ?>
				</div> <!-- End of section -->				
				
				
				<!-- Important Notes -->
				<div class="section">
			        <h1><?=fuel_var('important_heading', 'Important Notes')?></h1>
			        <p><?=fuel_var('important_description', '')?></p>
			
			        <!-- Accordion -->
			        <?php foreach($important_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p><?= $section['content'] ?></p>
			            </div>
			 		</div>
					<?php } ?>					
				</div> <!-- End of section -->
				
				
				<!-- Experience Sharing -->
				<div class="section">
			        <h1><?=fuel_var('experience_heading', 'Experience Sharing')?></h1>
			        <p><?=fuel_var('experience_description', '')?></p>			
			
			        <!-- Accordion -->
			        <?php foreach($experience_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p><?= $section['content'] ?></p>
			            </div>
			 		</div>
					<?php } ?>						
				</div> <!-- End of section -->	
							
				
				<!-- Useful Websites -->
				<div class="section">
					<h1><?=fuel_var('useful_heading', 'Useful Websites')?></h1>
					<p><?=fuel_var('useful_description', '')?></p>
					<p><?=fuel_var('useful_sections')?></p>
				</div> <!-- End of section -->
				
			</div><!-- [END] #main -->
			
			<script type="text/javascript">
				$(document).ready(function(){
					$('body').pageScroller({navigation: '#navscroll'});
				});	
			</script>
	
			
<?php $this->load->view('_blocks/footer') ?>