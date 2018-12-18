<?php 


$post=get_post(get_the_ID());

// var_dump($post);


	$videos = get_all_video_uri($post->post_content);
// 包含视频
if($videos) {
	// echo "string";
	include(get_my_source_directory("/single-video.php"));
	return;
	# code...
}


$content  = $post->post_content;

// 全是图片
if (!have_word($post->post_content)) {
	// echo "all_images";
	include(get_my_source_directory("/single-image.php"));
	return;
}
// echo "normal";
include(get_my_source_directory("/single-normal.php")); 

?>
