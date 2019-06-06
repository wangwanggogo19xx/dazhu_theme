<?php
/**
 * Created by IntelliJ IDEA.
 * User: 827605162@qq.com
 * Date: 2018/3/27
 * Time: 17:19
 */

function my_table_install () {   
    global $wpdb;
    $table_name = $wpdb->prefix . "card";  //获取表前缀，并设置新表的名称
    if($wpdb->get_var("show tables like '$table_name'") != $table_name) {  //判断表是否已存在
        $sql = "CREATE TABLE " . $table_name . " (
		id int auto_increment primary key not null,
		card_no char(12) unique not null,
   		village varchar(255) not null,
    		town varchar(255) not null,
    		tag varchar(15)
	)engine InnoDB charset=utf8 ;";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");  //引用wordpress的内置方法库

        dbDelta($sql);
    }
}
my_table_install ();

function get_cards($page,$count=5){
	global $wpdb;
	$sql= "select id,card_no,village,town,tag from ".$wpdb->prefix."card limit ".$page*$count.",".$count.";";
	$results = $wpdb->get_results($sql);
//	$i=0;
	#echo $sql;
//	while($i < count($results)){
		//echo $results[$i]->
//		var_dump($results[$i]);
//		$i=$i + 1;
//	}
	return $results;
}
function delete_card_by_id($id){
	global $wpdb;
	//$sql="delete from ".$wpdb->prefix."card where id =".$id." ;";
	$where = array("id"=>$id);
	$result = $wpdb->delete($wpdb->prefix.'card',$where);
	//echo $result."=====";
	return $result;
}
function insert_card($card_no,$village,$town,$tag){
	global $wpdb;
	$data = array(
		"card_no"=>$card_no,
		'village'=>$village,
		'town'=>$town,
		'tag'=>$tag
	);
	return $wpdb->insert($wpdb->prefix.'card',$data);
}

	/**
	*
	*
	*/
function get_total_page($count = 5){
	global $wpdb;
	$sql= "select count(id) as `count` from ".$wpdb->prefix."card ;";
	$results = $wpdb->get_results($sql);
	return (int)($results[0]->count / $count) +ceil($results[0]->count % $count) - 1;
}




?>
