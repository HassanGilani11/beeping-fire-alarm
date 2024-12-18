<?php

/**
 * Plugin language
 */
function plumco_plugin_language_setup() {
  load_plugin_textdomain( 'plumco-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'plumco_plugin_language_setup' );

/* WPAUTOP for shortcode output */
if( ! function_exists( 'plumco_set_wpautop' ) ) {
  function plumco_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/* Use shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Shortcodes enable in the_excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* Remove p tag and add by our self in the_excerpt */
remove_filter('the_excerpt', 'wpautop');


/* Add Extra Social Fields in Admin User Profile */
function plumco_add_twitter_facebook( $contactmethods ) {
  $contactmethods['twitter']    = 'Twitter';
  $contactmethods['facebook']   = 'Facebook';
  $contactmethods['instagram']  = 'Instagram';
  $contactmethods['pinterest']   = 'Pinterest';
  return $contactmethods;
}
add_filter('user_contactmethods','plumco_add_twitter_facebook',10,1);

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
  function cs_encode_string( $string ) {
    return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
  }
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
  function cs_decode_string( $string ) {
    return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
  }
}


/* Inline Style */
global $plumco_all_inline_styles;
$plumco_all_inline_styles = array();
if( ! function_exists( 'plumco_add_inline_style' ) ) {
  function plumco_add_inline_style( $style ) {
    global $plumco_all_inline_styles;
    array_push( $plumco_all_inline_styles, $style );
  }
}

/* Enqueue Inline Styles */
if ( ! function_exists( 'plumco_enqueue_inline_styles' ) ) {
  function plumco_enqueue_inline_styles() {

    global $plumco_all_inline_styles;

    if ( ! empty( array_filter($plumco_all_inline_styles) ) ) {
      echo '<style id="plumco-inline-style" type="text/css">'. plumco_compress_css_lines( join( '', $plumco_all_inline_styles ) ) .'</style>';
    }

  }
  add_action( 'wp_footer', 'plumco_enqueue_inline_styles' );
}

/* Validate px entered in field */
if( ! function_exists( 'plumco_core_check_px' ) ) {
  function plumco_core_check_px( $num ) {
    return ( is_numeric( $num ) ) ? $num . 'px' : $num;
  }
}


/* Share Options */
if ( ! function_exists( 'plumco_wp_share_option' ) ) {
  function plumco_wp_share_option() {

    global $post;
    $page_url = get_permalink($post->ID );
    $title = $post->post_title;
    $share_text = cs_get_option('share_text');
    $share_text = $share_text ? $share_text : esc_html__( 'Share', 'plumco' );
    $share_on_text = cs_get_option('share_on_text');
    $share_on_text = $share_on_text ? $share_on_text : esc_html__( 'Share On', 'plumco' );
    ?>
     <div class="share tag">
      <?php  echo '<span>'.esc_html__('Share:','plumco').'</span>'; ?>
      <ul class="share-list">
        <li>
          <a href="//www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'plumco'); ?>" target="_blank"><i class="ti-facebook"></i></a>
        </li>
        <li>
          <a href="//twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'plumco'); ?>" target="_blank"><i class="ti-twitter-alt"></i></a>
        </li>
        <li>
          <a href="//linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="linkedin" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'plumco'); ?>" target="_blank"><i class="ti-linkedin"></i></a>
        </li>
        <li>
          <a href="//pinterest.com/pin/create/button?url=<?php print(urlencode($page_url)); ?>" class="pinterest" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Pinterest', 'plumco'); ?>" target="_blank"><i class="ti-pinterest"></i></a>
        </li>
      </ul>
    </div>
<?php
  }
}

/* Maintenance Mode */
if( ! function_exists( 'plumco_maintenance_mode' ) ) {
  function plumco_maintenance_mode(){
    if( function_exists( 'cs_get_option' ) ) {
       $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' ) && cs_get_option( 'enable_maintenance_mode' );
    }
    if ( ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('theme-layouts/post/content', 'maintenance');
      exit;
    }

  }
  add_action( 'wp', 'plumco_maintenance_mode', 1 );
}

/* Yoast Plugin Metabox Low */
if( ! function_exists( 'plumco_yoast_metabox' ) ) {
  function plumco_yoast_metabox() {
    return 'low';
  }
  add_filter( 'wpseo_metabox_prio', 'plumco_yoast_metabox' );
}


/* Compress CSS */
if ( ! function_exists( 'plumco_compress_css_lines' ) ) {
  function plumco_compress_css_lines( $css ) {
    $css  = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
    $css  = str_replace( ': ', ':', $css );
    $css  = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
    return $css;
  }
}
