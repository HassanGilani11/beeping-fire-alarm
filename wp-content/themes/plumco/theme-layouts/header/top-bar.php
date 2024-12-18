<?php
// Metabox
global $post;
$plumco_id    = ( isset( $post ) ) ? $post->ID : false;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
$plumco_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $plumco_id : false;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
  if ($plumco_meta) {
    $plumco_topbar_options = $plumco_meta['topbar_options'];
  } else {
    $plumco_topbar_options = '';
  }

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

// Define Theme Options and Metabox varials in right way!
if ($plumco_meta) {
  if ($plumco_topbar_options === 'custom' && $plumco_topbar_options !== 'default') {
    $plumco_top_left          = $plumco_meta['top_left'];
    $plumco_top_right          = $plumco_meta['top_right'];
    $plumco_hide_topbar        = $plumco_topbar_options;
    $plumco_topbar_bg          = $plumco_meta['topbar_bg'];
    if ($plumco_topbar_bg) {
      $plumco_topbar_bg = 'background-color: '. $plumco_topbar_bg .';';
    } else {$plumco_topbar_bg = '';}
  } else {
    $plumco_top_left          = cs_get_option('top_left');
    $plumco_top_right          = cs_get_option('top_right');
    $plumco_hide_topbar        = cs_get_option('top_bar');
    $plumco_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $plumco_top_left         = cs_get_option('top_left');
  $plumco_top_right          = cs_get_option('top_right');
  $plumco_hide_topbar        = cs_get_option('top_bar');
  $plumco_topbar_bg          = '';
}
// All options
if ( $plumco_meta && $plumco_topbar_options === 'custom' && $plumco_topbar_options !== 'default' ) {
  $plumco_top_right = ( $plumco_top_right ) ? $plumco_meta['top_right'] : cs_get_option('top_right');
  $plumco_top_left = ( $plumco_top_left ) ? $plumco_meta['top_left'] : cs_get_option('top_left');
} else {
  $plumco_top_right = cs_get_option('top_right');
  $plumco_top_left = cs_get_option('top_left');
}
if ( $plumco_meta && $plumco_topbar_options !== 'default' ) {
  if ( $plumco_topbar_options === 'hide_topbar' ) {
    $plumco_hide_topbar = 'hide';
  } else {
    $plumco_hide_topbar = 'show';
  }
} else {
  $plumco_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $plumco_hide_topbar_check === true ) {
     $plumco_hide_topbar = 'hide';
  } else {
     $plumco_hide_topbar = 'show';
  }
}
if ( $plumco_meta ) {
  $plumco_topbar_bg = ( $plumco_topbar_bg ) ? $plumco_meta['topbar_bg'] : '';
} else {
  $plumco_topbar_bg = '';
}
if ( $plumco_topbar_bg ) {
  $plumco_topbar_bg = 'background-color: '. $plumco_topbar_bg .';';
} else { $plumco_topbar_bg = ''; }

if( $plumco_hide_topbar === 'show' && ( $plumco_top_left || $plumco_top_right ) ) {
?>
 <div class="topbar" style="<?php echo esc_attr( $plumco_topbar_bg ); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-7 col-sm-12 col-12">
               <?php echo do_shortcode( $plumco_top_left ); ?>
            </div>
            <div class="col col-md-5 col-sm-12 col-12">
                <?php echo do_shortcode( $plumco_top_right ); ?>
            </div>
        </div>
    </div>
</div> <!-- end topbar -->
<?php } // Hide Topbar - From Metabox