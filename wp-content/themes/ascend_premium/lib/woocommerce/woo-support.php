<?php 
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce */
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ascend_woocommerce_support() {
    add_theme_support( 'woocommerce' );

    if (class_exists('woocommerce')) {
    	if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
    		$ascend = ascend_get_options();
    		if(isset($ascend['product_gallery_zoom']) && 1 == $ascend['product_gallery_zoom']) {
    			add_theme_support( 'wc-product-gallery-zoom' );
    		}
			if(isset($ascend['product_gallery_slider']) && 1 == $ascend['product_gallery_slider']) {
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
        // Add popup Login
        add_action( 'wp_loaded', 'ascend_process_popup_login', 20 );
        add_action( 'wp_loaded', 'ascend_process_popup_registration', 20 );

        // Disable WooCommerce Lightbox
        if (get_option( 'woocommerce_enable_lightbox' ) == true ) {
            update_option( 'woocommerce_enable_lightbox', false );
        }

        add_action('kadence_archive_title_container', 'ascend_wc_print_notices', 40);
        add_action('kadence_page_title_container', 'ascend_wc_print_notices', 40);
        add_action('ascend_post_header', 'ascend_wc_print_notices', 40);
        add_action('kadence_portfolio_header', 'ascend_wc_print_notices', 40);
        add_action('kadence_testimonial_header', 'ascend_wc_print_notices', 40);
        add_action('kadence_staff_header', 'ascend_wc_print_notices', 40);
        add_action('kadence_front_page_title_container', 'ascend_wc_print_notices', 40);
        function ascend_wc_print_notices() {
            if(!is_shop() and !is_woocommerce() and !is_cart() and !is_checkout() and !is_account_page() ) {
              echo '<div class="container kt-woo-messages-none-woo-pages">';
              echo do_shortcode( '[woocommerce_messages]' );
              echo '</div>';
            }
        }

	    if ( version_compare( WC_VERSION, '2.7', '>' ) ) {
	    	add_filter('woocommerce_add_to_cart_fragments', 'ascend_get_refreshed_fragments');
	    } else {
	    	add_filter('add_to_cart_fragments', 'ascend_get_refreshed_fragments');
	    }
	 	function ascend_get_refreshed_fragments($fragments) {
		    // Get mini cart
		    ob_start();

		    woocommerce_mini_cart();

		    $mini_cart = ob_get_clean();

		    // Fragments and mini cart are returned
		    $fragments['li.kt-mini-cart-refreash'] ='<li class="kt-mini-cart-refreash">' . $mini_cart . '</li>';

		    return $fragments;

		}
	  	if ( version_compare( WC_VERSION, '2.7', '>' ) ) {
	    	add_filter('woocommerce_add_to_cart_fragments', 'ascend_get_refreshed_fragments_number');
	    } else {
	    	add_filter('add_to_cart_fragments', 'ascend_get_refreshed_fragments_number');
	    }
	 	function ascend_get_refreshed_fragments_number($fragments) {
		    global $woocommerce;
		    // Get mini cart
		    ob_start();

		    ?><span class="kt-cart-total"><?php echo WC()->cart->get_cart_contents_count(); ?></span> <?php

		    $fragments['span.kt-cart-total'] = ob_get_clean();

		    return $fragments;

	 	}
	}
}
add_action( 'after_setup_theme', 'ascend_woocommerce_support' );

/**
 * Process the login form.
 */
function ascend_process_popup_login() {
	$nonce_value = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';
	$nonce_value = isset( $_POST['woocommerce-pop-login-nonce'] ) ? $_POST['woocommerce-pop-login-nonce'] : $nonce_value;

	if ( ! empty( $_POST['login'] ) && wp_verify_nonce( $nonce_value, 'woocommerce-pop-login' ) ) {

		try {
			$creds = array(
				'user_login'    => trim( $_POST['username'] ),
				'user_password' => $_POST['password'],
				'remember'      => isset( $_POST['rememberme'] ),
			);

			$validation_error = new WP_Error();
			$validation_error = apply_filters( 'woocommerce_process_login_errors', $validation_error, $_POST['username'], $_POST['password'] );

			if ( $validation_error->get_error_code() ) {
				throw new Exception( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . $validation_error->get_error_message() );
			}

			if ( empty( $creds['user_login'] ) ) {
				throw new Exception( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . __( 'Username is required.', 'woocommerce' ) );
			}

			// On multisite, ensure user exists on current site, if not add them before allowing login.
			if ( is_multisite() ) {
				$user_data = get_user_by( is_email( $creds['user_login'] ) ? 'email' : 'login', $creds['user_login'] );

				if ( $user_data && ! is_user_member_of_blog( $user_data->ID, get_current_blog_id() ) ) {
					add_user_to_blog( get_current_blog_id(), $user_data->ID, 'customer' );
				}
			}

			// Perform the login
			$user = wp_signon( apply_filters( 'woocommerce_login_credentials', $creds ), is_ssl() );

			if ( is_wp_error( $user ) ) {
				$message = $user->get_error_message();
				$message = str_replace( '<strong>' . esc_html( $creds['user_login'] ) . '</strong>', '<strong>' . esc_html( $creds['user_login'] ) . '</strong>', $message );
				throw new Exception( $message );
			} else {

				if ( ! empty( $_POST['redirect'] ) ) {
					$redirect = $_POST['redirect'];
				} elseif ( wc_get_raw_referer() ) {
					$redirect = wc_get_raw_referer();
				} else {
					$redirect = wc_get_page_permalink( 'myaccount' );
				}

				wp_redirect( wp_validate_redirect( apply_filters( 'woocommerce_login_redirect', remove_query_arg( 'wc_error', $redirect ), $user ), wc_get_page_permalink( 'myaccount' ) ) );
				exit;
			}
		} catch ( Exception $e ) {
			wc_add_notice( apply_filters( 'login_errors', $e->getMessage() ), 'error' );
			do_action( 'woocommerce_login_failed' );
		}
	}
}
function ascend_process_popup_registration() {
	$nonce_value = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';
	$nonce_value = isset( $_POST['woocommerce-pop-register-nonce'] ) ? $_POST['woocommerce-pop-register-nonce'] : $nonce_value;

	if ( ! empty( $_POST['register'] ) && wp_verify_nonce( $nonce_value, 'woocommerce-pop-register' ) ) {
		$username = 'no' === get_option( 'woocommerce_registration_generate_username' ) ? $_POST['username'] : '';
		$password = 'no' === get_option( 'woocommerce_registration_generate_password' ) ? $_POST['password'] : '';
		$email    = $_POST['email'];

		try {
			$validation_error = new WP_Error();
			$validation_error = apply_filters( 'woocommerce_process_registration_errors', $validation_error, $username, $password, $email );

			if ( $validation_error->get_error_code() ) {
				throw new Exception( $validation_error->get_error_message() );
			}

			$new_customer = wc_create_new_customer( sanitize_email( $email ), wc_clean( $username ), $password );

			if ( is_wp_error( $new_customer ) ) {
				throw new Exception( $new_customer->get_error_message() );
			}

			if ( apply_filters( 'woocommerce_registration_auth_new_customer', true, $new_customer ) ) {
				wc_set_customer_auth_cookie( $new_customer );
			}

			if ( ! empty( $_POST['redirect'] ) ) {
				$redirect = wp_sanitize_redirect( $_POST['redirect'] );
			} elseif ( wc_get_raw_referer() ) {
				$redirect = wc_get_raw_referer();
			} else {
				$redirect = wc_get_page_permalink( 'myaccount' );
			}

			wp_redirect( wp_validate_redirect( apply_filters( 'woocommerce_registration_redirect', $redirect ), wc_get_page_permalink( 'myaccount' ) ) );
			exit;

		} catch ( Exception $e ) {
			wc_add_notice( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . $e->getMessage(), 'error' );
		}
	}
}
