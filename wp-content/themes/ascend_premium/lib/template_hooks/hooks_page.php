<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function ascend_wp_link_pages() { 
	 wp_link_pages(array('before' => '<nav class="pagination kt-pagination">', 'after' => '</nav>', 'link_before'=> '<span>','link_after'=> '</span>'));
}
add_action( 'kadence_single_testimonial_content_after', 'ascend_wp_link_pages', 10 );

add_action( 'kt_content_top', 'ascend_shortcode_after_header', 40 );
function ascend_shortcode_after_header() {
	global $ascend;
	if(isset($ascend['sitewide_after_header_shortcode_input']) && !empty($ascend['sitewide_after_header_shortcode_input']) ) {
		echo do_shortcode($ascend['sitewide_after_header_shortcode_input']); 
	}
}
add_action( 'kadence_page_content', 'ascend_page_content_wrap_before', 10 );
function ascend_page_content_wrap_before() {
	echo '<div class="entry-content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">';
}
add_action( 'kadence_page_content', 'ascend_page_content', 20 );
function ascend_page_content() {
	get_template_part('templates/content', 'page'); 
}
add_action( 'kadence_page_content', 'ascend_page_content_wrap_after', 30 );
function ascend_page_content_wrap_after() {
	echo '</div>';
}

add_action( 'kadence_page_footer', 'ascend_page_comments', 20 );
function ascend_page_comments() {
	global $ascend;
	if(isset($ascend['page_comments']) && $ascend['page_comments'] == '1' && ! is_front_page() ) {
		comments_template('/templates/comments.php');
	}
}

add_action( 'kadence_page_title_container', 'ascend_page_title', 20 );
function ascend_page_title() {
	if(ascend_display_pagetitle()) {
		get_template_part('templates/page', 'header');
	} else {
		if( ascend_display_page_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin kt_bread_container">';
			ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}
add_action( 'kadence_front_page_title_container', 'ascend_front_page_header', 20 );
function ascend_front_page_header() {
	global $ascend;
	if(isset($ascend['mobile_switch']) && $ascend['mobile_switch'] == 1) {
		if(isset($ascend['home_mobile_header'])) { 
	  		$m_home_header = $ascend['home_mobile_header'];
	  	} else {
	  		$m_home_header = 'none';
	  	}
		if ($m_home_header == "ksp") {
			get_template_part('templates/mobile_home/mobile', 'ksp');
		} else if ($m_home_header == "basic") {
			get_template_part('templates/mobile_home/mobile', 'basic-slider');
		} else if ($m_home_header == "pagetitle") {
			get_template_part('templates/mobile_home/mobile', 'page-header');
		} else if ($m_home_header == "shortcode") {
			get_template_part('templates/mobile_home/mobile', 'shortcode-entry');
		}
	}
	if(isset($ascend['home_header'])) { 
		$home_header = $ascend['home_header'];
	} else {
		$home_header = 'pagetitle';
	}
	if ($home_header == "ksp") {
		get_template_part('templates/home/ksp', 'slider');
	} else if ($home_header == "basic") {
		get_template_part('templates/home/basic', 'slider');
	} else if ($home_header == "basic_post_carousel") {
		get_template_part('templates/home/post', 'carousel');
	} else if ($home_header == "shortcode") {
			get_template_part('templates/home/shortcode', 'entry');
	} else if ($home_header == "pagetitle") {
		get_template_part('templates/home/home', 'page-header');
	}
}
function ascend_breadcrumbs_position_above() {
	global $ascend;
	if( isset( $ascend[ 'breadcrumbs_position' ] ) && 'above' == $ascend[ 'breadcrumbs_position' ] ) {
		return true;
	} else {
		return false;
	}

}
function ascend_iso_filter($tax, $termtypes) {
	global $ascend;
	echo '<div id="options" class="kt-filter-options clearfix">';	
		if(!empty($ascend['filter_all_text'])) {
			$alltext = $ascend['filter_all_text'];
		} else {
			$alltext = __('All', 'ascend');
		}
		if(!empty($ascend['filter_text'])) {
			$filter_text = $ascend['filter_text'];
		} else {
			$filter_text = __('Filter', 'ascend');
		}
		$categories = get_terms($tax, $termtypes);
		$count 		= count($categories);
			echo '<a class="filter-trigger" data-toggle="collapse" data-target=".filter-collapse"> '.esc_html($filter_text).'</a>';
			echo '<ul id="filters" class="clearfix filter-set option-set filter-collapse">';
				echo '<li class="postclass"><a href="#" data-filter="*" title="All" class="selected"><h5>'.esc_html($alltext).'</h5><div class="arrow-up"></div></a></li>';
				if ( $count > 0 ){
					foreach ($categories as $category){ 
						$term_slug = strtolower($category->slug);
						echo '<li class="postclass kt-data-filter-'.esc_attr($term_slug).'"><a href="#" data-filter=".'.esc_attr($term_slug).'"><h5>'.esc_html($category->name).'</h5><div class="arrow-up"></div></a></li>';
					}
			 	}
			echo "</ul>"; 
	echo '</div>';

}