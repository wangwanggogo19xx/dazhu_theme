<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery-1.8.1.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/key_binds.js'; ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/header.css"); ?>">
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
	