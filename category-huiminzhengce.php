<?php 
	get_header();
 ?>
<?php 

	$cur_cat = get_query_var('cat');
	// var_dump(get_categories("child_of=3&hide_empty=0"));


 ?>

<ul>
 	
<?php 

	$cur_cat = get_category(get_query_var('cat'))->category_nicename;

	$categories = get_categories(
            array(
                'child_of' => get_query_var('cat'),
                'hide_empty'=> 0
            ));
	// $categories = get_term_children(get_query_var('cat'),'category');
	foreach ($categories as $category) {
	 	if($category->name != "未分类"){
	 		// var_dump($category);
	 		echo "<a  href='".get_category_custome_link($category)."'>
	 		<li class='item'>".
	 		"<img height='100%' src='".get_my_resource_uri($category->category_nicename.'.png')."'><div class='item_name'>".$category->name."</div>";
		 	echo "</li></a>";
	 	}	

	 }
 ?>
</ul>

 <?php 
 	get_footer();
  ?>
