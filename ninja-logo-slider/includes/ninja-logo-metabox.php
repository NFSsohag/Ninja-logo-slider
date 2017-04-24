<?php 
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ninja_logo_slider_add_meta_box() {

		add_meta_box(
			'ninja_logo_slider_sectionid',
			__( "Client's URL" , 'shahadatsohag' ),
			'ninja_logo_slider_meta_box_callback',
			'ninja-logo-slider'
		);
}
add_action( 'add_meta_boxes', 'ninja_logo_slider_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ninja_logo_slider_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'ninja_logo_slider_meta_box', 'ninja_logo_slider_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'client_url', true );

	echo '<label for="ninja_logo_slider_url_field">';
	_e( 'Enter Site URL', 'shahadatsohag' );
	echo '</label> ';
	echo '<input type="text" id="ninja_logo_slider_url_field" name="ninja_logo_slider_url_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ninja_logo_slider_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['ninja_logo_slider_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['ninja_logo_slider_meta_box_nonce'], 'ninja_logo_slider_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['ninja_logo_slider_url_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$ninja_logo = sanitize_text_field( $_POST['ninja_logo_slider_url_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'client_url', $ninja_logo );
}
add_action( 'save_post', 'ninja_logo_slider_save_meta_box_data' );


// Ad for PRO version

function ninja_logo_pro_add_meta_box() {

		add_meta_box(
			'ninja_logo_sectionid_pro',
			__( "NINJA Logo Slider - PRO" , 'shahadatsohag' ),
			'ninja_logo_meta_box_pro',
			'ninja-logo-slider'
		);
}


// SIDEBAR Ad for PRO version

function ninja_logo_pro_sidebar_add_meta_box() {

		add_meta_box(
			'ninja_logo_sectionid_pro_sidebar',
			__( "Other Info" , 'shahadatsohag' ),
			'ninja_logo_meta_box_pro_sidebar',
			'ninja-logo-slider',
			'side',
			'low'
		);
}
add_action( 'add_meta_boxes', 'ninja_logo_pro_sidebar_add_meta_box' );

function ninja_logo_meta_box_pro_sidebar() { ?>
	<a href="http://logo.ninjaamdani.com" target="_blank" style="text-decoration: none;width:97%;overflow:hidden;margin:5px;background: #ffffff;border: 1px solid #eeeeee;display: block;float: left;text-align: center;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px; outline: 0!important;" ><h3 style="margin: 0px;background: #eeeeee;-webkit-border-top-left-radius: 3px;-webkit-border-top-right-radius: 3px;-moz-border-radius-topleft: 3px;-moz-border-radius-topright: 5px;border-top-left-radius: 3px;border-top-right-radius: 3px;padding:5px;text-decoration: none;color:#333">ninja Logo Slider - DEMO</h3><img style="max-width: 100%;height:auto; border-radius: 50%; margin: 5px 0 2px;" src="<?php echo plugins_url('ninja-logo-slider/img/ninjal.png'); ?>" /></a>

	<a href="http://testimonial.ninjaamdani.com/" target="_blank" style="text-decoration: none;width:97%;overflow:hidden;margin:5px;background: #ffffff;border: 1px solid #eeeeee;display: block;float: left;text-align: center;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px; outline: 0!important;" ><h3 style="margin: 0px;background: #eeeeee;-webkit-border-top-left-radius: 3px;-webkit-border-top-right-radius: 3px;-moz-border-radius-topleft: 3px;-moz-border-radius-topright: 5px;border-top-left-radius: 3px;border-top-right-radius: 3px;padding:5px;text-decoration: none;color:#333">ninja Testimonial Slider - DEMO</h3><img style="max-width: 100%;height:auto; border-radius: 50%; margin: 5px 0 2px;" src="<?php echo plugins_url('ninja-logo-slider/img/ninja-testimonial-slider.png'); ?>" /></a>

	<div style="clear:both"></div>
<?php
}