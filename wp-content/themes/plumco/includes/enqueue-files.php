<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function plumco_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'plumco' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Manrope:wght@300;400;500;600;700;800&display=swap' ), "//fonts.googleapis.com/css2" );
    }
    return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

if ( ! function_exists( 'plumco_scripts_styles' ) ) {
  function plumco_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', PLUMCO_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', PLUMCO_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'font-awesome', PLUMCO_CSS .'/font-awesome.min.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'bootstrap', PLUMCO_CSS .'/bootstrap.min.css', array(), '5.0.1', 'all' );
    wp_enqueue_style( 'animate', PLUMCO_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', PLUMCO_CSS .'/odometer.css', array(), '0.4.8', 'all' );
    wp_enqueue_style( 'owl-carousel', PLUMCO_CSS .'/owl.carousel.css', array(), '2.3.4', 'all' );
    wp_enqueue_style( 'owl-theme', PLUMCO_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', PLUMCO_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'swiper', PLUMCO_CSS .'/swiper.min.css', array(), '4.0.7', 'all' );
    wp_enqueue_style( 'slick-theme', PLUMCO_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', PLUMCO_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', PLUMCO_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'plumco-style', PLUMCO_CSS .'/styles.css', array(), PLUMCO_VERSION, 'all' );
    wp_enqueue_style( 'element', PLUMCO_CSS .'/elements.css', array(), PLUMCO_VERSION, 'all' );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('plumco-default-style', get_template_directory_uri() . '/style.css', array(),  PLUMCO_VERSION, 'all' );
    }
    wp_enqueue_style( 'plumco-default-google-fonts', esc_url( plumco_google_font_url() ), array(), PLUMCO_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', PLUMCO_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '5.0.1', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', PLUMCO_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'fancybox', PLUMCO_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'instafeed', PLUMCO_SCRIPTS . '/instafeed.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'circle-progress', PLUMCO_SCRIPTS . '/circle-progress.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', PLUMCO_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.3.4', true );
    wp_enqueue_script( 'jquery-easing', PLUMCO_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', PLUMCO_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'odometer', PLUMCO_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'magnific-popup', PLUMCO_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', PLUMCO_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'swiper', PLUMCO_SCRIPTS . '/swiper.min.js', array( 'jquery' ), '4.0.7', true );
    wp_enqueue_script( 'wc-quantity-increment', PLUMCO_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'plumco-scripts', PLUMCO_SCRIPTS . '/scripts.js', array( 'jquery' ), PLUMCO_VERSION, true );
    // Comments
    wp_enqueue_script( 'plumco-inline-validate', PLUMCO_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'plumco-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $plumco_viewport = cs_get_option('theme_responsive');
    if( !$plumco_viewport ) {
      wp_enqueue_style( 'plumco-responsive', PLUMCO_CSS .'/responsive.css', array(), PLUMCO_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'plumco_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'plumco_admin_scripts_styles' ) ) {
  function plumco_admin_scripts_styles() {

    wp_enqueue_style( 'plumco-admin-main', PLUMCO_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', PLUMCO_CSS . '/flaticon.css', true );
    wp_enqueue_style( 'themify-icons', PLUMCO_CSS . '/themify-icons.css', true );
    wp_enqueue_script( 'plumco-admin-scripts', PLUMCO_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'plumco_admin_scripts_styles' );
}
