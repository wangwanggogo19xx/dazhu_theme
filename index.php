<?php  
/**
 * The main template file.
 * @package dazhu
 */
	get_header();
?>
<ul id="index_left">
	<?php 
		$top_categories = get_categories(
            array(
                'parent' => 0,
                'orderby'=> 'name'
            ));
		// var_dump(get_the_category());
		// var_dump($top_categories);
		// var_dump();
		 foreach ($top_categories as $top_category) {
		 	if($top_category->name != "未分类"){
		 		echo "<a href='".get_category_custome_link($top_category)."'><li class='nav_item border_5_blue'>";
		 	echo $top_category->name;
		 	echo "</li></a>";
		 	}	

		 }
	?>

    </ul>
    <div id="index_center">
        <img width="100%" height="100%" src="<?php echo get_template_directory_uri()."/resource/image/index-center-2.jpg"; ?>">
    </div>
    <div id="index_right">
        <div id="index_right_1">
            <h2>石河镇 新华村</h2>
        </div>
        <div id="index_right_2">
            <h1>通知公告</h1>
            <div id="infomation">
				<?php  
					echo get_post( 12)->post_content;
				?>
            </div>
        </div>

    </div>
    <div class="clear_float"></div>

<?php get_footer(); ?>