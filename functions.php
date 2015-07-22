<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme definitions
define( 'CHILD_THEME_NAME', 'GENAPP' );
define( 'CHILD_THEME_URL', 'http://webdesign-workshop.com' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue styles and scripts
/* if ( wp_is_mobile() ) { */	//uncomment this and its closing tag and the theme will fall back to normal genesis on desktop
add_action('wp_enqueue_scripts', 'genapp_enqueue_script', 5);
function genapp_enqueue_script() {

//enqueue jquery mobile style
wp_enqueue_style(
 'jqm',
 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css',
 '',
 '1.4.5'
 );

//enqueue themeroller style		//uncomment this and add your css to the structure if you wish to use a jquery mobile theme from http://themeroller.jquerymobile.com/
/*
wp_enqueue_style(
 'themeroller',
 get_bloginfo( 'stylesheet_directory' ) . '/css/themeroller-1.0.min.css',
 '',
 '1.4.5'
 );
*/

//enqueue jqm_global.js		//use this file to customize jquery mobile behavior
wp_enqueue_script(
 'jqm_global',
 get_bloginfo( 'stylesheet_directory' ) . '/js/jqm_global.js',
 array('jquery'),
 '1.0'
 );
//enqueue jquery mobile script
wp_enqueue_script(
 'jqm',
 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js',
 array('jquery'),
 '1.4.5'
 );

 }
/* } */		// wp_is_mobile() closing tag

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

//* Reposition the primary navigation menu	//uncomment if you want to reposition the navigation
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_header', 'genesis_do_nav', 1 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove primary widget	//You can just set the page layout to full width content
//remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Add data-role="page" wrapper required by jquery mobile so no need to start your posts with this
function child_before_content_sidebar_wrap() {
echo '<div data-role="page"><!-- start jquery mobile page -->';
}
add_action('genesis_before_content', 'child_before_content_sidebar_wrap');

function child_after_content_sidebar_wrap() {
echo '</div><!-- end jquery mobile page -->';
}
add_action('genesis_after_content', 'child_after_content_sidebar_wrap');

//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'custom_footer_creds_text' );
function custom_footer_creds_text() {
	echo '<div class="credit"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="http://webdesign-workshop.com">webdesign-workshop</a><br /><a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis</a> child theme for developing with jquery mobile';
	echo '</p></div>';
}
