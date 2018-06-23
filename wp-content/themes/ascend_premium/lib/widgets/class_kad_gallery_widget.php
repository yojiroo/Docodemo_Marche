<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class kad_gallery_widget extends WP_Widget{

private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_gallery_widget', 'description' => __('Adds a gallery to any widget area.', 'ascend'));
        parent::__construct('kadence_gallery_widget', __('Ascend: Gallery', 'ascend'), $widget_ops);
    }
     public function widget($args, $instance){ 
     	if ( ! isset( $args['widget_id'] ) ) {
      		$args['widget_id'] = $this->id;
     	}
        extract( $args ); 
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if(!empty($instance["ids"])) {$g_ids = $instance["ids"];} else {$g_ids = '';}
        if(!empty($instance["gallery_width"])) {$g_width = 'width='.$instance["gallery_width"];} else {$g_width = '';}
        if(!empty($instance["gallery_height"])) {$g_height = 'height='.$instance["gallery_height"];} else {$g_height = '';}
        if(!empty($instance["gallery_speed"])) {$g_speed = 'speed='.$instance["gallery_speed"];} else {$g_speed = '';}
        if(!empty($instance["gallery_thumbs"])) {$g_thumbs = 'thumbs='.$instance["gallery_thumbs"];} else {$g_thumbs = '';}
        if(!empty($instance["gallery_type"])) { $g_type = $instance["gallery_type"]; } else {$g_type = 'standard';}
        if(!empty($instance["lightbox_size"])) { $l_size = 'lightboxsize="'.$instance["lightbox_size"].'"'; } else {$l_size = '';}
        if(!empty($instance["gallery_columns"])) { $g_columns = $instance["gallery_columns"]; } else {$g_columns = '3';}
        if(!empty($instance["gallery_captions"]) && $instance["gallery_captions"] == 'on') { $g_captions = 'caption=true';} else {$g_captions = '';}
        if(!empty($instance["gallery_auto"]) && $instance["gallery_auto"] == 'false') { $g_auto = 'autoplay="false"'; } else { $g_auto = '';}
        if($g_type == 'masonry') {$masonry = 'true';} else {$masonry = 'false';}

            ?>

          <?php echo $before_widget;
          if ( $title ) echo $before_title . $title . $after_title; 
          echo do_shortcode('[gallery ids='.$g_ids.' type='.$g_type.' '.$g_captions.' gallery_id="'.$args['widget_id'].'" masonry='.$masonry.' columns='.$g_columns.' '.$g_speed.' '.$g_thumbs.' '.$g_height.' '.$g_auto.' '.$l_size.' '.$g_width .']');
          echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['ids'] = sanitize_text_field( $new_instance['ids'] );
        $instance['gallery_type'] = sanitize_text_field( $new_instance['gallery_type'] );
        $instance['lightbox_size'] = sanitize_text_field( $new_instance['lightbox_size'] );
        $instance['gallery_columns'] = sanitize_text_field( $new_instance['gallery_columns'] ); 
        $instance['gallery_captions'] = sanitize_text_field( $new_instance['gallery_captions'] );
        $instance['gallery_width'] = (int) $new_instance['gallery_width'];
        $instance['gallery_height'] = (int) $new_instance['gallery_height'];
        $instance['gallery_speed'] = (int) $new_instance['gallery_speed'];
        $instance['gallery_thumbs'] = sanitize_text_field( $new_instance['gallery_thumbs'] );
        $instance['gallery_auto'] = sanitize_text_field( $new_instance['gallery_auto'] );
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        return $instance;
    }

  public function form($instance){ 
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $ids = isset($instance['ids']) ? esc_attr($instance['ids']) : '';
    $gallery_width = isset($instance['gallery_width']) ? esc_attr($instance['gallery_width']) : '';
    $gallery_height = isset($instance['gallery_height']) ? esc_attr($instance['gallery_height']) : '';
    $gallery_speed = isset($instance['gallery_speed']) ? esc_attr($instance['gallery_speed']) : '';
    if (isset($instance['gallery_thumbs'])) { $gallery_thumbs = esc_attr($instance['gallery_thumbs']); } else {$gallery_thumbs = 'false';}
    if (isset($instance['gallery_type'])) { $gallery_type = esc_attr($instance['gallery_type']); } else {$gallery_type = 'standard';}
    if (isset($instance['lightbox_size'])) { $lightbox_size = esc_attr($instance['lightbox_size']); } else {$lightbox_size = 'full';}
    if (isset($instance['gallery_columns'])) { $gallery_columns = esc_attr($instance['gallery_columns']); } else {$gallery_columns = '3';}
    if (isset($instance['gallery_captions'])) { $gallery_captions = esc_attr($instance['gallery_captions']); } else {$gallery_captions = 'off';}
    if (isset($instance['gallery_auto'])) { $gallery_auto = esc_attr($instance['gallery_auto']); } else {$gallery_auto = 'true';}
    $gallery_type_array = array();
    $lightbox_size_array = array();
    $gallery_columns_array = array();
    $gallery_captions_array = array();
    $gallery_thumbs_array = array();
    $gallery_auto_array = array();
    $gallery_options = array(array("slug" => "standard", "name" => __('Standard', 'ascend')), array("slug" => "masonry", "name" => __('Masonry', 'ascend')), array("slug" => "mosaic", "name" => __('Mosaic', 'ascend')),  array("slug" => "tiles", "name" => __('Tiles', 'ascend')), array( "slug" => "carousel", "name" => __('Carousel equal ratio images', 'ascend')), array( "slug" => "slider", "name" => __('Slider', 'ascend')), array( "slug" => "imagecarousel", "name" => __('Carousel different ratio images', 'ascend')));
    $gallery_columns_options = array(array("slug" => "1", "name" => __('1 Column', 'ascend')), array("slug" => "2", "name" => __('2 Columns', 'ascend')), array("slug" => "3", "name" => __('3 Columns', 'ascend')), array("slug" => "4", "name" => __('4 Columns', 'ascend')), array("slug" => "5", "name" => __('5 Columns', 'ascend')), array("slug" => "6", "name" => __('6 Columns', 'ascend')));
    $gallery_caption_options = array(array("slug" => "off", "name" => __('Off', 'ascend')), array("slug" => "on", "name" => __('On', 'ascend')));
    $gallery_thumbs_options = array(array("slug" => "false", "name" => __('False', 'ascend')), array("slug" => "true", "name" => __('True', 'ascend')));
    $lightbox_size_options = array(array("slug" => "full", "name" => __('Full', 'ascend')), array("slug" => "large", "name" => __('Large', 'ascend')), array("slug" => "medium", "name" => __('Medium', 'ascend')), array("slug" => "thumbnail", "name" => __('Thumbnail', 'ascend')));
     foreach ($gallery_caption_options as $gallery_caption_option) {
      if ($gallery_captions == $gallery_caption_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $gallery_captions_array[] = '<option value="' . $gallery_caption_option['slug'] .'"' . $selected . '>' . $gallery_caption_option['name'] . '</option>';
    }
      foreach ($lightbox_size_options as $lightbox_size_option) {
      if ($lightbox_size == $lightbox_size_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $lightbox_size_array[] = '<option value="' . $lightbox_size_option['slug'] .'"' . $selected . '>' . $lightbox_size_option['name'] . '</option>';
    }
    foreach ($gallery_options as $gallery_option) {
      if ($gallery_type == $gallery_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $gallery_type_array[] = '<option value="' . $gallery_option['slug'] .'"' . $selected . '>' . $gallery_option['name'] . '</option>';
    }
    foreach ($gallery_thumbs_options as $g_thumbs) {
      if ($gallery_thumbs == $g_thumbs['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $gallery_thumbs_array[] = '<option value="' . $g_thumbs['slug'] .'"' . $selected . '>' . $g_thumbs['name'] . '</option>';
    }
    foreach ($gallery_thumbs_options as $g_autos) {
      if ($gallery_auto == $g_autos['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $gallery_auto_array[] = '<option value="' . $g_autos['slug'] .'"' . $selected . '>' . $g_autos['name'] . '</option>';
    }
    foreach ($gallery_columns_options as $gallery_column_option) {
      if ($gallery_columns == $gallery_column_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $gallery_columns_array[] = '<option value="' . $gallery_column_option['slug'] .'"' . $selected . '>' . $gallery_column_option['name'] . '</option>';
    }?>  

    <div id="kadence_gallery_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_widget_image_gallery">
        <div class="gallery_images">
            <?php
            $attachments = array_filter( explode( ',', $ids ) );
             if ( $attachments )
            foreach ( $attachments as $attachment_id ) {
                $img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                $imgfull = wp_get_attachment_image_src($attachment_id, 'full');
                    echo '<a class="of-uploaded-image" target="_blank" rel="external" href="' . $imgfull[0] . '">';
                    echo '<img class="gallery-widget-image" id="gallery_widget_image_'.$attachment_id. '" src="' . $img[0] . '" />';
                    echo '</a>';
                }
?>
        </div>
           <?php  echo '<a href="#" onclick="return false;" id="edit-gallery" class="gallery-attachments button button-primary">' . __('Add/Edit Gallery', 'ascend') . '</a> ';
            echo '<a href="#" onclick="return false;" id="clear-gallery" class="gallery-attachments button">' . __('Clear Gallery', 'ascend') . '</a>';
            echo '<input type="hidden" id="' . esc_attr($this->get_field_id('ids')) . '" class="gallery_values" value="' . $ids . '" name="' . esc_attr($this->get_field_name('ids')) . '" />';
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_type'); ?>"><?php _e('Gallery Type', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('gallery_type'); ?>" style="width:100%; max-width:230px" name="<?php echo $this->get_field_name('gallery_type'); ?>"><?php echo implode('', $gallery_type_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_columns'); ?>"><?php _e('Gallery Columns', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('gallery_columns'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('gallery_columns'); ?>"><?php echo implode('', $gallery_columns_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_captions'); ?>"><?php _e('Display Captions', 'ascend'); ?></label><br />
               <select id="<?php echo $this->get_field_id('gallery_captions'); ?>" style="width:100%; max-width:230px" name="<?php echo $this->get_field_name('gallery_captions'); ?>"><?php echo implode('', $gallery_captions_array);?></select>  
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('lightbox_size'); ?>"><?php _e('Lightbox Image Size', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('lightbox_size'); ?>" style="width:100%; max-width:230px" name="<?php echo $this->get_field_name('lightbox_size'); ?>"><?php echo implode('', $lightbox_size_array);?></select>
            </p>
            <p style="font-weight:bold;"><?php echo __('If Type Slider', 'ascend'); ?></p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_width'); ?>"><?php _e('Slider Width (e.g. = 600)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('gallery_width'); ?>" id="<?php echo $this->get_field_id('gallery_width'); ?>" value="<?php echo $gallery_width; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_height'); ?>"><?php _e('Slider Height (e.g. = 400)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('gallery_height'); ?>" id="<?php echo $this->get_field_id('gallery_height'); ?>" value="<?php echo $gallery_height; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_speed'); ?>"><?php _e('Slider Speed (e.g. = 7000)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('gallery_speed'); ?>" id="<?php echo $this->get_field_id('gallery_speed'); ?>" value="<?php echo $gallery_speed; ?>">
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('gallery_auto'); ?>"><?php _e('Auto Play', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('gallery_auto'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('gallery_auto'); ?>"><?php echo implode('', $gallery_auto_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gallery_thumbs'); ?>"><?php _e('Thumbnail Slider?', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('gallery_thumbs'); ?>" style="width:100%; max-width:230px" name="<?php echo $this->get_field_name('gallery_thumbs'); ?>"><?php echo implode('', $gallery_thumbs_array);?></select>
            </p>
    </div>

    <style type="text/css">.kad_widget_image_gallery {padding-bottom: 10px;}
.kad_widget_image_gallery .gallery_images:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.kad_widget_image_gallery .gallery_images {padding: 5px 5px 0; margin: 10px 0; background: #f2f2f2;}
.kad_widget_image_gallery .gallery_images img {max-width: 80px; height: auto; float: left; padding: 0 5px 5px 0}
</style>

<?php } }