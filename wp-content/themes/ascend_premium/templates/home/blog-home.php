<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $ascend;
	// Check for Sidebar
	if(isset($ascend['home_post_column'])) {
	} 

	if(!empty($ascend['home_blog_title'])) {
		$btitle = $ascend['home_blog_title'];
	} else { 
		$btitle = '';
	}
	if(isset($ascend['home_blog_style'])) {
		$type = $ascend['home_blog_style'];
	} else {
		$type = 'grid'; 
	}
	if(isset($ascend['home_post_count'])) {
		$blogcount = $ascend['home_post_count'];
	} else {
		$blogcount = '4'; 
	}
	if(isset($ascend['home_post_column'])) {
		$blogcolumns = $ascend['home_post_column'];
	} else {
		$blogcolumns = '3'; 
	}
	if(!empty($ascend['home_post_type'])) { 
		$blog_cat = get_term_by ('id',$ascend['home_post_type'],'category');
		$blog_cat_slug = $blog_cat -> slug;
	} else {
		$blog_cat_slug = '';
	}

echo '<div class="home_blog home-margin clearfix home-padding">';
	if(!empty($btitle)) {
		echo '<div class="clearfix">';
			echo '<h3 class="hometitle">';
				echo '<span>'.esc_html($btitle).'</span>';
			echo '</h3>';
		echo '</div>';
	}
	echo do_shortcode('[blog_posts type="'.$type.'" items="'.$blogcount.'" cat="'.$blog_cat_slug.'" columns="'.$blogcolumns.'" ]');
	if(isset($ascend['home_post_readmore']) && $ascend['home_post_readmore'] == 1) {
		if(isset($ascend['home_post_readmore_text'])) {
			$readmore = $ascend['home_post_readmore_text'];
		} else {
			$readmore = __('Read More', 'ascend'); 
		}
		if(isset($ascend['home_post_readmore_link'])) {
			$link = $ascend['home_post_readmore_link'];
		} else {
			$link = ''; 
		}
		echo '<div class="home_blog_readmore">';
			echo '<a href="'.esc_url(get_permalink($link)).'" class="btn btn-primary">'.esc_html($readmore).'</a>';
		echo '</div>';
	}
echo '</div>';