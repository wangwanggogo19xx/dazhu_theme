<!-- <?php echo "string"; ?> -->
<?php 

	function test(){
		wp_enqueue_style('category_css',get_template_directory_uri().'/css/category.css');
	}
	add_action( 'wp_enqueue_scripts', 'test');
	get_header();
	// $styles = array(
	// 		'name'=>'category.css',
	// 		'pre'=>array()
	// 		);
	// do_action( 'wp_head', $styles, "");
// get_my_header(array(
// 			'name'=>'category.css',
// 			'pre'=>array()
// 			),"");
	
	// do_action('wp_head');
 ?>

<ul>
<?php 
// var_dump(get_category(get_query_var('cat')));
	$posts = get_posts( array(
            'category' => get_query_var('cat'),
            'numberposts'=> 3,
            'offset' => 1
        )); 
	$per_page_count = 6;
	if ($posts) {
		foreach( $posts as $index=>$post ){
			if($index < $per_page_count){
	?>
				<a  href="<?php echo the_permalink(); ?>">
	                <li class="item">
	                		
	                   <?php the_title(); ?>

	                </li>
           		</a>

	<?php
			}
		}
	}
?>       
</ul>
<img src="<?php echo get_template_directory_uri().'/resources/catergories/index-right.jpg'; ?>" width="30%" height="100%">
      
 <!-- <ul> -->
 	
<?php 
	
	// $cur_cat = get_category(get_query_var('cat'))->category_nicename;
	// var_dump(the_title());
	// $categories = get_categories(
 //            array(
 //                'child_of' => get_query_var('cat'),
 //                'hide_empty'=> 0
 //            ));
	// var_dump($categories);
	// foreach ($categories as $category) {
	//  	if($category->name != "未分类"){
	//  		echo "<a class='item_' href='".get_category_custome_link($category)."'>
	//  		<li>".
	//  		"<img width='100%' height='100%' src='".get_my_resource_uri($category->category_nicename.'.png')."'>";
	// 	 	echo "</li></a>";
	//  	}	

	//  }

 ?>
<!-- <?php
$cat_query=new WP_Query(array(
    'cat' => get_query_var('cat'),
    'posts_per_page'=>2 ));    
?>


<?php
   if($cat_query->have_posts()){
   	while($cat_query->have_posts()) {
   		$cat_query->the_post();
   	}
   };
?>
<?php $posts = get_posts( array(
                'category' => get_query_var('cat'),
                'numberposts'=> 3,
                'offset' => 1
            )); ?>  
<?php if( $posts ) : ?>  
<ul><?php foreach( $posts as $post ) : setup_postdata( $post ); ?>  
<li>  
<a href=”<?php the_permalink() ?>” rel=”bookmark” title=”<?php the_title(); ?>”><?php the_title(); ?></a>  
</li>  
<?php endforeach; ?>  
</ul>  
<?php endif; ?>
</ul> -->

<?php 
 	get_footer();
?>