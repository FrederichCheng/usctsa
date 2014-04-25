<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
 	<title><?=$page_title?></title>

 	<meta name="viewport" content="width=device-width">
	<?=css('fuel.min', 'fuel')?>
        <link rel="stylesheet" type="text/css" href="<?= assets_path('js/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.min.css') ?>">
        <script type="text/javascript" src="<?= assets_path('js/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/json2.js') ?>"></script>
        <script type="text/javascript" src="<?= assets_path('js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js') ?>"></script>
	<?php foreach($css as $m => $c) : echo css(array($m => $c))."\n\t"; endforeach; ?>

</head>