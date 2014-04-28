<?php $this->load->view('_blocks/header') ?>
<link rel="stylesheet" type="text/css" href="assets/css/car.css">
<div id="wrapper">
    <?= fuel_block(array('view' => 'market_nav', 'vars' => array('categoryName' =>'car'))); ?>
    <div class="section">
        <h2>Used Cars Selling</h2>
        
        <?php $num=1; ?>
        <?php $id="id='imgB"; ?>
        <?php $no="no='"; ?>
        <?php foreach ($sections as $value) { ?>
            <table class="car" border="2">
                <tr>
                    <td valign='top'>

                        <img src="assets/images/<?= $value['car_BigImg'] ?>" alt="car image" class="car_pic" <?php echo $id.$num."'"; ?>  >
                        <div id="imgList">    	

                            <div id="list">
                                <ul>
                                    <?php foreach ($value['photos'] as $image) { ?>
                                    
                                    <li><img src="assets/images/<?= $image['photo'] ?>"  <?php echo $no.$num."'";?> /></li>
                                        
                                    <?php } ?>
                                    

                                </ul>
                            </div>

                        </div>

                    </td>
                    <td class="car_descript" valign="top">
                        <span>   <strong>Model:</strong> <?= $value['model'] ?> <br /></span> 
                        
                        <span>   <strong>Type:</strong> <?= $value['type'] ?> <br /></span> 
                        
                        <span>   <strong>Color:</strong> <?= $value['color'] ?> <br /></span> 
                        
                        <span>   <strong>Year:</strong> <?= $value['year'] ?> <br /></span> 

                        <span>   <strong>Miles:</strong> <?= $value['miles'] ?> <br /></span> 

                        <span>   <strong>Location:</strong> <?= $value['location'] ?><br /></span> 

                        <span>   <strong>Saler:</strong> <?= $value['saler'] ?> <br/></span>

                        <span>   <strong>Mobile:</strong> <?= $value['mobile'] ?> <br /></span>

                        <span>   <strong>Email:</strong> <?= $value['email'] ?> <br/></span>

                        <span><strong>Price:</strong> <?= $value['price'] ?><br/></span>
                        <br/><br/>

                        <span><strong>Description:</strong> <?= $value['description'] ?> <br /></span>
                        

 </div>


                    </td>                      
                </tr>
            </table>
            <br /> <br />
            <?php $num++ ?>
        <?php } ?>


    </div>
    <!-- </div> -->

</div>


    <?php $this->load->view('_blocks/footer') ?>
