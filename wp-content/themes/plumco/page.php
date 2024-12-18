<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
if ( $plumco_meta ) {
	$plumco_content_padding = $plumco_meta['content_spacings'];
} else { $plumco_content_padding = 'section-padding'; }
// Top and Bottom Padding
if ( $plumco_content_padding && $plumco_content_padding !== 'padding-default' ) {
	$plumco_content_top_spacings = isset( $plumco_meta['content_top_spacings'] ) ? $plumco_meta['content_top_spacings'] : '';
	$plumco_content_bottom_spacings = isset( $plumco_meta['content_bottom_spacings'] ) ? $plumco_meta['content_bottom_spacings'] : '';
	if ( $plumco_content_padding === 'padding-custom' ) {
		$plumco_content_top_spacings = $plumco_content_top_spacings ? 'padding-top:'. plumco_check_px( $plumco_content_top_spacings ) .';' : '';
		$plumco_content_bottom_spacings = $plumco_content_bottom_spacings ? 'padding-bottom:'. plumco_check_px($plumco_content_bottom_spacings) .';' : '';
		$plumco_custom_padding = $plumco_content_top_spacings . $plumco_content_bottom_spacings;
	} else {
		$plumco_custom_padding = '';
	}
	$padding_class = '';
} else {
	$plumco_custom_padding = '';
	$padding_class = '';
}

// Page Layout
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ( $page_layout_options ) {
	$plumco_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$plumco_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ( $plumco_page_layout === 'extra-width' ) {
	$plumco_page_column = 'extra-width';
	$plumco_page_container = 'container-fluid';
} elseif ( $plumco_page_layout === 'full-width' ) {
	$plumco_page_column = 'col-md-12';
	$plumco_page_container = 'container ';
} elseif( ( $plumco_page_layout === 'left-sidebar' || $plumco_page_layout === 'right-sidebar' ) && is_active_sidebar( $page_sidebar_widget ) ) {
	if( $plumco_page_layout === 'left-sidebar' ){
		$plumco_page_column = 'col-md-8 order-12';
	} else {
		$plumco_page_column = 'col-md-8';
	}
	$plumco_page_container = 'container ';
} else {
	$plumco_page_column = 'col-md-12';
	$plumco_page_container = 'container ';
}
$plumco_theme_page_comments = cs_get_option( 'theme_page_comments' );
get_header();
?>
<div class="page-wrap <?php echo esc_attr( $padding_class.''.$plumco_content_padding ); ?>">
	<div class="<?php echo esc_attr( $plumco_page_container.''.$plumco_page_layout ); ?>" style="<?php echo esc_attr( $plumco_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $plumco_page_column ); ?>">
				<div class="page-wraper clearfix">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
					if ( !$plumco_theme_page_comments && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<div class="page-link-wrap">
					<?php plumco_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if( ($plumco_page_layout === 'left-sidebar' || $plumco_page_layout === 'right-sidebar') && is_active_sidebar( $page_sidebar_widget )  ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();