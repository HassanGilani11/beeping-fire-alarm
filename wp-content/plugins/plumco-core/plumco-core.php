<?php
/*
Plugin Name: Plumco Core
Plugin URI: http://themeforest.net/user/wpoceans
Description: Plugin to contain shortcodes and custom post types of the plumco theme.
Author: wpoceans
Author URI: http://themeforest.net/user/wpoceans/portfolio
Version: 1.0.2
Text Domain: plumco-core
*/

if( ! function_exists( 'plumco_block_direct_access' ) ) {
	function plumco_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'PLUMCO_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'PLUMCO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUMCO_PLUGIN_ASTS', PLUMCO_PLUGIN_URL . 'assets' );
define( 'PLUMCO_PLUGIN_IMGS', PLUMCO_PLUGIN_ASTS . '/images' );
define( 'PLUMCO_PLUGIN_INC', PLUMCO_PLUGIN_PATH . 'include' );

// DIRECTORY SEPARATOR
define ( 'DS' , DIRECTORY_SEPARATOR );

// Plumco Elementor Shortcode Path
define( 'PLUMCO_EM_SHORTCODE_BASE_PATH', PLUMCO_PLUGIN_PATH . 'elementor/' );
define( 'PLUMCO_EM_SHORTCODE_PATH', PLUMCO_EM_SHORTCODE_BASE_PATH . 'widgets/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function plumco_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* PLUMCO_THEME_NAME_PLUGIN */
define('PLUMCO_THEME_NAME_PLUGIN', 'Plumco' );

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('plumco-core/plumco-core.php')) {

	// Custom Post Type
  require_once( PLUMCO_PLUGIN_INC . '/custom-post-type.php' );

  if ( is_plugin_active('kingcomposer/kingcomposer.php') ) {

    define( 'PLUMCO_KC_SHORTCODE_BASE_PATH', PLUMCO_PLUGIN_PATH . 'kc/' );
    define( 'PLUMCO_KC_SHORTCODE_PATH', PLUMCO_KC_SHORTCODE_BASE_PATH . 'shortcodes/' );
    // Shortcodes
    require_once( PLUMCO_KC_SHORTCODE_BASE_PATH . '/kc-setup.php' );
    require_once( PLUMCO_KC_SHORTCODE_BASE_PATH . '/library.php' );
  }

  // Theme Custom Shortcode
  require_once( PLUMCO_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( PLUMCO_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

  // Importer
  require_once( PLUMCO_PLUGIN_INC . '/demo/importer.php' );


  if (class_exists('WP_Widget') && is_plugin_active('codestar-framework/cs-framework.php') ) {
    // Widgets

    require_once( PLUMCO_PLUGIN_INC . '/widgets/nav-widget.php' );
    require_once( PLUMCO_PLUGIN_INC . '/widgets/recent-posts.php' );
    require_once( PLUMCO_PLUGIN_INC . '/widgets/footer-posts.php' );
    require_once( PLUMCO_PLUGIN_INC . '/widgets/text-widget.php' );
    require_once( PLUMCO_PLUGIN_INC . '/widgets/widget-extra-fields.php' );

    // Elementor
    if(file_exists( PLUMCO_EM_SHORTCODE_BASE_PATH . '/em-setup.php' ) ){
      require_once( PLUMCO_EM_SHORTCODE_BASE_PATH . '/em-setup.php' );
      require_once( PLUMCO_EM_SHORTCODE_BASE_PATH . 'lib/fields/icons.php' );
      require_once( PLUMCO_EM_SHORTCODE_BASE_PATH . 'lib/icons-manager/icons-manager.php' );
    }
  }

  add_action('wp_enqueue_scripts', 'plumco_plugin_enqueue_scripts');
  function plumco_plugin_enqueue_scripts() {
    wp_enqueue_script('plugin-scripts', PLUMCO_PLUGIN_ASTS.'/plugin-scripts.js', array('jquery'), '', true);
  }

}

// Extra functions
require_once( PLUMCO_PLUGIN_INC . '/theme-functions.php' );