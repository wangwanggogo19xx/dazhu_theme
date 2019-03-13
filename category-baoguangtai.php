<?php 
	get_header();
 ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/baoguangtai.css"); ?>">
<script type="text/javascript" src="<?php echo get_my_source_uri("/js/baoguangtai.js"); ?>"></script>

<?php 

	$pages['current_page'] = $_GET['page'];
    if (!$pages['current_page']) {
        $pages['current_page'] = 1;
    }
    $posts = get_my_page(get_query_var('cat'),$pages['current_page']);
    $items =  array();
    foreach( $posts as $index=>$post ){

        $item  = array();
        $item['href'] = $post->guid;
        $item['name'] = $post->post_title;
        $item['img'] = get_my_resource_uri($post->category_nicename.'exposure.png');

        array_push($items,$item);
    }
    $pages['total_page'] = ceil(get_category(get_query_var('cat'))->count / PER_PAGE_COUNT);
    display_items($items,$pages);

 ?>

<!-- </div> -->
 <?php 

 	get_footer();
  ?>