<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title('|', true, 'right'); ?></title>
</head>
<body>
	
 <header>
    <img id = "logo" src="<?php echo get_template_directory_uri()."/resources/image/banner-icon.png"; ?>">
    <h2 id = "head_title">大竹县阳光惠民电视公开平台</h2>
    <div class="clear_float"></div> 
 </header>   

<div id="container">
	<?php 
        do_action('wp_head');
	?>
	