<?php
/**
 * Set content width
 */

// Change the upload size to 10MB
add_filter('upload_size_limit', 'wp_change_upload_size');
function wp_change_upload_size()
{
    return 1024 * 1024 * 20;
}

function metro_creativex_setup()
{

    global $content_width;

    if (!isset($content_width)) $content_width = 600;

    load_theme_textdomain('metro-creativex', get_template_directory() . '/languages');

    /*
    * Register menus
    */
    register_nav_menus(
        array(
            'secound' => __('Header menu', 'metro-creativex')
        )
    );
    // Add theme support for Featured Images
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /**
     * Enable support for Post Formats
     */
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    add_editor_style('/css/custom-editor-style.css');
    /* custom background */
    /*add_theme_support( 'custom-background' );*/

    require get_template_directory() . '/inc/customizer.php';
    /* tgm-plugin-activation */
    require_once get_template_directory() . '/class-tgm-plugin-activation.php';
    /* custom header */
    $args = array(
        'width' => 980,
        'height' => 60,
        'default-image' => '',
        'uploads' => true,
    );
    add_theme_support('custom-header', $args);

}

add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function metro_creativex_register_sidebar()
{


    register_sidebar(array(
        'name' => __('Left sidebar', 'metro-creativex'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside><br style="clear:both">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

}

//add_action( 'widgets_init',  "metro_creativex_register_sidebar");

add_action('after_setup_theme', 'metro_creativex_setup');

// Custom title function
function metro_creativex_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'metro-creativex'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'metro_creativex_wp_title', 10, 2);

/**
 * Returns the URL from the post.
 */
function metro_creativex_link_post_format()
{
    $content = get_the_content();
    $has_url = get_url_in_content($content);
    return ($has_url) ? $has_url : apply_filters('the_permalink', get_permalink());
}

/**
 * Enqueue scripts and styles
 */
function metro_creativex_theme_scripts()
{
    $blog_url = home_url();

    wp_enqueue_style('metro_creativex-style', get_stylesheet_uri());

    wp_enqueue_style('font_awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', '1.0.0');

    wp_enqueue_style('page_css', get_template_directory_uri() . '/css/page.css');
    wp_enqueue_style('head_css', get_template_directory_uri() . '/css/head.css');
//    wp_enqueue_style('article_css', get_template_directory_uri() . '/css/article.css');
//    wp_enqueue_style('list_css', get_template_directory_uri() . '/css/list.css');
//    wp_enqueue_style('mui_css', get_template_directory_uri() . '/css/mui.min.css');


    /*wp_enqueue_style( 'mui_min_css', get_template_directory_uri() . '/css/mui.min.css','1.0.0' );*/

    //wp_enqueue_style( 'video_js_min_css', get_template_directory_uri() . '/css/video-js.min.css','1.0.0' );

    //wp_enqueue_style( 'metro_creativex_opensans-font', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');

    //wp_enqueue_style( 'metro_creativex_sourcesans-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic');

    wp_enqueue_script('jquery_script', get_template_directory_uri() . '/js/jquery-1.8.1.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('toast_script', get_template_directory_uri() . '/js/toast.js', array('jquery'), '1.0', true);

    if(is_page()){
        wp_enqueue_script('jquery_qrcode_script', get_template_directory_uri() . '/js/jquery.qrcode.min.js', array('jquery'), '1.0', true);
    }


    wp_enqueue_script('header_jscript', get_template_directory_uri() . '/js/header.js', array('jquery'), '1.0', true);
    wp_enqueue_script('page_jscript', get_template_directory_uri() . '/js/page.js', array('jquery'), '1.0', true);
    if (is_single()) {
        wp_enqueue_script('easing_jscript', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.0', true);
        wp_enqueue_script('textify_jscript', get_template_directory_uri() . '/js/textify.js', array('jquery'), '1.0', true);
        wp_enqueue_script('article_jscript', get_template_directory_uri() . '/js/article.js', array('jquery'), '1.0', true);
    }
    if(is_home()){
        wp_enqueue_script('index_jscript', get_template_directory_uri() . '/js/index.js', array('jquery'), '1.0', true);
        wp_enqueue_script('unslider_jscript', get_template_directory_uri() . '/js/unslider.min.js', array('jquery'), '1.0', true);
    }


//    wp_enqueue_script('mui_jscript', get_template_directory_uri() . '/js/mui.min.js', array('jquery'), '1.0', true);

    /*wp_enqueue_script( 'metro_creativex_mui_js', get_template_directory_uri() . '/js/mui.min.js', array('jquery'), '1.0', true );*/

    //wp_enqueue_script( 'vedio_js', get_template_directory_uri() . '/js/video.min.js', array('jquery'), '1.0', true );

    /*wp_enqueue_script( 'metro_creativex_carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.1.0.js', array('jquery'), '6.1', true );*/
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (!is_single() and !is_page()) {
        /*wp_enqueue_script( 'metro_creativex_masonry', get_template_directory_uri() . '/js/metrox-masonry.js', array('jquery', 'masonry'), '1.0', true );*/
    }


}

add_action('wp_enqueue_scripts', 'metro_creativex_theme_scripts');

/**
 * Remove Gallery shortcode css style
 */
add_filter('use_default_gallery_style', '__return_false');
/**
 * Displays navigation to next/previous set of posts when applicable.
 */
function metro_creativex_pagination()
{
    global $wp_query;
    // Don't print empty markup if there's only one page.
    if ($wp_query->max_num_pages < 2)
        return;
    ?>
    <article class="navigation" role="navigation">
        <?php if (get_next_posts_link()) : ?>
            <div class="nav-previous"><?php next_posts_link(__('Older posts', 'metro-creativex')); ?></div>
        <?php endif; ?>
        <?php if (get_previous_posts_link()) : ?>
            <div class="nav-next"><?php previous_posts_link(__('Newer posts', 'metro-creativex')); ?></div>
        <?php endif; ?>
    </article><!-- .navigation -->
    <?php
}

add_action('tgmpa_register', 'metro_creativex_register_required_plugins');


function metro_creativex_register_required_plugins()
{


    $plugins = array(


        array(

            'name' => 'Custom Login customizer',

            'slug' => 'login-customizer',

            'required' => false,

        ),

        array(

            'name' => 'Revive Old Post (Former Tweet Old Post)',

            'slug' => 'tweet-old-post',

            'required' => false,

        )

    );


    $config = array(

        'default_path' => '',

        'menu' => 'tgmpa-install-plugins',

        'has_notices' => true,

        'dismissable' => true,

        'dismiss_msg' => '',

        'is_automatic' => false,

        'message' => '',

        'strings' => array(

            'page_title' => __('Install Required Plugins', 'metro-creativex'),

            'menu_title' => __('Install Plugins', 'metro-creativex'),

            'installing' => __('Installing Plugin: %s', 'metro-creativex'),

            'oops' => __('Something went wrong with the plugin API.', 'metro-creativex'),

            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'metro-creativex'),

            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'metro-creativex'),

            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'metro-creativex'),

            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'metro-creativex'),

            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'metro-creativex'),

            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'metro-creativex'),

            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'metro-creativex'),

            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'metro-creativex'),

            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'metro-creativex'),

            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'metro-creativex'),

            'return' => __('Return to Required Plugins Installer', 'metro-creativex'),

            'plugin_activated' => __('Plugin activated successfully.', 'metro-creativex'),

            'complete' => __('All plugins installed and activated successfully. %s', 'metro-creativex'),

            'nag_type' => 'updated'

        )

    );


    tgmpa($plugins, $config);


}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own metro_creativex_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since metro-creativex 1.0
 */


