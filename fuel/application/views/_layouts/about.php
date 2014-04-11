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
        <h1 id=members>Members</h1>
        <!-- First row of members -->
        <?php foreach ($sections as $value) { ?>
            <table class="member_frame">
                <tr>
                    <td>
                        <table class="member">  
                            <tr>

                                <td><img src="assets/images/<?= $value['president_img'] ?>" alt="image_left" class="profile_pic"></td>
                                <td>
                                    <table class="member_des">
                                        <tr>
                                            <td class="des">
                                                <h3><?= $value['title_left'] ?></h3>

                                                <h4>Name: <?= $value['president_name'] ?></h4>   

                                                <h4>Major: <?= $value['president_major'] ?></h4> 

                                                <h4>Email: <?= $value['president_email'] ?></h4>

                                                <p class="self_intro"><?= $value['president_intro'] ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>

                        <table class="member">  
                            <tr>

                                <td><img src="assets/images/<?= $value['vice_president_img'] ?>" alt="image right" class="profile_pic"></td>

                                <td>
                                    <table class="member_des">
                                        <td class="des">
                                            <h3><?= $value['title_right'] ?></h3>

                                            <h4>Name:<?= $value['vice_president_name'] ?></h4>   

                                            <h4>Major:<?= $value['vice_president_major'] ?></h4>  

                                            <h4>Email:<?= $value['vice_president_email'] ?></h4>

                                            <p class="self_intro"><?= $value['vice_president_intro'] ?></p>
                                        </td>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>

        <?php } ?>



    </div> <!-- MEMBERS ends -->   
<!-- </div> -->   

<script type="text/javascript">
    $(document).ready(function() {
        $('body').pageScroller({navigation: '#navscroll'});
    });

</script>


<?php $this->load->view('_blocks/footer') ?>