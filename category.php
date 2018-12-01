<!-- <?php echo "string"; ?> -->
<?php 

	function test(){
		wp_enqueue_style('category_css',get_template_directory_uri().'/css/category.css');
	}
	add_action( 'wp_enqueue_scripts', 'test');
	get_header();
 ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery-1.8.1.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/category.js'; ?>"></script>

<div class="left">
	<ul class="items">
	<!-- 第一个元素获得焦点 -->

		<?php 
			$page = $_GET['page'];
			if (!$page) {
				$page = 1;
			}
			// $posts = get_my_category(get_query_var('cat'),0);
			
			$posts = get_my_page(get_query_var('cat'),$page);
			if ($posts) {
				foreach( $posts as $index=>$post ){
			?>
						<a  href="<?php echo the_permalink(); ?>">
			                <li class="item">
			                		
			                   <?php the_title(); ?>

			                </li>
		           		</a>

			<?php
				}
			}else{
				echo "没有数据";
			}
?>       
</ul>
<p class="page"> 
	<?php 
	$per_page_count = 6;
	$total_pages = ceil(get_category(get_query_var('cat'))->count / $per_page_count);
	if($total_pages > 0){

	?>

	<span class="current_page"><?php echo $page; ?></span>
	/
	<span class="total_pages"><?php echo $total_pages; ?></span>
	<?php 
		}


	 ?>

</p>

</div>

<img src="<?php echo get_template_directory_uri().'/resources/catergories/index-right.jpg'; ?>" width="30%" height="100%">
      
 <!-- <ul> -->
 	
<?php 
 	get_footer();
?>