<?php 

	get_header();
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/baoguangtai.css'; ?>">
<script type="text/javascript" src="<?php echo get_my_source_uri("/js/baoguangtai.js"); ?>"></script>

<!-- <div class="item_container"> -->
<?php 
	$path = get_my_source_directory("/php/items.php");
	include($path);

 ?>

<!-- </div> -->
 <?php 

 	get_footer();
  ?>