function metro_creativex_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e('Pingback:', 'metro-creativex'); ?><?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'metro-creativex'), '<span class="edit-link">', '</span>'); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>
            <div id="comment-<?php comment_ID(); ?>" class="comment">
                <div class="avatar"><?php echo get_avatar($comment, 44); ?></div>
                <div class="comm_content">
				<span><?php
                    printf('<cite class="fn">%1$s %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ($comment->user_id === $post->post_author) ? '<span> ' . __('', 'metro-creativex') . '</span>' : ''
                    );
                    printf('<b><a href="%1$s"><time datetime="%2$s">%3$s</time></a></b>',
                        esc_url(get_comment_link($comment->comment_ID)),
                        get_comment_time('c'),
                        /* translators: 1: date, 2: time */
                        sprintf(__('%1$s at %2$s', 'metro-creativex'), get_comment_date(), get_comment_time())
                    );
                    ?></span>
                    <?php comment_text(); ?>
                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'metro-creativex'); ?></p>
                    <?php endif; ?>
                    <?php edit_comment_link(__('Edit', 'metro-creativex'), '<p class="edit-link">', '</p>'); ?>
                    <div class="reply">
                        <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'metro-creativex'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => 20))); ?>
                    </div><!-- .reply -->
                </div><!--/comm_content-->

            </div><!--/comment-->
            <?php
            break;
    endswitch; // end comment_type check
}


