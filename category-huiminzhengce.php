<?php 
	get_header();
 ?>
<?php 

	// $cur_cat = get_query_var('cat');
	// var_dump(get_categories("child_of=3&hide_empty=0"));


 ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/huiminzhengce.js'; ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/huiminzhengce.css"); ?>">
	
<?php 
	
	$query_arr = array(
                'child_of' => get_query_var('cat'),
                'hide_empty'=> 0
            );
    $posts = get_categories($query_arr);
    $items =  array();
    foreach ($posts as $post) {
    	$item  = array();
        $item['href'] = get_category_custome_link($post);
        $item['name'] = $post->name;
        $item['img'] = get_my_resource_uri($post->category_nicename.'.png');

        array_push($items,$item);
    }
    display_items($items);
 ?>

 <?php 
 	get_footer();
  ?>
