<?php $this->load->view('_blocks/header') ?>

 <div id="wrapper">
     
     <link rel="stylesheet" type="text/css" href="assets/css/car.css">
     <script type="text/javascript" src="assets/js/slidepics.js"></script>
     
            <div class="section">
                <h2>Used Cars Selling</h2>
                <?php foreach($sections as $value) { ?>
                <table class="car" border="2">
                    <tr>
                        <td valign='top'>

                            <img src="assets/images/b/<?= $value['car_BigImg']?>" alt="car_1 image" class="car_pic" id="imgB">
                            <div id="imgList">    	

                                <div id="list">
                                    <ul>
                                        <li><img src="assets/images/<?= $value['sImg_1']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_2']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_3']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_4']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_5']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_6']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_7']?>" /></li>
                                        <li><img src="assets/images/<?= $value['sImg_8']?>" /></li>

                                    </ul>
                                </div>

                            </div>

                        </td>
                        <td class="car_descript" valign="top">
                            Model: <?= $value['model'] ?><br /><br/>

                            Year: <?= $value['year']?> <br/><br/>

                            Miles: <?= $value['miles']?> <br/><br/>

                            Location: <?= $value['location']?><br /> <br />

                            Saler: <?= $value['saler']?> <br/><br/>
                            
                            Mobile: <?= $value['mobile']?> <br /><br/>

                            Email: <?= $value['email']?> <br/><br/>
                           
                            Price: <?= $value['price']?><br/><br />
                            
                            Description: <?= $value['description']?>
                           <br /> 

                           

                        </td>                      
                    </tr>
                </table>
                <br /> <br />
                <?php } ?>

                <table class="car" border="2">
                    <tr>
                        <td valign="top">

                            <img src="images/Mercedez.jpg" alt="car_2 image" class="car_pic">

                        </td>
                        <td class="car_descript" valign="top">
                            Brand: Mercedez-Benz C250 <br /><br/>

                            Year:2009 <br/><br/>

                            Miles:45000 <br/><br/>

                            Description:
                            This car is good condition since I bought it 2 years ago, it's a clean title car.
                            Only a few scratches on the bumper.I have a good driving habit, never smoke in the 
                            car and keep it clean all the time...<br /> <br />

                            Location: Alhambra<br /> <br />

                            Contact Info: 213-273-9736 <br /><br/>

                            Saler: Mr. Lee <br/><br/>

                            Price: 22000<br/>

                        </td>                      
                    </tr>
                </table>
                <br /> <br />

                <table class="car" border="2">
                    <tr>
                        <td valign="top">                           
                            <img src="images/Honda.jpg" alt="car_3 image" class="car_pic">

                        </td>
                        <td class="car_descript" valign="top">
                            Brand: Honda Civic  <br /><br/>

                            Year:2004 <br/><br/>

                            Miles:93000 <br/><br/>

                            Description:
                            This car is good condition since I bought it 2 years ago, it's a clean title car.
                            Only a few scratches on the bumper.I have a good driving habit, never smoke in the 
                            car and keep it clean all the time...<br /> <br />

                            Location: Culver City<br /> <br />

                            Contact Info: 353-845-8722 <br /><br/>

                            Saler: Ms. Chou <br/><br/>

                            Price: 4500<br/>

                        </td>                      
                    </tr>
                </table>
                <br /> <br />

            </div>
 </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').pageScroller({navigation: '#navscroll'});
    });

</script>


<?php $this->load->view('_blocks/footer') ?>
