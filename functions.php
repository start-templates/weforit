<?php 

function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    wp_dequeue_style('classic-theme-styles');
    //wp_dequeue_style('contact-form-7');
    wp_dequeue_style( 'global-styles' );
} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );


function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


function theme_add_theme_support(){
	add_theme_support('post-thumbnails');
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support('menus');	
}
add_action( 'after_setup_theme', 'add_theme_support' );



register_nav_menus( array(
    'primary-nav' => "Primary Menu"
) );



add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/dist/css/bootstrap.css' );
	wp_enqueue_style( 'theme', get_stylesheet_uri() );
});


add_action( 'get_footer', function(){
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/dist/js/bootstrap.bundle.min.js','','',true);
	wp_enqueue_script('jquery-normal', get_template_directory_uri().'/dist/js/jquery-3.6.3.min.js','','',true);
	wp_enqueue_script('lazysizes', get_template_directory_uri().'/dist/js/lazysizes.min.js','','',true);
	wp_enqueue_style( 'aos', get_template_directory_uri().'/dist/css/aos.css');
	wp_enqueue_script('aos', get_template_directory_uri().'/dist/js/aos.js','','',true);
	wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/dist/slick/slick-theme.css');
	wp_enqueue_script('slick', get_template_directory_uri().'/dist/slick/slick.min.js','','',true);
});