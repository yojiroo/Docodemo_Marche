<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class kad_infobox_widget extends WP_Widget{

private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_infobox_widget', 'description' => __('Adds a info box with icon options', 'ascend'));
        parent::__construct('kadence_infobox_widget', __('Ascend: Info Box', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args );
        //title
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if(!empty($title)) { $title = 'title="'.$title.'"';} else {$title = '';}
        //description & link
        if(!empty($instance['description'])) { $description = $instance['description'];} else {$description = '';}
        if(!empty($instance['link'])) {$link = $instance["link"];} else {$link = '';}
        if(!empty($description)) {$description = $description;} else {$description = '';}
        if(!empty($link)) { $link = 'link='.$link; } else {$link = '';}

        if(!empty($instance['image_uri'])) {$imglink = esc_url($instance['image_uri']);} else {$imglink = '';}
        if(!empty($instance["info_icon"])) {$icon = 'icon='.$instance["info_icon"];} else {$icon = '';}
        if(!empty($instance["icon_side"])) {$iconside = 'iconside='.$instance["icon_side"];} else {$iconside = 'left';}
        if(!empty($instance["background"])) {$info_background = 'background='.$instance["background"];} else {$info_background = '';}
        if(!empty($instance["iconbackground"])) {$icon_background = 'iconbackground='.$instance["iconbackground"];} else {$icon_background = '';}
        if(!empty($instance["size"])) {$info_size = 'size='.$instance["size"];} else {$info_size = 'size=48';}
        if(!empty($instance["style"])) { $style = 'style='.$instance["style"]; } else {$style = '';}
        if(!empty($instance["color"])) { $color = 'color='.$instance["color"]; } else {$color = '';}
        if(!empty($instance["tcolor"])) { $tcolor = 'tcolor='.$instance["tcolor"]; } else {$tcolor = '';}
        if(!empty($instance["target"])) { $target = 'target='.$instance["target"]; } else {$target = '';}
        if(!empty($imglink)) {$info_icon = 'image='.$imglink;} else {$info_icon = $icon;}
        if(!empty($instance['image_id'])) {
          $alt = 'alt="'.esc_attr( get_post_meta($instance['image_id'], '_wp_attachment_image_alt', true) ).'"';
        } else {
          $alt = '';
        }

            ?>


          <?php echo $before_widget;
           echo do_shortcode('[infobox '.$link.' '.$target.' '.$info_icon.' '.$tcolor.' '.$info_size.' '.$iconside.' '.$info_background.' '.$alt.' '.$style .' '.$icon_background.' '.$color.' '.$title.']'. $description.'[/infobox]');
           echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['info_icon'] 		= sanitize_text_field($new_instance['info_icon']);
        $instance['icon_side'] 		= sanitize_text_field($new_instance['icon_side']);
        $instance['image_uri'] 		= esc_url_raw( $new_instance['image_uri'] );
        $instance['background'] 	= sanitize_text_field( $new_instance['background'] );
        $instance['iconbackground'] = sanitize_text_field($new_instance['iconbackground'] );
        $instance['color'] 			= sanitize_text_field( $new_instance['color'] );
        $instance['tcolor'] 		= sanitize_text_field( $new_instance['tcolor'] );
        $instance['size'] 			= (int) $new_instance['size']; 
        $instance['style'] 			= sanitize_text_field($new_instance['style']);
        $instance['target'] 		= sanitize_text_field($new_instance['target']);
        $instance['description'] 	= wp_kses_post($new_instance['description']);
        $instance['title'] 			= wp_kses_post($new_instance['title']);
        $instance['image_id'] 		= (int) $new_instance['image_id'];
        $instance['link'] 			= esc_url_raw( $new_instance['link']);
        return $instance;
    }

  public function form($instance){ 
    $title = isset($instance['title']) ? $instance['title'] : '';
    $link = isset($instance['link']) ? $instance['link'] : '';
    $background = isset($instance['background']) ? esc_attr($instance['background']) : '';
    $iconbackground = isset($instance['iconbackground']) ? esc_attr($instance['iconbackground']) : '';
    $color = isset($instance['color']) ? esc_attr($instance['color']) : '';
    $icon_side = isset($instance['icon_side']) ? $instance['icon_side'] : 'left';
    $tcolor = isset($instance['tcolor']) ? esc_attr($instance['tcolor']) : '';
    $size = isset($instance['size']) ? esc_attr($instance['size']) : '';
    if (isset($instance['target'])) { $target = esc_attr($instance['target']); } else {$target = '_self';}
    if (isset($instance['info_icon'])) { $info_icon = esc_attr($instance['info_icon']); } else {$info_icon = '';}
    $image_uri = isset($instance['image_uri']) ? esc_attr($instance['image_uri']) : '';
    $image_id = isset($instance['image_id']) ? esc_attr($instance['image_id']) : '';
    if (isset($instance['style'])) { $style = esc_attr($instance['style']); } else {$style = 'none';}
    $icon_style_array = array();
    $icon_array = array();
    $icon_side_array = array();
    $target_options = array(array("slug" => "_self", "name" => __('Self', 'ascend')), array("slug" => "_blank", "name" => __('New Window', 'ascend')));
    foreach ($target_options as $target_option) {
      if ($target == $target_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $target_array[] = '<option value="' . $target_option['slug'] .'"' . $selected . '>' . $target_option['name'] . '</option>';
    }
    $icon_side_options = array(array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')), array("slug" => "above", "name" => __('Above', 'ascend')));
    $icon_style_options = array(array("slug" => "none", "name" => __('None', 'ascend')), array("slug" => "kad-circle-iconclass", "name" => __('Circle', 'ascend')), array("slug" => "kad-square-iconclass", "name" => __('Square', 'ascend')));
    $icons = ascend_icon_list();
    foreach ($icons as $icon) {
      if ($info_icon == $icon) { $selected=' selected="selected"';} else { $selected=""; }
      $icon_array[] = '<option value="' . $icon .'"' . $selected . '>' . $icon . '</option>';
    }
    foreach ($icon_side_options as $icon_side_option) {
      if ($icon_side == $icon_side_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $icon_side_array[] = '<option value="' . $icon_side_option['slug'] .'"' . $selected . '>' . $icon_side_option['name'] . '</option>';
    }
    foreach ($icon_style_options as $icon_style_option) {
      if ($style == $icon_style_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $icon_style_array[] = '<option value="' . $icon_style_option['slug'] .'"' . $selected . '>' . $icon_style_option['name'] . '</option>';
    }
    ?>  

    <div id="kadence_infobox_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_img_upload_widget kadence-select-widget kad_infobox_widget">
            <p>
                <label for="<?php echo $this->get_field_id('info_icon'); ?>"><?php _e('Choose an Icon', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('info_icon'); ?>" class="kad_icomoon" name="<?php echo $this->get_field_name('info_icon'); ?>"><?php echo implode('', $icon_array);?></select>
            </p>
            <p>
            <img class="kad_custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Or upload a custom icon', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
                <input type="hidden" value="<?php echo $image_id; ?>" class="kad_custom_media_id" name="<?php echo $this->get_field_name('image_id'); ?>" id="<?php echo $this->get_field_id('image_id'); ?>" />
                <input type="button" value="<?php _e('Upload', 'ascend'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'ascend'); ?></label><br />
              <textarea name="<?php echo $this->get_field_name('description'); ?>" style="min-height: 100px;" id="<?php echo $this->get_field_id('description'); ?>" class="widefat" ><?php if(!empty($instance['description'])) echo $instance['description']; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Box Background Color (e.g. = #f2f2f2)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('background'); ?>" id="<?php echo $this->get_field_id('background'); ?>" value="<?php echo $background; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tcolor'); ?>"><?php _e('Text Color (e.g. = #444444)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('tcolor'); ?>" id="<?php echo $this->get_field_id('tcolor'); ?>" value="<?php echo $tcolor; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Icon Size (e.g. = 48)', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('size'); ?>" id="<?php echo $this->get_field_id('size'); ?>" value="<?php echo $size; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('icon_side'); ?>"><?php _e('Icon Side', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('icon_side'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('icon_side'); ?>"><?php echo implode('', $icon_side_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Icon Style', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('style'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('style'); ?>"><?php echo implode('', $icon_style_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('iconbackground'); ?>"><?php _e('Icon Background Color (e.g. = #444444)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('iconbackground'); ?>" id="<?php echo $this->get_field_id('iconbackground'); ?>" value="<?php echo $iconbackground; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Icon Color (e.g. = #f2f2f2)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" value="<?php echo $color; ?>">
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Link Target', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('target'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('target'); ?>"><?php echo implode('', $target_array);?></select>
            </p>

    </div>

<?php } }
