<?php 
	get_header();
 ?>

 <script type="text/javascript" src="<?php echo get_my_source_uri("/js/nav_3d.js"); ?>"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo get_my_source_uri("/css/3D.css"); ?>">
<ul>
 	
<?php 

	// $cur_cat = get_category(get_query_var('cat'))->category_nicename;

	$categories = get_categories(
            array(
                'child_of' => get_query_var('cat'),
                'hide_empty'=> 0
            ));
	$item_class_no = array("3","2","1","2","3");
	foreach ($categories as $index=>$category) {
	 	if($category->name != "未分类"){
	 		echo "<a class='item_".$item_class_no[$index]."' href='".get_category_custome_link($category)."'>
	 		<li class='item'>".
	 		"<img width='100%' height='100%' src='".get_my_resource_uri($category->category_nicename.'.png')."'>";
		 	echo "</li></a>";
	 	}	

	 }
 ?>
</ul>

 <?php 
 	get_footer();
  ?>