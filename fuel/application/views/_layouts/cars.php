<?php $this->load->view('_blocks/header') ?>

<div id="wrapper">

    <link rel="stylesheet" type="text/css" href="assets/css/car.css">
    <script type="text/javascript" src="assets/js/slidepics_car.js"></script>

    <div class="section">
        <h2>Used Cars Selling</h2>
        <?php foreach ($sections as $value) { ?>
            <table class="car" border="2">
                <tr>
                    <td valign='top'>

                        <img src="assets/images/<?= $value['car_BigImg'] ?>" alt="car_1 image" class="car_pic" id="imgB">
                        <div id="imgList">    	

                            <div id="list">
                                <ul>
                                    <li><img src="assets/images/<?= $value['sImg_1'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_2'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_3'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_4'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_5'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_6'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_7'] ?>" /></li>
                                    <li><img src="assets/images/<?= $value['sImg_8'] ?>" /></li>

                                </ul>
                            </div>

                        </div>

                    </td>
                    <td class="car_descript" valign="top">
                        Model: <?= $value['model'] ?><br /><br/>

                        Year: <?= $value['year'] ?> <br/><br/>

                        Miles: <?= $value['miles'] ?> <br/><br/>

                        Location: <?= $value['location'] ?><br /> <br />

                        Saler: <?= $value['saler'] ?> <br/><br/>

                        Mobile: <?= $value['mobile'] ?> <br /><br/>

                        Email: <?= $value['email'] ?> <br/><br/>

                        Price: <?= $value['price'] ?><br/><br />

                        Description: <?= $value['description'] ?>
                        <br /> 

 </div>


                    </td>                      
                </tr>
            </table>
            <br /> <br />
        <?php } ?>


    </div>
    <!-- </div> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').pageScroller({navigation: '#navscroll'});
        });

    </script>


    <?php $this->load->view('_blocks/footer') ?>
