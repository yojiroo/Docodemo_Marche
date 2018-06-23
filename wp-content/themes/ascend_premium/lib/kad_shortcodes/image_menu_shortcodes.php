<?php 
//Shortcode for image menu
function ascend_image_menu_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'type'		=> 'fixed_height',
		'height' 	=> '220',
		'image_id' 	=> null,
		'image_url' => null,
		'title'		=> null,
		'subtitle' 	=> null,
		'link' 		=> null,
		'class' 	=> null,
		'align' 	=> 'left',
		'valign' 	=> 'center',
		'target' 	=> '_self',
), $atts));            
   	$output = ascend_build_image_menu( $image_id, $type, $height, $link, $target, $title, $subtitle, $align,  $valign, $class, $image_url);
	
	return $output;
}
if(!function_exists('ascend_build_image_menu')) {
	function ascend_build_image_menu( $imageid = null, $type = 'fixed_height', $height = '220', $link = null, $target = '_self', $title = null, $subtitle = null, $align = 'left',  $valign = 'center', $class = null, $image_url) {
		if(empty($imageid) && empty($image_url)) {
			return;
		}
		ob_start(); 
			if($type == 'image_height') { 
				$csstype = 'image-menu-image-size';
			} else {
				$csstype = 'image-menu-fixed-height';
			}
			if(empty($imageid)) {
				$image = array($image_url, null, null);
				$alt = $title;
			} elseif($type != 'image_height' && !empty($image_url)) {
				$image = array($image_url, null, null);
				$alt = $title;
			} else {
				$image = wp_get_attachment_image_src($imageid, 'full' );
				$alt = get_post_meta($imageid, '_wp_attachment_image_alt', true);
			}
			?>
			<div class="<?php echo esc_attr($csstype);?> image-menu_item <?php echo esc_attr($class);?>">
			    <?php if(!empty($link)) {
		    		echo '<a href="'.esc_attr($link).'" class="image_menu_item_link" target="'.esc_attr($target).'">';
		    	} else {
		    		echo '<div class="image_menu_item_link">';
		    	}?>
			        <?php if($type == 'image_height') { ?>
	                	<img src="<?php echo esc_url($image['0']);?>" width="<?php echo esc_attr($image['1']); ?>" height="<?php echo esc_attr($image['2']); ?>" alt="<?php echo esc_attr($alt);?>" />
	                <?php } else { ?>
	                		<div class="image_menu-bg-item" style="background: url(<?php echo esc_url($image['0']); ?>) center center no-repeat; height:<?php echo esc_attr($height) ?>px; background-size:cover;">
				        </div>
	                <?php } ?>
                	<div class="image_menu_overlay"></div>
                    <div class="image_menu_message  <?php echo 'imt-align-'.esc_attr($align);?> <?php echo 'imt-valign-'.esc_attr($valign);?>">
                    	<div class="image_menu_message_inner">
			        		<?php if (!empty($title)) {
			        			echo '<h4>'.$title.'</h4>';
			        		} 
			        		if (!empty($subtitle)) {
			            		echo '<h5>'.$subtitle.'</h5>';
			            	}?>
			            </div>
				    </div>
	        	<?php if(!empty($link)) {
        			echo '</a>'; 
        		} else {
        			echo '</div>';
        		}?>
			</div>
		<?php
    	$output = ob_get_contents();
		ob_end_clean();

	return $output;
	
	}
}