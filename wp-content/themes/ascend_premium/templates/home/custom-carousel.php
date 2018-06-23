<?php 
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
  global $ascend; 

$cc_items = $ascend['home_custom_carousel_items'];
if(!empty($ascend['custom_carousel_title'])) {
  $cctitle = $ascend['custom_carousel_title']; 
} else { 
  $cctitle = ''; 
}
if(!empty($ascend['home_custom_speed'])) {
  $carousel_speed = $ascend['home_custom_speed'].'000';
} else {
  $carousel_speed = '9000';
}
if(isset($ascend['home_custom_carousel_scroll']) && $ascend['home_custom_carousel_scroll'] == 'all' ) {
  $carousel_scroll = 'all';
} else {
  $carousel_scroll = '1';
}
if(!empty($ascend['home_custom_carousel_column'])) {
  $custom_column = $ascend['home_custom_carousel_column'];
} else {
  $custom_column = 4;
} 
$cc = array();
if ($custom_column == '3') {
    $cc = ascend_carousel_columns('3');
} else if($custom_column == '5') {
    $cc = ascend_carousel_columns('5');
} else if($custom_column == '6') {
    $cc = ascend_carousel_columns('6');
} else if($custom_column == '2') {
    $cc = ascend_carousel_columns('2');
} else {
    $cc = ascend_carousel_columns('4');
} 
if ($custom_column == '2') {
	$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
} else if ($custom_column == '3'){ 
	$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
} else if ($custom_column == '6'){
	$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
} else if ($custom_column == '5'){ 
	$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
} else {
	$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
} 
$image_crop = true;
	if(ascend_display_sidebar()) {
        if(!empty($custom_column)) {
            if($custom_column == '3') {
                $image_width = 420;
                $image_height = 280;
            } else if($custom_column == '2') {
                $image_width = 660;
                $image_height = 440;
            } else {
                $image_width = 360;
                $image_height = 240;
            }
        } else {
            $image_width = 360;
            $image_height = 240;
        }
    } else {
        if(!empty($custom_column)) {
            if($custom_column == '3') {
                $image_width = 420;
                $image_height = 280;

            } else if($custom_column == '2') {
                $image_width = 660;
                $image_height = 440;
            } else {
                $image_width = 360;
                $image_height = 240;
            }
        } else {
            $image_width = 360;
            $image_height = 240;
        }
    }
if(isset($ascend['home_custom_carousel_imageratio']) && $ascend['home_custom_carousel_imageratio'] == '1' ) {
	$image_crop = false;
	$image_height = null;
}
$cc = apply_filters('kt_home_custom_carousel_columns', $cc);

echo '<div class="home-custom-carousel home-margin home-padding">';
		if(!empty($cctitle)) {
		echo '<div class="clearfix">';
			echo '<h3 class="hometitle">';
				echo '<span>'.esc_html($cctitle).'</span>';
			echo '</h3>';
		echo '</div>';
	}	
	?>
	<div class="custom-home-carousel">
		<div class="custom-carouselcontainer rowtight">
    		<div id="custom-home-carousel" class="slick-slider custom_carousel kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="<?php echo esc_attr($carousel_scroll);?>" data-slider-auto="true" data-slider-speed="<?php echo esc_attr($carousel_speed);?>" data-slider-xxl="<?php echo esc_attr($cc['xxl']);?>" data-slider-xl="<?php echo esc_attr($cc['xl']);?>" data-slider-md="<?php echo esc_attr($cc['md']);?>" data-slider-sm="<?php echo esc_attr($cc['sm']);?>" data-slider-xs="<?php echo esc_attr($cc['xs']);?>" data-slider-ss="<?php echo esc_attr($cc['ss']);?>">
 			<?php 
        	if(!empty($cc_items)) {

          		foreach ($cc_items as $c_item) :

			        if(!empty($c_item['target']) && $c_item['target'] == 1) {
			          $target = '_blank';
			        } else {
			          $target = '_self';
			        }
	            
		            echo '<div class="'.esc_attr($itemsize).' kad_customcarousel_item">';
		              	echo '<div class="grid_item custom_carousel_item all postclass">';
		              		if(!empty($c_item['link'])){
		                		echo '<a href="'.esc_url($c_item['link']).'" class="custom_carousel_item_link" target="'.esc_attr($target).'">';
		                	}
			                	$img = ascend_get_image($image_width, $image_height, $image_crop, null, null, $c_item['attachment_id'], false);
						        if( ascend_lazy_load_filter() ) {
						            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
						        } else {
						            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
						        }
			 					echo '<div class="kt-intrinsic" style="padding-bottom:'.(($img['height']/$img['width']) * 100).'%;">';
			 						echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'">';
			 					echo '</div>';
		                	
		                	if(!empty($c_item['link'])){
		                		echo '</a>';
		                	}
		                
		                	echo '<div class="custom_carousel_details">';
			                	if(!empty($c_item['link'])){
			                		echo '<a href="'.esc_url($c_item['link']).'" class="custom_carousel_content_link" target="'.esc_attr($target).'">';
			                	}
			                    	if (!empty($c_item['title'])){
			                    		echo '<h5>'.esc_html($c_item['title']).'</h5>'; 
			                    	}
			                   	if(!empty($c_item['link'])){
			                		echo '</a>';
			                	}
			                    echo '<div class="ccarousel_excerpt">';
				                    if(!empty($c_item['description'])){
				                    	echo $c_item['description'];
				                    }
				                echo '</div>';
		                	echo '</div>';
		            	echo '</div>';
		            echo '</div>';
            	endforeach; 
        	} ?>
      		</div>
  		</div>
	</div>
</div>