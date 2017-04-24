<?php
/**
 *
 * @package   Ninja logo slider
 * @author    Shahadat Hossain Sohag <sohag0@yahoo.com>     
 * @copyright 2017 Shahadat Hossain Sohag
 *
 * @wordpress-plugin
 * Plugin Name:			Ninja logo slider
 * Description:       	Best Responsive Logo slider to display partners, clients or sponsors Logo on Wordpress site. Display anywhere at your site using shortcode like [ninja_logo] 
 * Author:       		Shahadat Hossain Sohag
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//--------- CPT Logo ----------------------- 
require_once dirname( __FILE__ ) . '/includes/ninja-logo-cpt.php';

//--------- CPT's MetaBox ------------------ 
require_once dirname( __FILE__ ) . '/includes/ninja-logo-metabox.php';

//--------- CPT's Columns ------------------ 
require_once dirname( __FILE__ ) . '/includes/ninja-logo-column.php';

//--------- CPT's Shortcode ---------------- 
require_once dirname( __FILE__ ) . '/includes/ninja-logo-shortcode.php';

//--------- Enqueue Scripts & Style Files --
require_once dirname( __FILE__ ) . '/ninja-ls-script.php';

//--------- ninja Plugins ---------------- 
require_once dirname( __FILE__ ) . '/includes/ninja-plugins/ninja-plugins.php';
require_once dirname( __FILE__ ) . '/includes/ninja-plugins/ninja-plugins-free.php';

add_action('do_meta_boxes', 'ninjal_fea_img_box');
function ninjal_fea_img_box()
{
    remove_meta_box( 'postimagediv', 'ninja-logo-slider', 'side' );
    add_meta_box('postimagediv', __('Company Logo'), 'post_thumbnail_meta_box', 'ninja-logo-slider', 'normal', 'high');
}

//add_action('do_meta_boxes', 'change_image_box2');
function change_image_box() {
    remove_meta_box( 'postimagediv', 'ninja-logo-slider', 'side' );
    add_meta_box(
        'postimagediv',             // id
        __('Company Logo'),         // title
        'post_thumbnail_meta_boxes',  // callback
        'ninja-logo-slider',           // screen
        'advance',                  // context 
        'high'                      // priority
    );
}
