<?php 
/*
 * Ascend Premium Widgets 
 */

class kad_gmap_widget extends WP_Widget{

private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_gmap_widget', 'description' => __('Adds a google map to a widget area', 'ascend'));
        parent::__construct('kadence_gmap_widget', __('Ascend: Google Map', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        if(!empty($instance["location"])) {$location = $instance["location"];} else {$location = '';}
        if(!empty($instance['height'])) {$height = 'height="'.esc_attr($instance['height']).'"';} else {$height = '';}
        if(!empty($instance['title'])) {$title = 'title="'.esc_attr($instance['title']).'"';} else {$title = '';}
        if(!empty($instance['description'])) {$description = 'description="'.esc_attr($instance['description']).'"';} else {$description = '';}
        if(!empty($instance["maptype"])) {$maptype = 'maptype='.$instance["maptype"];} else {$maptype = '';}
        if(!empty($instance["zoom"])) {$zoom = 'zoom='.$instance["zoom"];} else {$zoom = '';}
            ?>


          <?php echo $before_widget;
           echo do_shortcode('[gmap address="'.$location.'" '.$height.' '.$maptype.' '.$zoom.' '.$title.' '.$description.']');
           echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['location'] = $new_instance['location'];
        $instance['title'] = $new_instance['title'];
        $instance['description'] = $new_instance['description'];
        $instance['height'] = (int) $new_instance['height'];
        $instance['maptype'] = $new_instance['maptype']; 
        $instance['zoom'] = $new_instance['zoom'];
        return $instance;
    }

  public function form($instance){
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $description = isset($instance['description']) ? esc_attr($instance['description']) : '';
    $height = isset($instance['height']) ? esc_attr($instance['height']) : '';
    if (isset($instance['zoom'])) { $zoom = esc_attr($instance['zoom']); } else {$zoom = '15';}
    if (isset($instance['maptype'])) { $maptype = esc_attr($instance['maptype']); } else {$maptype = 'ROADMAP';}
    $map_type_array = array();
    $zoom_array = array();
    $loadscripts_array = array();
	$map_type_options = array(array("slug" => "ROADMAP", "name" => __('ROADMAP', 'ascend')), array("slug" => "HYBRID", "name" => __('HYBRID', 'ascend')), array("slug" => "TERRAIN", "name" => __('TERRAIN', 'ascend')), array("slug" => "SATELLITE", "name" => __('SATELLITE', 'ascend')));
    $zoom_options = array(array("slug" => "1"), array("slug" => "2"), array("slug" => "3"), array("slug" => "4"), array("slug" => "5"), array("slug" => "6"), array("slug" => "7"), array("slug" => "8"), array("slug" => "9"), array("slug" => "10"), array("slug" => "11"), array("slug" => "12"), array("slug" => "13"), array("slug" => "14"), array("slug" => "15"), array("slug" => "16"), array("slug" => "17"), array("slug" => "18"), array("slug" => "19"), array("slug" => "20"), array("slug" => "21"));
    foreach ($zoom_options as $zoom_option) {
      if ($zoom == $zoom_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $zoom_array[] = '<option value="' . $zoom_option['slug'] .'"' . $selected . '>' . $zoom_option['slug'] . '</option>';
    }
    foreach ($map_type_options as $map_type_option) {
      if ($maptype == $map_type_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $map_type_array[] = '<option value="' . $map_type_option['slug'] .'"' . $selected . '>' . $map_type_option['name'] . '</option>';
    }
    ?>  

    <div id="kadence_gmap_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_gmap_widget">
            <p>
              <label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Address', 'ascend'); ?></label><br />
              <textarea name="<?php echo $this->get_field_name('location'); ?>" style="min-height: 50px;" id="<?php echo $this->get_field_id('location'); ?>" class="widefat" ><?php if(!empty($instance['location'])) echo $instance['location']; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('maptype'); ?>"><?php _e('Map Type', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('maptype'); ?>" name="<?php echo $this->get_field_name('maptype'); ?>"><?php echo implode('', $map_type_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Map Zoom', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('zoom'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('zoom'); ?>"><?php echo implode('', $zoom_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Map Height (e.g. = 300)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_map_widget_height" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php echo $height; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('OPTIONAL: Map overlay title', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_map_widget_title" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('OPTIONAL: Map overlay description', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_map_widget_description" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php echo $description; ?>">
            </p>
    </div>

<?php } }


class kad_imgmenu_widget extends WP_Widget{

private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_imgmenu_widget', 'description' => __('Adds an image background with text, link and hover effect.', 'ascend'));
        parent::__construct('kadence_imgmenu_widget', __('Ascend: Image Menu Item', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if(!empty($instance["subtitle"])) {$subtitle = $instance["subtitle"];} else {$subtitle = '';}
        if(!empty($instance['image_id'])) {$imageid = $instance['image_id'];} else {$imageid = '';}
        if(!empty($instance['image_uri'])) {$image_uri = $instance['image_uri'];} else {$image_uri = '';}
        if(!empty($instance["height"])) { $height = $instance["height"];} else {$height = '210';}
        if(!empty($instance["link"])) { $link = $instance["link"];} else {$link = '#';}
        if(!empty($instance["align"])) { $align = $instance["align"];} else {$align = 'left';}
        if(!empty($instance["valign"])) { $valign = $instance["valign"];} else {$valign = 'center';}
        if(!empty($instance["height_setting"])) { $type = $instance["height_setting"];} else {$type = 'normal';}
        if(!empty($instance["target"]) && $instance["target"] == 'true') { $target = '_blank';} else {$target = '_self';}
            

        	echo $before_widget; 
                echo ascend_build_image_menu( $imageid, $type, $height, $link, $target, $title, $subtitle, $align,  $valign, 'kt-img-overlay-widget', $image_uri);
            echo $after_widget;

    	}

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance['image_id'] = (int) $new_instance['image_id'];
        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['link'] = $new_instance['link'];
        $instance['align'] = $new_instance['align'];
        $instance['valign'] = $new_instance['valign'];
        $instance['height'] = (int) $new_instance['height'];
        $instance['target'] = $new_instance['target'];
        $instance['height_setting'] = $new_instance['height_setting'];
        return $instance;
    }
  public function form($instance){ 
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $link = isset($instance['link']) ? esc_attr($instance['link']) : '';
    $height = isset($instance['height']) ? esc_attr($instance['height']) : '';
    $image_uri = isset($instance['image_uri']) ? esc_attr($instance['image_uri']) : '';
    $image_id = isset($instance['image_id']) ? esc_attr($instance['image_id']) : '';
    if (isset($instance['target'])) { $target = esc_attr($instance['target']); } else {$target = 'false';}
    if (isset($instance['align'])) { $align = esc_attr($instance['align']); } else {$align = 'left';}
    if (isset($instance['valign'])) { $valign = esc_attr($instance['valign']); } else {$valign = 'center';}
    if (isset($instance['height_setting'])) { $height_setting = esc_attr($instance['height_setting']); } else {$height_setting = 'normal';}
    $align_options = array(array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "center", "name" => __('Center', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')));

     $valign_options = array(array("slug" => "top", "name" => __('Top', 'ascend')), array("slug" => "center", "name" => __('Center', 'ascend')), array("slug" => "bottom", "name" => __('Bottom', 'ascend')));


    $height_options = array(array("slug" => "normal", "name" => __('Height setting Above', 'ascend')), array("slug" => "image_height", "name" => __('Image Size', 'ascend')));
    $target_options = array(array("slug" => "false", "name" => __('Self', 'ascend')), array("slug" => "true", "name" => __('New Window', 'ascend')));
    foreach ($target_options as $target_option) {
      if ($target == $target_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $target_array[] = '<option value="' . $target_option['slug'] .'"' . $selected . '>' . $target_option['name'] . '</option>';
    }
    foreach ($height_options as $height_option) {
      if ($height_setting == $height_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $height_array[] = '<option value="' . $height_option['slug'] .'"' . $selected . '>' . $height_option['name'] . '</option>';
    }
    foreach ($align_options as $align_option) {
      if ($align == $align_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $align_array[] = '<option value="' . $align_option['slug'] .'"' . $selected . '>' . $align_option['name'] . '</option>';
    }
    foreach ($valign_options as $valign_option) {
      if ($valign == $valign_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $valign_array[] = '<option value="' . $valign_option['slug'] .'"' . $selected . '>' . $valign_option['name'] . '</option>';
    }
    ?>  

    <div id="kadence_imgmenu_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_img_upload_widget kad_infobox_widget">
            <p>
            <img class="kad_custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Upload an image', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
                <input type="hidden" class="widefat kad_custom_media_id" name="<?php echo $this->get_field_name('image_id'); ?>" id="<?php echo $this->get_field_id('image_id'); ?>" value="<?php echo esc_attr($image_id); ?>">
                <input type="button" value="<?php _e('Upload', 'ascend'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Item Height (e.g. = 220)', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" style="width: 70px;" value="<?php echo $height; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('height_setting'); ?>"><?php _e('Height set by:', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('height_setting'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('height_setting'); ?>"><?php echo implode('', $height_array);?></select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', 'ascend'); ?></label><br />
              <textarea name="<?php echo $this->get_field_name('subtitle'); ?>" style="min-height: 20px;" id="<?php echo $this->get_field_id('subtitle'); ?>" class="widefat" ><?php if(!empty($instance['subtitle'])) echo esc_textarea($instance['subtitle']); ?></textarea>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Link Target', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('target'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('target'); ?>"><?php echo implode('', $target_array);?></select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Text Align', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('align'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('align'); ?>"><?php echo implode('', $align_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('valign'); ?>"><?php _e('Vertically Text Align', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('valign'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('valign'); ?>"><?php echo implode('', $valign_array);?></select>
            </p>

    </div>

<?php } }

class kad_icon_flip_box_widget extends WP_Widget{
private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_icon_flip_box_widget', 'description' => __('Adds a box that flips to show more content.', 'ascend'));
        parent::__construct('kadence_icon_flip_box_widget', __('Ascend: Icon Flip Box', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        if(!empty($instance["title"])) {$title = 'title="'.$instance["title"].'"';} else {$title = '';}
        if(!empty($instance["description"])) {$description = 'description="'.$instance["description"].'"';} else {$description = '';}
        if(!empty($instance['icon'])) {$icon = 'icon="'.$instance['icon'].'"';} else {$icon = '';}
        if(!empty($instance['iconcolor'])) {$iconcolor = 'iconcolor="'.$instance['iconcolor'].'"';} else {$iconcolor = '';}
        if(!empty($instance['titlecolor'])) {$titlecolor = 'titlecolor="'.$instance['titlecolor'].'"';} else {$titlecolor = '';}
        if(!empty($instance['fcolor'])) {$fcolor = 'fcolor="'.$instance['fcolor'].'"';} else {$fcolor = '';}
        if(!empty($instance['titlesize'])) {$titlesize = 'titlesize="'.$instance['titlesize'].'px"';} else {$titlesize = '';}
        if(!empty($instance['image'])) {$image = 'image="'.$instance['image'].'"';} else {$image = '';}
        if(!empty($instance['height'])) {$height = 'height="'.$instance['height'].'px"';} else {$height = '';}
        if(!empty($instance["iconsize"])) { $iconsize = 'iconsize="'.$instance["iconsize"].'px" ';} else {$iconsize = '';}
        if(!empty($instance["flip_content"])) { $flip_content = 'flip_content="'.$instance["flip_content"].'" ';} else {$flip_content = '';}
        if(!empty($instance["fbtn_text"])) { $fbtn_text = 'fbtn_text="'.$instance["fbtn_text"].'" ';} else {$fbtn_text = '';}
        if(!empty($instance["fbtn_link"])) { $fbtn_link = 'fbtn_link="'.$instance["fbtn_link"].'" ';} else {$fbtn_link = '';}
        if(!empty($instance["fbtn_color"])) { $fbtn_color = 'fbtn_color="'.$instance["fbtn_color"].'"';} else {$fbtn_color = '';}
        if(!empty($instance["fbtn_icon"])) { $fbtn_icon = 'fbtn_icon="'.$instance["fbtn_icon"].'"';} else {$fbtn_icon = '';}
        if(!empty($instance["fbtn_background"])) { $fbtn_background = 'fbtn_background="'.$instance["fbtn_background"].'"';} else {$fbtn_background = '';}
        if(!empty($instance["fbtn_border"])) { $fbtn_border = 'fbtn_border="'.$instance["fbtn_border"].'"';} else {$fbtn_border = '';}
        if(!empty($instance["fbtn_border_radius"])) { $fbtn_border_radius = 'fbtn_border_radius="'.$instance["fbtn_border_radius"].'px"';} else {$fbtn_border_radius = '';}
        if(!empty($instance["background"])) { $background = 'background="'.$instance["background"].'"';} else {$background = '';}
        if(!empty($instance["border"])) { $border = 'border="'.$instance["border"].'"';} else {$border = '';}
        if(!empty($instance["bcolor"])) { $bcolor = 'bcolor="'.$instance["bcolor"].'"';} else {$bcolor = '';}
        if(!empty($instance["bbackground"])) { $bbackground = 'bbackground="'.$instance["bbackground"].'"';} else {$bbackground = '';}
        if(!empty($instance["fbtn_target"])) { $fbtn_target = 'fbtn_target="'.$instance["fbtn_target"].'"';} else {$fbtn_target = '';}
            ?>

                <?php echo $before_widget; ?>
                <?php $output = '[kt_flip_box '.$icon.' '.$height.' '.$iconsize.' '.$iconcolor.' '.$titlecolor.' '.$fcolor.' '.$title.' '.$description.' '.$titlesize.' '.$image.' '.$flip_content.' '.$fbtn_text.' '.$fbtn_color.' '.$fbtn_icon.' '.$fbtn_background.' '.$fbtn_border.' '.$fbtn_border_radius.' '.$background.' '.$border.' '.$bcolor.' '.$bbackground.' '.$fbtn_target.' '.$fbtn_link.']';
                echo do_shortcode($output); ?>

                <?php echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['description'] = $new_instance['description'];
        $instance['icon'] = $new_instance['icon'];
        $instance['iconcolor'] = $new_instance['iconcolor'];
        $instance['titlecolor'] = $new_instance['titlecolor'];
        $instance['fcolor'] = $new_instance['fcolor'];
        $instance['image'] = $new_instance['image'];
        $instance['flip_content'] = $new_instance['flip_content'];
        $instance['fbtn_text'] = $new_instance['fbtn_text'];

        $instance['fbtn_link'] = $new_instance['fbtn_link'];
        $instance['fbtn_color'] = $new_instance['fbtn_color'];
        $instance['fbtn_icon'] = $new_instance['fbtn_icon'];
        $instance['fbtn_background'] = $new_instance['fbtn_background'];
        $instance['fbtn_border'] = $new_instance['fbtn_border'];
        $instance['background'] = $new_instance['background'];
        $instance['border'] = $new_instance['border'];
        $instance['bcolor'] = $new_instance['bcolor'];
        $instance['bbackground'] = $new_instance['bbackground'];
        $instance['fbtn_target'] = $new_instance['fbtn_target'];

        $instance['height'] = (int) $new_instance['height'];
        $instance['titlesize'] = (int) $new_instance['titlesize'];
        $instance['iconsize'] = (int) $new_instance['iconsize'];
        $instance['fbtn_border_radius'] = (int) $new_instance['fbtn_border_radius'];

        return $instance;
    }

  public function form($instance){ 
    $title = isset($instance['title']) ? $instance['title'] : '';
    $description = isset($instance['description']) ? $instance['description'] : '';
    $icon = isset($instance['icon']) ? $instance['icon'] : '';
    $iconcolor = isset($instance['iconcolor']) ? $instance['iconcolor'] : '';
    $titlecolor = isset($instance['titlecolor']) ? $instance['titlecolor'] : '';
    $fcolor = isset($instance['fcolor']) ? $instance['fcolor'] : '';
    $image = isset($instance['image']) ? $instance['image'] : '';
    $flip_content = isset($instance['flip_content']) ? $instance['flip_content'] : '';
    $fbtn_text = isset($instance['fbtn_text']) ? $instance['fbtn_text'] : '';
    $fbtn_color = isset($instance['fbtn_color']) ? $instance['fbtn_color'] : '';
    $fbtn_border = isset($instance['fbtn_border']) ? $instance['fbtn_border'] : '2px solid #ffffff';
    $fbtn_icon = isset($instance['fbtn_icon']) ? $instance['fbtn_icon'] : '';
    $fbtn_background = isset($instance['fbtn_background']) ? $instance['fbtn_background'] : '';
    $background = isset($instance['background']) ? $instance['background'] : '';
    $border = isset($instance['border']) ? $instance['border'] : '';
    $bcolor = isset($instance['bcolor']) ? $instance['bcolor'] : '';
    $bbackground = isset($instance['bbackground']) ? $instance['bbackground'] : '';
    $iconsize = isset($instance['iconsize']) ? $instance['iconsize'] : '48';
    $titlesize = isset( $instance['titlesize'] ) ? $instance['titlesize'] : '24';
    $height = isset( $instance['height'] ) ? $instance['height'] : '';
    $fbtn_border_radius = isset( $instance['fbtn_border_radius'] ) ? $instance['fbtn_border_radius'] : '0';
   
    $image = isset($instance['image']) ? esc_url($instance['image']) : '';
    $fbtn_link = isset($instance['fbtn_link']) ? esc_url($instance['fbtn_link']) : '';
    $fbtn_target = isset($instance['fbtn_target']) ? esc_attr($instance['fbtn_target']) : '_self';
    $target_options = array(array("slug" => "_self", "name" => __('Self', 'ascend')), array("slug" => "_blank", "name" => __('New Window', 'ascend')));
    foreach ($target_options as $target_option) {
      if ($fbtn_target == $target_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $target_array[] = '<option value="' . $target_option['slug'] .'"' . $selected . '>' . $target_option['name'] . '</option>';
    }
    $icons = ascend_icon_list();
    foreach ($icons as $ico) {
      if ($icon == $ico) { $selected=' selected="selected"';} else { $selected=""; }
      $icon_array[] = '<option value="' . $ico .'"' . $selected . '>' . $ico . '</option>';
    }
    $icon_btn_array[] = '<option value="">' . __('None', 'ascend') . '</option>';
    foreach ($icons as $ico) {
      if ($fbtn_icon == $ico) { $selected=' selected="selected"';} else { $selected=""; }
      $icon_btn_array[] = '<option value="' . $ico .'"' . $selected . '>' . $ico . '</option>';
    }
    ?>  

    <div id="kadence_icon_flip_box_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_img_upload_widget kadence-select-widget kad_iconflip_widget">
            <h4><?php _e('Front Side', 'ascend');?></h4>
            <p>
                <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Choose an Icon', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('icon'); ?>" class="kad_icomoon" name="<?php echo $this->get_field_name('icon'); ?>"><?php echo implode('', $icon_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('iconsize'); ?>"><?php _e('Icon Size', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('iconsize'); ?>" id="<?php echo $this->get_field_id('iconsize'); ?>" style="width: 70px;" value="<?php echo $iconsize; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('iconcolor'); ?>"><?php _e('Icon Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('iconcolor'); ?>" id="<?php echo $this->get_field_id('iconcolor'); ?>" style="width: 70px;" value="<?php echo $iconcolor; ?>">
            </p>
            <p>
            <img class="kad_custom_media_image" src="<?php if(!empty($instance['image'])){echo $instance['image'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Optional Image instead of icon', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $image; ?>">
                <input type="button" value="<?php _e('Upload', 'ascend'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('titlesize'); ?>"><?php _e('Title Size', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('titlesize'); ?>" id="<?php echo $this->get_field_id('titlesize'); ?>" style="width: 70px;" value="<?php echo $titlesize; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('titlecolor'); ?>"><?php _e('Title Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('titlecolor'); ?>" id="<?php echo $this->get_field_id('titlecolor'); ?>" style="width: 70px;" value="<?php echo $titlecolor; ?>">
            </p>
           <p>
              <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'ascend'); ?></label><br />
              <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" ><?php echo esc_textarea( $description ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fcolor'); ?>"><?php _e('Description Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('fcolor'); ?>" id="<?php echo $this->get_field_id('fcolor'); ?>" style="width: 70px;" value="<?php echo $fcolor; ?>">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Front Side Background', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('background'); ?>" id="<?php echo $this->get_field_id('background'); ?>" style="width: 70px;" value="<?php echo $background; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('border'); ?>"><?php _e('Front Side Border (example: 2px solid #eeeeee)', 'ascend'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('border'); ?>" name="<?php echo $this->get_field_name('border'); ?>" type="text" value="<?php echo $border; ?>" />
            </p>
            <h4><?php _e('Back Side', 'ascend');?></h4>
            <p>
              <label for="<?php echo $this->get_field_id('flip_content'); ?>"><?php _e('Back Side Description', 'ascend'); ?></label><br />
              <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('flip_content'); ?>" name="<?php echo $this->get_field_name('flip_content'); ?>" ><?php echo esc_textarea( $flip_content ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('bcolor'); ?>"><?php _e('Back Side Description Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('bcolor'); ?>" id="<?php echo $this->get_field_id('bcolor'); ?>" style="width: 70px;" value="<?php echo $bcolor; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_text'); ?>"><?php _e('Button Text', 'ascend'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('fbtn_text'); ?>" name="<?php echo $this->get_field_name('fbtn_text'); ?>" type="text" value="<?php echo $fbtn_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_link'); ?>"><?php _e('Button Link', 'ascend'); ?></label><br />
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('fbtn_link'); ?>" id="<?php echo $this->get_field_id('fbtn_link'); ?>"value="<?php echo $fbtn_link; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_color'); ?>"><?php _e('Button Text Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('fbtn_color'); ?>" id="<?php echo $this->get_field_id('fbtn_color'); ?>" style="width: 70px;" value="<?php echo $fbtn_color; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_background'); ?>"><?php _e('Button Background Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('fbtn_background'); ?>" id="<?php echo $this->get_field_id('fbtn_background'); ?>" style="width: 70px;" value="<?php echo $fbtn_background; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_border'); ?>"><?php _e('Button Border (example: 2px solid #ffffff)', 'ascend'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('fbtn_border'); ?>" name="<?php echo $this->get_field_name('fbtn_border'); ?>" type="text" value="<?php echo $fbtn_border; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_border_radius'); ?>"><?php _e('Button Border Radius (example: 6)', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('fbtn_border_radius'); ?>" id="<?php echo $this->get_field_id('fbtn_border_radius'); ?>" style="width: 70px;" value="<?php echo $fbtn_border_radius; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fbtn_icon'); ?>"><?php _e('Button Icon (optional)', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('fbtn_icon'); ?>" class="kad_icomoon" name="<?php echo $this->get_field_name('fbtn_icon'); ?>"><?php echo implode('', $icon_btn_array);?></select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('fbtn_target'); ?>"><?php _e('Button Link Target', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('fbtn_target'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('fbtn_target'); ?>"><?php echo implode('', $target_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('bbackground'); ?>"><?php _e('Back Side Background', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('bbackground'); ?>" id="<?php echo $this->get_field_id('bbackground'); ?>" style="width: 70px;" value="<?php echo $bbackground; ?>">
            </p>


            <h4><?php _e('Box Height', 'ascend');?></h4>
            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height (example: 280)', 'ascend'); ?></label><br />
                <input type="number" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" style="width: 70px;" value="<?php echo $height; ?>">
            </p>
    </div>

<?php } }
class kad_payment_methods_widget extends WP_Widget{
private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_payment_method_widget', 'description' => __('Adds icons for avaibile payment methods', 'ascend'));
        parent::__construct('kadence_payment_method_widget', __('Ascend: Payment Method Icons', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        if(!empty($instance["title"])) {$title = $instance["title"];} else {$title = '';}
        if(!empty($instance['color'])) {$color = 'color="'.$instance['color'].'"';} else {$color = '';}
        if(!empty($instance['visa'])) {$visa = 'visa="'.$instance['visa'].'"';} else {$visa = '';}
        if(!empty($instance['mastercard'])) {$mastercard = 'mastercard="'.$instance['mastercard'].'"';} else {$mastercard = '';}
        if(!empty($instance['amex'])) {$amex = 'amex="'.$instance['amex'].'"';} else {$amex = '';}
        if(!empty($instance['discover'])) {$discover = 'discover="'.$instance['discover'].'"';} else {$discover = '';}
        if(!empty($instance['paypal'])) {$paypal = 'paypal="'.$instance['paypal'].'"';} else {$paypal = '';}
        if(!empty($instance["stripe"])) { $stripe = 'stripe="'.$instance["stripe"].'" ';} else {$stripe = '';}
        if(!empty($instance["jcb"])) { $jcb = 'jcb="'.$instance["jcb"].'" ';} else {$jcb = '';}
            ?>

                <?php echo $before_widget; 
                if ( $title ) echo $before_title . $title . $after_title; 
                $output = '[kt_payment_methods '.$color.' '.$visa.' '.$mastercard.' '.$amex.' '.$discover.' '.$paypal.' '.$stripe.' '.$jcb.']';
                echo do_shortcode($output); 

                echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['color'] = $new_instance['color'];
        $instance['visa'] = $new_instance['visa'];
        $instance['mastercard'] = $new_instance['mastercard'];
        $instance['amex'] = $new_instance['amex'];
        $instance['discover'] = $new_instance['discover'];
        $instance['paypal'] = $new_instance['paypal'];
        $instance['stripe'] = $new_instance['stripe'];
        $instance['jcb'] = $new_instance['jcb'];

        return $instance;
    }

  public function form($instance){ 
    $title 			= isset($instance['title']) ? $instance['title'] : '';
    $color 			= isset($instance['color']) ? $instance['color'] : '';
    $visa 			= isset($instance['visa']) ? $instance['visa'] : 'false';
    $mastercard 	= isset($instance['mastercard']) ? $instance['mastercard'] : 'false';
    $amex 			= isset( $instance['amex'] ) ? $instance['amex'] : 'false';
    $discover 		= isset( $instance['discover'] ) ? $instance['discover'] : 'false';
    $paypal 		= isset( $instance['paypal'] ) ? $instance['paypal'] : 'false';
    $stripe 		= isset( $instance['stripe'] ) ? $instance['stripe'] : 'false';
    $jcb 			= isset( $instance['jcb'] ) ? $instance['jcb'] : 'false';

   	$visa_array = array();
   	$mastercard_array = array();
   	$amex_array = array();
   	$discover_array = array();
   	$paypal_array = array();
   	$stripe_array = array();
   	$jcb_array = array();
    $card_options = array(array("slug" => "false", "name" => __('False', 'ascend')), array("slug" => "true", "name" => __('True', 'ascend')));
    foreach ($card_options as $card_option) {
      	if ($visa == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$visa_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($mastercard == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$mastercard_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($amex == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$amex_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($discover == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$discover_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($paypal == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$paypal_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($stripe == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$stripe_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    foreach ($card_options as $card_option) {
      	if ($jcb == $card_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$jcb_array[] = '<option value="' . $card_option['slug'] .'"' . $selected . '>' . $card_option['name'] . '</option>';
    }
    ?>  

    <div id="kadence_payment_methods_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kadence_payment_methods">
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Payment Icon Color', 'ascend'); ?></label><br />
                <input type="text" class="kad-widget-colorpicker" name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" style="width: 70px;" value="<?php echo $color; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('visa'); ?>"><?php _e('Visa', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('visa'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('visa'); ?>"><?php echo implode('', $visa_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('mastercard'); ?>"><?php _e('Mastercard', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('mastercard'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('mastercard'); ?>"><?php echo implode('', $mastercard_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('amex'); ?>"><?php _e('American Express', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('amex'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('amex'); ?>"><?php echo implode('', $amex_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('discover'); ?>"><?php _e('Discover', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('discover'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('discover'); ?>"><?php echo implode('', $discover_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('paypal'); ?>"><?php _e('Paypal', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('paypal'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('paypal'); ?>"><?php echo implode('', $paypal_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('stripe'); ?>"><?php _e('Stripe', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('stripe'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('stripe'); ?>"><?php echo implode('', $stripe_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('jcb'); ?>"><?php _e('JCB', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('jcb'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('jcb'); ?>"><?php echo implode('', $jcb_array);?></select>
            </p>
    </div>

<?php } }