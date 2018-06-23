<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/*
 * Ascend Split content widget.
 */
class kad_split_content_widget extends WP_Widget{
private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_split_content_widget', 'description' => __('Adds an column with an image beside a content field.', 'ascend'));
        parent::__construct('kadence_split_content_widget', __('Ascend: Split Content', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        if(!empty($instance["title"])) {$title = $instance["title"];} else {$title = '';}
        if(!empty($instance["description"])) {$description = $instance["description"];} else {$description = '';}
        if(!empty($instance["description_max_width"])) {$description_max_width = 'description_max_width="'.$instance["description_max_width"].'" ';} else {$description_max_width = '';}
        if(!empty($instance["description_align"])) { $description_align = 'description_align="'.$instance["description_align"].'" ';} else {$description_align = '';}
        if(!empty($instance['image_url'])) {$image = esc_url($instance['image_url']);} else {$image = '';}
        if(!empty($instance['image_id'])) {$image_id = 'image_id="'.$instance['image_id'].'" ';} else {$image_id = '';}
        if(!empty($instance["img_link"])) { $img_link = 'image_link="'.$instance["img_link"].'" ';} else {$img_link = '';}
        if(!empty($instance["img_align"])) { $img_align = 'imageside="'.$instance["img_align"].'" ';} else {$img_align = '';}
        if(!empty($instance['img_background_color'])) {$img_background_color = 'img_background="'.$instance['img_background_color'].'" ';} else {$img_background_color = '';}
        if(!empty($instance['content_background_color'])) {$content_background_color = 'content_background="'.$instance['content_background_color'].'" ';} else {$content_background_color = '';}
        if(!empty($instance['content_text_color'])) {$content_text_color = 'text_color="'.$instance['content_text_color'].'"'; $text_color = 'color:'.$instance['content_text_color'].';';} else {$content_text_color = ''; $text_color = '';}
        if(!empty($instance["height"])) { $height = $instance["height"];} else {$height = '500';}
        if(!empty($instance["btn_text"])) { $btn_text = $instance["btn_text"];} else {$btn_text = '';}
        if(!empty($instance["btn_link"])) { $btn_link = $instance["btn_link"];} else {$btn_link = '#';}
        if(!empty($instance["link_target"])) { $linktarget = 'link_target="'.$instance["link_target"].'"'; $btntarget = 'target="'.$instance["link_target"].'"';} else {$linktarget = ''; $$btntarget = '';}
        if(!empty($instance['filter'])){ $description = wpautop( $description );} else {$description = $description;}
        if(!empty($instance['img_cover'])){ $cover = 'image_cover="true" ';} else {$cover = '';}
            ?>

                <?php echo $before_widget; ?>
                <?php $output = '[kt_imgsplit image="'.esc_attr($image).'" height="'.$height.'" '.$img_align.' '.$cover.' '.$img_background_color.' '.$img_link.' '.$linktarget.' '.$content_background_color .' '.$content_text_color .' '.$description_max_width.' '.$image_id.' id="'.$args['widget_id'].'" '.$description_align.']';
                if(!empty($title)) { $output .= '<h2 class="kt_imgsplit_title" style="'.esc_attr($text_color).'">'.$title.'</h2>';}
                if(!empty($description)) {$output .= '<div class="kt_imgsplit_content" style="'.esc_attr($text_color).'">'.$description.'</div>';}
                if(!empty($btn_text)) {$output .= '<a href="'.$btn_link.'" '.$btntarget.' class="kt_imgsplit_btn btn">'.$btn_text.'</a>';}
                $output .= '[/kt_imgsplit]'; 
                echo do_shortcode($output); ?>

                <?php echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['image_url'] = strip_tags( $new_instance['image_url'] );
        $instance['image_id'] = (int) $new_instance['image_id'];
        $instance['description'] = wp_kses_post($new_instance['description']);
        $instance['description_max_width'] = $new_instance['description_max_width'];
        $instance['description_align'] = $new_instance['description_align'];
        $instance['title'] = $new_instance['title'];
        $instance['btn_link'] = $new_instance['btn_link'];
        $instance['btn_text'] = $new_instance['btn_text'];
        $instance['img_link'] = $new_instance['img_link'];
        $instance['height'] = (int) $new_instance['height'];
        $instance['link_target'] = $new_instance['link_target'];
        $instance['img_align'] = $new_instance['img_align'];
        $instance['filter'] = ! empty( $new_instance['filter'] );
        $instance['img_cover'] = ! empty( $new_instance['img_cover'] );
        $instance['img_background_color'] = $new_instance['img_background_color'];
        $instance['content_background_color'] = $new_instance['content_background_color'];
        $instance['content_text_color'] = $new_instance['content_text_color'];

        return $instance;
    }

  public function form($instance){ 
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $description = isset($instance['description']) ? $instance['description'] : '';
    $description_max_width = isset($instance['description_max_width']) ? $instance['description_max_width'] : '';
    $description_align = isset($instance['description_align']) ? esc_attr($instance['description_align']) : 'default';
    $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
    $btn_text = isset($instance['btn_text']) ? esc_attr($instance['btn_text']) : '';
    $btn_link = isset($instance['btn_link']) ? esc_attr($instance['btn_link']) : '';
    $img_link = isset($instance['img_link']) ? esc_attr($instance['img_link']) : '';
    $height = isset($instance['height']) ? esc_attr($instance['height']) : '500';
    $cover = isset( $instance['img_cover'] ) ? $instance['img_cover'] : 0;
    $image_url = isset($instance['image_url']) ? esc_attr($instance['image_url']) : '';
    $image_id = isset($instance['image_id']) ? esc_attr($instance['image_id']) : '';
    $img_background_color = isset($instance['img_background_color']) ? esc_attr($instance['img_background_color']) : '';
    $content_background_color = isset($instance['content_background_color']) ? esc_attr($instance['content_background_color']) : '';
    $content_text_color = isset($instance['content_text_color']) ? esc_attr($instance['content_text_color']) : '';
    $img_align = isset($instance['img_align']) ? esc_attr($instance['img_align']) : 'left';
    $link_target = isset($instance['link_target']) ? esc_attr($instance['link_target']) : '_self';
    $target_options = array(array("slug" => "_self", "name" => __('Self', 'ascend')), array("slug" => "_blank", "name" => __('New Window', 'ascend')));
    $align_options = array(array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')));
    $text_align_options = array(array("slug" => "default", "name" => __('Default', 'ascend')), array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')), array("slug" => "center", "name" => __('Center', 'ascend')), array("slug" => "justify", "name" => __('Justify', 'ascend')));
    foreach ($target_options as $target_option) {
      if ($link_target == $target_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $target_array[] = '<option value="' . $target_option['slug'] .'"' . $selected . '>' . $target_option['name'] . '</option>';
    }
    foreach ($align_options as $align_option) {
      if ($img_align == $align_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $align_array[] = '<option value="' . $align_option['slug'] .'"' . $selected . '>' . $align_option['name'] . '</option>';
    }
     foreach ($text_align_options as $talign_option) {
      if ($description_align == $talign_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $talign_array[] = '<option value="' . $talign_option['slug'] .'"' . $selected . '>' . $talign_option['name'] . '</option>';
    }
    ?>  

    <div id="<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_img_upload_widget kad_infobox_widget">
            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" style="width: 70px;" value="<?php echo esc_attr($height); ?>">
            </p>
            <h4><?php _e('Image content', 'ascend');?></h4>
            <p>
            <img class="kad_custom_media_image" src="<?php if(!empty($instance['image_url'])){echo $instance['image_url'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Upload an image', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image_url'); ?>" id="<?php echo $this->get_field_id('image_url'); ?>" value="<?php echo esc_attr($image_url); ?>">
                <input type="hidden" class="widefat kad_custom_media_id" name="<?php echo $this->get_field_name('image_id'); ?>" id="<?php echo $this->get_field_id('image_id'); ?>" value="<?php echo esc_attr($image_id); ?>">
                <input type="button" value="<?php _e('Upload', 'ascend'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
            </p>
            <p><input id="<?php echo $this->get_field_id('img_cover'); ?>" name="<?php echo $this->get_field_name('img_cover'); ?>" type="checkbox"<?php checked( $cover ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('img_cover'); ?>"><?php _e('Force image to cover whole area', 'ascend'); ?></label></p>
           
            <p>
                <label for="<?php echo $this->get_field_id('img_link'); ?>"><?php _e('Image Link (optional)', 'ascend'); ?></label><br />
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('img_link'); ?>" id="<?php echo $this->get_field_id('img_link'); ?>"value="<?php echo esc_attr($img_link); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('img_background_color'); ?>"><?php _e('Image Background Color (optional)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" name="<?php echo $this->get_field_name('img_background_color'); ?>" id="<?php echo $this->get_field_id('img_background_color'); ?>" value="<?php echo $img_background_color; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('img_align'); ?>"><?php _e('Image align:', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('img_align'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('img_align'); ?>"><?php echo implode('', $align_array);?></select>
            </p>
            <h4><?php _e('Text content', 'ascend');?></h4>
            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
             <p>
              <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php _e('Description', 'ascend'); ?></label>
              	<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" ><?php echo wp_kses_post( $description ); ?></textarea>
              </p>
            <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'ascend'); ?></label></p>
             <p>
                <label for="<?php echo $this->get_field_id('description_max_width'); ?>"><?php _e('Text max width', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('description_max_width'); ?>" id="<?php echo $this->get_field_id('description_max_width'); ?>" style="width: 70px;" value="<?php echo $description_max_width; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('description_align'); ?>"><?php _e('Text align:', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('description_align'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('description_align'); ?>"><?php echo implode('', $talign_array);?></select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php _e('Button Text (optional)', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo $btn_text; ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('btn_link'); ?>"><?php _e('Button Link (optional)', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('btn_link'); ?>" name="<?php echo $this->get_field_name('btn_link'); ?>" type="text" value="<?php echo $btn_link; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('link_target'); ?>"><?php _e('Link link_Target (optional)', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('link_target'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('link_target'); ?>"><?php echo implode('', $target_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('content_background_color'); ?>"><?php _e('Text Content Background Color (optional)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" name="<?php echo $this->get_field_name('content_background_color'); ?>" id="<?php echo $this->get_field_id('content_background_color'); ?>" value="<?php echo $content_background_color; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('content_text_color'); ?>"><?php _e('Text Content Color (optional)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad-widget-colorpicker" name="<?php echo $this->get_field_name('content_text_color'); ?>" id="<?php echo $this->get_field_id('content_text_color'); ?>" value="<?php echo $content_text_color; ?>">
            </p>

    </div>

<?php } }