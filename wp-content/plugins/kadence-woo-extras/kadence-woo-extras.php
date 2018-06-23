<?php

/*
 * Plugin Name: Kadence Woocommerce Extras
 * Description: This plugin adds extra features for woocommerce to help improve your online shops.
 * Version: 1.4.0
 * Author: Kadence Themes
 * Author URI: http://kadencethemes.com/
 * License: GPLv2 or later
 * WC requires at least: 3.0.0
 * WC tested up to: 3.3.5
*/
function kadence_woocommerce_activation() {
}
register_activation_hook(__FILE__, 'kadence_woocommerce_activation');

function kadence_woocommerce_deactivation() {
}
register_deactivation_hook(__FILE__, 'kadence_woocommerce_deactivation');
if(!defined('KADENCE_WOO_EXTRAS_PATH')){
	define('KADENCE_WOO_EXTRAS_PATH', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
}
if(!defined('KADENCE_WOO_EXTRAS_URL')){
	define('KADENCE_WOO_EXTRAS_URL', plugin_dir_url(__FILE__) );
}
if(!defined('KADENCE_WOO_EXTRAS_VERSION')){
	define('KADENCE_WOO_EXTRAS_VERSION', '1.3.9' );
}

require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/kt-woo-check.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/class-kadence-image-processing.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/class-kadence-woo-get-image.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/custom_functions.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'admin/admin_options.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'cmb/init.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/cmb2-conditionals/cmb2-conditionals.php');
require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/cmb2_select2/cmb_select2.php');


/* Variation Swatch Options */
if (kt_is_woo_active() ) {
	$kt_woo_extras = get_option('kt_woo_extras');
	if(isset($kt_woo_extras['variation_swatches']) && $kt_woo_extras['variation_swatches'] == 1) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/swatches/kt-variations-swatches.php');
	}
	if(isset($kt_woo_extras['product_gallery']) && $kt_woo_extras['product_gallery'] == 1) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/gallery/kt-product-gallery.php');
	}
	if(isset($kt_woo_extras['size_charts']) && $kt_woo_extras['size_charts'] == 1) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/sizechart/kt-size-chart.php');
	}
    require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/variations/kt-variations-price.php');
    if(isset($kt_woo_extras['kt_add_to_cart_text']) && $kt_woo_extras['kt_add_to_cart_text'] == 1) {
        require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/add_to_cart_text/kt-add-to-cart-text.php');
    }
    if(isset($kt_woo_extras['kt_reviews']) && $kt_woo_extras['kt_reviews'] == 1) {
        require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/reviews/reviews.php');
    }
    if(isset($kt_woo_extras['kt_cart_notice']) && $kt_woo_extras['kt_cart_notice'] == 1) {
        require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/cartnotice/kt-cart-notice.php');
    }
    if(isset($kt_woo_extras['kt_extra_cat']) && $kt_woo_extras['kt_extra_cat'] == 1) {
        require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/extracatdesc/kt-extra-cat-desc.php');
    }
    if(isset($kt_woo_extras['kt_checkout_editor']) && $kt_woo_extras['kt_checkout_editor'] == 1) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/checkout_editor/kt-checkout-editor.php');
	}
	if( isset( $kt_woo_extras[ 'kt_affiliate_options' ] ) && 1 == $kt_woo_extras[ 'kt_affiliate_options' ] ) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/affiliate/kt-affiliate-options.php');
	}
	if( isset( $kt_woo_extras[ 'kt_product_brands_options' ] ) && 1 == $kt_woo_extras[ 'kt_product_brands_options' ] ) {
		require_once( KADENCE_WOO_EXTRAS_PATH . 'lib/brands/kt-extra-brands.php');
	}
}
add_action( "after_setup_theme", 'kt_woo_extra_tax_class', 1);
function kt_woo_extra_tax_class() {
   if ( class_exists( 'KT_WOO_EXTRAS_Taxonomy_Meta' ) ) {
      return;
    }
    require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/taxonomy-meta-class.php');
}
add_action( "after_setup_theme", 'kt_woo_updating', 1);
function kt_woo_updating() {
    require_once('wp-updates-plugin.php');
    if ( theme_is_kadence() ) {
        $the_theme = wp_get_theme();
        $activated = false;
        if( $the_theme->get( 'Name' ) == 'Pinnacle Premium' || $the_theme->get( 'Template') == 'pinnacle_premium' ) {
            if ( get_option( 'kt_api_manager_pinnacle_premium_activated' ) == 'Activated' ) {
                $activated = true;
            }
        } else if( $the_theme->get( 'Name' ) == 'Ascend - Premium' || $the_theme->get( 'Template') == 'ascend_premium' ) {
            if ( get_option( 'kt_api_manager_ascend_premium_activated' ) == 'Activated' ) {
                $activated = true;
            }
        } else if(get_option( 'kt_api_manager_virtue_premium_activated' ) == 'Activated' ) {
            $activated = true;
        }
        if($activated) {
            $kad_woo_extras_updater = new PluginUpdateChecker_2_0 ('https://kernl.us/api/v1/updates/57a0dc911d25838411878099/',__FILE__, 'kadence-woo-extras', 1);
            $kad_woo_extras_updater->purchaseCode = "kt-member";
        }
    } else {
        require_once( KADENCE_WOO_EXTRAS_PATH . 'classes/kt_activation/kt-api.php');
        if ( get_option( 'kt_api_manager_kadence_woo_activated' ) == 'Activated' ) {
            $kad_woo_extras_updater = new PluginUpdateChecker_2_0 ('https://kernl.us/api/v1/updates/57a0dc911d25838411878099/',__FILE__, 'kadence-woo-extras', 1);
            $kad_woo_extras_updater->purchaseCode = "kt-member";
        }
    }
}

/* text-domain */

function kwe_textdomain() {
  	load_plugin_textdomain( 'kadence-woo-extras', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'kwe_textdomain' );

