<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
	$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
	$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
	$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
	if ( $plumco_meta ) {
		$plumco_content_padding = $plumco_meta['content_spacings'];
	} else { $plumco_content_padding = ''; }
	// Padding - Metabox
	if ( $plumco_content_padding && $plumco_content_padding !== 'padding-default' ) {
		$plumco_content_top_spacings = $plumco_meta['content_top_spacings'];
		$plumco_content_bottom_spacings = $plumco_meta['content_bottom_spacings'];
		if ( $plumco_content_padding === 'padding-custom' ) {
			$plumco_content_top_spacings = $plumco_content_top_spacings ? 'padding-top:'. plumco_check_px($plumco_content_top_spacings) .';' : '';
			$plumco_content_bottom_spacings = $plumco_content_bottom_spacings ? 'padding-bottom:'. plumco_check_px($plumco_content_bottom_spacings) .';' : '';
			$plumco_custom_padding = $plumco_content_top_spacings . $plumco_content_bottom_spacings;
		} else {
			$plumco_custom_padding = '';
		}
	} else {
		$plumco_custom_padding = '';
	}
	// Theme Options
	$plumco_sidebar_position = cs_get_option( 'service_sidebar_position' );
	$plumco_single_comment = cs_get_option( 'service_comment_form' );
	$plumco_sidebar_position = $plumco_sidebar_position ? $plumco_sidebar_position : 'sidebar-hide';
	// Sidebar Position
	if ( $plumco_sidebar_position === 'sidebar-hide' ) {
		$plumco_layout_class = 'col-md-12 col col-xs-12';
		$plumco_sidebar_class = 'hide-sidebar';
	} elseif ( $plumco_sidebar_position === 'sidebar-left' ) {
		$plumco_layout_class = 'col-lg-8 order-lg-2 order-md-1';
		$plumco_sidebar_class = 'left-sidebar';
	} else {
		$plumco_layout_class = 'col-lg-8';
		$plumco_sidebar_class = 'right-sidebar';
	} ?>
<div class="service-single-section section-padding <?php echo esc_attr( $plumco_content_padding .' '. $plumco_sidebar_class ); ?>" style="<?php echo esc_attr( $plumco_custom_padding ); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $plumco_layout_class ); ?>">
				<div class="service-single-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/service', 'content' );
									$plumco_single_comment = !$plumco_single_comment ? comments_template() : '';

								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Blog Div -->
				<?php
		    wp_reset_postdata(); ?>
			</div><!-- Content Area -->
				<?php
				if ( $plumco_sidebar_position !== 'sidebar-hide' ) {
					get_sidebar(); // Sidebar
				} ?>
		</div>
	</div>
</div>
<?php
get_footer();