<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/*
 * tabs and accordions widget.
 * THANKS PROTEUSTHEMES!
 */
class kad_custom_carousel_widget extends WP_Widget{
	private $used_IDs = array();

    public function __construct() {
        $widget_ops = array('classname' => 'kadence_custom_carousel_widget', 'description' => __('Add unlimited carousel items that can hold widgets.', 'ascend'));
        parent::__construct('kadence_custom_carousel_widget', __('Ascend: Custom Carousel', 'ascend'), $widget_ops);
    }

       public function widget($args, $instance){ 
        extract( $args ); 
        if ( ! isset( $widget_id ) ) {
      		$widget_id = $this->id;
     	}
        $instance['widget_title'] 	= empty( $instance['widget_title'] ) ? '' : $args['before_title'] . apply_filters( 'widget_title', $instance['widget_title'], $instance ) . $args['after_title'];
        $instance['scroll'] 		= ! empty( $instance['scroll'] ) ? $instance['scroll'] : '1';
        $instance['speed'] 			= ! empty( $instance['speed'] ) ? $instance['speed'] : '9000';
        $instance['autoplay'] 		= ! empty( $instance['autoplay'] ) ? $instance['autoplay'] : 'true';
        $instance['arrows'] 		= ! empty( $instance['arrows'] ) ? $instance['arrows'] : 'true';
        $instance['pagination'] 	= ! empty( $instance['pagination'] ) ? $instance['pagination'] : 'false';
        $instance['columns'] 		= ! empty( $instance['columns'] ) ? $instance['columns'] : '1';
        $instance['gutter'] 		= ! empty( $instance['gutter'] ) ? $instance['gutter'] : 'row-margin-small';
        $items                		= isset( $instance['items'] ) ? array_values( $instance['items'] ) : array();

        $ccc = array();
		if ($instance['columns'] == '2') {
			$ccc = ascend_carousel_columns('2');
			$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
		} else if ($instance['columns'] == '3'){
			$ccc = ascend_carousel_columns('3');
			$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		} else if ($instance['columns'] == '1'){
			$ccc = ascend_carousel_columns('1');
			$itemsize = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
		} else if ($instance['columns'] == '6'){
			$ccc = ascend_carousel_columns('6');
			$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		} else if ($instance['columns'] == '5'){ 
			$ccc = ascend_carousel_columns('5');
			$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		} else {
			$ccc = ascend_carousel_columns('4');
			$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		} 
		$ccc = apply_filters('ascend_custom_carousel_columns', $ccc);

        // Prepare items data.
		foreach ( $items as $key => $item ) {
			$items[ $key ]['builder_id'] = empty( $item['builder_id'] ) ? uniqid() : $item['builder_id'];
		}
        echo $before_widget; 
        	?>
        	<div class="carousel_outerrim">
        		<?php if ( ! empty( $instance['widget_title'] ) ) : ?>
					<?php echo wp_kses_post( $instance['widget_title'] ); ?>
				<?php endif; ?>
				<div class="custom-carouselcontainer <?php echo esc_attr($instance['gutter']);?>">
					<div id="custom-carousel-<?php echo esc_attr($widget_id);?>" class="slick-slider custom_carousel_shortcode kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="<?php echo esc_attr($instance['scroll']);?>" data-slider-arrows="<?php echo esc_attr($instance['arrows']);?>" data-slider-dots="<?php echo esc_attr($instance['pagination']);?>" data-slider-auto="<?php echo esc_attr($instance['autoplay']);?>" data-slider-speed="<?php echo esc_attr($instance['speed']);?>" data-slider-xxl="<?php echo esc_attr($ccc['xxl']);?>" data-slider-xl="<?php echo esc_attr($ccc['xl']);?>" data-slider-md="<?php echo esc_attr($ccc['md']);?>" data-slider-sm="<?php echo esc_attr($ccc['sm']);?>" data-slider-xs="<?php echo esc_attr($ccc['xs']);?>" data-slider-ss="<?php echo esc_attr($ccc['ss']);?>">
						<?php
						if ( ! empty( $items ) ) :
							$i = 1;
							foreach ( $items as $item ) : 
										?>
								<div class="<?php echo esc_attr($itemsize); ?> kad_customcarousel_item cc_item_<?php echo esc_attr($i);?>">
									<div class="carousel_item grid_item">
										<?php echo siteorigin_panels_render( 'w'.$item['builder_id'], true, $item['panels_data'] ); ?>
									</div>
								</div>
								<?php $i ++; 
							endforeach; 

						endif; ?>
					</div>
				</div>
			</div>

        	<?php 
        
        echo $after_widget;

    }

