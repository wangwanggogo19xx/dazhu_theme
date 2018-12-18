<?php 
	get_header();
 ?>
<?php 

	$cur_cat = get_query_var('cat');
	// var_dump(get_categories("child_of=3&hide_empty=0"));


 ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/huiminzhengce.js'; ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/huiminzhengce.css"); ?>">
	
<?php 
	
	$query_arr = array(
                'child_of' => get_query_var('cat'),
                'hide_empty'=> 0
            );

	 $exclude = array();
     $conf = array(
            'item_img' => true,
            'item_name' => true,
            'show_page' =>false,
            'current_page_count' => 0,
            'is_category' =>true
        );
    get_items($query_arr,$exclude,$conf);
	// $cur_cat = get_category(get_query_var('cat'))->category_nicename;

	// $categories = get_categories(
 //            array(
 //                'child_of' => get_query_var('cat'),
 //                'hide_empty'=> 0
 //            ));
	// // $categories = get_term_children(get_query_var('cat'),'category');
	// foreach ($categories as $category) {
	//  	if($category->name != "未分类"){
	//  		// var_dump($category);
	//  		echo "<a  href='".get_category_custome_link($category)."'>
	//  		<li class='item'>".
	//  		"<img height='100%' src='".get_my_resource_uri($category->category_nicename.'.png')."'><div class='item_name'>".$category->name."</div>";
	// 	 	echo "</li></a>";
	//  	}	

	//  }
 ?>

 <?php 
 	get_footer();
  ?>
