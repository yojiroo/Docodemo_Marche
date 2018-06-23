<?php
	// Post Header
	global $post, $ascend; 
		$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
		$shortcode_slider = apply_filters('kt_shortcode_slider_header', get_post_meta( $post->ID, '_kad_shortcode_slider', true ) );
		$post_header_title = get_post_meta( $post->ID, '_kad_post_header_title', true );
		$title_color = get_post_meta( $post->ID, '_kad_pagetitle_title_color', true );
		$sub_color = get_post_meta( $post->ID, '_kad_pagetitle_sub_color', true );
		$title_align = get_post_meta( $post->ID, '_kad_pagetitle_align', true );
		$bg_color = get_post_meta( $post->ID, '_kad_pagetitle_bg_color', true );
		$bg_image = apply_filters( 'ascend_post_header_background_image', get_post_meta( $post->ID, '_kad_pagetitle_bg_image', true ), $post->ID );
		$bg_position = get_post_meta( $post->ID, '_kad_pagetitle_bg_position', true );
		$bg_repeat = get_post_meta( $post->ID, '_kad_pagetitle_bg_repeat', true );
		$bg_size = get_post_meta( $post->ID, '_kad_pagetitle_bg_size', true );
		$bg_parallax = get_post_meta( $post->ID, '_kad_pagetitle_bg_parallax', true );

		$t_large_size = get_post_meta( $post->ID, '_kad_title_fs_large', true );
		$t_small_size = get_post_meta( $post->ID, '_kad_title_fs_small', true );
		$s_large_size = get_post_meta( $post->ID, '_kad_sub_fs_large', true );
		$s_small_size = get_post_meta( $post->ID, '_kad_sub_fs_small', true );
		if(!empty($t_large_size)) {
			$title_data = $t_large_size;
		} else {
			if(isset($ascend['single_header_title_size'])){
				$title_data = $ascend['single_header_title_size'];
			} else {
				$title_data = '70';
			}
		}
		if(!empty($t_small_size)) {
			$title_small_data = $t_small_size;
		} else {
			if(isset($ascend['single_header_title_size_small'])){
				$title_small_data = $ascend['single_header_title_size_small'];
			} else {
				$title_small_data = '30';
			}
		}
		if(!empty($s_large_size)) {
			$subtitle_data = $s_large_size;
		} else {
			if(isset($ascend['single_header_subtitle_size'])){
				$subtitle_data = $ascend['single_header_subtitle_size'];
			} else {
				$subtitle_data = '40';
			}
		}
		if(!empty($s_small_size)) {
			$subtitle_small_data = $s_small_size;
		} else {
			if(isset($ascend['single_header_subtitle_size_small'])){
				$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
			} else {
				$subtitle_small_data = '20';
			}
		}

	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		if(isset($bg_position)) {$b_position = 'background-position:'.$bg_position.';'; }
		if($bg_repeat) {$brepeat = 'background-repeat:repeat;';} else {$brepeat = 'background-repeat:no-repeat;';}
		if(!empty($bg_size)) {$bsize = 'background-size:'.$bg_size.';';} else {$bsize = "";}
		if($bg_parallax) {$b_parallax = 'kad-ascend-parallax';} else {$b_parallax = '';}

	} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bsize = ""; $b_parallax = ''; $b_parallax_data = '';
		if(!empty($bg_color) && $bg_color != '#') {
			$bcolor = 'background:'.$bg_color.';';
		} else {
			$bcolor = '';
		}
	}
	if(!empty($title_align) && $title_align != 'default') {
		$talign = 'text-align:'.$title_align.';';
	} else {
		$talign = '';
	}
	$title_tag = 'h1';
	// Sinlge Product
	if(is_singular('product')){
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if(isset($ascend['product_post_title_content']) && $ascend['product_post_title_content'] == 'custom') {
			if(isset($ascend['product_header_title_text'])) {
				$page_title_title = $ascend['product_header_title_text']; 
			} else { 
				$page_title_title = '';
			}
			if(!empty($ascend['product_header_subtitle_text'])) {
				$bsub = $ascend['product_header_subtitle_text'];
			}
		} else if (isset($ascend['product_post_title_content']) && $ascend['product_post_title_content'] == 'category') {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('product_cat', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
		} else {
			$page_title_title =  get_the_title();
		}
		if( ascend_display_product_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
		if( isset( $ascend['product_post_title_tag'] ) && !empty( $ascend['product_post_title_tag'] ) ) {
			$title_tag = $ascend['product_post_title_tag'];
		} else {
			$title_tag = 'h1';
		}
	} else if(is_singular('portfolio')){
		// Sinlge Portfolio
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if(isset($ascend['portfolio_post_title_content']) && $ascend['portfolio_post_title_content'] == 'custom') {
			if(isset($ascend['portfolio_header_title_text'])) {
				$page_title_title = $ascend['portfolio_header_title_text']; 
			} else { 
				$page_title_title = '';
			}
			if(!empty($ascend['portfolio_header_subtitle_text'])) {
				$bsub = $ascend['portfolio_header_subtitle_text'];
			}
		} else if (isset($ascend['portfolio_post_title_content']) && $ascend['portfolio_post_title_content'] == 'portfolio-type') {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('portfolio-type', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
		} else {
			$page_title_title =  get_the_title();
		}
		if( ascend_display_portfolio_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
		if( isset( $ascend['portfolio_post_title_tag'] ) && !empty( $ascend['portfolio_post_title_tag'] ) ) {
			$title_tag = $ascend['portfolio_post_title_tag'];
		} else {
			$title_tag = 'h1';
		}
	} else if(is_singular('testimonial')){
		// Sinlge testimonial
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if(isset($ascend['testimonial_post_title_content']) && $ascend['testimonial_post_title_content'] == 'custom') {
			if(isset($ascend['testimonial_header_title_text'])) {
				$page_title_title = $ascend['testimonial_header_title_text']; 
			} else { 
				$page_title_title = '';
			}
			if(!empty($ascend['testimonial_header_subtitle_text'])) {
				$bsub = $ascend['testimonial_header_subtitle_text'];
			}
		} else if (isset($ascend['testimonial_post_title_content']) && $ascend['testimonial_post_title_content'] == 'group') {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('testimonial-group', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'testimonial-group', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'testimonial-group', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
			
		} else {
			$page_title_title =  get_the_title();
		}
		if( ascend_display_testimonial_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
		if( isset( $ascend['testimonial_post_title_tag'] ) && !empty( $ascend['testimonial_post_title_tag'] ) ) {
			$title_tag = $ascend['testimonial_post_title_tag'];
		} else {
			$title_tag = 'h1';
		}
	} else if(is_singular('staff')){
		// Sinlge staff
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if(isset($ascend['staff_post_title_content']) && $ascend['staff_post_title_content'] == 'custom') {
			if(isset($ascend['staff_header_title_text'])) {
				$page_title_title = $ascend['staff_header_title_text']; 
			} else { 
				$page_title_title = '';
			}
			if(!empty($ascend['staff_header_subtitle_text'])) {
				$bsub = $ascend['staff_header_subtitle_text'];
			}
		} else if (isset($ascend['staff_post_title_content']) && $ascend['staff_post_title_content'] == 'group') {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('staff-group', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'staff-group', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'staff-group', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
		} else {
			$page_title_title =  get_the_title();
		}
		if( ascend_display_staff_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
		if( isset( $ascend['staff_post_title_tag'] ) && !empty( $ascend['staff_post_title_tag'] ) ) {
			$title_tag = $ascend['staff_post_title_tag'];
		} else {
			$title_tag = 'h1';
		}
	} else if(is_singular('post')){
		// Blog Post
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if(isset($ascend['blog_post_title_content']) && $ascend['blog_post_title_content'] == 'custom') {
			if( isset ( $ascend['blog_header_title_text'] ) ) {
				$page_title_title = $ascend['blog_header_title_text'];
			} else { 
				$page_title_title = '';
			}
			if(!empty($ascend['blog_header_subtitle_text'])){ $bsub = $ascend['blog_header_subtitle_text'];}
		} else if (isset($ascend['blog_post_title_content']) && $ascend['blog_post_title_content'] == 'posttitle') {
			$page_title_title =  get_the_title();
		} else {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('category', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'category', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'category', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
		}
		if( ascend_display_post_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
		if( isset( $ascend['post_title_tag'] ) && !empty( $ascend['post_title_tag'] ) ) {
			$title_tag = $ascend['post_title_tag'];
		} else {
			$title_tag = 'h1';
		}
	} else if(is_singular('tribe_events')){
		// Tribe
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else {
			$page_title_title = tribe_get_event_label_singular();
		} 
		if( ascend_display_post_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
	} else if(is_singular('event')){
		// Events
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if (isset($ascend['blog_post_title_content']) && $ascend['blog_post_title_content'] == 'posttitle') {
			$page_title_title =  get_the_title();
		} else {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('event-category', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'event-category', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						if( is_array($terms) ) {
							$main_term = $terms[0];
						}
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'event-category', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
          		if( is_array($terms) ) {
					$main_term = $terms[0];
				}
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
	    }
	    if( ascend_display_post_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
	} else if(is_singular('podcast')){
		// Podcast
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else if (isset($ascend['blog_post_title_content']) && $ascend['blog_post_title_content'] == 'posttitle') {
			$page_title_title =  get_the_title();
		} else {
			$main_term = '';
            if(class_exists('WPSEO_Primary_Term')) {
          		$WPSEO_term = new WPSEO_Primary_Term('series', $post->ID);
				$WPSEO_term = $WPSEO_term->get_primary_term();
				$WPSEO_term = get_term($WPSEO_term);
				if (is_wp_error($WPSEO_term)) { 
					if ( $terms = wp_get_post_terms( $post->ID, 'series', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
						$main_term = $terms[0];
					}
				} else {
					$main_term = $WPSEO_term;
				}
          	} elseif ( $terms = wp_get_post_terms( $post->ID, 'series', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                $main_term = $terms[0];
            }
        	if($main_term){
	            $page_title_title = $main_term->name;
	        } else {
	            $page_title_title = '';
	        }
	    }
	    if( ascend_display_post_breadcrumbs()) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
	} else {
		// Other singe post.
		if(!empty($post_header_title)) {
			$page_title_title = $post_header_title;
		} else  {
			$page_title_title =  get_the_title();
		} 
		if( apply_filters('kadence_custom_post_type_breadcrumbs', false, $post) ) {
		 	$breadcrumb = true;
		 	if( ascend_breadcrumbs_position_above() ) {
				$breadcrumb_position = "above";
				$breadclass = "kt_bc_inner_active";
			} else {
				$breadcrumb_position = "below";
				$breadclass = "kt_bc_active";
			}
		} else {
		 	$breadcrumb = false;
		 	$breadclass = "kt_bc_not_active";
		 	$breadcrumb_position = 'none';
		}
	}

if(!empty($shortcode_slider)) { ?>
			<div class="sliderclass post-header-area">
				<?php echo do_shortcode( $shortcode_slider); ?>
			</div><!--sliderclass-->
<?php } else { ?>
	<div id="pageheader" class="titleclass post-header-area <?php echo esc_attr( $b_parallax.' '.$breadclass );?>" style="<?php echo esc_attr($bcolor).' '.esc_attr($b_image).' '.esc_attr($b_position).' '.esc_attr($brepeat).' '.esc_attr($bsize);?>">
	<div class="header-color-overlay"></div>
	<?php do_action("kt_header_overlay"); ?>
		<div class="container">
			<div class="page-header" style="<?php echo esc_attr($talign);?>">
				<div class="page-header-inner">
					<?php do_action('ascend_above_post_title'); 
					if( $breadcrumb && 'above' == $breadcrumb_position ) { 
						ascend_breadcrumbs( $scolor );
					}
					$title_tag = apply_filters('ascend_post_title_tag', $title_tag);

					echo '<'.esc_attr($title_tag).' style="'.esc_attr($tcolor).'" class="post_head_title top-contain-title entry-title" itemprop="name" data-max-size="'.esc_attr($title_data).'" data-min-size="'.esc_attr($title_small_data).'">'.wp_kses_post( $page_title_title ).' </'.esc_attr($title_tag).'>';

					?>
					<?php if(!empty($bsub)) { echo '<p class="subtitle" data-max-size="'.esc_attr($subtitle_data).'" data-min-size="'.esc_attr($subtitle_small_data).'" style="'.esc_attr( $scolor ).'"> '.do_shortcode($bsub).' </p>'; } ?>
					<?php do_action('ascend_below_post_title'); ?>
				</div>
			</div>
		</div><!--container-->
		<?php  if( $breadcrumb && 'below' == $breadcrumb_position ) { 
				ascend_breadcrumbs();
			} ?>
	</div><!--titleclass-->
<?php } 