    public function update($new_instance, $old_instance) {
        $instance = array();

        $instance['widget_title'] = sanitize_text_field( $new_instance['widget_title'] );
        $instance['speed'] = (int) $new_instance['speed'];
        $instance['columns'] = (int) $new_instance['columns'];
        $instance['autoplay'] = sanitize_text_field( $new_instance['autoplay'] );
        $instance['scroll'] = sanitize_text_field( $new_instance['scroll'] );
        $instance['arrows'] = sanitize_text_field( $new_instance['arrows'] );
        $instance['gutter'] = sanitize_text_field( $new_instance['gutter'] );
        $instance['pagination'] = sanitize_text_field( $new_instance['pagination'] );

        if ( ! empty( $new_instance['items'] )  ) {
			foreach ( $new_instance['items'] as $key => $item ) {
				$instance['items'][ $key ]['id']          = sanitize_key( $item['id'] );
				$instance['items'][ $key ]['builder_id']  = uniqid();
				$instance['items'][ $key ]['panels_data'] = is_string( $item['panels_data'] ) ? json_decode( $item['panels_data'], true ) : $item['panels_data'];
			}
		}
        // Sort items by ids, because order might have changed.
		usort( $instance['items'], array( $this, 'sort_by_id' ) );

        return $instance;
    }

    function sort_by_id( $a, $b ) {
		return $a['id'] - $b['id'];
	}


