<?php
/*
Single Post Template: 普通
Description: 只有文字的普通文章
*/
?>
<?php 
	get_header();
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/single_normal.css"); ?>">
<script type="text/javascript" src="<?php echo get_my_source_uri("/js/single_normal.js");  ?>"></script>


<?php 
	// $post=get_post(get_the_ID());
  if(!$post){
      $post=get_post(get_the_ID());
    }
 ?>
<?php while (have_posts()) : the_post(); ?>

<div id="top_row">
       <h3><?php the_title(); ?></h1> 
    </div>
       <article>
			<?php 
        // echo get_the_content();
        the_content(); 
      ?>
       </article>
       <div id="bottom_row">
   <div>
   	<span id="current_page">1</span>
   	/
   	<span id="total_page"></span>
   </div> 
 <?php endwhile; ?>
<?php 
	get_footer();
?>
