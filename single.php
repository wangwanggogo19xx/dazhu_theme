<!-- <?php echo "aaaaaa"; ?> -->
<?php 
	echo get_post_format();
	echo has_post_format( 'aside');
	echo has_post_format( 'video');
	$post=get_post(get_the_ID());
	var_dump($post);

 ?>
<?php while (have_posts()) : the_post(); ?>
<!-- <?php the_title(); ?>
<?php the_content(); ?> -->
<!-- <?php the_tags('','','') =="video"; ?> -->
<!-- <?php echo get_tag(); ?> -->
<?php endwhile; ?>