  	public function form($instance){

  			$widget_title 	= ! empty( $instance['widget_title'] ) ? $instance['widget_title'] : '';
  			$speed			= ! empty( $instance['speed'] ) ? $instance['speed'] : '9000';
  			$columns		= ! empty( $instance['columns'] ) ? $instance['columns'] : '1';
	    	$autoplay		= ! empty( $instance['autoplay'] ) ? $instance['autoplay'] : 'true';
	    	$arrows 		= ! empty( $instance['arrows'] ) ? $instance['arrows'] : 'true';
	    	$gutter 		= ! empty( $instance['gutter'] ) ? $instance['gutter'] : 'row-margin-small';
	    	$pagination 	= ! empty( $instance['pagination'] ) ? $instance['pagination'] : 'false';
			$items        	= isset( $instance['items'] ) ? $instance['items'] : array();
			$true_false_options = array(array('name' => 'True', 'slug' => 'true'), array('name' => 'False', 'slug' => 'false'));
			$scroll_array = array(array('name' => '1 item', 'slug' => '1'), array('name' => 'All Visible', 'slug' => 'all'));
			$gutter_array = array(array('name' => '10px', 'slug' => 'row-margin-small'), array('name' => '20px', 'slug' => 'rowtight'), array('name' => '30px', 'slug' => 'row'), array('name' => '0px', 'slug' => 'row-nomargin'));
			$columns_array = array(array("slug" => "1", "name" => __('1 Column', 'ascend')), array("slug" => "2", "name" => __('2 Columns', 'ascend')), array("slug" => "3", "name" => __('3 Columns', 'ascend')), array("slug" => "4", "name" => __('4 Columns', 'ascend')), array("slug" => "5", "name" => __('5 Columns', 'ascend')), array("slug" => "6", "name" => __('6 Columns', 'ascend')));
		    $columns_options = array();
		    foreach ($columns_array as $coption) {
		      if ($columns == $coption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      $columns_options[] = '<option value="' . $coption['slug'] .'"' . $selected . '>' . $coption['name'] . '</option>';
		    }
			$autoplay_options = array();
		    foreach ($true_false_options as $tfoption) {
		      	if ($autoplay == $tfoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$autoplay_options[] = '<option value="' . $tfoption['slug'] .'"' . $selected . '>' . $tfoption['name'] . '</option>';
		    }
		    $arrows_options = array();
		    foreach ($true_false_options as $tfoption) {
		      	if ($arrows == $tfoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$arrows_options[] = '<option value="' . $tfoption['slug'] .'"' . $selected . '>' . $tfoption['name'] . '</option>';
		    }
		    $gutter_options = array();
		    foreach ($gutter_array as $goption) {
		      	if ($gutter == $goption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$gutter_options[] = '<option value="' . $goption['slug'] .'"' . $selected . '>' . $goption['name'] . '</option>';
		    }
		    $pagination_options = array();
		    foreach ($true_false_options as $tfoption) {
		      	if ($pagination == $tfoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$pagination_options[] = '<option value="' . $tfoption['slug'] .'"' . $selected . '>' . $tfoption['name'] . '</option>';
		    }
		    $scroll_options = array();
		    foreach ($scroll_array as $soption) {
		      	if ($pagination == $soption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$scroll_options[] = '<option value="' . $soption['slug'] .'"' . $selected . '>' . $soption['name'] . '</option>';
		    }

			// Page Builder fix when using repeating fields
			if ( 'temp' === $this->id ) {
				$this->current_widget_id = $this->number;
			}
			else {
				$this->current_widget_id = $this->id;
			}
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php esc_html_e( 'Widget title:', 'ascend' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Columns:', 'ascend' ); ?></label>
			<select id="<?php echo $this->get_field_id('columns'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('columns'); ?>"><?php echo implode('', $columns_options);?></select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"><?php esc_html_e( 'Autoplay?:', 'ascend' ); ?></label>
			<select id="<?php echo $this->get_field_id('autoplay'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('autoplay'); ?>"><?php echo implode('', $autoplay_options);?></select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'speed' ) ); ?>"><?php esc_html_e( 'Speed:', 'ascend' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'speed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'speed' ) ); ?>" type="text" value="<?php echo esc_attr( $speed ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'scroll' ) ); ?>"><?php esc_html_e( 'Scroll:', 'ascend' ); ?></label>
			<select id="<?php echo $this->get_field_id('scroll'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('scroll'); ?>"><?php echo implode('', $scroll_options);?></select>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>"><?php esc_html_e( 'Column gutter:', 'ascend' ); ?></label>
			<select id="<?php echo $this->get_field_id('gutter'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('gutter'); ?>"><?php echo implode('', $gutter_options);?></select>
		</p>


		<hr>

		<h3><?php esc_html_e( 'Items:', 'ascend' ); ?></h3>

		<script type="text/template" id="js-kadence-tab-<?php echo esc_attr( $this->current_widget_id ); ?>">
			<div class="kadence-tabs-widget  ui-widget  ui-widget-content  ui-helper-clearfix  ui-corner-all">
				<div class="kadence-tabs-widget-header  ui-widget-header  ui-corner-all">
					<span class="dashicons  dashicons-sort"></span>
					<span><?php esc_html_e( 'Item', 'ascend' ); ?> - </span>
					<span class="kadence-tabs-widget-header-title">{{id}}</span>
					<span class="kadence-tabs-widget-toggle  dashicons  dashicons-minus"></span>
				</div>
				<div class="kadence-tabs-widget-content">

					<label><?php echo __( 'Pane content:', 'ascend' ); ?></label>
					<div class="siteorigin-page-builder-widget siteorigin-panels-builder siteorigin-panels-builder-kadence-tabs" id="siteorigin-page-builder-widget-{{builder_id}}" data-builder-id="{{builder_id}}" data-type="layout_widget">
						<p>
							<a href="#" class="button-secondary siteorigin-panels-display-builder" ><?php _e('Open Builder', 'ascend') ?></a>
						</p>

						<input type="hidden" data-panels-filter="json_parse" value="{{panels_data}}" class="panels-data" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[{{id}}][panels_data]" />
					</div>

					<p>
						<input name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[{{id}}][id]" class="js-kadence-tab-id" type="hidden" value="{{id}}" />
						<a href="#" class="kadence-remove-tab  js-kadence-remove-tab"><span class="dashicons dashicons-dismiss"></span> <?php echo __( 'Remove Item', 'ascend' ); ?></a>
					</p>
				</div>
			</div>
		</script>

		<div class="kadence-widget-tabs" id="tabs-<?php echo esc_attr( $this->current_widget_id ); ?>">
			<div class="tabs  js-kadence-sortable-tabs"></div>
			<p>
				<a href="#" class="button  js-kadence-add-tab"><?php echo  __( 'Add new Item', 'ascend' ); ?></a>
			</p>
		</div>

		<script type="text/javascript">
			(function( $ ) {
				var tabsJSON = <?php echo wp_json_encode( $items ) ?>;

				// Get the right widget id and remove the added < > characters at the start and at the end.
				var widgetId = '<<?php echo esc_js( $this->current_widget_id ); ?>>'.slice( 1, -1 );

				if ( _.isFunction( KTTabs.Utils.repopulateTabs ) ) {
					KTTabs.Utils.repopulateTabs( tabsJSON, widgetId );
				}

				// Make tabs settings sortable.
				$( '.js-kadence-sortable-tabs' ).sortable({
					items: '.kadence-widget-single-tab',
					handle: '.kadence-tabs-widget-header',
					cancel: '.kadence-tabs-widget-toggle',
					placeholder: 'kadence-tabs-widget-placeholder',
					stop: function( event, ui ) {
						$( this ).find( '.js-kadence-tab-id' ).each( function( index ) {
							$( this ).val( index );
						});
					}
				});
			})( jQuery );
		</script>

		<?php
		}
}