//add_filter( 'post_class', 'metro_creativex_post_class' );

function metro_creativex_post_class($classes)
{
    global $post;

    if (is_single($post->ID)):
        $class[] = 'post';
    else:
        $format = get_post_format($post->ID);
        if ($format == 'aside'):
            $class[] = 'bg-design';
        elseif (($format == 'audio') || ($format == 'video')):
            $class[] = 'bg-wordpress';
        elseif (($format == 'gallery') || ($format == 'image')):
            $class[] = 'bg-responsive';
        elseif (($format == 'link') || ($format == 'quote') || ($format == 'status')):
            $class[] = 'bg-web';
        else:
            $class[] = 'bg-stuff';
        endif;
    endif;

    return $class;

}

function metro_creativex_excerpt_max_charlength($charlength)
{
    $excerpt = get_the_excerpt();
    $charlength++;

    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $excerpt;
    }
}

add_action('wp_footer', 'metro_creativex_php_style', 100);

function metro_creativex_php_style()
{

    echo ' <style type="text/css">';

    $metro_creativex_text_color = get_theme_mod('metro-creativex_text_color');
    if (!empty($metro_creativex_text_color)):
        echo '	#topside h1, #content article .post_content, #content p, .insidepost_date, header, #searchform .searchtext, p, span { color: ' . esc_attr($metro_creativex_text_color) . ' !important; }';
    endif;

    $metro_creativex_link_color = get_theme_mod('metro-creativex_link_color');
    if (!empty($metro_creativex_link_color)):
        echo ' .left-sidebar li a, #content article .post_content a, a { color: ' . esc_attr($metro_creativex_link_color) . ' ; }';
    endif;

    $metro_creativex_link_color_hover = get_theme_mod('metro-creativex_link_color_hover');
    if (!empty($metro_creativex_link_color_hover)):
        echo ' .left-sidebar li a:hover, #content article .post_content a:hover, a:hover { color: ' . esc_attr($metro_creativex_link_color_hover) . ' !important; }';
    endif;

    $metro_creativex_nav_color = get_theme_mod('metro-creativex_nav_color');
    if (!empty($metro_creativex_nav_color)):
        echo ' #topside .pages ul a { color: ' . esc_attr($metro_creativex_nav_color) . ' !important; }';
    endif;

    $metro_creativex_nav_color_hover = get_theme_mod('metro-creativex_nav_color_hover');
    if (!empty($metro_creativex_nav_color_hover)):
        echo ' #topside .pages ul a:hover { color: ' . esc_attr($metro_creativex_nav_color_hover) . ' !important; }';
    endif;

    $metro_creativex_sidebar_title_color = get_theme_mod('metro-creativex_sidebar_title_color');
    if (!empty($metro_creativex_sidebar_title_color)):
        echo ' .widget-title { color: ' . esc_attr($metro_creativex_sidebar_title_color) . ' !important; }';
    endif;

    echo '</style>';

}

//add_action('set_cookies', 'wp_set_cookies');
//function wp_set_cookies($key, $value)
//{
//    setcookie($key, $value, time() + 1209600, COOKIEPATH, COOKIE_DOMAIN, false);
//}


