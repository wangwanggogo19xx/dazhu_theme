<?php 

	// function test(){
	// 	wp_enqueue_style('category_css',get_template_directory_uri().'/css/category.css');
	// }
	// add_action( 'wp_enqueue_scripts', 'test');
	get_header();
 ?>
 	<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/category.css"); ?>">

<div class="left">
	<?php 
		display_my_catergories();
	?>
</div>

<img src="<?php echo get_template_directory_uri().'/resources/catergories/index-right.jpg'; ?>" width="30%" height="95%">
<div class="clear"></div>
 	
<?php 
 	get_footer();
?>