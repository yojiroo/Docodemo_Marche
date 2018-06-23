<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Kadence Testimonial_slider widget class
 * 
 */
class kad_testimonial_slider_widget extends WP_Widget {

  private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_testimonials_slider', 'description' => __('This shows a slider with your testimonials', 'ascend'));
      parent::__construct('kadence_testimonials_slider', __('Ascend: Testimonial Carousel', 'ascend'), $widget_ops);
  }

  public function widget($args, $instance) {


    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    extract($args);
    $carousel_rn = $args['widget_id'];
    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ){ $number = 10;}
    if(isset($instance['orderby'])) {$testorder = $instance['orderby'];} else {$testorder = 'rand';}
    if(isset($instance['columns'])) {$columns = $instance['columns'];} else {$columns = '1';}
    if(!empty($instance['speed'])) {$speed = $instance['speed'];} else {$speed = '9000';}
    if(!empty($instance['link'])) {$link = $instance['link'];} else {$link = 'false';}
    if(!empty($instance['autoplay'])) {$autoplay = $instance['autoplay'];} else {$autoplay = 'true';}
    if(!empty($instance['arrows'])) {$arrows = $instance['arrows'];} else {$arrows = 'true';}
    if(!empty($instance['pagination'])) {$pagination = $instance['pagination'];} else {$pagination = 'false';}
    if(!empty($instance['group'])) {$group = $instance['group'];} else {$group = '';}
    if(!empty($instance['content'])) {$content = $instance['content'];} else {$content = 'excerpt';}
    if(empty($instance['scroll']) || $instance['scroll'] == 1) {$scroll = '1';} else {$scroll = 'all';}
	global $kt_testimonial_loop;
	$kt_testimonial_loop = array(
		'columns' 	=> $columns,
	 	'content' 	=> $content,
	 	'link' 		=> $link,
 	);
   	$tc = array();
    if ($columns == '4') {
        $tc = ascend_carousel_columns('4');
    } else if($columns == '1') {
        $tc = ascend_carousel_columns('1');
    } else if($columns == '5') {
        $tc = ascend_carousel_columns('5');
    } else if($columns == '6') {
        $tc = ascend_carousel_columns('6');
    } else if($columns == '2') {
        $tc = ascend_carousel_columns('2');
    } else {
        $tc = ascend_carousel_columns('3');
    } 
    $r = new WP_Query( array( 
	    'post_type' 			=> 'testimonial', 
	    'testimonial-group' 	=> $group, 
	    'no_found_rows' 		=> true, 
	    'posts_per_page'		=> $number,
	    'orderby' 				=> $testorder, 
	    'post_status' 			=> 'publish', 
	    'ignore_sticky_posts'	=> true 
	    ) 
    );
    if ($r->have_posts()) :
	
	echo $before_widget; 
    if ( $title ) echo $before_title . $title . $after_title; ?>
          <div id="carouselcontainer-<?php echo esc_attr($carousel_rn);?>" class="row testimonial-widget-carousel-outer">
          	<div id="testimonial-widget-carousel-<?php echo esc_attr($carousel_rn);?>" class="slick-slider kt_testimonial_carousel kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-dots="<?php echo esc_attr($pagination);?>" data-slider-arrows="<?php echo esc_attr($arrows);?>"  data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="<?php echo esc_attr($scroll);?>" data-slider-auto="<?php echo esc_attr($autoplay);?>" data-slider-speed="<?php echo esc_attr($speed);?>" data-slider-xxl="<?php echo esc_attr($tc['xxl']);?>" data-slider-xl="<?php echo esc_attr($tc['xl']);?>" data-slider-md="<?php echo esc_attr($tc['md']);?>" data-slider-sm="<?php echo esc_attr($tc['sm']);?>" data-slider-xs="<?php echo esc_attr($tc['xs']);?>" data-slider-ss="<?php echo esc_attr($tc['ss']);?>">
            <?php 
            while ($r->have_posts()) : $r->the_post(); 
            	get_template_part('templates/content', 'loop-testimonial'); 
      		endwhile; ?>
        </div>
      </div>
      
    <?php echo $after_widget; ?>
