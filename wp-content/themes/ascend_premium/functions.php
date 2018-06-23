<?php
define( 'OPTIONS_SLUG', 'ascend' );
define( 'LANGUAGE_SLUG', 'ascend' );
load_theme_textdomain('ascend', get_template_directory() . '/languages');
/*
 * Init Theme Options
 */
require_once locate_template('/themeoptions/redux/framework.php');          		// Options framework
require_once locate_template('/themeoptions/options.php');          				// Options settings
require_once locate_template('/themeoptions/options/ascend_extension.php'); 		// Options framework extension
require_once locate_template('/kt_framework/extensions.php');        				// Remove options from the admin

/*
 * Init Theme Startup/Core utilities/classes
 */
require_once locate_template('/lib/init.php');            								// Initial theme setup and constants
require_once locate_template('/lib/classes/class-ascend-sidebar.php');         			// Sidebar class
require_once locate_template('/lib/classes/class-ascend-custom-menu.php');        		// Nav Options
require_once locate_template('/lib/classes/class-resizer.php');      					// Resize on the fly
require_once locate_template('/lib/classes/class-ascend-taxonomy-meta.php');   			// Taxonomy meta boxes
require_once locate_template('/lib/classes/class-kadence-image-processing.php');   		// Image Processing
require_once locate_template('/lib/classes/class-ascend-get-image.php');   				// Getting Image Size
require_once locate_template('/lib/kt-plugins-activate.php');   						// Plugin Activation
require_once locate_template('/lib/classes/cmb/init.php');     							// Custom metaboxes
require_once locate_template('/lib/metaboxes/ascend-cmb-extensions.php');     			// Custom Gallery metaboxes
require_once locate_template('/lib/image_functions.php');     							// Image Functions
require_once locate_template('/lib/kt_slider.php');     								// Ascend Slider
require_once locate_template('/lib/config.php');          								// Configuration
require_once locate_template('/lib/config-pagetitle.php');          					// Configuration page title
require_once locate_template('/lib/config-sidebar.php');          						// Configuration Sidebar
require_once locate_template('/kt_framework/status.php');   							// System status

/*
 * Init Custom post type, metaboxes
 */
require_once locate_template('/lib/cleanup.php');        							// Cleanup
require_once locate_template('/lib/nav.php');            							// Custom nav modifications
require_once locate_template('/lib/taxonomy-meta.php');         					// Taxonomy meta boxes
require_once locate_template('/lib/post-types.php');      							// Post Types
require_once locate_template('/lib/metaboxes/post-metaboxes.php');     				// Custom metaboxes
require_once locate_template('/lib/metaboxes/postheader-metaboxes.php');     		// Custom metaboxes
require_once locate_template('/lib/metaboxes/pageheader-metaboxes.php');     		// Custom metaboxes
require_once locate_template('/lib/metaboxes/staff-metaboxes.php');     			// Custom metaboxes
require_once locate_template('/lib/metaboxes/sidebar-metaboxes.php');     			// Custom metaboxes
require_once locate_template('/lib/metaboxes/page-template-blog-metaboxes.php');    // Custom metaboxes
require_once locate_template('/lib/metaboxes/product-metaboxes.php');     			// Custom metaboxes
require_once locate_template('/lib/metaboxes/testimonial-metaboxes.php');     		// Custom metaboxes
require_once locate_template('/lib/metaboxes/portfolio-metaboxes.php');     		// Custom metaboxes

/*
 * Init Shortcodes
 */
