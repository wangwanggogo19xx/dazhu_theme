<!-- <?php 



 ?> -->

<!-- <link rel="stylesheet" type="text/css" href="<?php 
 echo get_my_source_uri("/css/items.css") ?>"> -->
<!-- <script type="text/javascript" src="<?php 
 echo get_my_source_uri("/js/item.js") ?>"></script> -->



 <div id="items_container">
 	 <ul>
		<?php 
				$page = $_GET['page'];
				if (!$page) {
					$page = 1;
				}
				
				$posts = get_my_page(get_query_var('cat'),$page);
				if ($posts) {
					foreach( $posts as $index=>$post ){
				?>
				<a  href="<?php echo the_permalink(); ?>">
	                <li class="item">
	                    <img  width="100%" height="80%" src="<?php get_title_img($post->post_content); ?>">
	                    <div class="item_name"><?php the_title(); ?></div>
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
