<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class kad_carousel_widget extends WP_Widget{

private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_carousel_widget', 'description' => __('Adds a carousel to any widget area', 'ascend'));
        parent::__construct('kadence_carousel_widget', __('Ascend: Carousel', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
       	if ( ! isset( $args['widget_id'] ) ) {
      		$args['widget_id'] = $this->id;
       	}
        extract( $args ); 
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if(!empty($instance["type"])) {$c_type = $instance["type"];} else {$c_type = 'post';}
        $productargs = '';
        $c_cat = '';
        if(!empty($instance["c_order"])) {$c_order = $instance["c_order"];} else {$c_order = 'menu_order';}
        if(!empty($instance["autoplay"])) {$autoplay = $instance["autoplay"];} else {$autoplay = 'true';}
        if(!empty($instance["c_items"])) {$c_items = $instance["c_items"];} else {$c_items = '6';}
        if(!empty($instance["c_speed"])) {$c_speed = $instance["c_speed"];} else {$c_speed = '9000';}
        if(!empty($instance["arrows"])) {$arrows = $instance["arrows"];} else {$arrows = 'true';}
        if(!empty($instance["pagination"])) {$pagination = $instance["pagination"];} else {$pagination = 'false';}
        if($c_type == "cat-products" || $c_type == "sale-products" || $c_type == "best-products" || $c_type == "featured-products") {
            if(!empty($instance["productcat"])) {$c_cat = $instance["productcat"];} else {$c_cat = '';}
        } else if ($c_type == "portfolio") {
            if(!empty($instance["portfoliocat"])) {$c_cat = $instance["portfoliocat"];} else {$c_cat = '';}
        } else if ($c_type == "event") {
            if(!empty($instance["eventcat"])) {$c_cat = $instance["eventcat"];} else {$c_cat = '';}
        } else if ($c_type == "podcast") {
            if(!empty($instance["podcastcat"])) {$c_cat = $instance["podcastcat"];} else {$c_cat = '';}
        } else {
            if(!empty($instance["postcat"])) {$c_cat = $instance["postcat"];} else {$c_cat = '';}
        }
        if($c_order == "date") {
        	$order = 'DESC';
        } else {
        	$order = 'ASC';
        }
        if($c_type == "cat-products" || $c_type == "sale-products" || $c_type == "best-products" || $c_type == "featured-products" ) {
        	$productargs = $c_type;
        	$c_type = "product";
        }
        if(!empty($instance["c_columns"])) { $c_columns = $instance["c_columns"]; } else {$c_columns = '1';}
        if(!empty($instance["c_scroll"])) { $c_scroll = $instance["c_scroll"]; } else {$c_scroll = '1';}
		if ( ! empty( $instance["xxlcol"] ) && 'default' != $instance["xxlcol"] ) {
			$xxlcol = $instance["xxlcol"];
		} else {
			$xxlcol = null;
		}
		if ( ! empty( $instance["xlcol"] ) && 'default' != $instance["xlcol"] ) {
			$xlcol = $instance["xlcol"];
		} else {
			$xlcol = null;
		}
		if ( ! empty( $instance["smcol"] ) && 'default' != $instance["smcol"] ) {
			$smcol = $instance["smcol"];
		} else {
			$smcol = null;
		}
		if ( ! empty( $instance["xscol"] ) && 'default' != $instance["xscol"] ) {
			$xscol = $instance["xscol"];
		} else {
			$xscol = null;
		}
		if ( ! empty( $instance["sscol"] ) && 'default' != $instance["sscol"] ) {
			$sscol = $instance["sscol"];
		} else {
			$sscol = null;
		}
       

            ?>


          <?php echo $before_widget;
            if ( $title ) echo $before_title . $title . $after_title; 
            	echo ascend_build_post_content_carousel($args['widget_id'], $c_columns, $c_type, $c_cat, $c_items, $c_order, $order, 'kadence_carousel_widget_output', null, $autoplay, $c_speed, $c_scroll, $arrows, '400', $productargs, $pagination, $xxlcol, $xlcol, null, $smcol, $xscol, $sscol );
           echo $after_widget;?>

    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['type'] 		= sanitize_text_field($new_instance['type']);
        $instance['c_items'] 	= (int) $new_instance['c_items']; 
        $instance['c_columns'] 	= sanitize_text_field( $new_instance['c_columns'] );
        $instance['autoplay'] 	= sanitize_text_field( $new_instance['autoplay'] );
        $instance['c_order'] 	= sanitize_text_field( $new_instance['c_order'] );
        $instance['c_scroll'] 	= sanitize_text_field( $new_instance['c_scroll'] );
        $instance['postcat'] 	= sanitize_text_field( $new_instance['postcat'] );
        $instance['portfoliocat'] = sanitize_text_field( $new_instance['portfoliocat'] );
        if(isset($new_instance['productcat'])){
        	$instance['productcat'] = sanitize_text_field( $new_instance['productcat'] );
        }
        if(isset($new_instance['eventcat'])){
        	$instance['eventcat'] 	= sanitize_text_field( $new_instance['eventcat'] );
    	}
    	if(isset($new_instance['podcastcat'])){
        	$instance['podcastcat'] 	= sanitize_text_field( $new_instance['podcastcat'] );
    	}
        $instance['c_speed'] 	= (int) $new_instance['c_speed'];
        $instance['title']		= sanitize_text_field( $new_instance['title'] );
        $instance['pagination'] = sanitize_text_field( $new_instance['pagination'] );
        $instance['arrows'] = sanitize_text_field( $new_instance['arrows'] );
        $instance['xxlcol'] = sanitize_text_field( $new_instance['xxlcol'] );
        $instance['xlcol'] = sanitize_text_field( $new_instance['xlcol'] );
        $instance['smcol'] = sanitize_text_field( $new_instance['smcol'] );
        $instance['xscol'] = sanitize_text_field( $new_instance['xscol'] );
        $instance['sscol'] = sanitize_text_field( $new_instance['sscol'] );
        return $instance;
    }

  public function form($instance){ 
    $c_items = isset($instance['c_items']) ? esc_attr($instance['c_items']) : '';
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $c_speed = isset($instance['c_speed']) ? esc_attr($instance['c_speed']) : '';
    $autoplay = isset($instance['autoplay']) ? esc_attr($instance['autoplay']) : 'true';
    $arrows = isset($instance['arrows']) ? esc_attr($instance['arrows']) : 'true';
    $pagination = isset($instance['pagination']) ? esc_attr($instance['pagination']) : 'false';
    $xxlcol = isset($instance['xxlcol']) ? esc_attr($instance['xxlcol']) : 'default';
    $xlcol = isset($instance['xlcol']) ? esc_attr($instance['xlcol']) : 'default';
    $smcol = isset($instance['smcol']) ? esc_attr($instance['smcol']) : 'default';
    $xscol = isset($instance['xscol']) ? esc_attr($instance['xscol']) : 'default';
    $sscol = isset($instance['sscol']) ? esc_attr($instance['sscol']) : 'default';
    if (isset($instance['type'])) { $c_type = esc_attr($instance['type']); } else {$c_type = 'post';}
    if (isset($instance['c_scroll'])) { $c_scroll = esc_attr($instance['c_scroll']); } else {$c_scroll = '1';}
    if (isset($instance['c_order'])) { $c_order = esc_attr($instance['c_order']); } else {$c_order = 'menu_order';}
    if (isset($instance['c_columns'])) { $c_columns = esc_attr($instance['c_columns']); } else {$c_columns = '1';}
    $carousel_type_array = array();
    $carousel_scroll_array = array();
    $carousel_columns_array = array();
    $carousel_order_array = array();
    $carousel_types = array(
        'post' => array("slug" => "post", "name" => __('Blog Posts', 'ascend')), 
        'post_photo' => array("slug" => "post_photo", "name" => __('Blog Posts photo output', 'ascend')), 
        'portfolio' => array("slug" => "portfolio", "name" => __('Portfolio Posts', 'ascend')), 
        'staff' => array("slug" => "staff", "name" => __('Staff Posts', 'ascend')), 
    );
    if (class_exists('woocommerce')) { 
	    $carousel_types_product = array(
	        'featured-products' => array( "slug" => "featured-products", "name" => __('Featured Products', 'ascend')), 
	        'sale-products' => array( "slug" => "sale-products", "name" => __('Sale Products', 'ascend')), 
	        'best-products' => array( "slug" => "best-products", "name" => __('Best Products', 'ascend')),
	        'cat-products' => array( "slug" => "cat-products", "name" => __('Category of Products', 'ascend')),
	    );
	} else {
		$carousel_types_product = array();
	}
	if( post_type_exists( 'event' ) ) { 
	    $carousel_types_event = array(
	        'event' => array( "slug" => "event", "name" => __('Event Posts', 'ascend')),
	    );
	} else {
		 $carousel_types_event = array();
	}
	if( post_type_exists( 'podcast' ) ) { 
	    $carousel_types_podcast = array(
	        'podcast' => array( "slug" => "podcast", "name" => __('Podcast Posts', 'ascend')),
	    );
	} else {
		 $carousel_types_podcast = array();
	}
    
    $carousel_types = array_merge($carousel_types, $carousel_types_product, $carousel_types_event, $carousel_types_podcast);
    $carousel_types = apply_filters('kadence_widget_carousel_types', $carousel_types);
    $carousel_columns_options = array(array("slug" => "1", "name" => __('1 Column', 'ascend')), array("slug" => "2", "name" => __('2 Columns', 'ascend')), array("slug" => "3", "name" => __('3 Columns', 'ascend')), array("slug" => "4", "name" => __('4 Columns', 'ascend')), array("slug" => "5", "name" => __('5 Columns', 'ascend')));
    $carousel_scroll_options = array(array("slug" => "1", "name" => __('1 item', 'ascend')), array("slug" => "all", "name" => __('All Visible', 'ascend')));
    $carousel_autoplay = array(array("slug" => "true", "name" => __('True', 'ascend')), array("slug" => "false", "name" => __('False', 'ascend')));
    $carousel_order_options = array(array("slug" => "menu_order", "name" => __('Menu Order', 'ascend')), array("slug" => "date", "name" => __('Date', 'ascend')), array("slug" => "rand", "name" => __('Random', 'ascend')));
    $true_false_options = array(array('name' => 'True', 'slug' => 'true'), array('name' => 'False', 'slug' => 'false'));
    if (isset($instance['postcat'])) { $postcat = esc_attr($instance['postcat']); } else {$postcat = '';}
    if (isset($instance['portfoliocat'])) { $portfoliocat = esc_attr($instance['portfoliocat']); } else {$portfoliocat = '';}
    if (isset($instance['productcat'])) { $productcat = esc_attr($instance['productcat']); } else {$productcat = '';}
    if (isset($instance['eventcat'])) { $eventcat = esc_attr($instance['eventcat']); } else {$eventcat = '';}
    if (isset($instance['podcastcat'])) { $podcastcat = esc_attr($instance['podcastcat']); } else {$podcastcat = '';}
    $carousel_extra_columns_options = array(array("slug" => "default", "name" => __('Default', 'ascend')), array("slug" => "1", "name" => __('1 Column', 'ascend')), array("slug" => "2", "name" => __('2 Columns', 'ascend')), array("slug" => "3", "name" => __('3 Columns', 'ascend')), array("slug" => "4", "name" => __('4 Columns', 'ascend')), array("slug" => "5", "name" => __('5 Columns', 'ascend')));
	$xxlcol_options = array();
	foreach ($carousel_extra_columns_options as $ceoption) {
		if ($xxlcol == $ceoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		$xxlcol_options[] = '<option value="' . $ceoption['slug'] .'"' . $selected . '>' . $ceoption['name'] . '</option>';
	}
	$xlcol_options = array();
	foreach ($carousel_extra_columns_options as $ceoption) {
		if ($xlcol == $ceoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		$xlcol_options[] = '<option value="' . $ceoption['slug'] .'"' . $selected . '>' . $ceoption['name'] . '</option>';
	}
	$smcol_options = array();
	foreach ($carousel_extra_columns_options as $ceoption) {
		if ($smcol == $ceoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		$smcol_options[] = '<option value="' . $ceoption['slug'] .'"' . $selected . '>' . $ceoption['name'] . '</option>';
	}
	$xscol_options = array();
	foreach ($carousel_extra_columns_options as $ceoption) {
		if ($xscol == $ceoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		$xscol_options[] = '<option value="' . $ceoption['slug'] .'"' . $selected . '>' . $ceoption['name'] . '</option>';
	}
	$sscol_options = array();
	foreach ($carousel_extra_columns_options as $ceoption) {
		if ($sscol == $ceoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		$sscol_options[] = '<option value="' . $ceoption['slug'] .'"' . $selected . '>' . $ceoption['name'] . '</option>';
	}
    $pagination_options = array();
    foreach ($true_false_options as $tfoption) {
      	if ($pagination == $tfoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$pagination_options[] = '<option value="' . $tfoption['slug'] .'"' . $selected . '>' . $tfoption['name'] . '</option>';
    }
    $arrows_options = array();
    foreach ($true_false_options as $tfoption) {
      	if ($arrows == $tfoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      	$arrows_options[] = '<option value="' . $tfoption['slug'] .'"' . $selected . '>' . $tfoption['name'] . '</option>';
    }
    $types= get_terms('portfolio-type');
    $type_options = array();
    $type_options[] = '<option value="">All</option>';
    if(!is_wp_error($types) ) {
        foreach ($types as $type) {
          if ($portfoliocat==$type->slug) { $selected=' selected="selected"';} else { $selected=""; }
          $type_options[] = '<option value="' . $type->slug .'"' . $selected . '>' . $type->name . '</option>';
        }
    }
    $categories= get_categories();
    $cat_options = array();
    $cat_options[] = '<option value="">All</option>';
    foreach ($categories as $cat) {
      if ($postcat==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . $cat->slug .'"' . $selected . '>' . $cat->name . '</option>';
    }

    $product_options = array();
    $product_options[] = '<option value="">All</option>';
    if (class_exists('woocommerce')) { 
        $product_categories= get_terms('product_cat');
        foreach ($product_categories as $pcat) {
          if ($productcat==$pcat->slug) { $selected=' selected="selected"';} else { $selected=""; }
          $product_options[] = '<option value="' . $pcat->slug .'"' . $selected . '>' . $pcat->name . '</option>';
        }
    }

    $event_options = array();
    $event_options[] = '<option value="">All</option>';
    if (taxonomy_exists( 'event-category' )) { 
        $event_categories= get_terms('event-category');
        foreach ($event_categories as $ecat) {
          if ($eventcat==$ecat->slug) { $selected=' selected="selected"';} else { $selected=""; }
          $event_options[] = '<option value="' . $ecat->slug .'"' . $selected . '>' . $ecat->name . '</option>';
        }
    }
    $podcast_options = array();
    $podcast_options[] = '<option value="">All</option>';
    if (taxonomy_exists( 'series' )) { 
        $podcast_categories= get_terms('series');
        foreach ($podcast_categories as $pccat) {
          if ($podcastcat==$pccat->slug) { $selected=' selected="selected"';} else { $selected=""; }
          $podcast_options[] = '<option value="' . $pccat->slug .'"' . $selected . '>' . $pccat->name . '</option>';
        }
    }
    $autoplay_options = array();
    foreach ($carousel_autoplay as $auto) {
        if ($autoplay == $auto['slug']) { $selected=' selected="selected"';} else { $selected=""; }
            $autoplay_options[] = '<option value="' . $auto['slug'] .'"' . $selected . '>' . $auto['name'] . '</option>';
        }


    foreach ($carousel_types as $carousel_type) {
      if ($c_type == $carousel_type['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $carousel_type_array[] = '<option value="' . $carousel_type['slug'] .'"' . $selected . '>' . $carousel_type['name'] . '</option>';
    }
    foreach ($carousel_scroll_options as $carousel_scroll_option) {
      if ($c_scroll == $carousel_scroll_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $carousel_scroll_array[] = '<option value="' . $carousel_scroll_option['slug'] .'"' . $selected . '>' . $carousel_scroll_option['name'] . '</option>';
    }
    foreach ($carousel_columns_options as $carousel_column_option) {
      if ($c_columns == $carousel_column_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $carousel_columns_array[] = '<option value="' . $carousel_column_option['slug'] .'"' . $selected . '>' . $carousel_column_option['name'] . '</option>';
    }
    foreach ($carousel_order_options as $carousel_order_option) {
      if ($c_order == $carousel_order_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $carousel_order_array[] = '<option value="' . $carousel_order_option['slug'] .'"' . $selected . '>' . $carousel_order_option['name'] . '</option>';
    }?>  

    <div id="kadence_carousel_widget<?php echo esc_attr($this->get_field_id('container')); ?>" class="kad_widget_carousel">
          <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Carousel Type', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('type'); ?>" style="width:100%; max-width:230px" name="<?php echo $this->get_field_name('type'); ?>"><?php echo implode('', $carousel_type_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('c_columns'); ?>"><?php _e('Carousel Columns', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('c_columns'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('c_columns'); ?>"><?php echo implode('', $carousel_columns_array);?></select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('c_scroll'); ?>"><?php _e('Scroll Setting', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('c_scroll'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('c_scroll'); ?>"><?php echo implode('', $carousel_scroll_array);?></select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('c_items'); ?>"><?php _e('Items (e.g. = 8)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('c_items'); ?>" id="<?php echo $this->get_field_id('c_items'); ?>" value="<?php echo $c_items; ?>">
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('c_order'); ?>"><?php _e('Order by', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('c_order'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('c_order'); ?>"><?php echo implode('', $carousel_order_array);?></select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('postcat'); ?>"><?php _e('Blog Post Category', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('postcat'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('postcat'); ?>"><?php echo implode('', $cat_options);?></select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('portfoliocat'); ?>"><?php _e('Portfolio Category', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('portfoliocat'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('portfoliocat'); ?>"><?php echo implode('', $type_options);?></select>
            </p>
            <?php 
            if( post_type_exists( 'product' ) ) { ?>
	            <p>
	                <label for="<?php echo $this->get_field_id('productcat'); ?>"><?php _e('Product Category', 'ascend'); ?></label><br />
	                <select id="<?php echo $this->get_field_id('productcat'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('productcat'); ?>"><?php echo implode('', $product_options);?></select>
	            </p>
            <?php 
        	} ?>
        	<?php 
        	if( post_type_exists( 'event' ) ) { ?>
	            <p>
	                <label for="<?php echo $this->get_field_id('eventcat'); ?>"><?php _e('Event Category', 'ascend'); ?></label><br />
	                <select id="<?php echo $this->get_field_id('eventcat'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('eventcat'); ?>"><?php echo implode('', $event_options);?></select>
	            </p>

            <?php 
        	} ?>
        	<?php 
        	if( post_type_exists( 'podcast' ) ) { ?>
	            <p>
	                <label for="<?php echo $this->get_field_id('podcastcat'); ?>"><?php _e('Podcast Series', 'ascend'); ?></label><br />
	                <select id="<?php echo $this->get_field_id('podcastcat'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('podcastcat'); ?>"><?php echo implode('', $podcast_options);?></select>
	            </p>

            <?php 
        	} ?>
            <p>
                <label for="<?php echo $this->get_field_id('c_speed'); ?>"><?php _e('Carousel Speed (e.g. = 7000)', 'ascend'); ?></label><br />
                <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('c_speed'); ?>" id="<?php echo $this->get_field_id('c_speed'); ?>" value="<?php echo $c_speed; ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Auto Play?', 'ascend'); ?></label><br />
                <select id="<?php echo $this->get_field_id('autoplay'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('autoplay'); ?>"><?php echo implode('', $autoplay_options);?></select>
            </p>
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'arrows' ) ); ?>"><?php esc_html_e( 'Show Arrows?:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('arrows'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('arrows'); ?>"><?php echo implode('', $arrows_options);?></select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'pagination' ) ); ?>"><?php esc_html_e( 'Show Pagination Dots?:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('pagination'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('pagination'); ?>"><?php echo implode('', $pagination_options);?></select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'xxlcol' ) ); ?>"><?php esc_html_e( 'Above 1500px screen width columns:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('xxlcol'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('xxlcol'); ?>"><?php echo implode('', $xxlcol_options);?></select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'xlcol' ) ); ?>"><?php esc_html_e( '1200px - 1500px screen width columns:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('xlcol'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('xlcol'); ?>"><?php echo implode('', $xlcol_options);?></select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'smcol' ) ); ?>"><?php esc_html_e( '768px - 992px screen width columns:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('smcol'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('smcol'); ?>"><?php echo implode('', $smcol_options);?></select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'xscol' ) ); ?>"><?php esc_html_e( '544px - 768px screen width columns:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('xscol'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('xscol'); ?>"><?php echo implode('', $xscol_options);?></select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sscol' ) ); ?>"><?php esc_html_e( 'Below 544px screen width columns:', 'ascend' ); ?></label>
				<select id="<?php echo $this->get_field_id('sscol'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('sscol'); ?>"><?php echo implode('', $sscol_options);?></select>
			</p>
    </div>

<?php } }