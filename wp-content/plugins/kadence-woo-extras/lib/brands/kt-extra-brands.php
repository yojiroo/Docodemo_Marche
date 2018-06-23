<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'plugins_loaded', 'kt_extra_brands_plugin_loaded' );

function kt_extra_brands_plugin_loaded() {

	class kt_extra_brands {

		public function __construct() {
			$kt_woo_extras = get_option('kt_woo_extras');
			if ( isset( $kt_woo_extras[ 'product_brands_singular'] ) && !empty( $kt_woo_extras[ 'product_brands_singular'] ) ) {
				$this->name = $kt_woo_extras[ 'product_brands_singular'];
			} else {
				$this->name = __('Product Brand', 'kadence-woo-extras');
			}
			if ( isset( $kt_woo_extras[ 'product_brands_plural'] ) && !empty( $kt_woo_extras[ 'product_brands_plural'] ) ) {
				$this->name_plural = $kt_woo_extras[ 'product_brands_plural'];
			} else {
				$this->name_plural = __('Product Brands', 'kadence-woo-extras');
			}
			if ( isset( $kt_woo_extras[ 'product_brands_slug'] ) && !empty( $kt_woo_extras[ 'product_brands_slug'] ) ) {
				$this->slug_name = sanitize_title_with_dashes( $kt_woo_extras[ 'product_brands_slug'] );
			} else {
				$this->slug_name = 'product-brands';
			}
			add_filter( 'manage_edit-product_brands_columns', array( $this, 'add_brand_image_columns') );
			add_filter( 'manage_product_brands_custom_column', array( $this, 'kt_custom_kt_gallery_column' ), 10, 3 );
			add_action( 'init', array( $this, 'product_brands') );
			add_action( 'init', array( $this, 'hook_brands_into_products') );
			add_action( 'admin_init', array( $this, 'kt_extra_brands_meta' ));
		}
		public function hook_brands_into_products() {
			$kt_woo_extras = get_option('kt_woo_extras');
			if ( isset( $kt_woo_extras[ 'product_brands_single_output'] ) && !empty( $kt_woo_extras[ 'product_brands_single_output'] ) && 'none' != $kt_woo_extras[ 'product_brands_single_output'] ) {
				if ( 'above_title' == $kt_woo_extras[ 'product_brands_single_output'] ) {
					$position = '2';
				} else if ( 'above_price' == $kt_woo_extras[ 'product_brands_single_output'] ) {
					$position = '6';
				} else if ( 'above_excerpt' == $kt_woo_extras[ 'product_brands_single_output'] ) {
					$position = '12';
				} else if ( 'above_addtocart' == $kt_woo_extras[ 'product_brands_single_output'] ) {
					$position = '22';
				} else if ( 'above_meta' == $kt_woo_extras[ 'product_brands_single_output'] ) {
					$position = '32';
				} else {
					$position = '42';
				}
				add_action( 'woocommerce_single_product_summary', array( $this, 'product_brand_output'), $position );
			}
			if ( isset( $kt_woo_extras[ 'product_brands_archive_output'] ) && !empty( $kt_woo_extras[ 'product_brands_archive_output'] ) && 'none' != $kt_woo_extras[ 'product_brands_archive_output'] ) {
				if ( 'above_image' == $kt_woo_extras[ 'product_brands_archive_output'] ) {
					$position = '10';
					$hook = 'woocommerce_before_shop_loop_item';
				} else if ( 'above_title' == $kt_woo_extras[ 'product_brands_archive_output'] ) {
					$position = '60';
					$hook = 'woocommerce_before_shop_loop_item_title';
				} else if ( 'above_excerpt' == $kt_woo_extras[ 'product_brands_archive_output'] ) {
					$position = '70';
					$hook = 'woocommerce_shop_loop_item_title';
				} else if ( 'above_price' == $kt_woo_extras[ 'product_brands_archive_output'] ) {
					$position = '2';
					$hook = 'woocommerce_after_shop_loop_item_title';
				} else if ( 'above_addtocart' == $kt_woo_extras[ 'product_brands_archive_output'] ) {
					$position = '7';
					$hook = 'woocommerce_after_shop_loop_item';
				} else {
					$position = '70';
					$hook = 'woocommerce_after_shop_loop_item';
				}
				add_action( $hook, array( $this, 'product_brand_output_archive'), $position );
			}
		}
		public function product_brand_output() {
			global $post, $kt_woo_extras;
			$terms = wp_get_post_terms( $post->ID, 'product_brands' );
			if ( ! is_wp_error( $terms ) && !empty( $terms ) ) {
				if ( isset( $kt_woo_extras[ 'product_brands_single_output_width'] ) && !empty( $kt_woo_extras[ 'product_brands_single_output_width'] ) ) {
					$width = $kt_woo_extras[ 'product_brands_single_output_width'];
				} else {
					$width = '200';
				}
				if ( isset( $kt_woo_extras[ 'product_brands_single_output_cropped'] ) && '1' == $kt_woo_extras[ 'product_brands_single_output_cropped'] ) {
					$crop = true;
				} else {
					$crop = false;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_single_link'] ) && '1' == $kt_woo_extras[ 'product_brands_single_link'] ) {
					$link = true;
				} else {
					$link = false;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_single_output_height'] ) && !empty( $kt_woo_extras[ 'product_brands_single_output_height'] ) && '1' == $kt_woo_extras[ 'product_brands_single_output_cropped'] ) {
					$height = $kt_woo_extras[ 'product_brands_single_output_height'];
				} else {
					$height = null;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_single_output_style'] ) && !empty( $kt_woo_extras[ 'product_brands_single_output_style'] ) && 'text' == $kt_woo_extras[ 'product_brands_single_output_style'] ) {
					$style = 'text';
				} else {
					$style = 'image';
				}
				if( 'text' == $style ) {
					echo '<div class="product-brand-wrapper">';
						echo '<span class="product-brand-label">';
							if( count($terms) >= 2 ) {
								echo $this->name_plural.': ';
							} else {
								echo $this->name.': ';
							}
						echo '</span>';
						$i = 1;
						foreach( $terms as $term ) {
							if ( 1 != $i ) {
								echo ', ';
							}
							if ( $link ) {
								echo '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="product-brand-text-link">';
							}
								echo $term->name;
							if ( $link ) {
								echo '</a>';
							}
							$i ++;
						}
						echo '</div>';
				} else {
					$meta = get_option( 'product_brand_image_info' );
			    	if ( empty( $meta) ) {
			    		$meta = array();
			    	}
					if ( ! is_array( $meta ) ) {
						$meta = (array) $meta;
					}
					foreach( $terms as $term ) {
						$data = isset( $meta[$term->term_id] ) ? $meta[$term->term_id] : array();
						if( ! empty($data[ 'kt_woo_extras_brand_image' ] ) ) {
							$image_array = $data[ 'kt_woo_extras_brand_image' ];
							$img = kt_woo_get_image_array($width, $height, $crop, 'attachment-shop-single',$term->name, $image_array[0]);
							echo '<div class="product-brand-image-wrapper">';
							if ( $link ) {
								echo '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="product-brand-link">';
							}
							echo '<img src="'.esc_url($img['src']).'" class="product-brand-image" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" '.$img['srcset'].' />';
							if ( $link ) {
								echo '</a>';
							}
							echo '</div>';
						}
					}
				}
			}
		}
		public function product_brand_output_archive() {
			global $post, $kt_woo_extras;
			$terms = wp_get_post_terms( $post->ID, 'product_brands' );
			if ( ! is_wp_error( $terms ) && !empty( $terms ) ) {
				if ( isset( $kt_woo_extras[ 'product_brands_archive_output_width'] ) && !empty( $kt_woo_extras[ 'product_brands_archive_output_width'] ) ) {
					$width = $kt_woo_extras[ 'product_brands_archive_output_width'];
				} else {
					$width = '200';
				}
				if ( isset( $kt_woo_extras[ 'product_brands_archive_output_cropped'] ) && '1' == $kt_woo_extras[ 'product_brands_archive_output_cropped'] ) {
					$crop = true;
				} else {
					$crop = false;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_archive_link'] ) && '1' == $kt_woo_extras[ 'product_brands_archive_link'] ) {
					$link = true;
				} else {
					$link = false;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_archive_output_height'] ) && !empty( $kt_woo_extras[ 'product_brands_archive_output_height'] ) && '1' == $kt_woo_extras[ 'product_brands_archive_output_cropped'] ) {
					$height = $kt_woo_extras[ 'product_brands_archive_output_height'];
				} else {
					$height = null;
				}
				if ( isset( $kt_woo_extras[ 'product_brands_archive_output_style'] ) && !empty( $kt_woo_extras[ 'product_brands_archive_output_style'] ) && 'text' == $kt_woo_extras[ 'product_brands_archive_output_style'] ) {
					$style = 'text';
				} else {
					$style = 'image';
				}
				if( 'text' == $style ) {
					echo '<div class="product-brand-wrapper">';
						echo '<span class="product-brand-label">';
							if( count($terms) >= 2 ) {
								echo $this->name_plural.': ';
							} else {
								echo $this->name.': ';
							}
						echo '</span>';
						$i = 1;
						foreach( $terms as $term ) {
							if ( 1 != $i ) {
								echo ', ';
							}
							if ( $link ) {
								echo '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="product-brand-text-link">';
							}
								echo $term->name;
							if ( $link ) {
								echo '</a>';
							}
							$i ++;
						}
						echo '</div>';
				} else {
					$meta = get_option( 'product_brand_image_info' );
			    	if ( empty( $meta) ) {
			    		$meta = array();
			    	}
					if ( ! is_array( $meta ) ) {
						$meta = (array) $meta;
					}
					foreach( $terms as $term ) {
						$data = isset( $meta[$term->term_id] ) ? $meta[$term->term_id] : array();
						if( ! empty($data[ 'kt_woo_extras_brand_image' ] ) ) {
							$image_array = $data[ 'kt_woo_extras_brand_image' ];
							$img = kt_woo_get_image_array($width, $height, $crop, 'attachment-shop-single',$term->name, $image_array[0]);
							echo '<div class="product-brand-image-wrapper">';
							if ( $link ) {
								echo '<a href="'.esc_url( get_term_link( $term->term_id ) ).'" class="product-brand-link">';
							}
							echo '<img src="'.esc_url($img['src']).'" class="product-brand-image" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" '.$img['srcset'].' />';
							if ( $link ) {
								echo '</a>';
							}
							echo '</div>';
						}
					}
				}
			}
		}
		public function add_brand_image_columns($columns) {
			return ( empty($columns) ) ? $columns : array_merge( array('cb' => $columns['cb'],'kt_brand_thumbnail' => __('Image', 'kadence-woo-extras' ) ), $columns);
		}
		public function kt_custom_kt_gallery_column( $columns, $column, $id ) {
		    if ( 'kt_brand_thumbnail' == $column ) {
		    	$meta = get_option( 'product_brand_image_info' );
		    	if ( empty( $meta) ) {
		    		$meta = array();
		    	}
				if ( ! is_array( $meta ) ) {
					$meta = (array) $meta;
				}
				$meta = isset( $meta[$id] ) ? $meta[$id] : array();
				if( ! empty($meta[ 'kt_woo_extras_brand_image' ] ) ) {
					$image_array = $meta[ 'kt_woo_extras_brand_image' ];

					$src = wp_get_attachment_image_src( $image_array[0], 'thumbnail'); 
					if( !empty( $src ) ) {
						$columns .= '<img src="' . esc_url( $src[0] ) . '" alt="' . esc_attr__( 'Thumbnail', 'kadence-woo-extras' ) . '" class="wp-post-image" height="48" width="48" />';
					}
				}
		    }
		    return $columns;
		}
		public function product_brands() {
			$labels = array(
				'name'                       => __( $this->name_plural, 'kadence-woo-extras' ),
				'singular_name'              => __( $this->name, 'kadence-woo-extras' ),
				'menu_name'                  => __( $this->name_plural, 'kadence-woo-extras' ),
				'all_items'                  => __( 'All '.$this->name_plural, 'kadence-woo-extras' ),
				'parent_item'                => __( 'Parent '.$this->name, 'kadence-woo-extras' ),
				'parent_item_colon'          => __( 'Parent '.$this->name.' :', 'kadence-woo-extras' ),
				'new_item_name'              => __( 'New '.$this->name.' Name', 'kadence-woo-extras' ),
				'add_new_item'               => __( 'Add New '.$this->name, 'kadence-woo-extras' ),
				'edit_item'                  => __( 'Edit '.$this->name, 'kadence-woo-extras' ),
				'update_item'                => __( 'Update '.$this->name, 'kadence-woo-extras' ),
				'view_item'                  => __( 'View '.$this->name, 'kadence-woo-extras' ),
				'separate_items_with_commas' => __( 'Separate '.$this->name.' With Commas', 'kadence-woo-extras' ),
				'add_or_remove_items'        => __( 'Add or remove '.$this->name, 'kadence-woo-extras' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'kadence-woo-extras' ),
				'popular_items'              => __( 'Popular '.$this->name, 'kadence-woo-extras' ),
				'search_items'               => __( 'Search '.$this->name, 'kadence-woo-extras' ),
				'not_found'                  => __( 'Not Found', 'kadence-woo-extras' ),
			);
			$labels = apply_filters( 'kadence_woo_extras_brands_taxonomy_labels', $labels );

			$rewrite = array(
				'slug'                       => $this->slug_name,
				'with_front'                 => true,
				'hierarchical'               => true,
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $rewrite,
			);

			$args = apply_filters( 'kadence_woo_extras_brands_taxonomy_args', $args );

			register_taxonomy( 'product_brands', array( 'product' ), $args );

		}
		public function kt_extra_brands_meta() {
			if ( !class_exists( 'KT_WOO_EXTRAS_Taxonomy_Meta' ) )
				return;

			$meta_sections = array();
			$prefix = 'kt_woo_extras_';
			$meta_sections[] = array(
				'title'      => __('Brand Image', 'virtue'), 
				'taxonomies' => array('product_brands'),
				'id'         => 'product_brand_image_info',

				'fields' => array(
					array(
						'name' => __('Brand Image', 'pinnacle' ),
						'id' => $prefix . 'brand_image',
						'type' => 'image',
					),
				),
			);

			foreach ( $meta_sections as $meta_section ) { 
				new KT_WOO_EXTRAS_Taxonomy_Meta( $meta_section );
			}
		}

	}
	$GLOBALS['kt_extra_brands'] = new kt_extra_brands();
}

