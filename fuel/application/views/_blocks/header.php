<?php 
    $CI->lang->load('tsa', detect_lang());
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title><?= fuel_var('page_title', ''); ?></title>

        <meta name="keywords" content="<?php echo fuel_var('meta_keywords') ?>">
        <meta name="description" content="<?php echo fuel_var('meta_description') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets_path('css/style.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets_path('js/engine1/style.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets_path('js/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets_path('js/bootstrap-3.1.1/css/bootstrap.min.css') ?>">
        <link rel="shortcut icon" type="image/png" href="<?= img_path('favicon.ico')?>"/>
        <link rel="shortcut icon" type="image/png" href="<?= img_path('favicon.ico')?>"/>
        <script type="text/javascript" src="<?= assets_path('js/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/main.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/json2.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/bootstrap-3.1.1/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/jquery.pagescroller.lite.js') ?>"></script>
        
    </head>
    <body>
            <div id="middle-frame">
            <div id="header">

                <!-- Title -->
                <div id="title">
                    <!-- Logo -->
                    <div id="logo">
                        <a href="http://www.usc.edu/" target="_blank" title="University of Southern California"><img src="<?=  assets_path('images/usc_logo.png') ?>" alt="USC Logo" width="130" height="130" /></a>
                        <div id="tagline">USC Taiwanese Student Association<br>南加大台灣同學會</div>
                    </div>

                    <!-- Social Icons -->
                    <div id="contact">
                        <div class="links">
                            <div class="lang-links">
                                <a href="<?= site_url('/',FALSE, lang('tsa_change_language_link'))?>"> 
                                    <?=lang('tsa_change_language_label')?> 
                                </a>
                            </div>
                            <div class="social-icons">
                                <ul>
                                    <li class="facebook"><a href="https://www.facebook.com/groups/usctsa/" target="_blank" title='Facebook'>Facebook</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Contact Details -->
                        <!--
                        <div id="contact-details">
                                <ul>
                                <li><a href="mailto:tsa.usc@gmail.com">Contact us</a></li>
                            </ul>
                        </div>
                        -->
                    </div>
                </div>
                <div id="nav_bar">
                    <nav>
                        <?= fuel_nav(array('render_type' => 'basic', 'language' => detect_lang())); ?>
                    </nav>
                </div>
            </div>
            <div id="outer-wrapper">