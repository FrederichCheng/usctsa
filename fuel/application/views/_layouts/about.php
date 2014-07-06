<?php $this->load->view('_blocks/header') ?>
<?= css('about.css') ?>

<!-- ABOUT -->
<div id="wrapper">

    <!-- nav scroll -->
    <div id="navscroll" class="pageScrollerNav standardNav right dark">
        <ul>
            <li><a href="#"><?= lang('tsa_about') ?></a></li>
            <li><a href="#"><?= lang('tsa_staff') ?></a></li>
            <li><a href="#"><?= lang('tsa_founder') ?></a></li>

        </ul>
    </div>

    <div class="section">
        <h1 class="scroll-headline"> <?= lang('tsa_about') ?> </h1>
        <p class="about_us">
            <?= fuel_var('about_content', '') ?>             
        </p>
    </div>
    <!-- ABOUT ends -->

    <HR>

    <!-- MEMBERS -->
    <div class="section">
        <h1 class="title"><?= lang('tsa_members') ?></h1>
        <h3><?= lang('tsa_staff') ?></h3>
        <!-- TSA Staff -->
        <div id="members">
            <?php foreach ($sections as $value) { ?>
                <div class="member_frame">
                    <div class="member_photo_frame">
                        <div class="member_photo">
                            <img src="<?= img_path($value['photo']) ?>" alt="<?= $value['title'] . "'s photo" ?>" class="profile_pic">
                        </div>
                        <div class="member_title"><?= $value['title'] ?></div>
                    </div>
                    <div class="member_des">
                        <span class="member_name"><?= $value['name'] ?></span>   
                        <?php if (!empty($value['major']) && 0 != strlen(trim($value['major']))) { ?>
                            <span class="member_major"><?= $value['major'] ?></span> 
                        <?php } ?>
                        <span class="member_message self_intro"><?= $value['message'] ?></span>

                        <span class="member_icons">
                            <ul>
                                <?php if (!empty($value['email']) && 0 != strlen(trim($value['email']))) { ?>
                                    <li class="email"><?= mailto($value['email'], 'Contact TSA', array('target' => '_blank')) ?></li>
                                <?php } ?>
                                <?php if (!empty($value['facebook']) && 0 != strlen(trim($value['facebook']))) { ?>
                                    <li class="facebook"><a href="<?= $value['facebook'] ?>" target="_blank">Facebook</a></li>
                                <?php } ?>
                            </ul>
                        </span>
                    </div>
                </div>

            <?php } ?>

        </div> <!--TSA Staff end -->
    </div>
    <!-- TSA Website Founders -->
    <div class="section">
        <h3><?= lang('tsa_founder') ?></h3>
        <div id="members">
            <?php foreach ($founder_sections as $value) { ?>
                <div class="member_frame">
                    <div class="member_photo_frame">
                        <div class="member_photo">
                            <img src="<?= img_path($value['photo']) ?>" alt="<?= $value['title'] . "'s photo" ?>" class="profile_pic">
                        </div>
                        <div class="member_title"><?= $value['title'] ?></div>
                    </div>
                    <div class="member_des">
                        <span class="member_name"><?= $value['name'] ?></span>   
                        <?php if (!empty($value['major']) && 0 != strlen(trim($value['major']))) { ?>
                            <span class="member_major"><?= $value['major'] ?></span> 
                        <?php } ?>
                        <span class="member_message self_intro"><?= $value['message'] ?></span>

                        <span class="member_icons">
                            <ul>
                                <?php if (!empty($value['email']) && 0 != strlen(trim($value['email']))) { ?>
                                    <li class="email"><?= mailto($value['email'], 'Contact TSA', array('target' => '_blank')) ?></li>
                                <?php } ?>
                                <?php if (!empty($value['facebook']) && 0 != strlen(trim($value['facebook']))) { ?>
                                    <li class="facebook"><a href="<?= $value['facebook'] ?>" target="_blank">Facebook</a></li>
                                    <?php } ?>
                            </ul>
                        </span>
                    </div>
                </div>

            <?php } ?>
        </div> <!-- Website Founder ends -->   
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').pageScroller({navigation: '#navscroll'});
        });

    </script>
</div>
<?php $this->load->view('_blocks/footer') ?>