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
<div class ="section">
    <?= fuel_block(array('view' => 'market_nav', 'vars' => array('categoryTag' =>'housing'))); ?>
    <div>
        <h1><?= lang('tsa_housing') ?></h1>
    </div>
    <div id="prototype_message" class="alert alert-warning">
        <?= lang('tsa_market_prototype_message','Housing', ' <a href="market?category=3"> link </a>')?>
    </div>
</div>
</div>
    <?php $this->load->view('_blocks/footer') ?>
   
