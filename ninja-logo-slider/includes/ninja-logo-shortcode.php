<?php 
/**
 * 
 */
add_action('wp_footer','ninja_ls_slider_trigger');

function ninja_ls_slider_trigger(){
?>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.ninja_logo_container').carousel({
  	slideWidth: 200,
    minSlides: 1,
    maxSlides: 5,
    slideMargin: 10,
  	moveSlides: 1,
  	speed: 750,
  	controls: true,
  	autoHover: true,
  	pager: false,
  	auto: true
  });
 
});
</script>
<?php
}


// ---------- Shortcode [ninja_logo] -------------

add_shortcode( 'ninja_logo', 'ninja_logo_shortcode' );

function ninja_logo_shortcode( $atts ) {

	extract(shortcode_atts( 
			array(
			'posts' 	=> 20,
			'order'		=> 'DESC',
			'orderby'   => 'date',
			'title'		=> 'no'
			), $atts 
		));

	$loop = new WP_Query(
		array(
			'post_type'	=> 'ninja-logo-slider',
			'order'		=> 'DESC',
			'orderby'	=> 'date',
			'posts_per_page'	=> $posts
			)
		);

	$output = '<div class="ninja_logo_container">';
		if ( $loop->have_posts() ) {
			
			while ( $loop->have_posts() ) {
				$loop->the_post();
				$meta = get_post_meta( get_the_id() );
				
				$ninja_logo_id = get_post_thumbnail_id();
				$ninja_logo_url = wp_get_attachment_image_src($ninja_logo_id, array(200,200), true);
				$ninja_logo = $ninja_logo_url[0];
				$ninja_logo_alt = get_post_meta($ninja_logo_id,'_wp_attachment_image_alt',true);

				$output .= '<div class="ninja_logo_single">';

					if ($meta['client_url'][0]) :
				 		$output .= '<a href="'. $meta['client_url'][0] .'" target="_blank">';
				 	endif;

				 	if ($ninja_logo) :
						$output .= '<img src="'.$ninja_logo.'" alt="'.$ninja_logo_alt.'" >';
					endif;

					if ($meta['client_url'][0]) :
						$output .= '</a>';
					endif;
					
					if ( $title == "yes" ) :
						$output .= '<h3 class="ninja_logo_title">'. get_the_title() .'</h3>';
					endif;
				$output .= '</div>';
			}

		} else {
			$output .= "No Logo Added!";
		}

		wp_reset_postdata();

	$output .= '</div>';

	return $output;
}