add_action('maple-news-title-list', 'maple_news_title_list_display');
function maple_news_title_list_display()
{
    ?>
    <div class=" right_list_news title-list">
        <ul>
            <?php if (have_posts()) : ?>
                <?php /* The loop */ ?>
                <?php
//                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $page = (get_query_var('page')) ? get_query_var('page') : 1;
                $cur_cate_name = single_term_title('', false);
                $posts_per_page = 6;
                $custom_query_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'category_name' => $cur_cate_name,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'paged' => $page,

                );
                $custom_query = new WP_Query($custom_query_args);
                $total_pages = $custom_query->max_num_pages;  //总共多少页
                $current_page = $page; //当前第几页

                $have_next_page = 0;
                if ($current_page < $total_pages) {
                    $have_next_page = 1;
                }
                //echo "total page '. $total_pages.' ";
                echo '<input type="hidden" id="pages_info" current_page="', esc_html($current_page), '" total_pages="', esc_html($total_pages), '" >';
                //echo '<button id="up-btn">上一页</button><button id="down-btn">下一页</button>';

                $idx = 0;
                if ($custom_query->have_posts()) {

                    while ($custom_query->have_posts()) {
                        $idx++;
                        $custom_query->the_post();

                        //get_template_part('content', get_post_format());
                        // pass params to template
                        include(locate_template('content.php'));
                    }
                }
                wp_reset_postdata();

                ?>


            <?php else : ?>
                <!--    --><?php //get_template_part('content', 'none'); ?>
            <?php endif; ?>

        </ul>
    </div>

    <?php

}


add_action('maple-subnav', 'maple_subnav_display');
function maple_subnav_display()
{
    ?>


    <ul class="subnav-list-group text-align-center">
        <?php

        //        single_cat_title();
        $categories = get_the_category();
        $cur_cate = get_queried_object();
        $parent_id = 0;
        //        var_dump($categories);

        if ($cur_cate->parent == 0) {
            //只有一级菜单，默认显示第一个菜单的子菜单
            $parent_id = $cur_cate->term_id;
            //获取所有的子菜单
            $children = get_categories(
                array(
                    'parent' => $cur_cate->term_id,
                    'hide_empty' => 0
                )
            );
            if (!empty($children)) {
                //获取第一个菜单的子菜单
                $parent_id = $children[0]->term_id;
            }


        } else {


            //二级 或者 三级菜单 ， 获取上一级菜单
            $parent = get_categories(
                array(
                    'term_taxonomy_id' => $cur_cate->parent,
                    'hide_empty' => 0

                )
            );
//                var_dump($parent);

            if ($parent[0]->parent == 0) {
                //上级菜单是顶级菜单，当前二级
                $parent_id = $cur_cate->term_id;
            } else {
                //三级
                $parent_id = $cur_cate->parent;
            }


        }


        $cates = get_categories(
            array(
                'parent' => $parent_id,
                'hide_empty' => 0
            )
        );

        //        var_dump($metro_creativex_terms);

        if ($cates) {


            foreach ($cates as $cate) {

                $link = get_category_link($cate->term_id);
                $cate_name = $cate->name;
                if(!is_null($GLOBALS['custome_pages']) ){
                    $custome_pages = $GLOBALS['custome_pages'];
                    if(isset($custome_pages[$cate_name])){
                        $custome_page = $custome_pages[$cate_name];
                        if($custome_page['type'] =='qrcode'){
                            $link = home_url( '/' ).'qrcode'.'?cate_name='.$cate_name;

                        }
                    }
                }
                echo '<a  href="' . $link . '"  
                title="' . $cate_name . '">' . '<li >'
                    . $cate_name . '</li></a>';
            }
        }

        ?>
    </ul>


    <?php
//    do_action('metro_creativex_social');
}


add_action('metro-creativex_sidebar', 'metro_creativex_sidebar_display', 10);
function metro_creativex_sidebar_display()
{
    ?>


    <nav>
        <ul>
            <?php

            $cur_cate = get_queried_object();
            //            $cur_cate_name = $cur_cate->name;
            $parent_id = 0;
            //            var_dump($cur_cate_name);
            //            var_dump($categories);


            if ($cur_cate->parent == 0) {
                //只有一级菜单
                $parent_id = $cur_cate->term_id;
                //默认二级菜单第一个高亮显示
                $cate_level = 1;


            } else {

                // 三级标题，get_the_category 查不到category信息了
                // 必须通过当前分类获取上级分类的上级分类来显示二级分类信息
//                var_dump($cur_cate);
//                var_dump($cur_cate->parent);
                $parent = get_categories(
                    array(
                        'term_taxonomy_id' => $cur_cate->parent,
                        'hide_empty' => 0

                    )
                );
//                $parent = get_the_category($cur_cate->parent);
//                var_dump($parent);
                if ($parent[0]->parent == 0) {
                    //二级标题
                    $parent_id = $parent[0]->term_id;
                } else {
                    //三级标题
                    $parent_id = $parent[0]->parent;
                }

            }

            $top_parent = get_categories(
                array(
                    'parent' => $parent_id,
                    'hide_empty' => 0
                )
            );

            //        var_dump($metro_creativex_terms);

            if ($top_parent) {

                foreach ($top_parent as $cate) {
                    echo '<a class="list-group-item" href="' . get_category_link($cate->term_id) . '"  
                title="' . $cate->name . '"  cate_id = "' . $cate->term_id . '">' . '<li class="nav-item"><span>&nbsp;'
                        . $cate->name . '</span></li></a>';
                }
            }


            ?>
        </ul>
    </nav>


    <?php
//    do_action('metro_creativex_social');
}

