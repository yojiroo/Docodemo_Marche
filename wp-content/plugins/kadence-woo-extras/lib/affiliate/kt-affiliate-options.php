<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'plugins_loaded', 'kt_affiliate_options_plugin_loaded' );

function kt_affiliate_options_plugin_loaded() {

	class kt_affiliate_options {

		public function __construct() {
			$kt_woo_extras = get_option( 'kt_woo_extras' );
			if( isset( $kt_woo_extras[ 'kt_aa_image_link' ] ) && 1 == $kt_woo_extras[ 'kt_aa_image_link' ] ) {
				add_action( 'init', array( $this, 'kt_archive_image_link' ), 50 );
			}
			if( isset( $kt_woo_extras[ 'kt_aa_action_link_target' ] ) && 1 == $kt_woo_extras[ 'kt_aa_action_link_target' ] ) {
				add_filter( 'woocommerce_loop_add_to_cart_link',  array( $this, 'kt_archive_loop_add_to_cart' ), 50, 2);
			}
			if( isset( $kt_woo_extras[ 'kt_single_aa_image_link' ] ) && 1 == $kt_woo_extras[ 'kt_single_aa_image_link' ] ) {
				add_filter( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'kt_single_image_link' ), 10, 2);
			}
			if( isset( $kt_woo_extras[ 'kt_single_aa_action_link_target' ] ) && 1 == $kt_woo_extras[ 'kt_single_aa_action_link_target' ] ) {
				remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
				add_action( 'woocommerce_external_add_to_cart', array( $this, 'kt_single_external_add_to_cart' ), 30 );
			}
		}
		public function kt_archive_image_link() {
			// Remove Woocommerce
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			// Remove kad 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'kad_woocommerce_image_link_open', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'kad_woocommerce_image_link_close', 50 );
			// Remove Ascend 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'ascend_woocommerce_image_link_open', 2 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'ascend_woocommerce_image_link_close', 50 );
			// Remove Virtue
			remove_action( 'woocommerce_before_shop_loop_item_title', 'virtue_woocommerce_image_link_open', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'virtue_woocommerce_image_link_close', 50 );
			// Remove Pinnacle 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'pinnacle_woocommerce_image_link_open', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'pinnacle_woocommerce_image_link_close', 50 );

			// Add Woo Extras
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'kt_archive_image_link_open' ), 2 );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'kt_archive_image_link_close' ), 50 );
			if ( ! theme_is_kadence() ) {
				add_action( 'woocommerce_shop_loop_item_title', array( $this, 'kt_archive_title_link_open' ), 7 );
				add_action( 'woocommerce_shop_loop_item_title', array( $this, 'kt_archive_title_link_close' ), 15 );
			}
		}
		public function kt_single_external_add_to_cart() {
			global $product;

			if ( ! $product->add_to_cart_url() ) {
				return;
			}
			if ( ! class_exists( 'Virtue_Get_Image' ) ) {
				$extra_classes = 'kad_add_to_cart kad-btn kad-btn-primary headerfont';
			} else {
				$extra_classes = '';
			}
			do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<p class="cart">
				<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" target="_blank" rel="nofollow" class="<?php echo esc_attr( $extra_classes );?> single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></a>
			</p>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); 

		}
		public function kt_single_image_link( $html, $id ) {
			if ( empty( $id ) ) {
				return $html;
			}
			global $product, $kt_woo_extras;
			if( $product->is_type( 'external' ) ) {
				$image = wp_get_attachment_image_src( $id, 'full' );
				if( isset( $kt_woo_extras[ 'kt_single_aa_image_link_target' ] ) && 1 == $kt_woo_extras[ 'kt_single_aa_image_link_target' ] ) {
					$html = str_replace('href="'.$image[0].'"', 'href="'.$product->get_product_url().'" target="_blank"', $html);
				} else {
					$html = str_replace('href="'.$image[0].'"', 'href="'.$product->get_product_url().'"', $html);
				}
			} 
			return $html;
		}
		public function kt_archive_image_link_open() {
			global $product, $kt_woo_extras;
			if( $product->is_type( 'external' ) ) {
				if( isset( $kt_woo_extras[ 'kt_aa_image_link_target' ] ) && 1 == $kt_woo_extras[ 'kt_aa_image_link_target' ] ) {
					echo  '<a href="'.esc_url( $product->get_product_url() ).'" class="product_item_link product_img_link" target="_blank">';
				} else {
					echo  '<a href="'.esc_url( $product->get_product_url() ).'" class="product_item_link product_img_link">';
				}
			} else {
				echo  '<a href="'.esc_url( get_the_permalink() ).'" class="product_item_link product_img_link">';
			}
		}
		public function kt_archive_image_link_close() {
			echo  '</a>';
		}
		public function kt_archive_title_link_open() {
				echo  '<a href="'.esc_url( get_the_permalink() ).'" class="product_item_link product_title_link">';
		}
		public function kt_archive_title_link_close() {
			echo  '</a>';
		}

		public function kt_archive_loop_add_to_cart( $link, $product ) {
			if( $product->is_type( 'external' ) ) {
				$args = array();
				$defaults = array(
					'quantity' => 1,
					'class'    => implode( ' ', array_filter( array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
					) ) ),
				);

				$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

				$link = sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" target="_blank">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
					esc_html( $product->add_to_cart_text() )
				);
			} 
			return $link;
		}

	}
	$GLOBALS['kt_affiliate_options'] = new kt_affiliate_options();
}

