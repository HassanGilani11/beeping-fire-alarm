<?php
	// Metabox
	$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
	$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
	$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
	$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
	if ($plumco_meta && is_page()) {
		$plumco_title_bar_padding = $plumco_meta['title_area_spacings'];
	} else { $plumco_title_bar_padding = ''; }
	// Padding - Theme Options
	if ($plumco_title_bar_padding && $plumco_title_bar_padding !== 'padding-default') {
		$plumco_title_top_spacings = $plumco_meta['title_top_spacings'];
		$plumco_title_bottom_spacings = $plumco_meta['title_bottom_spacings'];
		if ($plumco_title_bar_padding === 'padding-custom') {
			$plumco_title_top_spacings = $plumco_title_top_spacings ? 'padding-top:'. plumco_check_px($plumco_title_top_spacings) .';' : '';
			$plumco_title_bottom_spacings = $plumco_title_bottom_spacings ? 'padding-bottom:'. plumco_check_px($plumco_title_bottom_spacings) .';' : '';
			$plumco_custom_padding = $plumco_title_top_spacings . $plumco_title_bottom_spacings;
		} else {
			$plumco_custom_padding = '';
		}
	} else {
		$plumco_title_bar_padding = cs_get_option('title_bar_padding');
		$plumco_titlebar_top_padding = cs_get_option('titlebar_top_padding');
		$plumco_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
		if ($plumco_title_bar_padding === 'padding-custom') {
			$plumco_titlebar_top_padding = $plumco_titlebar_top_padding ? 'padding-top:'. plumco_check_px($plumco_titlebar_top_padding) .';' : '';
			$plumco_titlebar_bottom_padding = $plumco_titlebar_bottom_padding ? 'padding-bottom:'. plumco_check_px($plumco_titlebar_bottom_padding) .';' : '';
			$plumco_custom_padding = $plumco_titlebar_top_padding . $plumco_titlebar_bottom_padding;
		} else {
			$plumco_custom_padding = '';
		}
	}
	// Banner Type - Meta Box
	if ($plumco_meta && is_page()) {
		$plumco_banner_type = $plumco_meta['banner_type'];
	} else { $plumco_banner_type = ''; }
	// Header Style
	if ($plumco_meta) {
	  $plumco_header_design  = $plumco_meta['select_header_design'];
	  $plumco_hide_breadcrumbs  = $plumco_meta['hide_breadcrumbs'];
	} else {
	  $plumco_header_design  = cs_get_option('select_header_design');
	  $plumco_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
	}
	if ( $plumco_header_design === 'default') {
	  $plumco_header_design_actual  = cs_get_option('select_header_design');
	} else {
	  $plumco_header_design_actual = ( $plumco_header_design ) ? $plumco_header_design : cs_get_option('select_header_design');
	}
	if ( $plumco_header_design_actual == 'style_two') {
		$overly_class = ' overly';
	} else {
		$overly_class = ' ';
	}
	// Overlay Color - Theme Options
		if ($plumco_meta && is_page()) {
			$plumco_bg_overlay_color = $plumco_meta['titlebar_bg_overlay_color'];
			$title_color = isset($plumco_meta['title_color']) ? $plumco_meta['title_color'] : '';
		} else { $plumco_bg_overlay_color = ''; }
		if (!empty($plumco_bg_overlay_color)) {
			$plumco_bg_overlay_color = $plumco_bg_overlay_color;
			$title_color = $title_color;
		} else {
			$plumco_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
			$title_color = cs_get_option('title_color');
		}
		$e_uniqid        = uniqid();
		$inline_style  = '';
		if ( $plumco_bg_overlay_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title {';
		 $inline_style .= ( $plumco_bg_overlay_color ) ? 'background-color:'. $plumco_bg_overlay_color.';' : '';
		 $inline_style .= '}';
		}
		if ( $title_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title h2, .page-title-'.$e_uniqid .'.page-title .breadcrumb li, .page-title-'.$e_uniqid .'.page-title .breadcrumbs ul li a {';
		 $inline_style .= ( $title_color ) ? 'color:'. $title_color.';' : '';
		 $inline_style .= '}';
		}
		// add inline style
		plumco_add_inline_style( $inline_style );
		$styled_class  = ' page-title-'.$e_uniqid;
	// Background - Type
	if( $plumco_meta ) {
		$title_bar_bg = $plumco_meta['title_area_bg'];
	} else {
		$title_bar_bg = '';
	}
	$plumco_custom_header = get_custom_header();
	$header_text_color = get_theme_mod( 'header_textcolor' );
	$background_color = get_theme_mod( 'background_color' );
	if( isset( $title_bar_bg['image'] ) && ( $title_bar_bg['image'] ||  $title_bar_bg['color'] ) ) {
	  extract( $title_bar_bg );
	  $plumco_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . esc_url($image) . ');' : '';
	  $plumco_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . esc_attr( $repeat) . ';' : '';
	  $plumco_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . esc_attr($position) . ';' : '';
	  $plumco_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . esc_attr($size) . ';' : '';
	  $plumco_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . esc_attr( $attachment ) . ';' : '';
	  $plumco_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . esc_attr( $color ) . ';' : '';
	  $plumco_background_style       = ( ! empty( $image ) ) ? $plumco_background_image . $plumco_background_repeat . $plumco_background_position . $plumco_background_size . $plumco_background_attachment : '';
	  $plumco_title_bg = ( ! empty( $plumco_background_style ) || ! empty( $plumco_background_color ) ) ? $plumco_background_style . $plumco_background_color : '';
	} elseif( $plumco_custom_header->url ) {
		$plumco_title_bg = 'background-image:  url('. esc_url( $plumco_custom_header->url ) .');';
	} else {
		$plumco_title_bg = '';
	}
	if($plumco_banner_type === 'hide-title-area') { // Hide Title Area
	} elseif($plumco_meta && $plumco_banner_type === 'revolution-slider') { // Hide Title Area
		echo do_shortcode($plumco_meta['page_revslider']);
	} else {
	?>
 <!-- start page-title -->
  <section class="wpo-page-title <?php echo esc_attr( $overly_class.$styled_class.' '.$plumco_banner_type ); ?>" style="<?php echo esc_attr( $plumco_title_bg ); ?>">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12" style="<?php echo esc_attr( $plumco_custom_padding ); ?>">
                <div class="wpo-breadcumb-wrap">
                    <h2><?php echo plumco_title_area(); ?></h2>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<?php } ?>