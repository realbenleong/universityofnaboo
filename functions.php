<?php
function uni_files() {
    wp_enqueue_script('main-uni-js',get_theme_file_uri( '/js/scripts-bundled.js'), NULL,  microtime(), true );
    wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('uni_mainstyle',get_stylesheet_uri(), NULL, microtime());
}
add_action('wp_enqueue_scripts','uni_files');

function university_features() {
    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerLocationOne','Footer Location One');
    register_nav_menu('footerLocationTwo','Footer Location Two');
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size('professorLandscape',400,260,true);
    add_image_size('professorPortrait',480,650,true);
}

add_action('after_setup_theme','university_features');

function university_adjust_queries($x) {
    if(!is_admin()&&is_post_type_archive('program')&&$x->is_main_query()) {
        $x->set('orderby','title');
        $x->set('order','ASC');
        $x->set('posts_per_page',-1);
    }
    if(!is_admin()&&is_post_type_archive('event')&&$x->is_main_query()) {
        $today=date('Ymd');
        $x->set('meta_key','event_date');
        $x->set('orderby','meta_value_num');
        $x->set('order','ASC');
        $x->set('meta_query',array(
                array(
                'key'=>'event_date',
                'compare'=>'>=',
                'value'=>$today,
                'type'=>'numeric'
                )
            ));
    }
}

add_action('pre_get_posts','university_adjust_queries');