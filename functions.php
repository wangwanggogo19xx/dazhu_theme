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
	wp_deregister_script('jquery');
	wp_register_script('jquery',get_template_directory_uri().'/js/jquery-1.8.1.min.js');

    wp_register_style( 'header_css', get_template_directory_uri().'/css/header.css' );
    wp_register_style( 'index_css', get_template_directory_uri().'/css/index.css' );


    // wp_enqueue_style('zhuchenglianyun_css',get_template_directory_uri().'/css/3D.css')

    
    
    if(is_category('minshengzijin')){
    	wp_register_style('minshengzijin_css',get_template_directory_uri().'/css/minshengzijin.css');
   		wp_register_script('minshengzijin_js',  get_template_directory_uri().'/js/minshengzijin.js',array('jquery'));

    	wp_enqueue_style('minshengzijin_css');
    	wp_enqueue_script('minshengzijin_js');
    	
    }else{

    	wp_enqueue_style('header_css');
    	wp_enqueue_style('index_css');

    }

    if (is_category('zhuchenglianyun') or is_category('cunwugongkai')) {
    	wp_register_style('zhuchenglianyun_css',get_template_directory_uri().'/css/3D.css');
   		wp_register_script('zhuchenglianyun_js',
    		get_template_directory_uri().'/js/nav_3d.js',array('jquery'));
   		
   		wp_enqueue_style('zhuchenglianyun_css');
    	wp_enqueue_script('zhuchenglianyun_js');
    }elseif (is_category('huiminzhengce')) {
        wp_register_style('huiminzhengce_css',get_template_directory_uri().'/css/huiminzhengce.css');
        wp_enqueue_style('huiminzhengce_css');
        # code...
    }
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

// 获取$content中的所有链接
function get_all_img_uri($content){
    $output = preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim',$content,$matches);
    return $matches[1];
}

 ?>
