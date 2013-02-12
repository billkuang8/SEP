<!DOCTYPE html>
<html>
    <head>
	<meta property="og:image" content="http://www.berkeleysep.com/public/images/bird.jpg" />
	<link rel="image_src" href="http://www.berkeleysep.com/public/images/bird.jpg" />
        <title><?php echo $title; ?></title>
        <?php include 'include.php'; 
		if(isset($css))
		{
		foreach ($css as $cssItem):?>
			<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_PATH . $cssItem; ?>" />	
		<?php endforeach; 
		}?>
	
	
		<?php
		if(isset($js))
		{ foreach ($js as $jsItem):?>
			<script type="text/javascript" src="<?php echo JS_BASE_PATH . $jsItem; ?>" ></script>
		<?php endforeach; 
		}?>
        
    </head>
    <body>
		<div id="body">
		<?php include 'top_banner.php'; ?>
	
