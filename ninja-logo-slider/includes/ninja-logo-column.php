<?php 
/**
* ============== Displaying Additional Columns ===============
*/

add_filter( 'manage_edit-ninja-logo-slider_columns', 'ninja_logo_screen_columns' );

function ninja_logo_screen_columns( $columns ) {
	unset( $columns['date'] );
    $columns['ninjal_featured_image'] = 'Logo';
    $columns['ninja_logo_slider_url_field'] = 'URL';
    $columns['date'] = 'Date';
    return $columns;
}

// GET FEATURED IMAGE
function ninja_logo_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
        return $post_thumbnail_img[0];
    }
}

add_action('manage_posts_custom_column', 'ninja_logo_columns_content', 10, 2);
// SHOW THE FEATURED IMAGE
function ninja_logo_columns_content($column_name, $post_ID) {
    if ($column_name == 'ninjal_featured_image') {
        $post_featured_image = ninja_logo_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" width="34"/>';
        }
    }
}
