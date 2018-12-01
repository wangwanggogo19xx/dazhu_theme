<?php 
function get_category_custome_link($cate){

    $cate_link = get_category_link($cate->term_id);
    if(!is_null($cate->description) &&
        (strncmp($cate->description,'http:',5)==0 || strncmp($cate->description,"https:",6)==0)){
            $cate_link = trim($cate->description);
    }
    return  $cate_link;
}

function get_my_resource_uri($path="",$is_abs=false){

	if ($is_abs) {
		return $path;
		# code...
	}
    $cur_cat = get_category(get_query_var('cat'))->category_nicename;
	return get_template_directory_uri().'/resources/catergories/'.$cur_cat.'/'.$path;
}

function get_my_header($styles,$jses){
    // var_dump($styles);
    $styles;
    add_action('wp_enqueue_scripts','add_my_style',10,1);
    get_header();
}
function add_my_style($styles){
    // var_dump($styles);
    foreach( $styles as $style ){
        wp_enqueue_style($style['name'] , get_template_directory_uri().'/css/'.$style['name'],$style['pre'] );
    }
    // wp_enqueue_style
}
// add_action('wp_enqueue_scripts','add_my_style',10,1);

function add_my_script() {
	// wp_deregister_script('jquery');
	// wp_register_script('jquery',get_template_directory_uri().'/js/jquery-1.8.1.min.js');

 //    wp_register_style( 'header_css', get_template_directory_uri().'/css/header.css' );
 //    wp_register_style( 'index_css', get_template_directory_uri().'/css/index.css' );


 //    // wp_enqueue_style('zhuchenglianyun_css',get_template_directory_uri().'/css/3D.css')

    
    
 //    if(is_category('minshengzijin')){
 //    	wp_register_style('minshengzijin_css',get_template_directory_uri().'/css/minshengzijin.css');
 //   		wp_register_script('minshengzijin_js',  get_template_directory_uri().'/js/minshengzijin.js',array('jquery'));

 //    	wp_enqueue_style('minshengzijin_css');
 //    	wp_enqueue_script('minshengzijin_js');
    	
 //    }else{

 //    	wp_enqueue_style('header_css');
 //    	wp_enqueue_style('index_css');

 //    }

 //    if (is_category('zhuchenglianyun') or is_category('cunwugongkai')) {
 //    	wp_register_style('zhuchenglianyun_css',get_template_directory_uri().'/css/3D.css');
 //   		wp_register_script('zhuchenglianyun_js',
 //    		get_template_directory_uri().'/js/nav_3d.js',array('jquery'));
   		
 //   		wp_enqueue_style('zhuchenglianyun_css');
 //    	wp_enqueue_script('zhuchenglianyun_js');
 //    }elseif (is_category('huiminzhengce')) {
 //        wp_register_style('huiminzhengce_css',get_template_directory_uri().'/css/huiminzhengce.css');
 //        wp_enqueue_style('huiminzhengce_css');
 //        # code...
 //    }
    // $cur_cat = get_category(get_query_var('cat'))->category_nicename;
    // echo $cur_cat;
    // wp_enqueue_style($cur_cat.'_css','/css/');
   
}
add_action( 'wp_enqueue_scripts', 'add_my_script');






// add_action('template_include', 'load_single_template');
// function load_single_template($template) {
//   $new_template = '';
//   if( is_single() ) {
//     global $post;
//     if ( has_post_format( 'soft' )) {
//       $new_template = locate_template(array('single-testa.php' ));
//     }
//   }
//   return ('' != $new_template) ? $new_template : $template;
// }
add_theme_support('post-formats',array('aside','gallery'));
// add post-formats to post_type 'page'
add_post_type_support( 'page', 'post-formats' );
 
// add post-formats to post_type 'my_custom_post_type'
add_post_type_support( 'my_custom_post_type', 'post-formats' );

// 获取$content中的所有图片链接
function get_all_img_uri($content){
    $output = preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim',$content,$matches);
    if($output){
        // echo $output."=====";

        return $matches[1];
    }
    return false;
}
// 获取$content中的所有视屏链接地址
function get_all_video_uri($content){
    $output = preg_match_all('/<a[^<]+href="(.+?)"/is',$content,$matches);
    // $output = preg_match_all('/href="(.+?)"/is',$content,$matches);
    if($output){
        return $matches[1];
    }
    return false;
}


//获取民生资金查询结果
function query_livehood_funds($id_card){
     $livehood_welfare_ajax_query_url ='http://www.dzxyghmhdpt.gov.cn/fundsdetail!getFundsInfo.do?start=0&limit=5&permissionCode=978D90244C82F512E888DBE28270AC95&idCard=';
    $livehood_welfare_ajax_query_url = $livehood_welfare_ajax_query_url . $id_card;
    $curYear = date("Y");
    $resp = '[';
    for( $i=0;$i<2;$i++){
        $year = $curYear -$i;
        $query_url = $livehood_welfare_ajax_query_url . '&year=' . $year;
        $html = file_get_contents($query_url);

        if($resp{strlen($resp)-1}=='}'){
            $resp = $resp .',' .$html;
        }else{
            $resp = $resp .$html;
        }

    }
    $resp = $resp.']';

    return $resp;
}

//获取目录
function get_my_category($cat_id,$offset,$count = 6){

    return get_posts( array(
            'category' => $cat_id,
            'numberposts'=> $count,
            'offset' => $offset
        )); 
}
function get_my_page($cat_id,$current_page){
    $per_count = 6;
    return get_my_category($cat_id,($current_page - 1) * $per_count,$per_count);
}


//获取我的主题url
function get_my_source_directory($path=""){
    // echo get_template_directory_uri().$path;
    return  get_template_directory().$path;
}
function get_my_source_uri($path=""){
    // echo get_template_directory_uri().$path;
    return  get_template_directory_uri().$path;
}

// 获取曝光台展示的图片
function get_title_img($content,$default_img=
    null){
    if (!$default_img) {
        # code...
        $img_url =get_template_directory_uri().'/resources/catergories/baoguangtai/exposure.png';
    }
    // $img_url = $default_img;
    $imgs=get_all_img_uri($content);
    // var_dump($imgs);
    if($imgs && count($imgs)){
        $img_url = $imgs[0];
    }

    echo $img_url;

}

 ?>
