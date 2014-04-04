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
                    <?=fuel_var('content')?>                   
                </p>
            </div>
            <!-- ABOUT ends -->

            <HR>

              <!-- MEMBERS -->
            <div class="section">
                <h1 id=members>Members</h1>
                <!-- First row of members -->
                <table class="member_frame">
                    <tr>
                        <td>
                            <table class="member">  
                                <tr>
                                    <td>
                                        <table >
                                            <tr>
                                                <td><img src="assets/images/<?=fuel_var('president_img')?>" alt="President's image" class="profile_pic"></td>
                                                  
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="member_des">
                                            <tr>
                                                <td class="des">
                                                    <h3><?=fuel_var('title_left')?></h3>
                                                    
                                                    <h4>Name: <?=fuel_var('president_name')?></h4>   

                                                    <h4>Major: <?=fuel_var('president_major')?></h4> 

                                                    <h4>Email: <?=fuel_var('president_email')?></h4>
                                                    
                                                    <p class="self_intro"><?=fuel_var('president_intro')?></p>
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
                                    <td>
                                        <table>
                                            <tr>
                                                <td><img src="assets/images/<?=fuel_var('vice_president_img')?>" alt="Vice President's image" class="profile_pic"></td>
                                            </tr>
     
                                        </table>
                                    </td>
                                    <td>
                                        <table class="member_des">
                                            <td class="des">
                                                <h3><?=fuel_var('title_right')?></h3>
                                                
                                                <h4>Name:<?=fuel_var('vice_president_name')?></h4>   

                                                <h4>Major:<?=fuel_var('vice_president_major')?></h4>  

                                                <h4>Email:<?=fuel_var('vice_president_email')?></h4>
                                                
                                                <p class="self_intro"><?=fuel_var('vice_president_intro')?></p>
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>
                <!-- Second row of members -->

                <table class="member_frame">
                    <tr>
                        <td>
                            <table class="member">  
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td><img src="assets/images/<?=fuel_var('public_relation_img')?>" alt="Public Relation's image" class="profile_pic"></td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"><p>Public Relation</p></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="member_des">
                                            <tr>
                                                <td class="des">

                                                    <h4>Name:<?=fuel_var('public_relation_name')?></h4>   

                                                    <h4>Major:<?=fuel_var('public_relation_major')?></h4> 

                                                    <h4>Email:<?=fuel_var('public_relation_email')?></h4>
                                                    
                                                    <p class="self_intro"><?=fuel_var('public_relation_intro')?></p>
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
                                    <td>
                                        <table>
                                            <tr>
                                                <td><img src="assets/images/<?=fuel_var('web_technician_img')?>" alt="Web Tech's image" class="profile_pic"></td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"><p>Web Technician</p></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="member_des">
                                            <td class="des">
                                                <h4>Name:<?=fuel_var('web_technician_name')?></h4>   

                                                <h4>Major<?=fuel_var('web_technician_major')?></h4>  

                                                <h4>Email:<?=fuel_var('web_technician_email')?></h4>
                                                
                                                <p class="self_intro"><?=fuel_var('web_technician_intro')?></p>
                                            </td>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>


            </div>
        </div>
        <script type="text/javascript">
			$(document).ready(function(){
				$('body').pageScroller({navigation: '#navscroll'});
			});
				
			</script>
        <!-- MEMBERS ends -->      
<?php $this->load->view('_blocks/footer') ?>