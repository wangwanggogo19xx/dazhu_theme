<?php 


$post=get_post(get_the_ID());
var_dump($post);


// if (get_all_img_uri($post->post_content)) {
// 	include(get_my_source_directory("/single-image.php"));


// 	echo "image";
// 	return;
// 	# code...
// }


if(get_all_video_uri($post->post_content)) {
	include(get_my_source_directory("/single-video.php"));
	echo "video";
	return;
	# code...
}
// echo "normal";
include(get_my_source_directory("/single-normal.php")); 


?>

