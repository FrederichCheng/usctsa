<?php $this->load->view('_blocks/header') ?>

<?=css('housing.css')?>
<?=css('housePicDetail.css')?>
<?=js('slidepics_car.js')?>

<div id="wrapper">   <!--nav scrollbar on the left-->

<!--    <div id="navscroll" class="PageScrollerNav standardNav right dark">
        <ul>
            <li><A href="#">Long Term Contract</A></li>
            <li><A href="#">Sublease</A></li>
        </ul>
    </div>-->
    <?= fuel_block(array('view' => 'market_nav', 'vars' => array('categoryTag' =>'housing'))); ?>
    <div>
        <h1><?= lang('tsa_housing') ?></h1>
    </div>
    <div id="prototype_message" class="alert alert-warning">
        <?= lang('tsa_market_prototype_message','Housing', ' <a href="market?category=3"> link </a>')?>
    </div>
    <div class="section">
<!--        <h2>Long Term Contract</h2>-->
        
 
        
        <?php $num=1; ?>
        <?php $id="id='imgB"; ?>
        <?php $id_dialog="id='dialog" ?>
        <?php $no="no='"; ?>    
        <?php foreach ($sections as $value) { ?>
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
</div>
    <?php $this->load->view('_blocks/footer') ?>
   
