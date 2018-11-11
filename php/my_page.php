<?php 

header("Content-Type: text/html; charset=utf-8");

$action = $_POST['action'];
if($action != null){
	// $template_url = get_template_directory() ."/php/".$my_actions[$action].".php";
	$template_url = "/var/www/html/wp-content/themes/dazhu" ."/php/".$action.".php";
	// echo $template_url;
	if(file_exists($template_url)){
 		include($template_url);
	}else{
		echo "nothing";
	}
}

 ?>