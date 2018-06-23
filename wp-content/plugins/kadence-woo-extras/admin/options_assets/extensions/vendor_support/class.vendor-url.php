<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'Redux_VendorURL' ) ) {
        class Redux_VendorURL {
            static public $url;
            static public $dir;

            public static function get_url( $handle ) {
                if ( $handle == 'select2-js' && file_exists( self::$dir . 'vendor/select2/select2' . Redux_Functions::isMin() . '.js' ) ) {
                    return KADENCE_WOO_EXTRAS_URL . '/admin/options_assets/extensions/vendor_support/vendor/select2/select2.js';
                } elseif ( $handle == 'select2-css' && file_exists( self::$dir . 'vendor/select2/select2.css' )  ) {
                   return KADENCE_WOO_EXTRAS_URL . '/admin/options_assets/extensions/vendor_support/vendor/select2/select2.css';
                }
            }
        }
    }