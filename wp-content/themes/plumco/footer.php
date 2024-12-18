<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
$plumco_ft_bg = cs_get_option('plumco_ft_bg');
$plumco_attachment = wp_get_attachment_image_src( $plumco_ft_bg , 'full' );
$plumco_attachment = $plumco_attachment ? $plumco_attachment[0] : '';

if ( $plumco_attachment ) {
	$bg_url = ' style="';
	$bg_url .= ( $plumco_attachment ) ? 'background-image: url( '. esc_url( $plumco_attachment ) .' );' : '';
	$bg_url .= '"';
} else {
	$bg_url = '';
}

if ( $plumco_meta ) {
	$plumco_hide_footer  = $plumco_meta['hide_footer'];
} else { $plumco_hide_footer = ''; }
if ( !$plumco_hide_footer ) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');
	
?>
	<!-- Footer -->
	<footer class="wpo-site-footer clearfix"  <?php echo wp_kses( $bg_url, array('img' => array('src' => array(), 'alt' => array()),) ); ?>>
		<?php
			$footer_widget_block = cs_get_option( 'footer_widget_block' );
			if ( $footer_widget_block ) {
	      get_template_part( 'theme-layouts/footer/footer', 'widgets' );
	    }
			if ( !$hide_copyright ) {
      	get_template_part( 'theme-layouts/footer/footer', 'copyright' );
	    }
    ?>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
</div><!--plumco-theme-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