add_action('show_title', 'metro_creativex_blog_title');
function metro_creativex_blog_title()
{
    echo '<h1>';
    _e('Latest articles', 'metro-creativex');
    echo '</h1>';
}


add_action('page_title', 'metro_creativex_page_title');
function metro_creativex_page_title()
{
    echo '<h1 class="insidepost">';
    the_title();
    echo '</h1>';
}

add_action('metro_creativex_social', 'metro_creativex_social_display');
function metro_creativex_social_display()
{
    $metro_creativex_fb_link = get_theme_mod('metro-creativex_social_link_fb');
    $metro_creativex_tw_link = get_theme_mod('metro-creativex_social_link_tw');
    echo '<div id="social">';
    if (!empty($metro_creativex_fb_link) || !empty($metro_creativex_tw_link)) {
        if (!empty($metro_creativex_fb_link)) :
            echo '<a href="' . esc_url($metro_creativex_fb_link) . '"><img src="' . get_template_directory_uri() . '/images/facebook.png" alt=""></a>';
        endif;
        if (!empty($metro_creativex_tw_link)) :
            echo '<a href="' . esc_url($metro_creativex_tw_link) . '"><img src="' . get_template_directory_uri() . '/images/twitter.png" alt=""></a>';
        endif;
    }
    echo '</div>';
}


function metro_creativex_admin_styles()
{
    wp_enqueue_style('metro_creativex_admin_stylesheet', get_template_directory_uri() . '/css/admin-style.css', '1.0.0');
}

add_action('admin_enqueue_scripts', 'metro_creativex_admin_styles', 10);


include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('metro-customizr/metro-customizr.php')) {
    add_action('admin_menu', 'metro_creativex_menu');
}
function metro_creativex_menu()
{
    add_theme_page('Metro CustomizR', 'Metro CustomizR', 'edit_theme_options', 'metro-customizr-page', 'metro_creativex_page');
}

