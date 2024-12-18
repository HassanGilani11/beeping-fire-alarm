<?php
$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true);

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

$plumco_search  = cs_get_option( 'plumco_header_search' );

$plumco_menu_cta  = cs_get_option( 'plumco_menu_cta' );
$header_cta_text  = cs_get_option( 'header_cta_text' );
$header_cta_link  = cs_get_option( 'header_cta_link' );

?>
<div class="col-lg-2 col-md-2 col-2">
  <div class="header-search-form-wrapper header-right">
      <?php if ( $plumco_menu_cta ) { ?>
        <div class="close-form">
          <a class="theme-btn" href="<?php echo esc_url( $header_cta_link ); ?>">
           <?php echo esc_html( $header_cta_text ) ?>
          </a>
        </div>
      <?php }
      if ( !$plumco_search ) { ?>
      <div class="cart-search-contact">
          <button class="search-toggle-btn"><i class="fi ti-search"></i></button>
          <div class="header-search-form">
              <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="form" >
                  <div>
                      <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__( 'Search here','plumco' ); ?>">
                      <button type="submit"><i class="fi ti-search"></i></button>
                  </div>
              </form>
          </div>
      </div>
    <?php } ?>
  </div>
</div>
