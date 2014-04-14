<?php $this->load->view('_blocks/header') ?>

<link rel="stylesheet" type="text/css" href="assets/css/housing.css">

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
                    <td>
                        <A href="#" onclick="window.open('house_detail_left', '', 'scrollbar=yes,width=700px, height=600px')" target="_blank"><img src="assets/images/<?= $value['house_img_left'] ?>" alt="House image" class="housing_pic">
                        </A>
                    </td>
                    <td class="housing_descript" valign="top">
                        Location: <?= $value['location_left'] ?> <br /> <br />
                        Price: <?= $value['price_left'] ?>/month<br/><br />

                        Description:
                        <?= $value['description_left'] ?>
                        <br /> <br />

                    </td>

                    <td>
                        <A href="#" onclick="window.open('house_detail_right', '', 'scrollbar=yes,width=700px, height=600px')" target="_blank"><img src="assets/images/<?= $value['house_img_right'] ?>" alt="House image" class="housing_pic">
                        </A>
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
        });

    </script>

</div>
    <?php
    $this->load->view('_blocks/footer')?>
