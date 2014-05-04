<?php $this->load->view('_blocks/header') ?>
<?=js('slidepics_car.js')?>
<?=css('car.css')?>
<style>
    #prototype_message{
    }
</style>
<div id="wrapper">
    <?= fuel_block(array('view' => 'market_nav', 'vars' => array('categoryTag' =>'car'))); ?>
    <div>
         <h1><?= lang('tsa_cars') ?></h1>
    </div>
    <div id="prototype_message" class="alert alert-warning">
        <?= lang('tsa_market_prototype_message','Car', ' <a href="market?category=4"> link </a>')?>
    </div>
    <div class="section">
            
        <?php $num=1; ?>
        <?php $id="id='imgB"; ?>
        <?php $no="no='"; ?>
        <?php foreach ($sections as $value) { ?>
            <table class="car" border="2">
                <tr>
                    <td valign='top'>

                        <img src="<?= img_path($value['car_BigImg']) ?>" alt="car image" class="car_pic" <?php echo $id.$num."'"; ?>  >
                        <div id="imgList">    	

                            <div id="list">
                                <ul>
                                    <?php foreach ($value['photos'] as $image) { ?>
                                    
                                    <li><img src="<?= img_path($image['photo']) ?>"  <?php echo $no.$num."'";?> /></li>
                                        
                                    <?php } ?>
                                    

                                </ul>
                            </div>

                        </div>

                    </td>
                    <td class="car_descript" valign="top">
                        <span>   <strong><?= lang('tsa_cars_model') ?>:</strong> <?= $value['model'] ?> <br /></span> 
                        
                        <span>   <strong><?= lang('tsa_cars_type') ?>:</strong> <?= $value['type'] ?> <br /></span> 
                        
                        <span>   <strong><?= lang('tsa_cars_color') ?>:</strong> <?= $value['color'] ?> <br /></span> 
                        
                        <span>   <strong><?= lang('tsa_cars_year') ?>:</strong> <?= $value['year'] ?> <br /></span> 

                        <span>   <strong><?= lang('tsa_cars_mile') ?>:</strong> <?= $value['miles'] ?> <br /></span> 

                        <span>   <strong><?= lang('tsa_cars_loc') ?>:</strong> <?= $value['location'] ?><br /></span> 

                        <span>   <strong><?= lang('tsa_cars_seller') ?>:</strong> <?= $value['saler'] ?> <br/></span>

                        <span>   <strong><?= lang('tsa_cars_mobile') ?>:</strong> <?= $value['mobile'] ?> <br /></span>

                        <span>   <strong><?= lang('tsa_cars_email') ?>:</strong> <?= $value['email'] ?> <br/></span>

                        <span><strong><?= lang('tsa_cars_price') ?>:</strong> <?= $value['price'] ?><br/></span>
                        <br/><br/>

                        <span><strong><?= lang('tsa_cars_des') ?>:</strong> <?= $value['description'] ?> <br /></span>
                        

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
