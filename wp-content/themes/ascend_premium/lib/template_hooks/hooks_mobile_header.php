<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action('kadence_mobile_header_left', 'ascend_mobile_left', 20);
function ascend_mobile_left() {
	global $ascend;
	if(isset($ascend['mobile_header_menu']) && $ascend['mobile_header_menu'] == 'left') {
		ascend_mobile_menu_ouput('left');
	}
	if(isset($ascend['mobile_header_cart']) && $ascend['mobile_header_cart'] == 'left') {
		ascend_mobile_header_cart('left');
	}
	if(isset($ascend['mobile_header_account']) && $ascend['mobile_header_account'] == 'left')  {
		ascend_mobile_header_account('left');
	}
	if(isset($ascend['mobile_header_search']) && $ascend['mobile_header_search'] == 'left')  {
		ascend_mobile_header_search('left');
	}
	if(isset($ascend['mobile_header_layout']) && $ascend['mobile_header_layout'] == 'center') {
		// Do nothing
	} else {
		ascend_the_custom_mobile_logo();
	}
}
add_action('kadence_mobile_header_center', 'ascend_mobile_center', 20);
function ascend_mobile_center() {
	global $ascend;
	if(isset($ascend['mobile_header_layout']) && $ascend['mobile_header_layout'] == 'center') {
		ascend_the_custom_mobile_logo('center');
		ascend_the_custom_mobile_logo_decoy();
	}
}
add_action('kadence_mobile_header_right', 'ascend_mobile_right', 20);
function ascend_mobile_right() {
	global $ascend;
	if(isset($ascend['mobile_header_search']) && $ascend['mobile_header_search'] == 'right')  {
		ascend_mobile_header_search('right');
	}
	if(isset($ascend['mobile_header_account']) && $ascend['mobile_header_account'] == 'right')  {
		ascend_mobile_header_account('right');
	}
	if(isset($ascend['mobile_header_cart']) && $ascend['mobile_header_cart'] == 'right')  {
		ascend_mobile_header_cart('right');
	}
	if((isset($ascend['mobile_header_menu']) && $ascend['mobile_header_menu'] == 'right') || !isset($ascend['mobile_header_cart'])) {
		ascend_mobile_menu_ouput('right');
	}
}
function ascend_the_custom_mobile_logo($position = 'left') {
	global $ascend;
	echo '<div id="mobile-logo" class="logocase kad-mobile-header-height kad-mobile-logo-'.esc_attr($position).'">';
		echo '<a class="brand logofont" href="'.esc_url(apply_filters('kadence_logo_link', home_url('/'))).'">';
		$liu = '';
		if(isset($ascend['mobile_logo_switch']) && $ascend['mobile_logo_switch'] == '0') {
			if(isset($ascend['logo']['id']) && !empty($ascend['logo']['id'])) {
				if(isset($ascend['mobile_logo_width']) && !empty($ascend['mobile_logo_width'])) {
					$width = $ascend['mobile_logo_width'];
				} else {
					$width = 300;
				}
				$width = apply_filters('kadence_mobile_logo_width', $width);
				$alt = get_bloginfo('name');
				echo ascend_get_image_output($width, null, false, 'ascend-mobile-logo', $alt, $ascend['logo']['id'], false, false, false);
				if(isset($ascend['trans_logo']['id']) && !empty($ascend['trans_logo']['id'])) {
					$img = ascend_get_image($width, null, false, 'ascend-trans-logo', $alt, $ascend['trans_logo']['id'], false);
					echo '<img src="'.esc_url($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" style="max-height:'.esc_attr($img['height']).'px" alt="'.esc_attr($img['alt']).'">';
				}
				$liu = 'kad-logo-used';
			}
			if(isset($ascend['site_title']) && $ascend['site_title'] == 1) {
				echo '<span class="kad-site-title '.$liu.'">';
				echo apply_filters('kad_site_name', get_bloginfo('name')); 
				if(isset($ascend['site_tagline']) && $ascend['site_tagline'] == 1) {
					echo '<span class="kad-site-tagline">';
					echo apply_filters('kad_site_tagline', get_bloginfo('description'));
					echo '</span>';
				}
				echo '</span>';
			}
		} else {
			if(isset($ascend['mobile_logo']['id']) && !empty($ascend['mobile_logo']['id'])) {
				if(isset($ascend['mobile_logo_width']) && !empty($ascend['mobile_logo_width'])) {
					$width = $ascend['mobile_logo_width'];
				} else {
					$width = 300;
				}
				$width = apply_filters('kadence_mobile_logo_width', $width);
				$alt = get_bloginfo('name');
				echo ascend_get_image_output($width, null, false, 'ascend-mobile-logo', $alt, $ascend['mobile_logo']['id'], false, false, false);
				if(isset($ascend['trans_logo_mobile']['id']) && !empty($ascend['trans_logo_mobile']['id'])) {
					$img = ascend_get_image($width, null, false, 'ascend-mobile-trans-logo', $alt, $ascend['trans_logo_mobile']['id'], false);
					echo '<img src="'.esc_url($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" style="max-height:'.esc_attr($img['height']).'px" alt="'.esc_attr($img['alt']).'">';
				}
				$liu = 'kad-logo-used';
			}
			if(isset($ascend['mobile_site_title']) && $ascend['mobile_site_title'] == 1) {
				echo '<span class="kad-mobile-site-title '.$liu.'">';
				echo apply_filters('kad_site_name', get_bloginfo('name'));
				if(isset($ascend['mobile_site_tagline']) && $ascend['mobile_site_tagline'] == 1) {
					echo '<span class="kad-mobile-site-tagline">';
					echo apply_filters('kad_site_tagline', get_bloginfo('description'));
					echo '</span>';
				}
				echo '</span>';
			}
		}
		echo '</a>';
	echo '</div>';
}
function ascend_the_custom_mobile_logo_decoy() {
	echo '<div id="mobile-logo-placeholder" class="kad-mobile-header-height">';
	echo '</div>';
}
function ascend_mobile_menu_ouput($side = 'right') {
	if (has_nav_menu('primary_navigation') || has_nav_menu('mobile_navigation')) : ?>
        	<div class="kad-mobile-menu-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-menu-<?php echo esc_attr($side);?>">
             	<button class="mobile-navigation-toggle kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-menu" data-pop-sldr-direction="<?php echo esc_attr($side);?>" data-pop-sldr-class="sldr-menu-animi">
             	<span class="kt-mnt">
                	<span></span>
					<span></span>
					<span></span>
				</span>
              	</button>
            </div>
   	<?php  endif; 
}
function ascend_mobile_header_cart($side = 'right') {
	if (class_exists('woocommerce'))  { ?>
      	<div class="kad-mobile-cart-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-cart-<?php echo esc_attr($side);?>">
             	<button class="kt-woo-cart-toggle kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-cart" data-pop-sldr-direction="<?php echo esc_attr($side);?>"  data-pop-sldr-class="sldr-cart-animi">
					<span class="kt-extras-label"><i class="kt-icon-bag"></i><span class="kt-cart-total"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span>
              	</button>
        </div>
    <?php } 
}
function ascend_mobile_header_account($side = 'right') {
	if ( class_exists('woocommerce') )  {
		global $ascend;
		?>
      	<div class="kad-mobile-account-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-account-<?php echo esc_attr($side);?>">
      		<?php if ( is_user_logged_in() ) { ?>
             	<button class="kt-woo-account-toggle  kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-account" data-pop-sldr-direction="<?php echo esc_attr($side);?>"  data-pop-sldr-class="sldr-account-animi">
					<span class="kt-extras-label header-underscore-icon"><i class="kt-icon-user2"></i></span>
          		</button>
            <?php } else {
             	if( isset( $ascend[ 'header_extras_login_link' ] ) && 'link' == $ascend[ 'header_extras_login_link' ] ) { ?>
					<button class="kt-woo-account-toggle" onclick="location.href='<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>';">
						<span class="kt-extras-label"><i class="kt-icon-user2"></i></span>
					</button>
				<?php } else { ?>
					<button class="kt-woo-account-toggle kt-pop-modal" rel="nofollow" data-mfp-src="#kt-extras-modal-login">
						<span class="kt-extras-label"><i class="kt-icon-user2"></i></span>
					</button>
             <?php 	}
             } ?>
        </div>
    <?php } 
}
function ascend_mobile_header_search($side = 'right') {  ?>
      	<div class="kad-mobile-seearch-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-search-<?php echo esc_attr($side);?>">
             	<button class="kt-search-toggle kt-pop-modal" rel="nofollow" data-mfp-src="#kt-extras-modal-search">
					<span class="kt-extras-label"><i class="kt-icon-search"></i></span>
          		</button>
        </div>
    <?php
}

add_action('kadence_mobile_header_top', 'ascend_mobile_top_icon_bar', 20);
function ascend_mobile_top_icon_bar() {
	global $ascend;
	if(isset($ascend['mobile_topbar']) && $ascend['mobile_topbar'] == '1') {
		echo '<div class="mobile-top-icon-bar">';
		if(isset($ascend['mobile_topbar_icons']) && !empty($ascend['mobile_topbar_icons'])) {
			if(isset($ascend['mobile_topbar_icon_title']) && $ascend['mobile_topbar_icon_title'] == '1') {
				$show_title = true;
			} else {
				$show_title = false;
			}
			$counter = 1;
			foreach ($ascend['mobile_topbar_icons'] as $icon) :
                if(!empty($icon['target']) && $icon['target'] == 1) {
        			$target = '_blank';
    			} else {
    				$target = '_self';
    			}
    			if(isset($icon['attachment_id'])) {
					$id = $icon['attachment_id'];
				} else {
					$id = '';
				}
				if(isset($icon['icon_o'])) {
					$icon_o = $icon['icon_o'];
				} else {
					$icon_o = '';
				}
				if(isset($icon['link'])) {
					$link = $icon['link'];
				} else {
					$link = '';
				}
				if(isset($icon['title'])) {
					$title = $icon['title'];
				} else {
					$title = '';
				}
				if(isset($icon['description'])) {
					$subtitle = $icon['description'];
				} else {
					$subtitle = '';
				}
                echo '<div class="top-icon-bar-item icon-bar-itemcount'.esc_attr($counter).'">';
	                echo '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="top-icon-bar-link">';
		                if(!empty($id)) {
		                	 echo wp_get_attachment_image($id, 'full');
		                } else {
		                	echo '<i class="'.esc_attr($icon_o).'"></i>';
		                }
		                if($show_title) {
		                	echo '<span class="top-icon-bar-title">'.esc_html($title).'</span>';
		                }
	                echo '</a>';
    			echo '</div>';
                $counter ++;
            endforeach;
		}
		if( isset( $ascend['mobile_topbar_widget_area'] ) && 1 == $ascend['mobile_topbar_widget_area'] ) {
			if (is_active_sidebar('mobile_topbar_widget') ) { 
				echo '<div class="top-icon-bar-item">';
					dynamic_sidebar('mobile_topbar_widget'); 
				echo '</div>';
			}
		}
		echo '</div>';
	}
}