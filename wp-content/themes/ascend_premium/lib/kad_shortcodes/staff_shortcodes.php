<?php 
//Shortcode for staff Posts
function ascend_staff_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'id' 		=> (rand(10,1000)),
		'orderby' 	=> 'menu_order',
		'order' 	=> null,
		'group' 	=> null,
		'offset' 	=> null,
		'columns' 	=> '3',
		'content' 	=> 'excerpt',
		'link' 		=> 'false',
		'filter' 	=> 'false',
		'ratio' 	=> 'ratio',
		'items' 	=> '4'
), $atts));
	global $kt_staff_loop;
	if(!empty($order) ) {
		$order = $order;
	} else if($orderby == 'menu_order' || $orderby == 'title') {
		$order = 'ASC';
	} else {
		$order = 'DESC';
	} 
	if(empty($group)) {
		$group = '';
		$staff_group_ID = '';
	} else {
		$staff_group = get_term_by ('slug',$group,'staff-group' );
		$staff_group_ID = $staff_group->term_id;
	}
	
	$kt_staff_loop = array(
     	'content' 	=> $content,
     	'link' 		=> $link,
     	'filter' 	=> $filter,
     	'ratio' 	=> $ratio,
     	'columns' 	=> $columns,
    );
    ob_start(); 
	if ($filter == 'true') { 
		$termtypes  = array( 'child_of' => $staff_group_ID );
		ascend_iso_filter('staff-group', $termtypes);
	} ?>
        <div id="staff_shortcode_wrapper" class="row entry-content staff-wrapper init-isotope reinit-isotope" data-iso-selector=".s_item" data-iso-style="masonry" data-iso-filter="<?php echo esc_attr($filter);?>"> 
            <?php 	if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					}
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'post_type' 	=> 'staff',
						'orderby' 		=> $orderby,
						'order' 		=> $order,
						'staff-group'	=> $group,
						'posts_per_page'=> $items));					
					if ( $wp_query ) : 	 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
						get_template_part('templates/content', 'loop-staff'); 
					endwhile; else: ?>
					 
					<div class="error-not-found"><?php _e('Sorry, no staff entries found.', 'ascend');?></div>
						
				<?php endif; ?>
        </div> <!--staff-wrapper-->
	
	<?php  
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
	return $output;
}