<?php
    // Reset the global $the_post as this query will have stomped on it
    wp_reset_postdata();

    endif;

  }

  public function update( $new_instance, $old_instance ) {
    $instance 		= $old_instance;
    $instance['title'] 		= sanitize_text_field($new_instance['title']);
    $instance['number'] 	= (int) $new_instance['number'];
    $instance['autoplay'] 	= sanitize_text_field($new_instance['autoplay']);
    $instance['group'] 		= sanitize_text_field($new_instance['group']);
    $instance['orderby'] 	= sanitize_text_field($new_instance['orderby']);
    $instance['columns'] 	= sanitize_text_field($new_instance['columns']);
    $instance['content'] 	= sanitize_text_field($new_instance['content']);
    $instance['link'] 		= sanitize_text_field($new_instance['link']);
    $instance['pagination']	= sanitize_text_field($new_instance['pagination']);
    $instance['arrows'] 	= sanitize_text_field($new_instance['arrows']);
    $instance['speed'] 		= (int) $new_instance['speed'];

    return $instance;
  }


  public function form( $instance ) {
    
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 5;
    $speed = isset($instance['speed']) ? esc_attr($instance['speed']) : '';
    $autoplay = isset($instance['autoplay']) ? esc_attr($instance['autoplay']) : 'true';
    $arrows = isset($instance['arrows']) ? esc_attr($instance['arrows']) : 'true';
    $pagination = isset($instance['pagination']) ? esc_attr($instance['pagination']) : 'false';
    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'random';}
    if (isset($instance['columns'])) { $columns = esc_attr($instance['columns']); } else {$columns = '1';}
     if (isset($instance['content'])) { $content = esc_attr($instance['content']); } else {$content = 'excerpt';}
    if (isset($instance['link'])) { $link = esc_attr($instance['link']); } else {$link = 'none';}
    $orderoptions = array(array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Menu Order', 'slug' => 'menu_order'), array('name' => 'Date', 'slug' => 'date'));
    $autoplay_options = array(array('name' => 'True', 'slug' => 'true'), array('name' => 'False', 'slug' => 'false'));
    $coptions = array(array('name' => 'Excerpt', 'slug' => 'excerpt'), array('name' => 'Full Content', 'slug' => 'full_content'));
    $linkoptions = array(array('name' => __('False', 'ascend'), 'slug' => 'false'), array('name' => __('True', 'ascend'), 'slug' => 'true'));
    $testimonial_columns_options = array(array("slug" => "1", "name" => __('1 Column', 'ascend')), array("slug" => "2", "name" => __('2 Columns', 'ascend')), array("slug" => "3", "name" => __('3 Columns', 'ascend')), array("slug" => "4", "name" => __('4 Columns', 'ascend')), array("slug" => "5", "name" => __('5 Columns', 'ascend')), array("slug" => "6", "name" => __('6 Columns', 'ascend')));
     foreach ($testimonial_columns_options as $testimonial_column_option) {
      if ($columns == $testimonial_column_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $testimonial_columns_array[] = '<option value="' . $testimonial_column_option['slug'] .'"' . $selected . '>' . $testimonial_column_option['name'] . '</option>';
    }
    $order_options = array();
    foreach ($orderoptions as $ooption) {
      if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $order_options[] = '<option value="' . $ooption['slug'] .'"' . $selected . '>' . $ooption['name'] . '</option>';
    }
    $link_options = array();
    foreach ($linkoptions as $loption) {
      if ($link==$loption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $link_options[] = '<option value="' . $loption['slug'] .'"' . $selected . '>' . $loption['name'] . '</option>';
    }
    $auto_options = array();
    foreach ($autoplay_options as $aoption) {
      if ($autoplay==$aoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $auto_options[] = '<option value="' . $aoption['slug'] .'"' . $selected . '>' . $aoption['name'] . '</option>';
    }
    $arrows_options = array();
    foreach ($autoplay_options as $aoption) {
      if ($arrows==$aoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $arrows_options[] = '<option value="' . $aoption['slug'] .'"' . $selected . '>' . $aoption['name'] . '</option>';
    }
     $pagination_options = array();
    foreach ($autoplay_options as $aoption) {
      if ($pagination==$aoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $pagination_options[] = '<option value="' . $aoption['slug'] .'"' . $selected . '>' . $aoption['name'] . '</option>';
    }
    $content_options = array();
    foreach ($coptions as $foption) {
      if ($content==$foption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $content_options[] = '<option value="' . $foption['slug'] .'"' . $selected . '>' . $foption['name'] . '</option>';
    }
    if (isset($instance['group'])) { $group = esc_attr($instance['group']); } else {$group = '';}
     $categories= get_terms('testimonial-group');
     $cat_options = array();
     $cat_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cat) {
      if ($group==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . $cat->slug .'"' . $selected . '>' . $cat->name . '</option>';
    }

?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'ascend'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('group'); ?>"><?php _e('Limit to Group (Optional):', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('group'); ?>" name="<?php echo $this->get_field_name('group'); ?>"><?php echo implode('', $cat_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Carousel Columns', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>"><?php echo implode('', $testimonial_columns_array); ?></select>
    </p>
    <p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Carousel Speed (e.g. = 7000)', 'ascend'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo esc_attr($speed); ?>" />
    </p>
     <p>
    <label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Autoplay:', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>"><?php echo implode('', $auto_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo implode('', $content_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('If full content link to post?', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>"><?php echo implode('', $link_options); ?></select>
    </p>
     <p>
    <label for="<?php echo $this->get_field_id('arrows'); ?>"><?php _e('Show Arrows?', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('arrows'); ?>" name="<?php echo $this->get_field_name('arrows'); ?>"><?php echo implode('', $arrows_options); ?></select>
    </p>
  
     <p>
    <label for="<?php echo $this->get_field_id('pagination'); ?>"><?php _e('Show pagination dots?', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('pagination'); ?>" name="<?php echo $this->get_field_name('pagination'); ?>"><?php echo implode('', $pagination_options); ?></select>
    </p>
  
<?php
  }
}