<?php
//-------------- Enqueue Latest jQuery------------
function ninja_ls_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'ninja_ls_jquery');


//-------------- Include js files---------------
function ninja_ls_enq_scripts() {
	if (!is_admin()) {
	
		wp_register_script('carousel-js', plugins_url('js/jquery.carousel.min.js', __FILE__),array('jquery'),'4.1.2', true);
		wp_register_script('jq-easing-js', plugins_url('js/jquery.easing.1.3.js', __FILE__),array('jquery'),'1.3', true);
		
		wp_enqueue_script('carousel-js');
		wp_enqueue_script('jq-easing-js');
	}
}
add_action( 'wp_enqueue_scripts', 'ninja_ls_enq_scripts' ); 


//------------ Include css files-----------------
function ninja_ls_adding_style() {
	if (!is_admin()) {
		wp_register_style('carousel-style', plugins_url('css/jquery.carousel.css', __FILE__),'','4.1.2', false);
		wp_register_style('ninja-main-style', plugins_url('css/ninja-main.css', __FILE__),'','1.0.0', false);
				
		wp_enqueue_style('carousel-style');
		wp_enqueue_style('ninja-main-style');	
	}
}
add_action( 'init', 'ninja_ls_adding_style' );

// -- Include css,js files for Back-End (Dashboard)
if ( !function_exists('ninja_logo_enqueue_admin_styles') ) {
    function ninja_logo_enqueue_admin_styles() {
        $media = 'all';
        wp_register_style('ninja_free_plugins_css', plugins_url('css/ninja_free_plugins.css', __FILE__),'','1.0.0', false);
        wp_enqueue_style('ninja_free_plugins_css');

        wp_register_style('ninja_logo_admin_css', plugins_url('css/ninja-logo-admin.css', __FILE__),'','1.0.0', false);
        wp_enqueue_style('ninja_logo_admin_css');
    }
    add_action( 'admin_enqueue_scripts', 'ninja_logo_enqueue_admin_styles' );
}