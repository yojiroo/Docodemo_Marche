<?php 
  	get_header(); 
    /**
    * @hooked ascend_archive_title - 20
    */
     do_action('kadence_archive_title_container');
    ?>
	
    <div id="content" class="container clearfix">
   		<div class="row">
      		<div class="main <?php echo ascend_main_class(); ?>" role="main">
      			<div class="entry-content">
      				<?php echo category_description(); ?>
      			</div>
				<?php if (!have_posts()) : ?>
		            <div class="error-not-found entry-content">
		                <h5><?php _e('Sorry, no results were found.', 'ascend'); ?></h5>
		                <?php get_search_form(); ?>
		            </div>
				<?php endif; 
				global $ascend, $kt_portfolio_loop, $kt_portfolio_loop_count;
				if(isset($ascend['portfolio_tax_show_type']) && $ascend['portfolio_tax_show_type'] == '0') {
					$portfolio_item_types = 'false';
				} else {
					$portfolio_item_types = 'true';
				}
				if(isset($ascend['portfolio_tax_order'])) {
					$p_orderby = $ascend['portfolio_tax_order'];
				} else {
					$p_orderby = 'menu_order';
				}
				if($p_orderby == 'menu_order' || $p_orderby == 'title') {
			   		$p_order = 'ASC';
			   	} else {
			   		$p_order = 'DESC';
			   	}
				if(isset($ascend['portfolio_tax_show_excerpt']) && $ascend['portfolio_tax_show_excerpt'] == '1') {
					$portfolio_excerpt = 'true';
				} else {
					$portfolio_excerpt = 'false';
				}
				if(isset($ascend['portfolio_tax_show_lightbox']) && $ascend['portfolio_tax_show_lightbox'] == '0') {
					$portfolio_lightbox = 'false';
				} else {
					$portfolio_lightbox = 'true';
				}
				if(isset($ascend['portfolio_tax_style']) ) {
					$portfolio_style = $ascend['portfolio_tax_style'];
				} else {
			   		$portfolio_style = 'pgrid';
				}
				if(isset($ascend['portfolio_tax_ratio']) ) {
					$portfolio_ratio = $ascend['portfolio_tax_ratio'];
				} else {
					$portfolio_ratio = 'square';
				}
				if(isset($ascend['portfolio_tax_column']) ) {
			        $kt_grid_columns = $ascend['portfolio_tax_column'];
			    } else {
			        $kt_grid_columns = '4';
			    }

			    if($portfolio_ratio == 'softcrop') {
					$isostyle 	= 'masonry';
				} else {
					$isostyle 	= 'fitRows';
				}
				$tileheight = '0';
				$lastrow = 'nojustify';
			    if($portfolio_style == 'mosaic'){	
			    	$isoclass 	= 'init-mosaic-isotope'; 
			    	$isostyle 	= 'packery';
			    	$margins 	= 'row-nomargin';
			    } elseif($portfolio_style == 'poststyle') {
			    	$margins 	= 'row';
			    	$isoclass 	= 'init-isotope-intrinsic'; 
			    } elseif($portfolio_style == 'pgrid-no-margin') {
			    	$margins 	= 'row-nomargin';
			    	$isoclass 	= 'init-isotope-intrinsic'; 
			    } elseif($portfolio_style == 'tiles') {
			    	$margins 	= 'row-nomargin';
			    	$isoclass 	= 'init-tiles-justified'; 
			    	$tileheight = apply_filters('kadence_portfolio_tiles_height', '220' );
			    	$lastrow 	= apply_filters('kadence_portfolio_tiles_last_row', 'nojustify' );
			    } else {
			    	$isoclass 	= 'init-isotope-intrinsic'; 
			    	$margins 	= 'rowtight';
			    }

			    $kt_portfolio_loop = array(
			     	'lightbox' 		=> $portfolio_lightbox,
			     	'showexcerpt' 	=> $portfolio_excerpt,
			     	'showtypes' 	=> $portfolio_item_types,
			     	'columns' 		=> $kt_grid_columns,
			     	'ratio' 		=> $portfolio_ratio,
			     	'style' 		=> $portfolio_style,
			     	'carousel' 		=> 'false',
			     	'tileheight' 	=> $tileheight,
			    );
			    
					echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($portfolio_style).'">';
			            echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-iso-selector=".p_item" data-iso-style="'.esc_attr($isostyle).'" data-iso-filter="false" data-gallery-height="'.esc_attr($tileheight).'" data-gallery-lastrow="'.esc_attr($lastrow).'" data-gallery-margins="3">';
							
							global $wp_query;
							// get the query object
							$cat_obj = $wp_query->get_queried_object();
					 		$termslug = $cat_obj->slug;
					 		$tax = $cat_obj->taxonomy;
							query_posts( array(
								'paged' 			=> $paged,
								'orderby' 			=> $p_orderby,
								'order' 			=> $p_order,
								'post_type' 		=> 'portfolio',
								$tax  				=> $termslug,
								) 
							);
							
							if ( $wp_query ) : 
								$kt_portfolio_loop_count['loop'] = 1;
								$kt_portfolio_loop_count['count'] = $wp_query->post_count;
								while ( $wp_query->have_posts() ) : $wp_query->the_post();
											get_template_part('templates/content', 'loop-portfolio'); 
											$kt_portfolio_loop_count['loop']++;
								endwhile;
							endif; ?>
			            </div> <!--portfoliowrapper-->
			        </div> <!--portfoliowrapper-outer-->
                
                <?php if ($wp_query->max_num_pages > 1) :
                        ascend_wp_pagenav(); 
                endif;
				?>
			</div><!-- /.main -->
			<?php
			/**
		    * Sidebar
		    */
			if (ascend_display_sidebar()) : 
			      	get_sidebar();
		    endif; ?>
		</div><!-- /.row-->
	</div><!-- /.content -->
	<?php 
/**
* Footer
*/
get_footer(); ?>