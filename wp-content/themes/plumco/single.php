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
	$plumco_single_comment = cs_get_option( 'single_comment_form' );
	$plumco_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$plumco_sidebar_position = $plumco_sidebar_position ?$plumco_sidebar_position : 'sidebar-right';
	$plumco_blog_widget = cs_get_option( 'blog_widget' );
	$plumco_blog_widget = $plumco_blog_widget ? $plumco_blog_widget : 'sidebar-1';

	$plumco_sidebar_position = $plumco_sidebar_position ? $plumco_sidebar_position : 'sidebar-right';

	if (isset($_GET['sidebar'])) {
	  $plumco_sidebar_position = $_GET['sidebar'];
	}
	
	// Sidebar Position
	if ( $plumco_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col col-lg-10 offset-lg-1';
		$plumco_sidebar_class = 'hide-sidebar';
	} elseif ( $plumco_sidebar_position === 'sidebar-left' && is_active_sidebar( $plumco_blog_widget ) ) {
		$layout_class = 'col col-lg-8 order-lg-2';
		$plumco_sidebar_class = 'left-sidebar';
	} elseif( is_active_sidebar( $plumco_blog_widget ) ) {
		$layout_class = 'col col-lg-8';
		$plumco_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col col-lg-12';
		$plumco_sidebar_class = 'hide-sidebar';
	}
?>
<div class="wpo-blog-single-section section-padding <?php echo esc_attr( $plumco_content_padding .' '. $plumco_sidebar_class ); ?>" style="<?php echo esc_attr( $plumco_custom_padding ); ?>">
	<div class="container content-area ">
		<div class="row">
			<div class="single-content-wrap <?php echo esc_attr( $layout_class ); ?>">
				<div class="wpo-blog-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/content', 'single' );
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
				if ( $plumco_sidebar_position !== 'sidebar-hide' && is_active_sidebar( $plumco_blog_widget ) ) {
					get_sidebar(); // Sidebar
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();