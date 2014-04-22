<?php $this->load->view('_blocks/header') ?>

<!-- ABOUT -->
<div id="wrapper">

    <!-- nav scroll -->
    <div id="navscroll" class="pageScrollerNav standardNav right dark">
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="#">Members</a></li>

        </ul>
    </div>
    <link rel="stylesheet" type="text/css" href="assets/css/about.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <div class="section">
        <h1>About Us </h1>
        <p class="about_us">
            <?= fuel_var('about_content') ?>             
        </p>
    </div>
    <!-- ABOUT ends -->

    <HR>

    <!-- MEMBERS -->
    <div class="section">
        <h1 class="title">Members</h1>
        <!-- First row of members -->
        <div id="members">
        <?php foreach ($sections as $value) { ?>
            <div class="member_frame">
                    <div class="member_photo_frame">
                        <div class="member_photo">
                            <img src="assets/images/<?= $value['photo'] ?>" alt="<?=$value['title']."'s photo"?>" class="profile_pic">
                        </div>
                        <div class="member_title"><?= $value['title'] ?></div>
                    </div>
                    <div class="member_des">
                        <span class="member_name"><?= $value['name'] ?></span>   
                        <?php if(!empty($value['major']) && 0 !== strlen(trim($value['major']))){ ?>
                        <span class="member_major"><?= $value['major'] ?></span> 
                        <?php } ?>
                        <?php if(!empty($value['email']) && 0 !== strlen(trim($value['email']))){ ?>
                        <span class="member_email">Email: <?= $value['email'] ?></span>
                        <?php }?>
                        <span class="member_message self_intro"><?= $value['message'] ?></span>
                        <?php if(!empty($value['facebook_link']) && 0 !== strlen(trim($value['facebook_link']))){ ?>
                        <span class="member_icons">
                            <ul>
                                <li class="facebook"><a href="<?= $value['facebook_link'] ?>" title='Join us'>Facebook</a></li>
                            </ul>
                        </span>
                        <?php }?>
                    </div>
            </div>

        <?php } ?>

        </div>

    </div> <!-- MEMBERS ends -->   
<!-- </div> -->   

<script type="text/javascript">
    $(document).ready(function() {
        $('body').pageScroller({navigation: '#navscroll'});
    });

</script>
</div>
<?php $this->load->view('_blocks/footer') ?>
<?php $this->load->view('_blocks/header') ?>

<!-- ABOUT -->
<div id="wrapper">

    <!-- nav scroll -->
    <div id="navscroll" class="pageScrollerNav standardNav right dark">
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="#">Members</a></li>

        </ul>
    </div>
    <link rel="stylesheet" type="text/css" href="assets/css/about.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <div class="section">
        <h1>About Us </h1>
        <p class="about_us">
            <?= fuel_var('about_content') ?>             
        </p>
    </div>
    <!-- ABOUT ends -->

    <HR>

    <!-- MEMBERS -->
    <div class="section">
        <h1 class="title">Members</h1>
        <!-- First row of members -->
        <div id="members">
        <?php foreach ($sections as $value) { ?>
            <div class="member_frame">
                    <div class="member_photo_frame">
                        <div class="member_photo">
                            <img src="assets/images/<?= $value['photo'] ?>" alt="<?=$value['title']."'s photo"?>" class="profile_pic">
                        </div>
                        <div class="member_title"><?= $value['title'] ?></div>
                    </div>
                    <div class="member_des">
                        <span class="member_name"><?= $value['name'] ?></span>   
                        <?php if(!empty($value['major']) && 0 !== strlen(trim($value['major']))){ ?>
                        <span class="member_major"><?= $value['major'] ?></span> 
                        <?php } ?>
                        <?php if(!empty($value['email']) && 0 !== strlen(trim($value['email']))){ ?>
                        <span class="member_email">Email: <?= $value['email'] ?></span>
                        <?php }?>
                        <span class="member_message self_intro"><?= $value['message'] ?></span>
                        <?php if(!empty($value['facebook_link']) && 0 !== strlen(trim($value['facebook_link']))){ ?>
                        <span class="member_fb_icons">
                            <ul>
                                <li class="facebook"><a href="<?= $value['facebook_link'] ?>" >Facebook</a></li>
                            </ul>
                        </span>
                        <?php }?>
                    </div>
            </div>

        <?php } ?>

        </div>

    </div> <!-- MEMBERS ends -->   
<!-- </div> -->   

<script type="text/javascript">
    $(document).ready(function() {
        $('body').pageScroller({navigation: '#navscroll'});
    });

</script>
</div>
<?php $this->load->view('_blocks/footer') ?>
