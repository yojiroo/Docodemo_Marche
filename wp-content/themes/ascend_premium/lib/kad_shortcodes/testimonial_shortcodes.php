<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for Testimonial Posts
function ascend_testimonial_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' 	=> 'menu_order',
		'order' 	=> null,
		'group' 	=> null,
		'id' 		=> (rand(10,100)),
		'columns' 	=> '3',
		'content' 	=> 'excerpt',
		'offset' 	=> null,
		'link' 		=> 'false',
		'isostyle' 	=> 'masonry',
		'items' 	=> '3'
), $atts));
	if(!empty($order) ) {
		$order = $order;
	} else if($orderby == 'menu_order' || $orderby == 'title') {
		$order = 'ASC';
	} else {
		$order = 'DESC';
	} 
		global $kt_testimonial_loop;
		$kt_testimonial_loop = array(
        	'columns' 	=> $columns,
         	'content' 	=> $content,
         	'link' 		=> $link,
         	);
	ob_start(); ?>
	<div class="testimonial-shortcode">
		<div id="testimonial-wrapper-<?php echo esc_attr($id);?>" class="row reinit-isotope testimonial-wrapper init-isotope" data-iso-selector=".t_item" data-iso-style="<?php echo esc_attr($isostyle);?>" data-iso-filter="false"> 
            <?php 
            	if( isset( $wp_query ) ) {
            		$temp = $wp_query;
            	} else {
            		$temp = null;
            	}
				$wp_query = null; 
				$wp_query = new WP_Query();
				$wp_query->query(array(
				  	'orderby' 			=> $orderby,
				  	'order' 			=> $order,
				  	'offset' 			=> $offset,
				  	'post_type' 		=> 'testimonial',
				  	'testimonial-group'	=> $group,
				  	'posts_per_page' 	=> $items,
				  	)
				);
				if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
						get_template_part('templates/content', 'loop-testimonial'); 
					endwhile; else: ?>
					<div class="error-not-found"><?php _e('Sorry, no testimonial entries found.', 'ascend');?></div>
				<?php endif; ?>
                </div> <!-- testimonial-wrapper -->
            <?php 
            
            $wp_query = $temp;  // Reset
            wp_reset_query(); ?>
		</div><!-- /.testimonial-shortcode -->
            		

	<?php  $output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
	return $output;
}