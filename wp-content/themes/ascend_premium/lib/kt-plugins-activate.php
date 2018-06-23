<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/classes/class-plugin-activation.php';

if ( get_option( 'kt_api_manager_ascend_premium_activated' ) == 'Activated' ) {
	if( ! class_exists( 'ZipArchive' ) ) {
		 add_action( 'admin_notices', 'ascend_ziparchive_not_active' );
	} else {
		add_action( 'tgmpa_register', 'ascend_register_required_plugins' );
	}
}
function ascend_ziparchive_not_active() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div id="message" class="error">';
		echo '<p>'.__( 'ZipArchive is not enabled on this server. Please contact your hosting provider and ask them to enabled ZipArchive', 'ascend' ).'</p>';
	echo '</div>';
}
/**
 * Register the required plugins for this theme.
 *
 */
function ascend_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$extensions = array();
	$suggestions = array();
	$addons = array();
	$suggested = array();
	
	$addons[] = array(
		'name'     				=> 'Kadence Slider', // The plugin name
		'slug'     				=> 'kadence-slider', // The plugin slug (typically the folder name)
		'source'   				=> 'https://kernl-file-uploads.s3.amazonaws.com/uploads/13-02-2018/11-59-56/kadence-slider/kadence-slider.zip', // The plugin source
		'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		'version' 				=> '2.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
	);
	$addons[] = array(
			'name'     				=> 'Kadence Importer', // The plugin name
			'slug'     				=> 'kadence-importer', // The plugin slug (typically the folder name)
			'source'   				=> 'https://kernl-file-uploads.s3.amazonaws.com/uploads/04-12-2017/03-49-03/kadence-importer/kadence-importer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			);
			$suggested[] = array(
				'name'     				=> 'Page Builder by SiteOrigin', // The plugin name
				'slug'     				=> 'siteorigin-panels', // The plugin slug (typically the folder name)
			);
			$suggested[] = array(
				'name'     				=> 'Black Studio TinyMCE Widget', // The plugin name
				'slug'     				=> 'black-studio-tinymce-widget', // The plugin slug (typically the folder name)
			);

	if ( is_array( $addons ) ) {

      foreach ( $addons as $ext => $data ) {

        $extensions[$ext] = array(
          'name'               => $data['name'],
          'slug'               => $data['slug'],
          'source'             => $data['source'],
          'required'           => false,
          'version'            => $data['version'],
          'force_activation'   => false,
          'force_deactivation' => false,
          'external_url'       => '',
        );

      }

    }
    if ( is_array( $suggested ) ) {

      foreach ( $suggested as $ext => $data ) {

        $suggestions[$ext] = array(
          'name'               => $data['name'],
          'slug'               => $data['slug'],
          'required'           => false,
          'force_activation'   => false,
          'force_deactivation' => false,
        );

      }
  	}
	$plugins = array_merge( $suggestions, $extensions );

	$theme_text_domain = 'ascend';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'ascend',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug'  		=> 'themes.php',            // Parent menu slug.
		'menu'         		=> 'install-recommended-plugins', 	// Menu slug
		'has_notices'      	=> false,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Suggested Plugins', 'ascend' ),
			'menu_title'                       			=> __( 'Theme Plugins', 'ascend' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'ascend' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'ascend' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ascend' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme comes packaged with the following premium plugin: %1$s. Plugin is not required.', 'This theme comes packaged with the following premium plugins: %1$s. Plugins are not required.', 'ascend' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ascend' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ascend' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ascend' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ascend' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ascend' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ascend' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ascend' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'ascend' ),
			'return'                           			=> __( 'Return to recommended Plugins Installer', 'ascend' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'ascend' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'ascend' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);


	tgmpa( $plugins, $config );

	if( !current_user_can('manage_options') || apply_filters( 'kadence_hide_plugin_notice', false ) ) {
	TGM_Plugin_Activation::$instance->has_notices = false;
	}


}