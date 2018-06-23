<?php

/**
 * Enqueue CSS & JS
 */
function ascend_admin_scripts($hook) {
	if( $hook == 'toplevel_page_kad_options' || $hook == 'widgets.php' ) {
		wp_enqueue_script('select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', array( 'jquery' ), ASCEND_VERSION, false);
		wp_dequeue_script('select2-js' ); 
	}
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'widgets.php' && $hook != 'toplevel_page_kad_options' ) {
		return;
	}
	wp_enqueue_style('ascend_admin_styles', get_template_directory_uri() . '/assets/css/ascend_admin.css', false, ASCEND_VERSION);


	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'widgets.php' ) {
		return;
	}

	if (class_exists('woocommerce')) {
		if ( version_compare( WC_VERSION, '2.7', '>' ) ) {  
			wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2_v4-min.js', false, ASCEND_VERSION, false);
		} else {
			wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', false, ASCEND_VERSION, false);
			
		}
	} else {
		wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', false, ASCEND_VERSION, false);
	}
    wp_enqueue_script('select2');
    wp_dequeue_script('select2-js' ); 

	wp_enqueue_media();
	wp_register_script('mustache-js', get_template_directory_uri() . '/assets/js/vendor/mustache.min.js');
	wp_enqueue_script('ascend_admin_scripts', get_template_directory_uri() . '/assets/js/min/ascend-admin-min.js', array( 'wp-color-picker', 'jquery', 'underscore', 'backbone', 'jquery-ui-sortable', 'mustache-js'), ASCEND_VERSION, false);

}

add_action('admin_enqueue_scripts', 'ascend_admin_scripts');

function ascend_gallery_default_type_set_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
}
add_filter( 'media_view_settings', 'ascend_gallery_default_type_set_link');

function ascend_gallery_wp_enqueue_media() {
	global $ascend;

  	if(!isset($ascend['kadence_gallery']) || $ascend['kadence_gallery'] == '1')  {
		wp_register_script( 'kadence-gallery-settings', get_template_directory_uri() . '/assets/js/min/kt-gallery-settings-min.js', array( 'media-views' ), 3234 );
		wp_enqueue_script( 'kadence-gallery-settings' );
	}

}

add_action( 'wp_enqueue_media', 'ascend_gallery_wp_enqueue_media' );
add_action('print_media_templates', 'ascend_media_gallery_extras');
function ascend_media_gallery_extras(){
?>
<script type="text/html" id="tmpl-custom-gallery-setting">
    <hr style="clear: both;display: block;padding-top: 5px;border-top: 0;border-bottom: 1px solid #ddd;">
    <h3 style="margin-top:10px;"><?php echo __('Extra Gallery Settings', 'ascend');?></h3>
    <label class="setting">
      <span><?php _e('Type', 'ascend'); ?></span>
      <select data-setting="type" name="kt_type" class="kt_type">
        <option value="default"><?php _e('Default', 'ascend');?></option>
        <option value="slider"><?php _e('Slider', 'ascend');?></option>
        <option value="carousel"><?php _e('Carousel', 'ascend');?></option>
        <option value="mosaic"><?php _e('Mosaic', 'ascend');?></option>
        <option value="tiles"><?php _e('Tiled', 'ascend');?></option>
        <option value="imagecarousel"><?php _e('Image Carousel', 'ascend');?></option>
      </select>
    </label>
    <label class="setting">
      <span><?php _e('Show Captions', 'ascend'); ?></span>
      <select data-setting="caption">
      <option value="default"><?php _e('Default', 'ascend');?></option>
        <option value="false"><?php _e('False', 'ascend');?></option>
        <option value="true"><?php _e('True', 'ascend');?></option>
      </select>
    </label>
    <label class="setting masonry-setting">
      <span><?php _e('Masonry', 'ascend'); ?></span>
      <select data-setting="masonry">
        <option value="default"><?php _e('Default', 'ascend');?></option>
        <option value="false"><?php _e('False', 'ascend');?></option>
        <option value="true"><?php _e('True', 'ascend');?></option>
      </select>
    </label>
    <div class="slider-settings">
	    <h3 style="padding-top:10px;"><?php echo __('Slider Option - Settings', 'ascend');?></h3>
	    <label class="setting">
	        <span style="min-width: 50px;"><?php _e('Width', 'ascend'); ?></span>
	        <input type="text" value="" data-setting="width" style="float:left;">
	    </label>
	    <label class="setting">
	        <span style="min-width: 50px;"><?php _e('Height', 'ascend'); ?></span>
	        <input type="text" value="" data-setting="height" style="float:left;">
	    </label>
	</div>
    <hr style="clear: both;display: block;padding-top: 5px;border-top: 0;border-bottom: 1px solid #ddd;">
</script>

<?php

}