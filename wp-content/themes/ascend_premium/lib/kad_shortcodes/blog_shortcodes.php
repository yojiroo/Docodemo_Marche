<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for Blog Posts
function ascend_blog_shortcode_function( $atts ) {
	extract(shortcode_atts(array(
		'id' 			=> (rand(10,1000)),
		'orderby' 		=> 'date',
		'order' 		=> 'DESC',
		'type' 			=> 'normal',
		'speed' 		=> '7000',
		'columns' 		=> '3',
		'height' 		=> '400',
		'width' 		=> '800',
		'offset' 		=> null,
		'posttype'  	=> 'post',
		'cat' 			=> '',
		'ignore_sticky'	=> null,
		'ids'			=> '',
		'items' 		=> '4'
), $atts));
	if(empty($cat)) {
		$cat = '';
	}
	if($items == 'all') {
		$items = '-1';
	} 
	$lay = ascend_get_postlayout($type);
	global $kt_grid_columns, $kt_blog_loop, $kt_grid_carousel, $ascend_has_sidebar;
	$kt_blog_loop['loop'] = 1;
	$kt_grid_columns = $columns;
	$kt_grid_carousel = false;
	if(ascend_display_sidebar()) {
        $ascend_has_sidebar = true;
        if ($columns == '2') {
	        $itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    } else {
        $ascend_has_sidebar = false;
        if ($columns == '2') {
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    }
   	ob_start(); ?>
   	<div class="kt_blog_shortcode <?php echo esc_attr($lay['pclass']); ?>">
	   	<div class="kt_archivecontent <?php echo esc_attr($lay['tclass']);?>" <?php echo $lay['data'];?>> 
		   	<?php 
		   	if(isset($wp_query)) {
				$temp = $wp_query;
			} else {
				$temp = null;
			}
			$wp_query = null; 
			$wp_query = new WP_Query();
			$wp_query->query(array(
				'orderby' 				=> $orderby,
				'order' 				=> $order,
				'category_name'	 		=> $cat,
				'offset' 				=> $offset,
				'post_type' 			=> $posttype,
				'p' 					=> $ids,
				'ignore_sticky_posts' 	=> $ignore_sticky,
				'posts_per_page' 		=> $items
				)
			);
		if ( $wp_query ) : 
			$kt_blog_loop['count'] = $wp_query->post_count;

			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			if($lay['sum'] == 'full'){ 
                if (has_post_format( 'quote' )) {
                    get_template_part('templates/content', 'post-full-quote'); 
                } else {
                    get_template_part('templates/content', 'post-full'); 
                }
	        } else if($lay['sum'] == 'grid') { 
	        	if($lay['highlight'] == 'true' && $kt_blog_loop['loop'] == 1) {
                    get_template_part('templates/content', get_post_format());
                } else { ?>
                   	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
                   		<?php get_template_part('templates/content', 'post-grid'); ?>
                   	</div>
               <?php }
	        } else if($lay['sum'] == 'photo') { ?>
               	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
               		<?php get_template_part('templates/content', 'post-photo-grid'); ?>
               	</div>
	        <?php
	        } else if($lay['sum'] == 'mosaic') { 
	            get_template_part('templates/content', 'post-mosaic-grid'); 
	        } else if($lay['sum'] == 'below_title') {
	        	get_template_part('templates/content', 'post-title-above');
	        } else { 
	        	get_template_part('templates/content', get_post_format());
	        }
	        $kt_blog_loop['loop'] ++;
        endwhile; else: ?>
			<div class="error-not-found"><?php _e('Sorry, no blog entries found.', 'ascend'); ?></div>
		<?php 
		endif; 

		if ($wp_query->max_num_pages > 1) : 
				ascend_wp_pagenav();   
		endif; 
		$wp_query = $temp;  // Reset 
		wp_reset_query(); ?>
		</div>
	</div>
	<?php  	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}