<?php
	// Shop Page Header
	global $ascend; 

	$post_id = wc_get_page_id('shop');
	if(!empty($post_id)) {
		$bsub = get_post_meta( $post_id, '_kad_subtitle', true );
		$shortcode_slider = apply_filters('kt_shortcode_slider_header', get_post_meta( $post_id, '_kad_shortcode_slider', true ) );
		$title_color = get_post_meta( $post_id, '_kad_pagetitle_title_color', true );
		$sub_color = get_post_meta( $post_id, '_kad_pagetitle_sub_color', true );
		$title_align = get_post_meta( $post_id, '_kad_pagetitle_align', true );
		$bg_color = get_post_meta( $post_id, '_kad_pagetitle_bg_color', true );
		$bg_image = get_post_meta( $post_id, '_kad_pagetitle_bg_image', true );
		$bg_position = get_post_meta( $post_id, '_kad_pagetitle_bg_position', true );
		$bg_repeat = get_post_meta( $post_id, '_kad_pagetitle_bg_repeat', true );
		$bg_size = get_post_meta( $post_id, '_kad_pagetitle_bg_size', true );
		$bg_parallax = get_post_meta( $post_id, '_kad_pagetitle_bg_parallax', true );

		$t_large_size = get_post_meta( $post_id, '_kad_title_fs_large', true );
		$t_small_size = get_post_meta( $post_id, '_kad_title_fs_small', true );
		$s_large_size = get_post_meta( $post_id, '_kad_sub_fs_large', true );
		$s_small_size = get_post_meta( $post_id, '_kad_sub_fs_small', true );
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
			if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}
		}
		if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
		
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
			$subtitle_data = '30';
		}
	}
	if(!empty($s_small_size)) {
		$subtitle_small_data = $s_small_size;
	} else {
		if(isset($ascend['single_header_subtitle_size_small'])){
			$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
		} else {
			$subtitle_small_data = '18';
		}
	}
	if( ascend_display_shop_breadcrumbs()) {
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
	if( isset( $ascend['page_title_tag'] ) && !empty( $ascend['page_title_tag'] ) ) {
		$title_tag = $ascend['page_title_tag'];
	} else {
		$title_tag = 'h1';
	}

if(!empty($shortcode_slider)) { ?>
	<div class="sliderclass page-header-area">
		<?php echo do_shortcode( $shortcode_slider); ?>
	</div><!--sliderclass-->
<?php } else { ?>
	<div id="pageheader" class="titleclass post-header-area <?php echo esc_attr( $b_parallax.' '.$breadclass );?>" style="<?php echo esc_attr($bcolor).' '.esc_attr($b_image).' '.esc_attr($b_position).' '.esc_attr($brepeat).' '.esc_attr($bsize);?>">
	<div class="header-color-overlay"></div>
	<?php do_action("kt_header_overlay"); ?>
		<div class="container">
			<div class="page-header" style="<?php echo esc_attr( $talign );?>">
				<div class="page-header-inner">
					<?php 
					if( $breadcrumb && 'above' == $breadcrumb_position ) { 
						ascend_breadcrumbs( $scolor );
					}
					$title_tag = apply_filters('ascend_page_title_tag', $title_tag);
					
					echo '<'.$title_tag.' style="'.esc_attr($tcolor).'" class="page_head_title top-contain-title entry-title" itemprop="name" data-max-size="'.esc_attr($title_data).'" data-min-size="'.esc_attr($title_small_data).'">';
						echo apply_filters('kadence_page_title', woocommerce_page_title() ); 
					echo '</'.$title_tag.'>';

					if(!empty($bsub)) { echo '<p class="subtitle" data-max-size="'.esc_attr($subtitle_data).'" data-min-size="'.esc_attr($subtitle_small_data).'" style="'.esc_attr( $scolor ).'"> '.do_shortcode($bsub).' </p>'; } ?>
				</div>
			</div>
		</div><!--container-->
		<?php  if( $breadcrumb && 'below' == $breadcrumb_position ) { 
				ascend_breadcrumbs();
			} ?>
	</div><!--titleclass-->
<?php } 