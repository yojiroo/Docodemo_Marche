<?php 
add_action( "after_setup_theme", 'ascend_remove_sections', 1);
function ascend_remove_sections() {
	if(!is_admin()){
		return;
	}
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    if(ReduxFramework::$_version <= '3.5.6') {
        return;
    }
    $ascend_options = get_option('ascend');
    if(!isset($ascend_options['customizer_limited']) || $ascend_options['customizer_limited'] == '1') {
    	$limit = array('topbar_header_settings','footer','transparent_header_options','page_title','home_header_section','home_mobile_slider','shop_archive_settings','shop_page_header','product_settings','portfolio_settings','page_settings','blog_settings','staff_settings', 'testimonial_options','language_settings', 'breadcrumbs','search_settings', 'misc_settings');
    	foreach ($limit as $key) {
    		$item = Redux::getSection('ascend', $key);
	    	$item['customizer'] = false;
	    	Redux::setSection('ascend', $item);
    	}
    }
    if(isset($ascend_options['kadence_woo_extension']) && $ascend_options['kadence_woo_extension'] == '0') {

    	//Home Page Sorter
        $field = Redux::getField('ascend', 'homepage_layout');
        unset($field['options']['disabled']['block_three']);
        Redux::setField('ascend', $field);
        // Header
        $field = Redux::getField('ascend', 'header_extras');
        unset($field['options']['cart']);
        unset($field['options']['login']);
        Redux::setField('ascend', $field);

        Redux::removefield('ascend', 'header_extras_cart');
        // Mobile Header
        Redux::removefield('ascend', 'mobile_menu_search_woo');
        Redux::removefield('ascend', 'mobile_header_cart');
        Redux::removefield('ascend', 'mobile_header_account');
        // topbar 
        Redux::removefield('ascend', 'topbar_search_woo');
        Redux::removefield('ascend', 'topbar_cart');
        Redux::removefield('ascend', 'topbar_cart_label');
        Redux::removefield('ascend', 'topbar_account');

        // Home Slider 
        $field = Redux::getField('ascend', 'home_post_carousel_type');
        unset($field['options']['product']);
        Redux::setField('ascend', $field);

        Redux::removefield('ascend', 'home_post_carousel_product_cat');
        
        // Sections
        Redux::removeSection('ascend', 'home_layout_tabs_products');
        Redux::removeSection('ascend', 'shop_archive_settings');
        Redux::removeSection('ascend', 'shop_page_header');
        Redux::removeSection('ascend', 'product_settings');

        // Language
        Redux::removefield('ascend', 'tl_cart');
        Redux::removefield('ascend', 'tl_login_signup');
        Redux::removefield('ascend', 'tl_my_account');
        Redux::removefield('ascend', 'info_lang_woocommerce');
        Redux::removefield('ascend', 'sold_placeholder_text');
        Redux::removefield('ascend', 'sale_placeholder_text');
        Redux::removefield('ascend', 'wc_clear_placeholder_text');
        Redux::removefield('ascend', 'notavailable_placeholder_text');
        Redux::removefield('ascend', 'description_tab_text');
        Redux::removefield('ascend', 'description_header_text');
        Redux::removefield('ascend', 'additional_information_tab_text');
        Redux::removefield('ascend', 'additional_information_header_text');
        Redux::removefield('ascend', 'reviews_tab_text');
        Redux::removefield('ascend', 'related_products_text');
        Redux::removefield('ascend', 'wc_upsell_products_text');
        Redux::removefield('ascend', 'reviews_tab_text');

        // Breadcrumbs
        Redux::removefield('ascend', 'show_breadcrumbs_shop');
        Redux::removefield('ascend', 'show_breadcrumbs_product');

    }
    if(isset($ascend_options['kadence_portfolio_extension']) && $ascend_options['kadence_portfolio_extension'] == '0') {
    	 // Home Slider 
        $field = Redux::getField('ascend', 'home_post_carousel_type');
        unset($field['options']['portfolio']);
        Redux::setField('ascend', $field);
        Redux::removefield('ascend', 'home_post_carousel_portfolio_cat');

        //Home Page Sorter
        $field = Redux::getField('ascend', 'homepage_layout');
        unset($field['options']['disabled']['block_six']);
        unset($field['options']['disabled']['block_seven']);
        Redux::setField('ascend', $field);

        Redux::removeSection('ascend', 'home_layout_portfolio_carousel');
        Redux::removeSection('ascend', 'home_layout_portfolio_full');
        Redux::removeSection('ascend', 'portfolio_settings');

        Redux::removefield('ascend', 'show_breadcrumbs_portfolio');

        remove_action( 'init', 'ascend_portfolio_post_init', 1 );

        add_filter('kadence_widget_carousel_types', 'ascend_unset_portfolio_from_carousel');
        function ascend_unset_portfolio_from_carousel($types) {
            unset($types['portfolio']);
            return $types;
        }

    }
    if(isset($ascend_options['kadence_staff_extension']) && $ascend_options['kadence_staff_extension'] == '0') {
    	Redux::removeSection('ascend', 'staff_settings');
        Redux::removefield('ascend', 'show_breadcrumbs_staff');
        Redux::removefield('ascend', 'staff_link');

      	remove_action( 'init', 'ascend_staff_post_init');
    }
    if(isset($ascend_options['kadence_testimonial_extension']) && $ascend_options['kadence_testimonial_extension'] == '0') {
    	Redux::removeSection('ascend', 'testimonial_options');
        Redux::removefield('ascend', 'show_breadcrumbs_testimonial');
        Redux::removefield('ascend', 'testimonial_link');

      	remove_action( 'init', 'ascend_testimonial_post_init');

        add_filter('kadence_shortcodes', 'ascend_unset_test_from_shortcode_popup');
        function ascend_unset_test_from_shortcode_popup($extra_shortcodes) {
            unset($extra_shortcodes['kad_testimonial_form']);
            
            return $extra_shortcodes;
        }
        function ascend_remove_testimonial_widget() {
			unregister_widget('KT_Testimonial_Slider_Widget');
		}

		add_action( 'widgets_init', 'ascend_remove_testimonial_widget' );
    }
}