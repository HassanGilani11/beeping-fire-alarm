<?php
// Metabox
global $post;
$plumco_id    = ( isset( $post ) ) ? $post->ID : false;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
$plumco_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $plumco_id : false;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
// Header Style
if ( $plumco_meta ) {
  $plumco_header_design  = $plumco_meta['select_header_design'];
} else {
  $plumco_header_design  = cs_get_option( 'select_header_design' );
}

if ( $plumco_header_design === 'default' ) {
  $plumco_header_design_actual  = cs_get_option( 'select_header_design' );
} else {
  $plumco_header_design_actual = ( $plumco_header_design ) ? $plumco_header_design : cs_get_option('select_header_design');
}
$plumco_header_design_actual = $plumco_header_design_actual ? $plumco_header_design_actual : 'style_two';

$plumco_logo = cs_get_option( 'plumco_logo' );
$plumco_trlogo = cs_get_option( 'plumco_trlogo' );

$logo_url = wp_get_attachment_url( $plumco_logo );
$logo_alt = get_post_meta( $plumco_logo, '_wp_attachment_image_alt', true );

$trlogo_url = wp_get_attachment_url( $plumco_trlogo );
$trlogo_alt = get_post_meta( $plumco_trlogo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = PLUMCO_IMAGES.'/logo.svg';
}

if ( $trlogo_url ) {
  $trlogo_url = $trlogo_url;
} else {
 $trlogo_url = PLUMCO_IMAGES.'/tr-logo.svg';
}


if ( $plumco_header_design_actual == 'style_one' ) {
  $plumco_logo_url = $trlogo_url;
  $plumco_logo_alt = $trlogo_alt;
} else {
  $plumco_logo_url = $logo_url;
  $plumco_logo_alt = $logo_alt;
}

if ( has_nav_menu( 'primary' ) ) {
  $logo_padding = ' has_menu ';
}
else {
   $logo_padding = ' dont_has_menu ';
}


// Logo Spacings
$plumco_brand_logo_top = cs_get_option( 'plumco_logo_top' );
$plumco_brand_logo_bottom = cs_get_option( 'plumco_logo_bottom' );
if ( $plumco_brand_logo_top ) {
  $plumco_brand_logo_top = 'padding-top:'. plumco_check_px( $plumco_brand_logo_top ) .';';
} else { $plumco_brand_logo_top = ''; }
if ( $plumco_brand_logo_bottom ) {
  $plumco_brand_logo_bottom = 'padding-bottom:'. plumco_check_px( $plumco_brand_logo_bottom ) .';';
} else { $plumco_brand_logo_bottom = ''; }
?>
<div class="site-logo <?php echo esc_attr( $logo_padding ); ?>"  style="<?php echo esc_attr( $plumco_brand_logo_top ); echo esc_attr( $plumco_brand_logo_bottom ); ?>">
   <?php if ( $plumco_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $plumco_logo_url ); ?>" alt=" <?php echo esc_attr( $plumco_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $plumco_logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>