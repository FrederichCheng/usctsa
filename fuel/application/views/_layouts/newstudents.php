<!-- last modified date: Apr 3, 2014 by sky -->

<?php $this->load->view('_blocks/header') ?>
<?= css('newstudents.css') ?>
<?=css('housePicDetail.css')?>
<?=js('slidepics.js')?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<?=js('map.js')?>

		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#"><?=fuel_var('first_scroller', 'First')?></a></li>
				<li><a href="#"><?=fuel_var('second_scroller', 'Second')?></a></li>
				<li><a href="#"><?=fuel_var('third_scroller', 'Third')?></a></li>
				<li><a href="#"><?=fuel_var('fourth_scroller', 'Fourth')?></a></li>
				<li><a href="#"><?=fuel_var('fifth_scroller', 'Fifth')?></a></li>                              
                <li><a href="#"><?=fuel_var('sixth_scroller', 'Sixth')?></a></li>
                <li><a href="#"><?=fuel_var('seventh_scroller', 'Seventh')?></a></li>
                <li><a href="#"><?=fuel_var('eighth_scroller', 'Eighth')?></a></li>
                <li><a href="#"><?=fuel_var('ninth_scroller', 'Ninth')?></a></li>
                <li><a href="#"><?=fuel_var('tenth_scroller', 'Tenth')?></a></li>
            	<!-- <li><a href="#"><?= lang('tsa_housing_apartment') ?></a></li> -->
			</ul>
		</div>
	
		<!-- nav content -->
		<div id="wrapper">
			<div id="main">
				
				<!-- First -->
				<div class="section">
		        	<h1><?=fuel_var('first_heading', 'First')?></h1>
		        	<p><?=fuel_var('first_description', '')?></p>
					<p><?=fuel_var('first_sections')?></p>
				</div> <!-- End of section -->
				
				<!-- Second -->		
				<div class="section">
		        	<h1><?=fuel_var('second_heading', 'Second')?></h1>
		        	<p><?=fuel_var('second_description', '')?></p>
					<p><?=fuel_var('second_sections')?></p>
				</div> <!-- End of section -->			

				<!-- Third -->		
				<div class="section">
		        	<h1><?=fuel_var('third_heading', 'Third')?></h1>
		        	<p><?=fuel_var('third_description', '')?></p>
					<p><?=fuel_var('third_sections')?></p>
				</div> <!-- End of section -->	
				
				<!-- Fourth -->		
				<div class="section">
		        	<h1><?=fuel_var('fourth_heading', 'Fourth')?></h1>
		        	<p><?=fuel_var('fourth_description', '')?></p>
					<p><?=fuel_var('fourth_sections')?></p>
				</div> <!-- End of section -->	
				
				<!-- Fifth -->		
				<div class="section">
		        	<h1><?=fuel_var('fifth_heading', 'Fifth')?></h1>
		        	<p><?=fuel_var('fifth_description', '')?></p>
					<p><?=fuel_var('fifth_sections')?></p>
				</div> <!-- End of section -->	
				
				<!-- Sixth -->
				<div class="section">
					<h1><?=fuel_var('sixth_heading', 'Sixth')?></h1>
					<p><?=fuel_var('sixth_description', '')?></p>
					<p><?=fuel_var('sixth_sections')?></p>
				</div> <!-- End of section -->  
				
				<!-- Seventh -->
				<div class="section">
					<h1><?=fuel_var('seventh_heading', 'Seventh')?></h1>
					<p><?=fuel_var('seventh_description', '')?></p>
					<p><?=fuel_var('seventh_sections')?></p>
				</div> <!-- End of section -->  
				
				<!-- Eighth -->
				<div class="section">
					<h1><?=fuel_var('eighth_heading', 'Eighth')?></h1>
					<p><?=fuel_var('eighth_description', '')?></p>
					<p><?=fuel_var('eighth_sections')?></p>
				</div> <!-- End of section -->

				<!-- Ninth -->
				<div class="section">
					<h1><?=fuel_var('ninth_heading', 'Ninth')?></h1>
					<p><?=fuel_var('ninth_description', '')?></p>
					<p><?=fuel_var('ninth_sections')?></p>
				</div> <!-- End of section -->
								
				<!-- Tenth -->
				<div class="section">
					<h1><?=fuel_var('tenth_heading', 'Tenth')?></h1>
					<p><?=fuel_var('tenth_description', '')?></p>
					<p><?=fuel_var('tenth_sections')?></p>
				</div> <!-- End of section -->  
				
				<!-- Third -->
				<!-- <div class="section">
			        <h1><?=fuel_var('recv_heading', '')?></h1>
					<p><?=fuel_var('recv_description', '')?></p> -->
			
			        <!-- Accordion -->
			        <!-- <?php foreach($recv_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p><?= $section['content'] ?></p>
			            </div>
			 		</div>
					<?php } ?> -->
				<!-- </div> --> <!-- End of section -->				
				
			</div><!-- [END] #main -->
			
			<script type="text/javascript">
				$(document).ready(function(){
					$('body').pageScroller({navigation: '#navscroll'});
				});	
			</script>
			
		</div><!-- [END] #wrapper -->

<?php $this->load->view('_blocks/footer') ?>