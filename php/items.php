<?php 

	// function get_items()


 ?>
<div id="items_container">
	<ul id="items">
	
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
			        <li class="item_wrapper">

						<a  href="<?php echo the_permalink(); ?>">
								<div class="item">
									<img src="<?php echo get_my_resource_uri("/") ?>">
										<div class="item_name">
					               		    <?php the_title(); ?>
										</div>
								</div>
		           		</a>
			        </li>


			<?php
				}
			}else{
				echo "没有数据";
			}
	?>       
	</ul>
	<!-- <ul id="items"> -->
	<!-- <li class="item_wrapper" > -->
		<!-- <a href=""> -->
<!-- 			<div class="item">
				<img src="item_img">
				<div class="item_name"></div>
			</div>
		</a>
	</li>	
</ul> -->
<div id="page">
	<p> 
	<span class="current_page">1</span>
	/
	<span class="total_pages">1</span>
	</p>
</div>

</div>