function metro_creativex_page()
{
    ?>
    <div class="metro-customizr-jumbotron">
        <div class="container">
            <div class="metro-customizr-logo">
                <a href="http://themeisle.com/"><img
                            src="<?php echo get_template_directory_uri() . '/images/th_logo.png' ?>"/></a>
            </div>
            <h1><?php _e('Get unlimited customization possibilities', 'metro-creativex'); ?></h1>
            <p><?php _e('Fonts, colors, layout, everything is customizable. Super easy, super fast!', 'metro-creativex'); ?></p>
            <a href="http://themeisle.com/plugins/metro-customizr/"><?php _e('Get Metro CustomizR now!', 'metro-creativex'); ?></a>
        </div>
    </div>
    <div class="metro-customizr-presentation">
        <div class="container">
            <h1><?php _e('What You Will Get', 'metro-creativex'); ?></h1>
            <article>
                <p>
                    <?php
                    _e('Metro CustomizR is an addon plugin for Metro CreativeX that allows you to customize your theme the way you want. No more child themes or support needed. Just install it and you\'re ready to customize your website. Easy peasy!', 'metro-creativex');
                    ?>
                </p>
            </article>
            <div class="metro-customizr-left-col">
                <div class="metro-customizr-box">
                    <img src="<?php echo get_template_directory_uri() . '/images/palette.png' ?>"/>
                    <h3><?php _e('Palette picker', 'metro-creativex'); ?></h3>
                    <p><?php _e('Change your page colors in just a few clicks with our palette picker control.', 'metro-creativex'); ?></p>
                </div>
                <div class="metro-customizr-box">
                    <img src="<?php echo get_template_directory_uri() . '/images/individual.png' ?>"/>
                    <h3><?php _e('Individual post color', 'metro-creativex'); ?></h3>
                    <p><?php _e('No more child theme required.Customize each post background color.', 'metro-creativex'); ?></p>
                </div>
            </div>
            <div class="metro-customizr-right-col">
                <div class="metro-customizr-box">
                    <img src="<?php echo get_template_directory_uri() . '/images/document.png' ?>"/>
                    <h3><?php _e('Website layout', 'metro-creativex'); ?></h3>
                    <p><?php _e('With just one click you can change the sidebar position.', 'metro-creativex'); ?></p>
                </div>
                <div class="metro-customizr-box">
                    <img src="<?php echo get_template_directory_uri() . '/images/fonts.jpg' ?>"/>
                    <h3><?php _e('Fonts', 'metro-creativex'); ?></h3>
                    <p><?php _e('Choose from over 100 fonts to style your page.', 'metro-creativex'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_action('single_header', 'metro_creativex_display_single_header');

function metro_creativex_display_single_header()
{
    ?>
    <!--
	<h1 class="insidepost" style="background-image:url(
	<?php
    $metro_creativex_template_url = get_template_directory_uri();
    if (has_post_format('aside')) {
        echo $metro_creativex_template_url . '/images/pt_aside.png';
    } elseif (has_post_format('audio')) {
        echo $metro_creativex_template_url . '/images/pt_audio.png';
    } elseif (has_post_format('chat')) {
        echo $metro_creativex_template_url . '/images/pt_chat.png';
    } elseif (has_post_format('gallery')) {
        echo $metro_creativex_template_url . '/images/pt_gallery.png';
    } elseif (has_post_format('image')) {
        echo $metro_creativex_template_url . '/images/pt_image.png';
    } elseif (has_post_format('link')) {
        echo $metro_creativex_template_url . '/images/pt_link.png';
    } elseif (has_post_format('quote')) {
        echo $metro_creativex_template_url . '/images/pt_quote.png';
    } elseif (has_post_format('status')) {
        echo $metro_creativex_template_url . '/images/pt_status.png';
    } elseif (has_post_format('video')) {
        echo $metro_creativex_template_url . '/images/pt_video.png';
    } else {
        echo $metro_creativex_template_url . '/images/pt_standard.png';
    }
    ?>);"><?php the_title(); ?></h1>
	-->

    <h1 class="insidepost"> <?php the_title(); ?></h1>

    <div class="insidepost_date"><?php echo get_the_date(); ?> </div>
    <?php
}

add_action('archive_title', 'metro_creativex_display_archive_title');
function metro_creativex_display_archive_title()
{
    ?>
    <h1>
        <?php
        if (is_day()) :
            printf(__('Daily Archives: %s', 'metro-creativex'), get_the_date());
        elseif (is_month()) :
            printf(__('Monthly Archives: %s', 'metro-creativex'), get_the_date(_x('F Y', 'monthly archives date format', 'metro-creativex')));
        elseif (is_year()) :
            printf(__('Yearly Archives: %s', 'metro-creativex'), get_the_date(_x('Y', 'yearly archives date format', 'metro-creativex')));
        else :
            single_cat_title();
        endif;
        ?>
    </h1>
    <?php
}

//add by zhangwang
function myScripts()
{
    //wp_register_script( 'myJquery', 'https://code.jquery.com/jquery-3.2.1.min.js' );
    //wp_register_style( 'default', get_template_directory_uri() . '/test.css' );
//    wp_register_script('default', get_template_directory_uri() . '/js/page.js');
    if (is_single()) {
        /** Load Scripts and Style on Posts Only */
        //wp_deregister_script( 'jquery' );
//        wp_enqueue_script('myJquery');
        wp_enqueue_script('default');
        //wp_enqueue_style('default');
    }
}

add_action('wp_enqueue_scripts', 'myScripts');

add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        }else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
        echo get_post_meta($id,'bigfa_ding',true);
    }
    die;
}