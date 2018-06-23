<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/** 
 * Checks if WooCommerce is enabled
 */
class kt_plugin_check {

    private static $active_plugins;

    public static function init() {

        self::$active_plugins = (array) get_option( 'active_plugins', array() );

        if ( is_multisite() )
            self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
    }

    public static function kt_active_check_woo() {

        if ( ! self::$active_plugins ) self::init();

        return in_array( 'woocommerce/woocommerce.php', self::$active_plugins ) || array_key_exists( 'woocommerce/woocommerce.php', self::$active_plugins );
    }

}

function kt_is_woo_active() {
    return kt_plugin_check::kt_active_check_woo();
    }

