<?php
// Archive header
global $ascend;
	if(is_tax(array('product_cat', 'product_tag', 'portfolio-type', 'portfolio-tag', 'staff-group', 'testimonial-group', 'kt_album', 'speaker', 'series')) || is_category() || is_tag() ) {
		$cat_term_id = get_queried_object()->term_id;
		$meta = get_option('ascend_archive_pageheader');
		if (empty($meta)) $meta = array();
		if (!is_array($meta)) $meta = (array) $meta;
		$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
		if(isset($meta['kad_pagetitle_title_color'])) {$title_color = $meta['kad_pagetitle_title_color'];}
		if(isset($meta['kad_pagetitle_sub_color'])) {$sub_color = $meta['kad_pagetitle_sub_color'];}
		if(isset($meta['kad_pagetitle_align'])) { $title_align = $meta['kad_pagetitle_align'];}
		if(isset($meta['kad_pagetitle_bg_color'])) {$bg_color = $meta['kad_pagetitle_bg_color']; }
		if(isset($meta['kad_pagetitle_bg_image'])) { $bg_image_array = $meta['kad_pagetitle_bg_image']; $src = wp_get_attachment_image_src($bg_image_array[0], 'full'); $bg_image = $src[0];}
		if(isset($meta['kad_pagetitle_bg_position'])) { $bg_position = $meta['kad_pagetitle_bg_position']; }
		if(isset($meta['kad_pagetitle_bg_repeat'])) {$bg_repeat = $meta['kad_pagetitle_bg_repeat']; }
		if(isset($meta['kad_pagetitle_bg_size'])) {$bg_cover = $meta['kad_pagetitle_bg_size']; }
		if(isset($meta['kad_pagetitle_subtitle'])) {$bsub = $meta['kad_pagetitle_subtitle']; }
		if(isset($meta['kad_pagetitle_bg_parallax'])) {$bg_parallax = $meta['kad_pagetitle_bg_parallax'];}
		if(isset($meta['kad_shortcode_slider'])) {$shortcode = apply_filters('kt_shortcode_slider_header', $meta['kad_shortcode_slider']); } else { $shortcode = apply_filters('kt_shortcode_slider_header', ''); }

		if(isset($meta['kad_pagetitle_title_fs_large'])) {$t_large_size = $meta['kad_pagetitle_title_fs_large'];}
		if(isset($meta['kad_pagetitle_title_fs_small'])) {$t_small_size = $meta['kad_pagetitle_title_fs_small'];}
		if(isset($meta['kad_pagetitle_sub_fs_large'])) {$s_large_size = $meta['kad_pagetitle_sub_fs_large'];}
		if(isset($meta['kad_pagetitle_sub_fs_small'])) {$s_small_size = $meta['kad_pagetitle_sub_fs_small'];}
	}
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
			$subtitle_data = '34';
		}
	}
	if(!empty($s_small_size)) {
		$subtitle_small_data = $s_small_size;
	} else {
		if(isset($ascend['single_header_subtitle_size_small'])){
			$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
		} else {
			$subtitle_small_data = '15';
		}
	}
	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		if(isset($bg_position)) {$b_position = 'background-position:'.$bg_position.';'; }
		if(isset($bg_repeat) && $bg_repeat == '1') {$brepeat = 'background-repeat:repeat;';} else {$brepeat = 'background-repeat:no-repeat;';}
		if(isset($bg_cover))  {$bcover = 'background-size:'.$bg_cover.';';} else {$bcover = "";}
		if(isset($bg_parallax) && $bg_parallax == '1') {$b_parallax = 'kad-ascend-parallax'; } else {$b_parallax = '';}

	} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bcover = ""; $b_parallax = '';
		if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}}
	if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
	if( ascend_display_archive_breadcrumbs()) {
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
if(!empty($shortcode)) { ?>
		<div class="sliderclass archive-header-area">
		<?php echo do_shortcode( $shortcode); ?>
		</div><!--sliderclass-->
<?php } else { ?>
<div id="pageheader" class="titleclass archive-header-area <?php echo esc_attr($breadclass.' '.$b_parallax);?>" style="<?php echo $bcolor.' '.$b_image.' '.$b_position.' '.$brepeat.' '.$bcover;?>">
<div class="header-color-overlay"></div>
<?php do_action("kt_header_overlay"); ?>
	<div class="container">
		<div class="page-header" style="<?php echo esc_attr($talign);?>">
			<div class="page-header-inner">
			<div class="header-case">
				<?php do_action('ascend_above_archive_title'); 
					if( $breadcrumb && 'above' == $breadcrumb_position ) { 
						ascend_breadcrumbs( $scolor );
					}
					$title_tag = apply_filters('ascend_archive_title_tag', 'h1');

					echo '<'.esc_attr( $title_tag ).' style="'.esc_attr( $tcolor ).'" class="archive_head_title entry-title top-contain-title" data-max-size="'.esc_attr( $title_data ).'" data-min-size="'.esc_attr( $title_small_data ).'">'.wp_kses_post( ascend_title_archive() ).' </'.esc_attr( $title_tag ).'>';
					?>
		  		</div>
			  	<?php if(!empty($bsub)) { echo '<div class="subtitle" data-max-size="'.esc_attr($subtitle_data).'" data-min-size="'.esc_attr($subtitle_small_data).'" style="'.esc_attr( $scolor ).'"> '.$bsub.' </div>'; } ?>
			  	<?php do_action('ascend_below_archive_title'); ?>
			</div>
		</div>
	</div><!--container-->
	<?php  if( $breadcrumb && 'below' == $breadcrumb_position ) { 
				ascend_breadcrumbs();
			} ?>
</div><!--titleclass-->
<?php } 