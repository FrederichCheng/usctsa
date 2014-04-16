<?php $this->load->view('_blocks/header') ?>

<link rel="stylesheet" type="text/css" href="assets/css/housing.css">
<link rel="stylesheet" type="text/css" href="assets/css/housePicDetail.css">
<script type="text/javascript" src="assets/js/slidepics.js"></script>


<div id="wrapper">   <!--nav scrollbar on the left-->

    <div id="navscroll" class="PageScrollerNav standardNav right dark">
        <ul>
            <li><A href="#">Long Term Contract</A></li>
            <li><A href="#">Sublease</A></li>
        </ul>
    </div>

    <div>
        <h1>Housing</h1>
        <br />

    </div>

    <div class="section">
        <h2>Long Term Contract</h2>
        <?php foreach ($sections as $value) { ?>
            <table class="housing" border="2" cellpadding="" cellspacing="">
                <tr>
                    <td width="200" text-align="center">
                        <img src="assets/images/<?= $value['house_img_left'] ?>" alt="House image" no="1" class="housing_pic img-thumbnail" />

                        <!-- House Details -->
                        <div id="dialog1" class="dialog" title="House Details:">
                            <div id="showbox">
                                <div id="showImg">
                                    <table>
                                        <tr>
                                            <td align="center" valign="center">
                                                <img src="assets/images/<?= $value['house_img_left'] ?>"  class="imgB img-thumbnail"/>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="imgList">    	
                                    <span id="prv"><a href="#"><img src="assets/images/left_arrow.gif" border="0"/></a></span>           
                                    <div id="list">
                                        <ul>
                                            <li class="on"><img src="assets/images/<?= $value['sImg1_l'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg2_l'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg3_l'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg4_l'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg5_l'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg6_l'] ?>" /></li>

                                        </ul>
                                    </div>
                                    <span id="next"><a href="#"><img src="assets/images/right_arrow.gif" border="0"/></a></span>    
                                </div>
                            </div>


                            <div id="description">
                                <strong>Description:</strong><?= $value['description_left'] ?><br />
                                <br />
                                <strong>Location:</strong><?= $value['location_left'] ?><br/>
                                <br />
                                <strong>Style:</strong><?= $value['style_left'] ?><br />
                                <br />
                                <h4 id="price">Price: <?= $value['price_left'] ?> </h4>
                                <br /> 
                                <iframe src="http://www.dr2ooo.com/tools/maps/maps.php?zoom=15&width=300&height=225&ll=34.029076,-118.281919&ctrl=true&cp=true&" width="300" height="225"></iframe>
                            </div>

                        </div>
                    </td>

                    <td class="housing_descript" valign="top">
                        Location: <?= $value['location_left'] ?> <br /> <br />
                        Price: <?= $value['price_left'] ?>/month<br/><br />

                        Description:
                        <?= $value['description_left'] ?>
                        <br /> <br />

                    </td>
                    
<!-- Right one house -->

                    <td width="200" text-align="center">
                        <img src="assets/images/<?= $value['house_img_right'] ?>" alt="House image" no="2" class="housing_pic img-thumbnail ">
                        

                        <!-- House Details -->
                        <div id="dialog2" class="dialog" title="House Details:">
                            <div id="showbox">
                                <div id="showImg">
                                    <table>
                                        <tr>
                                            <td align="center" valign="center">
                                                <img src="assets/images/b/<?= $value['house_img_right'] ?>" class="imgB img-thumbnail" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="imgList">    	
                                    <span id="prv"><a href="#"><img src="assets/images/left_arrow.gif" border="0"/></a></span>           
                                    <div id="list">
                                        <ul>
                                            <li class="on"><img src="assets/images/<?= $value['sImg1_r'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg2_r'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg3_r'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg4_r'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg5_r'] ?>" /></li>
                                            <li><img src="assets/images/<?= $value['sImg6_r'] ?>" /></li>

                                        </ul>
                                    </div>
                                    <span id="next"><a href="#"><img src="assets/images/right_arrow.gif" border="0"/></a></span>    
                                </div>
                            </div>


                            <div id="description">
                                <strong>Description:</strong><?= $value['description_right'] ?><br />
                                <br />
                                <strong>Location:</strong><?= $value['location_right'] ?><br/>
                                <br />
                                <strong>Style:</strong><?= $value['style_right'] ?><br />
                                <br />
                                <h4 id="price">Price: <?= $value['price_right'] ?> </h4>
                                <br /> 
                                <iframe src="http://www.dr2ooo.com/tools/maps/maps.php?zoom=15&width=300&height=225&ll=34.029076,-118.281919&ctrl=true&cp=true&" width="300" height="225"></iframe>
                            </div>

                        </div>
                    </td>
                    <td class="housing_descript" valign="top">
                        Location: <?= $value['location_right'] ?> <br /> <br />
                        Price: <?= $value['price_right'] ?>/month<br/><br />

                        Description:
                        <?= $value['description_right'] ?>
                        <br /> <br />

                    </td>

            </table>
            <br /> <br />
        <?php } ?>    



        <br/><br/>
        <!-- For sublease -->
        <div class="section">
            <h2>Sublease</h2>

            <table class="housing" border="2" cellpadding="" cellspacing="">
                <tr>
                    <td class="housing_pic" align="left" valign="top">
                        <A href="images/house_pic3.jpg" target="_blank"><img src="images/house_pic3.jpg" alt="House image" width="160" height="150">
                        </A>   
                    </td>
                    <td class="housing_descript" valign="top">
                        <br />
                        Description:
                        This is a cozy apartment locating near USC campus.
                        There are 1 bedroom and 1 bathroom. 
                        House owner is very nice...<br /> <br />
                        Location: 2423 W 23rd St.<br /> <br />
                        Price: 800/month<br/>

                    </td>
                    <td class="housing_pic" align="left" valign="top">
                        <A href="images/house_pic4.jpg" target="_blank"><img src="images/house_pic4.jpg" alt="House image" width="160" height="150">
                        </A> 
                    </td>
                    <td class="housing_descript" valign="top">
                        <br />
                        This is a cozy apartment about 10mins walking distance to USC campus.
                        There are 1 bedroom and 1 bathroom. 
                        House owner is very nice...<br /><br />
                        Location: 2423 W 23rd St.<br /> <br />
                        Price: 750/month<br/>
                    </td>
                </tr>
            </table>
        </div>
        <!--      </div>  -->

        <script type="text/javascript">
            $(document).ready(function() {
                $('body').pageScroller({navigation: '#navscroll'});
                $(".housing_pic").click(
                        function() {
                            $("#dialog"+$(this).attr('no')).dialog({ //找到attribute為no的值，附加到dialog的id之後
                                
                                maxHeight: 550,
                                maxWidth: 750,
                                height: 550,
                                width: 750,
                                show: {
                                    effect: "blind",
                                    duration: 1000,
                                },
                                hide: {
                                    effect: "explode",
                                    duration: 1000
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
    <?php $this->load->view('_blocks/footer') ?>
   