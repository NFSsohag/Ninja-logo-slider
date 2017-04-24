<?php
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/

if ( ! function_exists('NINJA_Logo_Slider')) {

	function NINJA_Logo_Slider() {

		$labels = array(
			'name'               => _x( 'Logos', 'shahadatsohag' ),
			'singular_name'      => _x( 'Logo', 'shahadatsohag' ),
			'menu_name'          => _x( 'NINJA Logos', 'admin menu', 'shahadatsohag' ),
			'name_admin_bar'     => _x( 'Logo', 'add new on admin bar', 'shahadatsohag' ),
			'add_new'            => _x( 'Add New Logo', 'logo', 'shahadatsohag' ),
			'add_new_item'       => __( 'Add New Logo', 'shahadatsohag' ),
			'new_item'           => __( 'New Logo', 'shahadatsohag' ),
			'edit_item'          => __( 'Edit Logo', 'shahadatsohag' ),
			'view_item'          => __( 'View Logo', 'shahadatsohag' ),
			'all_items'          => __( 'All Logos', 'shahadatsohag' ),
			'search_items'       => __( 'Search Logos', 'shahadatsohag' ),
			'parent_item_colon'  => __( 'Parent Logos:', 'shahadatsohag' ),
			'not_found'          => __( 'No logos found.', 'shahadatsohag' ),
			'not_found_in_trash' => __( 'No logos found in Trash.', 'shahadatsohag' ),
		);

		$arninja = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'logo' ),
				'capability_type'    => 'post',
				'has_archive'        => false,
				'exclude_from_search' => true,
				'hierarchical'       => false,
				'menu_position'      => 5,
				'menu_icon'          => 'dashicons-screenoptions',
				'supports'           => array( 'title', 'thumbnail' )
			);

			register_post_type( 'ninja-logo-slider', $args );
	}
}

add_action( 'init', 'ninja_Logo_Slider' );

// Register Theme Features (feature image for Logo)
if ( ! function_exists('ninja_logo_theme_support') ) {

	function ninja_logo_theme_support()  {
		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails', array( 'ninja-logo-slider' ) );
		add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
		add_theme_support( 'post-thumbnails', array( 'page' ) ); // Add it for pages
		add_theme_support( 'post-thumbnails', array( 'product' ) ); // Add it for products
		add_theme_support( 'post-thumbnails');
		// Add Shortcode support in text widget
		add_filter('widget_text', 'do_shortcode'); 
	}

	// Hook into the 'after_setup_theme' action
	add_action( 'after_setup_theme', 'ninja_logo_theme_support' );
}