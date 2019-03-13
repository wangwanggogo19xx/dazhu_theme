<?php
/*
Single Post Template: 图片
Description: 只有图片的文章，每页显示两张
*/
?>

<?php 
	get_header();
?>

	<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/single_image.js'; ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/single_img.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/single.css"); ?>">




<?php 
	if(!$post){
      $post=get_post(get_the_ID());
    }
	$imgs=get_all_img_uri($post->post_content);
?>
<div id="top_row">
   <h3><?php  echo $post->post_title;?></h1> 
</div>

<ul>
	<?php foreach ($imgs as  $value){
	?>
		<li class="img_item">
			<img  src="<?php echo $value; ?>" >
		</li>
	<?php } ?>
</ul>
<div id="bottom_row">
   <div><span id="current_page">1</span>/<span id="total_page"><?php echo (int)((count($imgs)+1)/2);  ?></span><!-- <?php echo count($imgs); ?> --></div> 
</div>
<?php 
	get_footer();
?>
