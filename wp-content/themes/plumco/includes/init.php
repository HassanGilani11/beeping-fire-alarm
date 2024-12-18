<?php
/*
 * All Plumco Theme Related Functions Files are Linked here
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Theme All Plumco Setup */
require_once( PLUMCO_FRAMEWORK . '/theme-support.php' );
require_once( PLUMCO_FRAMEWORK . '/backend-functions.php' );
require_once( PLUMCO_FRAMEWORK . '/frontend-functions.php' );
require_once( PLUMCO_FRAMEWORK . '/enqueue-files.php' );
require_once( PLUMCO_CS_FRAMEWORK . '/custom-style.php' );
require_once( PLUMCO_CS_FRAMEWORK . '/config.php' );

/* Install Plugins */
require_once( PLUMCO_FRAMEWORK . '/theme-options/plugins/activation.php' );

/* Breadcrumbs */
require_once( PLUMCO_FRAMEWORK . '/theme-options/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( PLUMCO_FRAMEWORK . '/theme-options/plugins/aq_resizer.php' );

/* Bootstrap Menu Walker */
require_once( PLUMCO_FRAMEWORK . '/core/wp_bootstrap_navwalker.php' );

/* Sidebars */
require_once( PLUMCO_FRAMEWORK . '/core/sidebars.php' );

if ( class_exists( 'WooCommerce' ) ) :
	require_once( PLUMCO_FRAMEWORK . '/woocommerce-extend.php' );
endif;