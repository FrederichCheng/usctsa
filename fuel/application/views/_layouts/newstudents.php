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
				<li><a href="#"><?=fuel_var('top_scroller', 'Top')?></a></li>
				<li><a href="#"><?=fuel_var('tw_office_scroller', 'Taiwan Office')?></a></li>
				<li><a href="#"><?=fuel_var('recv_scroller', 'Materials Receiving')?></a></li>
				<li><a href="#"><?=fuel_var('important_scroller', 'Important Notes')?></a></li>
				<li><a href="#"><?=fuel_var('experience_scroller', 'Experience Sharing')?></a></li>                              
                                <li><a href="#"><?=fuel_var('useful_scroller', 'Useful Websites')?></a></li>
                                <li><a href="#"><?= lang('tsa_housing_apartment') ?></a></li>
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
                                
<!-- Housing Apartment -->
                                
<div class="section">
        <h1><?= lang('tsa_housing_apartment') ?></h1>
        <div class="housing-map" style="height:500px;">
              <?php $link="https://mapsengine.google.com/map/u/0/kml?mid=zYjzcxdR19fg.kvE0EHfKh8tc&cid=mp&cv=yCsoPjplrX0.zh_TW" ?>
            
        </div>
        
        <script type="text/javascript">
            (function(){
                var canva = $('.housing-map').get(0);
                var url = <?php $link ?>;
                                                                
                var usc = new google.maps.LatLng(34.02541587908883,-118.27750042546387);
                
                var mapOptions = {
                    center: usc
                };
                
                var map = new google.maps.Map(canva, mapOptions);
                var ctaLayer = new google.maps.KmlLayer({
                    url: url
                });
                ctaLayer.setMap(map);
            })();
            
        </script>
        
        <?php $num=1; ?>
        <?php $id="id='imgB"; ?>
        <?php $id_dialog="id='dialog" ?>
        <?php $no="no='"; ?>    
        <?php foreach ($apartment_sections as $value) { ?>
            <table class="housing" border="2">
                <tr>
                    <td >
                        <img src="<?= img_path($value['house_img']) ?>" alt="House image" <?php echo $no.$num."'"; ?> class="housing_pic img-thumbnail mouse_over" />

                        <!-- House Details show in dialog-->
                        <div <?php echo $id_dialog.$num."'";?>  class="dialog" title="House Details:">
                            <div id="showbox">
                                <div id="showImg">
                                    <table>
                                        <tr>
                                            <td >
                                                <img src="<?= img_path($value['house_img']) ?>"  class="img-thumbnail" <?php echo $id.$num."'"; ?>/>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="imgList">    	
                                    <span id="prv"><a href="#"><img src="<?=img_path('left_arrow.gif')?>" border="0"/></a></span>           
                                    <div id="list">
                                        <ul>
                       <?php foreach ($value['photos'] as $image) {   ?>
                              
                                                <li> <img src="<?=img_path($image['photo'])  ?>" <?php echo $no.$num."'"; ?> class="mouse_over"/>
                                                </li>  
                                                    <?php } ?>              
                                          
                                        </ul>
                                    </div>
                                    <span id="next"><a href="#"><img src="<?=img_path('right_arrow.gif')?>" border="0"/></a></span>    
                                </div>
                            </div>


                            <div class="description">
                                <span><strong><?= lang('tsa_housing_des') ?>:</strong><?= $value['description'] ?><br /> </span>
                                
                                <span><strong><?= lang('tsa_housing_loc') ?>:</strong><?= $value['location'] ?><br/> </span>
                                <span><strong><?= lang('tsa_housing_style') ?>:</strong><?= $value['style'] ?><br /> </span>
                                <span><strong><?= lang('tsa_housing_park') ?>:</strong><?= $value['parking'] ?><br/> </span>
                                <span><strong><?= lang('tsa_housing_tel') ?>:</strong><?= $value['phone'] ?><br /> </span>
                                <span><strong><?= lang('tsa_housing_email') ?>:</strong><?= $value['email'] ?><br /> </span>
                                <br />
                                <span><h4 id="price"><?= lang('tsa_housing_price') ?>: <?= $value['price'] ?> </h4> </span>
                                <span>
                                <?= $value['house_map'] ?>
                                </span>
                            </div>

                        </div>
                    </td>

                    <td class="housing_descript" valign="top">
                        <span><strong><?= lang('tsa_housing_loc') ?>:</strong> <?= $value['location'] ?> <br /> </span> 
                        <span><strong><?= lang('tsa_housing_price') ?>:</strong> <?= $value['price'] ?>/month<br/><br /></span>

                        <span><strong><?= lang('tsa_housing_des') ?>:</strong>
                        <?= $value['description'] ?>
                        </span>

                    </td>
                   </table>
           <?php $num++; ?>
        <?php } ?>   
            

        <br/><br/>
       

        <script type="text/javascript">
            $(document).ready(function() {
                $(".housing_pic").click(
                        function() {
                            $("#dialog"+$(this).attr('no')).dialog({ //找到點選.housing_pic的attribute為no的值，附加到dialog的id之後
                                
                                maxHeight: 600,
                                maxWidth: 800,
                                height: 600,
                                width: 800,
                                show: {
                                    effect: "blind",
                                    duration: 1000,
                                },
                                hide: {
                                    effect: "slide",
                                    direction: "up",
                                    duration: 500
                                }
                            });
                        }
                );
            });
                
//            $(document).ready(function() {
//                $(".dialog").each(
//                        function() {
//                            $(".dialog").dialog({
//                                autoOpen: false,
//                                maxHeight: 550,
//                                maxWidth: 750,
//                                height: 550,
//                                width: 750,
//                                show: {
//                                    effect: "blind",
//                                    duration: 1000,
//                                },
//                                hide: {
//                                    effect: "explode",
//                                    duration: 1000
//                                }
//                            });
//
//                            $('img.detail').click(function() {
//
//                                $(this).$(".dialog").dialog("open");
//                                return false;
//                            });
//                        });
//            });
        </script>

    </div>
    <!-- End of Housing Apartment -->        
				
			</div><!-- [END] #main -->
			
			<script type="text/javascript">
				$(document).ready(function(){
					$('body').pageScroller({navigation: '#navscroll'});
				});	
			</script>
                </div>

<?php $this->load->view('_blocks/footer') ?>