require_once locate_template('/lib/kad_shortcodes/shortcodes.php');      					// Shortcodes
require_once locate_template('/lib/kad_shortcodes/carousel_shortcodes.php');   				// Carousel Shortcodes
require_once locate_template('/lib/kad_shortcodes/post_carousel_shortcodes.php');   		// Post Carousel Shortcodes
require_once locate_template('/lib/kad_shortcodes/custom_carousel_shortcodes.php');   		// Custom Carousel Shortcodes
require_once locate_template('/lib/kad_shortcodes/testimonial_shortcodes.php');   			// Testimonial Carousel Shortcodes
require_once locate_template('/lib/kad_shortcodes/testimonial_form_shortcode.php');   		// Testimonial Form Shortcodes
require_once locate_template('/lib/kad_shortcodes/blog_shortcodes.php');   					// Blog Shortcodes
require_once locate_template('/lib/kad_shortcodes/image_menu_shortcodes.php'); 				// Image menu Shortcodes
require_once locate_template('/lib/kad_shortcodes/google_map_shortcode.php');  				// Map Shortcodes
require_once locate_template('/lib/kad_shortcodes/portfolio_shortcodes.php'); 				// Portfolio Shortcodes
require_once locate_template('/lib/kad_shortcodes/portfolio_type_shortcodes.php'); 			// Portfolio Type Shortcodes
require_once locate_template('/lib/kad_shortcodes/staff_shortcodes.php'); 					// Staff Shortcodes
require_once locate_template('/lib/kad_shortcodes/gallery.php');      						// Gallery Shortcode
require_once locate_template('/lib/kad_shortcodes/contact_form_shortcode.php');      		// Contact Form Shortcode
/*
 * Init Widgets
 */
require_once locate_template('/lib/widgets/premium_widgets.php'); 						// Premium Widgets
require_once locate_template('/lib/widgets/standard_widgets.php');         				// Standard Widgets
require_once locate_template('/lib/widgets/widget_setup.php');  						// Widget Setup

/*
 * Template Hooks
 */
require_once locate_template('/lib/custom.php');          						// Custom functions
require_once locate_template('/lib/pagebuilder/pagebuilder.php');          		// Pagebuilder Extensions
require_once locate_template('/lib/pagebuilder/animations.php');          		// Pagebuilder Animations
require_once locate_template('/lib/pagebuilder/snippets.php');          			// Pagebuilder Snippets
require_once locate_template('/lib/template_hooks/breadcrumbs.php');         	// Breadcrumbs
require_once locate_template('/lib/template_hooks/authorbox.php');         		// Author box
require_once locate_template('/lib/template_hooks/posts.php'); 					// Posts Template Hooks
require_once locate_template('/lib/template_hooks/portfolio.php'); 				// Portfolio Template Hooks
require_once locate_template('/lib/template_hooks/hooks_page.php'); 			// Page Template Hooks
require_once locate_template('/lib/template_hooks/hooks_header.php'); 			// Header Hooks
require_once locate_template('/lib/template_hooks/hooks_mobile_header.php'); 	// Mobile Header Hooks
require_once locate_template('/lib/template_hooks/hooks_topbar_header.php'); 	// Topbar Hooks
require_once locate_template('/lib/template_hooks/hooks_footer.php'); 			// Footer Hooks
require_once locate_template('/lib/template_hooks/posts_list.php'); 			// Post List Hooks
require_once locate_template('/lib/template_hooks/archive.php'); 				// Archive Hooks
require_once locate_template('/lib/template_hooks/staff_hooks.php'); 			// Staff Hooks
require_once locate_template('/lib/template_hooks/testimonial_hooks.php'); 		// Testimonial Hooks

/*
* Woomcommerce Support
*/
require_once locate_template('/lib/woocommerce/woo-support.php'); 					// Woocommerce functions
require_once locate_template('/lib/woocommerce/woo-archive-hooks.php'); 			// Woocommerce archive functions
require_once locate_template('/lib/woocommerce/woo-single-product-hooks.php'); 		// Woocommerce Single Product 
require_once locate_template('/lib/woocommerce/woo-account.php'); 					// Woocommerce My Account
require_once locate_template('/lib/woocommerce/woo-cart.php'); 						// Woocommerce Cart

/*
 * Load Scripts
 */
require_once locate_template('/lib/admin_scripts.php');    					// Admin Scripts
require_once locate_template('/lib/scripts.php');        					// Front End Scripts and stylesheets
require_once locate_template('/lib/output_css.php'); 						// Fontend Custom CSS

/*
 * Updater
 */
require_once locate_template('/kt_framework/kt-api.php'); 					// API Settings
require_once locate_template('/kt_framework/kt-theme-updates.php');			// Updater


/**
 * Note: Do not add any custom code here. Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 * https://www.kadencethemes.com/child-themes/
 */
