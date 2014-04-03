<?php $this->load->view('_blocks/header') ?>

		<link rel="stylesheet" type="text/css" href="assets/css/newstudents.css">
		
		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#">Top</a></li>
				<li><a href="#">Taiwan Office</a></li>
				<li><a href="#">Materials Receiving</a></li>
				<li><a href="#">Important Notes</a></li>
				<li><a href="#">Experience Sharing</a></li>
				<li><a href="#">Useful Websites</a></li>
			</ul>
		</div>
	
		<!-- nav content -->
		<div id="wrapper">
			<div id="main">

				<!-- Top -->
				<div class="section">
		        	<h1>
		        		<?=fuel_var('top_heading', 'Top')?>
		        	</h1>
				
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
						<span lang="EN-US" style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
							<?=fuel_var('top_sections')?>
						</span>
					</p>
				</div>
				
				
				<!--  USC Taiwan Office -->				
				<div class="section">
		        	<h1>
		        		<?=fuel_var('tw_office_heading', 'USC Taiwan Office')?>
		        	</h1>
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
						<span lang="EN-US" style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
							<?=fuel_var('tw_office_sections')?>
						</span>
					</p>
					

				</div>				
				
				
				<!-- Materials You Will Receive -->
				<div class="section">
					
					<!-- Headline -->
			        <div class="headline"><h1><?=fuel_var('recv_heading', 'Materials You Will Receive')?></h1></div>
					
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
					<span style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
					正常的情況下，你應該會陸續收到：</span>
			
			        <!-- Accordion -->
			        <?php foreach($recv_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p>
								<?= $section['content'] ?>
			                </p>
			            </div>
			 		</div>
					<?php } ?>			
				
				</div>				
				
				
				<!-- Important Notes -->
				<div class="section">
				
					<!-- Headline -->
			        <div class="headline"><h1><?=fuel_var('recv_heading', 'Important Notes')?></h1></div>
			
			        <!-- Accordion -->
			        <?php foreach($important_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p>
								<?= $section['content'] ?>
			                </p>
			            </div>
			 		</div>
					<?php } ?>					
				
				</div> <!-- End of section -->
				
				
				<!-- Experience Sharing -->
				<div class="section">
				
					<!-- Headline -->
			        <div class="headline"><h1><?=fuel_var('experience_heading', 'Experience Sharing')?></h1></div>
					<p>
						在你開始聯絡其他學長姐,&nbsp;詢問各種你關心的問題之前,&nbsp;有些寶貴的前人經驗,&nbsp;與你分享一下&nbsp;
						讓赴美之旅更順暢﹗除了截至目前為止,&nbsp;多位新生們針對大家憂心的議題提供個人經驗與心得外,&nbsp;
						下方辦事處也集結了一些重點供大家參考!!
					</p>			
			
			        <!-- Accordion -->
			        <?php foreach($experience_sections as $section){ ?>
			        <div class="acc-container">
			        	<span class="acc-trigger"><a href="#" onClick="return false;"><?=$section['title']?></a></span>
			            <div class="content">
			                <p>
								<?= $section['content'] ?>
			                </p>
			            </div>
			 		</div>
					<?php } ?>						
					
				</div>				
				
				<!-- Useful Websites -->
				<div class="section">
					<h1>
		        		<?=fuel_var('links_heading', 'Useful Websites')?>
		        	</h1>
				
					<ul>
						<?=fuel_var('links_sections')?>
					</ul>
				</div>				
				
				
			</div><!-- [END] #main -->
			
			<script type="text/javascript">
				$(document).ready(function(){
					$('body').pageScroller({navigation: '#navscroll'});
				});	
			</script>
			
<?php $this->load->view('_blocks/footer') ?>