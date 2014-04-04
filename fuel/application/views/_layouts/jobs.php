<!-- last modified date: Apr 3, 2014 by sky -->

<?php $this->load->view('_blocks/header') ?>


		<link rel="stylesheet" type="text/css" href="assets/css/jobs.css">
		
		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#"><?=fuel_var('top_scroller', 'Top')?></a></li>
				<li><a href="#"><?=fuel_var('opportunity_scroller', 'Job Opportunity')?></a></li>
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
				</div>

				
				<!-- Job Opportunity -->
				<div class="section">
					<h1><?=fuel_var('opportunity_heading', 'Job Opportunity')?></h1>
					<p><?=fuel_var('opportunity_description', '')?></p>	
					
					<div class="scrollbar" id="ex3">
				    	<div class="content">
				    		<table id="job_table">
						       	<!-- Accordion -->
						        <?php foreach($opportunity_sections as $section){ ?>
						        	<tr class="table_row">
						        		<td class="first_col">
						        			<p class="job_title">
						        				<a href='<?=$section['link']?>' >
													<?=$section['title']?>
												</a>
											</p>
						        			<p class="job_type"><?= $section['job_type'] ?></p>
							        		<p class="job_description"><?= $section['job_description'] ?>
							        			<a href='<?=$section['link']?>' >more...</a>
							        		</p>
							        	</td>
							        	<td class="second_col">
							       			<p><?= $section['company'] ?></p>
							       		</td>
							       		<td class="third_col">
							       			<p><?= $section['location'] ?></p>
							       		</td>
							       	</tr>
							       	<tr>
							       		<td class="divider" colspan="3"></td>
							       	</tr>
								<?php } ?>	
							</table>
						</div>   
					</div>
				</div>

				
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