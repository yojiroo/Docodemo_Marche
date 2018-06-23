<?php
//Shortcode for year
function ascend_year_shortcode_function() {
    $year = date('Y');
	return $year;
}
function ascend_copyright_shortcode_function() {
	return '&copy;';
}
function ascend_sitename_shortcode_function() {
	$sitename = get_bloginfo('name');
	return $sitename;
}
function ascend_sitetagline_shortcode_function() {
	$sitetag = get_bloginfo ( 'description' );
	return $sitetag;
}
function ascend_themecredit_shortcode_function() {
	$my_theme = wp_get_theme();
	$output = '- WordPress Theme by <a href="'.$my_theme->{'Author URI'}.'">Kadence Themes</a>';
	return $output;
}

//Shortcode for accordion
function ascend_accordion_shortcode_function($atts, $content ) {
	extract(shortcode_atts(array(
		'id' => rand(1, 999)
	), $atts));
		global $kt_pane_count, $kt_panes;
		$kt_pane_count = 0;
		$kt_panes = array();
		$return = '';
		do_shortcode( $content );
		if( is_array( $kt_panes ) && !empty($kt_panes)){
			$i = 0;
			foreach( $kt_panes as $tab ){
				if ($i % 2 == 0) {
					$eo = "even";
				} else {
					$eo = "odd";
				}
				$tabs[] = '<div class="panel panel-default panel-'.esc_attr($eo).'"><div class="panel-heading"><a class="accordion-toggle '.esc_attr($tab['open']).'" data-toggle="collapse" data-parent="#accordionname'.esc_attr($id).'" href="#collapse'.esc_attr($id.$tab['link']).'"><h5><i class="kt-icon-minus"></i><i class="kt-icon-plus"></i>'.$tab['title'].'</h5></a></div><div id="collapse'.esc_attr($id.$tab['link']).'" class="panel-collapse collapse '.esc_attr($tab['in']).'"><div class="panel-body postclass">'.$tab['content'].'</div></div></div>';
				$i++;
			}
			$return = "\n".'<div class="panel-group kt-accordion" id="accordionname'.esc_attr($id).'">'.implode( "\n", $tabs ).'</div>'."\n";
		}
	return $return;
}

function ascend_accordion_pane_function($atts, $content ) {
	extract(shortcode_atts(array(
		'title' => 'Pane %d',
		'start' => ''
	), $atts));
	if (!empty($start) || $start == 'closed') {
		$open = '';
	} else {
		$open = 'collapsed';
	}
	if (!empty($start) || $start == 'closed') {
		$in = 'in';
	} else {
		$in = '';
	}
	global $kt_pane_count, $kt_panes;
	$x = $kt_pane_count;
	$kt_panes[$x] = array( 'title' => $title, 'open' => $open, 'in' => $in, 'link' => $kt_pane_count, 'content' =>  do_shortcode( $content ) );

	$kt_pane_count++;
}
//Shortcode for Tab
function ascend_tab_shortcode_function($atts, $content ) {
	extract(shortcode_atts(array(
		'id' => rand(1, 9999),
		'style' => '1',
	), $atts));
		global $kt_tab_count, $kt_tabs;
		$kt_tab_count = 0;
		$kt_tabs = array();
		$return = '';
		do_shortcode( $content );
		if( is_array( $kt_tabs ) && !empty($kt_tabs)) {
			foreach( $kt_tabs as $nav ){
				$tabnav[] = '<li class="'.esc_attr($nav['active']).'"><a href="#sctab'.esc_attr($id.$nav['link']).'" rel="nofollow">'.$nav['title'].'</a></li>';
			}
			foreach( $kt_tabs as $tab ){
				$tabs[] = '<div class="tab-pane clearfix '.esc_attr($tab['active']).'" id="sctab'.esc_attr($id.$tab['link']).'">'.$tab['content'].'</div>';
			}
			$return = "\n".'<ul class="nav kt-tabs kt-sc-tabs kt-tabs-style'.esc_attr($style).'">'.implode( "\n", $tabnav ).'</ul> <div class="kt-tab-content postclass">'.implode( "\n", $tabs ).'</div>'."\n";
		}
	return $return;
}

function ascend_tab_pane_function($atts, $content ) {
	extract(shortcode_atts(array(
		'title' => 'Tab %d',
		'start' => ''
	), $atts));
	if (!empty($start)) {
		$active = 'active';
	} else {
		$active = '';
	}
	global $kt_tab_count, $kt_tabs;

	$x = $kt_tab_count;
	$kt_tabs[$x] = array( 'title' => $title, 'active' => $active, 'link' => $kt_tab_count, 'content' =>  do_shortcode( $content ) );

	$kt_tab_count++;
}

//Shortcode for columns
function ascend_column_shortcode_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'class' => '',
			), $atts));
	return '<div class="row '.esc_attr($class).'">'.do_shortcode($content).'</div>';
}
function ascend_hcolumn_shortcode_function( $atts, $content ) {
	return '<div class="row">'.do_shortcode($content).'</div>';
}
function ascend_column11_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'xxl' => '',
			'xl' => '',
			'ss' => '',
			'sm' => '',
			'tablet' => '',
			'phone' => '',
			'class' => '',
			'css' =>''
			), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-11 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column10_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'xxl' => '',
			'xl' => '',
			'ss' => '',
			'sm' => '',
			'tablet' => '',
			'phone' => '',
			'class' => '',
			'css' =>''
			), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-10 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column9_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-9 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column8_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-8 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column7_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-7 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column6_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-6 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column5_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-5 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column4_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
			), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-4 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column3_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-3 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column2_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-2 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column25_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-25 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
function ascend_column1_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'xxl' => '',
		'xl' => '',
		'ss' => '',
		'sm' => '',
		'tablet' => '',
		'phone' => '',
		'class' => '',
		'css' =>''
		), $atts));
		if(!empty($xxl)) {
			$xxln = preg_replace('/[^0-9.]+/', '', $xxl); 
			$xxlclass = 'col-xxl-'.$xxln;
		} else {
			$xxlclass = "";
		}
		if(!empty($xl)) {
			$xln = preg_replace('/[^0-9.]+/', '', $xl);
			$xlclass = 'col-xl-'.$xln;
		} else {
			$xlclass = "";
		}
		if(!empty($sm)) {
			$smn = preg_replace('/[^0-9.]+/', '', $sm);
			$smclass = 'col-sm-'.$smn;
		} elseif(!empty($tablet)) {
			$smn = preg_replace('/[^0-9.]+/', '', $tablet);
			$smclass = 'col-sm-'.$smn;
		} else {
			$smclass = '';
		}
		if(!empty($ss)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $ss);
			$ssclass = 'col-ss-'.$ssn;
		} elseif(!empty($phone)) {
			$ssn = preg_replace('/[^0-9.]+/', '', $phone);
			$ssclass = 'col-ss-'.$ssn;
		} else {
			$ssclass = '';
		}
		return '<div class="col-md-1 '.esc_attr($xxlclass).' '.esc_attr($xlclass).' '.esc_attr($smclass).' '.esc_attr($ssclass).' '.esc_attr($class).'" style="'.$css.'">'.do_shortcode($content).'</div>';
}
//Shortcode for Icons
function ascend_icon_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'icon' => 'kt-icon-home',
		'size' => '20px',
		'color' => '#444',
		'style' => 'normal',
		'background' => '#eee',
		'border_width' => '0',
		'border_color' => '#444',
		'link' => '',
		'target' => '_self',
		'float'=> ''
	), $atts));
	if($style == 'circle') {
		$stylecss = 'kad-circle-iconclass';
	} else if($style == 'square') {
		$stylecss = 'kad-square-iconclass';
	} else {
		$stylecss = '';
	}
	ob_start(); ?>
		<?php if(!empty($link)) {echo '<a href="'.$link.'" target="'.$target.'" class="kadiconlink">'; } ?>
		<?php if(!empty($stylecss)){
			$boxsize = floor(preg_replace('/[^0-9.]+/', '', $size) + 10); ?>
			<span class="inner-icon-case <?php if(!empty($stylecss)) {echo esc_attr($stylecss);}?>" style="<?php if(!empty($background)) {echo 'background:'.esc_attr($background).';';}?> <?php if(!empty($float)){echo 'float:'.$float.';';}  if($border_width != '0') { echo 'border:'.$border_width.' solid '.$border_color.';';}?> <?php if(!empty($boxsize)) {echo 'width:'.esc_attr($boxsize).'px; height:'.esc_attr($boxsize).'px;';}?> ">
		<?php } ?>
			<i class="kt-shortcode-icon <?php echo esc_attr($icon);?>" 
		style="font-size:<?php echo esc_attr($size); ?>; color:<?php echo esc_attr($color);?>; 
		<?php if(empty($stylecss)){ if(!empty($float)){ echo 'float:'.$float.';';} } ?> <?php if(!empty($boxsize)) {echo 'line-height:'.esc_attr($boxsize).'px;';}?>
		"></i>
		<?php if(!empty($stylecss)){ 
			echo '</span>';
		}?>
		<?php if(!empty($link)) {echo '</a>'; } ?>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Shortcode for Info Boxes
function ascend_info_boxes_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'icon' 				=> '',
		'image' 			=> '',
		'alt' 				=> '',
		'id' 				=> (rand(10,1000)),
		'size' 				=> '48',
		'link' 				=> '',
		'target' 			=> '_self',
		'iconbackground'	=> '',
		'style' 			=> '',
		'color' 			=> '',
		'tcolor' 			=> '',
		'title' 			=> '',
		'iconside' 			=> 'left',
		'class' 			=> '',
		'background' 		=> ''
), $atts));
	if(empty($size)){
		$size = '48';
	}
	ob_start(); ?>
	<?php if(!empty($link)) {
		echo '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="kadinfolink">'; 
	} ?>
	<div class="kad-info-box kad-info-box-<?php echo esc_attr($id);?> <?php echo esc_attr($class); ?> infoicon-side-<?php echo esc_attr($iconside);?> clearfix" style="<?php if(!empty($background)) echo 'background:'.esc_attr($background);?>">
		<?php echo '<div class="kt-info-icon-case">';
			if(!empty($image)){
				echo '<img src="'.esc_url($image).'" alt="'.esc_attr($alt).'">';
			} else if(!empty($icon)){?> 
				<?php if(!empty($style) && ($style == "kad-circle-iconclass" || $style == "kad-square-iconclass")) {
					$boxsize = floor($size + 10);

					}?>
					<div class="inner-info-icon-case <?php if(!empty($style)) {echo esc_attr($style);}?>" style="<?php if(!empty($iconbackground)) {echo 'background:'.esc_attr($iconbackground).';';}?> <?php if(!empty($boxsize)) {echo 'width:'.esc_attr($boxsize).'px; height:'.esc_attr($boxsize).'px;';}?> "><i class="<?php echo esc_attr($icon);?>" style="font-size:<?php echo esc_attr($size);?>px; <?php if(!empty($color)) echo 'color:'.esc_attr($color).';';?> <?php if(!empty($boxsize)) {echo 'line-height:'.esc_attr($boxsize).'px;';}?>"></i></div>
			<?php }
			echo '</div>';
			?>
			<div class="kt-info-content-case" style="<?php if(!empty($tcolor)) { echo 'color:'.esc_attr($tcolor).';'; }?>">
			<?php	if(!empty($title)) { ?>
					<h4 style="<?php if(!empty($tcolor)) { echo 'color:'.esc_attr($tcolor).';';} ?>"><?php echo wp_kses_post($title);?></h4>
			<?php }
			 	echo do_shortcode($content); 
			echo '</div>'; ?>
	</div>
	<?php if(!empty($link)) {echo '</a>'; } 
	
	$output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Shortcode for Icons Boxes
function ascend_icon_menu_output($icon = 'kt-icon-cogs', $imageid = null, $link = null, $target = null, $title = null, $description = null, $readmore = null, $iconcolor = null, $iconbackground = null, $iconborder = null, $iconsize = null, $textcolor = null, $highlight = null, $class = null) {
		if(!empty($target)) {
			$target = $target;
		} else {
			$target = '_self';
		}
		if(!empty($iconbackground)) {
			$iconbackground = 'background-color:'.$iconbackground.';';
		} else {
			$iconbackground = '';
		}
		if(!empty($iconsize)) {
			$iconsize = 'font-size:'.$iconsize.'px;';
		} else {
			$iconsize = '';
		}
		if(!empty($iconcolor)) {
			$iconcolor = 'color:'.$iconcolor.';';
		} else {
			$iconcolor = '';
		}
		if(!empty($iconborder)) {
			$iconborder = 'border-color:'.$iconborder.';';
		} else {
			$iconborder = '';
		}
		if(!empty($textcolor)) {
			$textcolor = 'color:'.$textcolor.';';
		} else {
			$textcolor = '';
		}
		if(!empty($highlight)) {
			$highlight_border = 'border-color:'.$highlight.';';
			$highlight_bg = 'background-color:'.$highlight.';';
		} else {
			$highlight_border = '';
			$highlight_bg = '';
		}
		if(!empty($icon)) {
			$icon = $icon;
		} else {
			$icon = 'kt-icon-cogs';
		} 
		 	if(!empty($link)) {
            	echo '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"  title="'.strip_tags(esc_attr($title)).'" class="box-icon-item '.esc_attr($class).'">';
         	} else {
                echo '<div class="box-icon-item '.esc_attr($class).'">';
            } 
               	echo '<div class="icon-container" style="'.esc_attr($iconbackground).' '.esc_attr($iconcolor).' '.esc_attr($iconborder).'">';
                 	echo '<span class="icon-left-highlight icon-heighlight" style="'.esc_attr($highlight_border).'"></span>';
                    echo '<span class="icon-right-highlight icon-heighlight" style="'.esc_attr($highlight_border).'"></span>';
                    if(!empty($imageid)) {
                    	echo wp_get_attachment_image($imageid, 'full');
                    } else {
                    	echo '<i class="'.esc_attr($icon).'" style="'.esc_attr($iconsize).'"></i>'; 
                    }
                echo '</div>';
                if (!empty($title)){
                	echo '<h4 style="'.esc_attr($textcolor).'">'.$title.'</h4>';
                } 
                if (!empty($description)){
                 	echo '<div class="menu-icon-description" style="'.esc_attr($textcolor).'">'.$description.'</div>';
                }
                if (!empty($readmore)){
                 	echo '<div class="menu-icon-read-more" style="'.esc_attr($textcolor).'"><span class="read-more-highlight" style="'.esc_attr($highlight_bg).'"></span>'.$readmore.'</div>';
                }
            if(!empty($link)) {
                echo '</a>';
            } else { 
                echo '</div>';
            }
    }
function ascend_icon_boxes_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'id' 				=> (rand(10,1000)),
		'icon' 				=> 'kt-icon-cogs',
		'iconsize' 			=> null,
		'iconcolor' 		=> null,
		'iconbackground' 	=> null,
		'iconborder' 		=> null,
		'imageid' 			=> null,
		'textcolor' 		=> null,
		'highlight' 		=> null,
		'link' 				=> null,
		'target' 			=> '_self',
		'title' 			=> null,
		'description' 		=> null,
		'readmore' 			=> null,
		'class' 			=> null,
), $atts));
	ob_start(); 
	ascend_icon_menu_output($icon, $imageid, $link, $target, $title, $description, $readmore, $iconcolor, $iconbackground, $iconborder, $iconsize, $textcolor, $highlight, $class);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
//Shortcode for Flip Boxes
function ascend_flip_boxes_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'id' 				=> (rand(10,100)),
		'icon' 				=> 'kt-icon-rocket',
		'iconsize' 			=> '48px',
		'iconcolor' 		=> '#444',
		'titlecolor' 		=> '#444',
		'title' 			=> '',
		'description' 		=> '',
		'height' 			=> '',
		'titlesize' 		=> '20px',
		'fcolor' 			=> '#444',
		'image' 			=> '',
		'flip_content' 		=> '',
		'fbtn_text'	 		=> '',
		'fbtn_link' 		=> '#',
		'fbtn_color' 		=> '#fff',
		'fbtn_icon' 		=> '',
		'fbtn_background' 	=> 'transparent',
		'fbtn_border' 		=> '2px solid #fff',
		'fbtn_border_radius'=> '0',
		'background' 		=> '#fff',
		'border' 			=> '',
		'bcolor' 			=> '#fff',
		'bbackground' 		=> '#444',
		'fbtn_target' 		=> '_self'
	), $atts));
	$icon_color = 'color:'.$iconcolor.';';
	$front_color = 'color:'.$fcolor.';';
	if(!empty($border)) {
		$front_border = 'border:'.$border.';';
	} else {
		$front_border = '';
	}
	$title_color = 'color:'.$titlecolor.';';
	$front_background = 'background:'.$background.';';
	$back_background = 'background:'.$bbackground.';';
	$back_color = 'color:'.$bcolor.';';
	if(!empty($height)) {
		$content_height = 'height:'.$height.';';
	} else {
		$content_height = '';
	}
	$f_btn_background = 'background:'.$fbtn_background.';';
	$f_btn_color = 'color:'.$fbtn_color.';';
	$f_btn_border = 'border:'.$fbtn_border.';';
	$f_btn_border_radius = 'border-radius:'.$fbtn_border_radius.';';

	$output = '<div class="kt-flip-box-contain kt-mhover-inactive kt-m-hover kt-flip-box-'.esc_attr($id).'" style="'.esc_attr($content_height).'">';
	$output .= '<div class="kt-flip-box-flipper">';
		$output .= '<div class="kt-flip-box-front" style="'.esc_attr($front_color).' '.esc_attr($front_background).' '.esc_attr($front_border).'">';
			$output .= '<div class="kt-flip-box-front-inner">';
			if(!empty($image)) {
				$output .= '<img src="'.esc_url($image).'" class="kad-flip-box-img kt-flip-icon">';
			} else {
				$output .= '<i class="'.esc_attr($icon).' kad-flip-box-icon kt-flip-icon" style="font-size:'.esc_attr($iconsize).'; '.esc_attr($icon_color).'"></i>';
			}
			if(!empty($title) ){
				$output .= '<h4 style="'.esc_attr($title_color).' font-size:'.esc_attr($titlesize).'">'.esc_html($title).'</h4>';
			}
			if(!empty($description) ){
				$output .= '<p style="'.esc_attr($front_color).'; margin:0;">'.esc_html($description).'</p>';
			}
			$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="kt-flip-box-back" style="'.esc_attr($back_color).' '.esc_attr($back_background).'">';
			$output .= '<div class="kt-flip-box-back-inner">';
			$output .= '<div style="'.esc_attr($back_color).'">'.wp_kses_post($flip_content).'</div>';
			if(!empty($fbtn_text)) {
				$output .= '<a href="'.esc_url($fbtn_link).'" target="'.esc_attr($fbtn_target).'" style="'.esc_attr($f_btn_background).' '.esc_attr($f_btn_color).' '.esc_attr($f_btn_border).' '.esc_attr($f_btn_border_radius).'" class="kt-flip-btn button btn">'.esc_html($fbtn_text);
				if(!empty($fbtn_icon) ){
					$output .= ' <i class="'.esc_attr($fbtn_icon).'""></i>';
				}
				$output .= '</a>';
			}
			$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';

	return $output;
}
//Shortcode for modal
function ascend_modal_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'title' => 'Modal Title',
		'close' => 'true',
		'btntitle' => 'Click Here',
		'id' => '',
		'btnfont' => 'body',
		'btnsize' => 'medium',
		'btncolor' => '',
		'type' => 'button',
		'btnbackground' => ''
), $atts));
	if(empty($id)) {$id = rand(1, 99);}
	if($btnsize == 'large'){$sizeclass = "lg-kad-btn";} else if ($btnsize == 'small') {$sizeclass = "sm-kad-btn";} else {$sizeclass = "";}
	if($btnfont == 'h1-family'){$fontclass = "h1class";} else {$fontclass = "";}
	ob_start(); 
		if($type == 'link'){?>
			<a class="kt-modal-link-<?php echo esc_attr($id);?> kt-modal-link" data-toggle="modal" data-target="#kt-modal-<?php echo esc_attr($id);?>">
			 <?php echo esc_html($btntitle); ?>
			</a>
		<?php } else { ?>
			<button class="btn button <?php echo esc_attr($sizeclass).' '.esc_attr($fontclass);?> kt-modal-btn-<?php echo esc_attr($id);?> kt-modal-btn" style="<?php if(!empty($btnbackground)) {echo 'background-color:'.esc_attr($btnbackground).';'; } if(!empty($btncolor)) { echo 'color:'.esc_attr($btncolor).';';}?>" data-toggle="modal" data-target="#kt-modal-<?php echo esc_attr($id);?>">
			<?php echo esc_html($btntitle); ?>
			</button>
		<?php } ?>
	<!-- Modal -->
	<div class="modal fade" id="kt-modal-<?php echo esc_attr($id);?>" tabindex="-1" role="dialog" aria-labelledby="#kt-modal-label-<?php echo esc_attr($id);?>" aria-hidden="true">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h4 class="modal-title" id="kt-modal-label-<?php echo esc_attr($id);?>"><?php echo esc_html($title); ?></h4>
	      		</div>
	      		<div class="modal-body">
	        		<?php echo do_shortcode($content); ?>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn button" data-dismiss="modal"><?php echo __('Close', 'ascend');?></button>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
// Video Shortcode
function ascend_video_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'mp4' => '',
		'm4v' => ''
	), $atts));
	if(!empty($mp4)) {
		 $output = '<div class="videofit-embed"><video style="max-width:'.esc_attr($width).'px; width:100%;" controls><source type="video/mp4" src="'.$mp4.'"/></video></div>';
	} elseif(!empty($m4v)) {
		 $output = '<div class="videofit-embed"><video style="max-width:'.esc_attr($width).'px; width:100%;" controls><source type="video/m4v" src="'.$m4v.'"/></video></div>';
	} elseif(!empty($width)) { 
		$output = '<div style="max-width:'.esc_attr($width).'px;"><div class="videofit">'.$content.'</div></div>';
	} else { 
		$output = '<div class="videofit">'.$content.'</div>'; 
	}
	return $output;
}
function ascend_youtube_shortcode_function( $atts, $content) {
		$return = array();
		$params = array();
		$atts = shortcode_atts(array(
				'url'  => false,
				'width' => 600,
				'height' => 400,
				'maxwidth' => '',
				'autoplay' => 'false',
				'controls' => 'true',
				'hidecontrols' => 'false',
				'fs' => 'true',
				'loop' => 'false',
				'rel' => 'false',
				'vq' => '',
				'https' => 'true',
				'modestbranding' => 'false',
				'nocookie' => 'false',
				'theme' => 'dark'
		), $atts, 'kad_youtube' );

		if ( !$atts['url'] ) return '<p class="error">YouTube: ' . __( 'please specify correct url', 'ascend' ) . '</p>';
		$id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $atts['url'], $match ) ) ? $match[1] : false;
		// Check that url is specified
		if ( !$id ) return '<p class="error">YouTube: ' . __( 'please specify correct url', 'ascend' ) . '</p>';
		// Prepare params
		if($atts['hidecontrols'] == 'true') {$atts['controls'] = 'false';}
		foreach ( array('autoplay', 'controls', 'fs', 'modestbranding', 'theme', 'rel', 'loop' ) as $param ) $params[$param] = str_replace( array( 'false', 'true', 'alt' ), array( '0', '1', '2' ), $atts[$param] );
		// Prepare player parameters
		if(!empty($atts['vq']) ) {$params['vq'] = $atts['vq']; }
		$params = http_build_query( $params );
		if($atts['maxwidth']) {$maxwidth = 'style="max-width:'.$atts['maxwidth'].'px;"';} else{ $maxwidth = '';}
		if(isset($atts['nocookie']) && $atts['nocookie'] == 'true') {$youtubeurl = 'youtube-nocookie.com';} else{$youtubeurl = 'youtube.com';}
		$protocol = ( $atts['https'] === 'true' ) ? 'https' : 'http';
		// Create player
		$return[] = '<div class="kad-youtube-shortcode videofit" '.$maxwidth.' >';
		$return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="'.$protocol.'://www.'.$youtubeurl.'/embed/' . $id . '?' . $params . '" frameborder="0" allowfullscreen="true"></iframe>';
		$return[] = '</div>';
		// Return result
		return implode( '', $return );
}
function ascend_vimeo_shortcode_function( $atts, $content) {
		$return = array();
		$atts = shortcode_atts( array(
				'url'        	=> false,
				'id'        	=> false,
				'width'      	=> apply_filters('ascend_vimeo_default_width', 600 ),
				'height'     	=> apply_filters('ascend_vimeo_default_height', 400 ),
				'maxwidth' 		=> '',
				'https' 		=> 'true',
				'autoplay'   	=> 'no'
			), $atts, 'vimeo' );
		if ( ! $atts['url'] && ! $atts['id'] ) {
			return '<p class="error">Vimeo: ' . __( 'please specify correct url', 'ascend' ) . '</p>';
		}
		if ( ! $atts['id'] ) {
			$id = ( preg_match( '~(?:<iframe [^>]*src=")?(?:https?:\/\/(?:[\w]+\.)*vimeo\.com(?:[\/\w]*\/videos?)?\/([0-9]+)[^\s]*)"?(?:[^>]*></iframe>)?(?:<p>.*</p>)?~ix', $atts['url'], $match ) ) ? $match[1] : false;
		} else {
			$id = $atts['id'];
		}
		// Check that url is specified
		if ( !$id ) {
			return '<p class="error">Vimeo: ' . __( 'please specify correct url', 'ascend' ) . '</p>';
		}

		if ( $atts['maxwidth'] ) {
			$maxwidth = 'style="max-width:'.$atts['maxwidth'].'px;"';
		} else {
			$maxwidth = '';
		}
		$protocol = ( $atts['https'] === 'true' ) ? 'https' : 'http';
		$autoplay = ( $atts['autoplay'] === 'yes' || $atts['autoplay'] === 'true' ) ? '&amp;autoplay=1' : '';
		// Create player
		$return[] = '<div class="kad-vimeo-shortcode videofit" '.$maxwidth.'>';
		$return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] .
			'" src="'.$protocol.'://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' .
			$autoplay . '" frameborder="0" allowfullscreen="true"></iframe>';
		$return[] = '</div>';
		// Return result
		return implode( '', $return );
	}

//Image Split
function ascend_image_split_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'height' 				=> '500',
		'image' 				=> '',
		'image_id' 				=> '',
		'description_max_width' => null,
		'description_align' 	=> 'default',
		'image_cover' 			=> 'false',
		'img_background' 		=> '',
		'content_background' 	=> '',
		'text_color' 			=> null,
		'image_link' 			=> '',
		'link_target' 			=> '_self',
		'imageside' 			=> 'left',
		'id' 					=> rand(1, 999),
), $atts));
	if(!empty($description_max_width) && $description_max_width != '0'){
		$max_width = 'max-width:'.$description_max_width.'px;';
	} else {
		$max_width = '';
	}
	if(!empty($text_color)){
		$tcolor = 'color:'.$text_color.';';
	} else {
		$tcolor = '';
	}
	if(!empty($description_align) && $description_align != 'default'){
		$textalign = 'text-align:'.$description_align.';';
	} else {
		$textalign = '';
	}
	if(!empty($image_id)) {
		$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	} else {
		$alt = '';
	}
	ob_start(); ?>
	<!-- Image Split -->
	<div class="kt-image-split" id="kt-image-split-<?php echo esc_attr($id);?>">
	  	<div class="row-no-margin">
	    	<div class="col-md-6 kt-si-imagecol img-ktsi-<?php echo esc_attr($imageside);?> kt-animate-fade-in-<?php if($imageside == 'right') {echo 'left';} else {echo 'right';}?>" style="<?php if(!empty($img_background)) {echo 'background-color:'.esc_attr($img_background).';';} if($image_cover == 'true' && !empty($image)) {echo 'background-image:url('.esc_url($image).'); background-size:cover; background-position: center center; min-height:'.esc_attr($height / 2).'px;';}?>">
	      		<div class="kt-si-table-box" style="height:<?php echo esc_attr($height);?>px">
	      			<div class="kt-si-cell-box">
		      			<?php if(!empty($image_link)) { echo '<a href="'.esc_url($image_link).'" target="'.esc_attr($link_target).'" class="kt-si-image-link">';} 
		      		
			      		if($image_cover == 'true' && !empty($image)) {
			      			echo '<div class="kt-si-image kt-si-cover-image" style="max-height:'.esc_attr($height).'px;"></div>'; 
			      		} else if(!empty($image)){
			      			 echo '<img src="'.esc_url($image).'" alt="'.esc_attr($alt).'" class="kt-si-image" style="max-height:'.esc_attr($height).'px">'; 
			      		}

		      			if(!empty($image_link)) { echo '</a>';} ?>
	        		</div>
	      		</div>
	     	</div>
	     	<div class="col-md-6 kt-si-imagecol content-ktsi-<?php echo esc_attr($imageside);?> kt-animate-fade-in-<?php echo esc_attr($imageside);?>" <?php if(!empty($content_background)) {echo 'style="background-color:'.esc_attr($content_background).'"';}?>>
	      		<div class="kt-si-table-box" style="height:<?php echo esc_attr($height);?>px">
	      			<div class="kt-si-cell-box">
	      				<div class="kt-si-inner-content" style="<?php echo esc_attr($max_width.' '.$tcolor.' '.$textalign);?>">
 							<?php echo do_shortcode($content); ?>
 						</div>
	        		</div>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
// Social Shortcode 
function ascend_social_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'facebook' 				=> null,
		'twitter' 				=> null,
		'instagram' 			=> null,
		'googleplus' 			=> null,
		'flickr' 				=> null,
		'vimeo' 				=> null,
		'youtube' 				=> null,
		'pinterest' 			=> null,
		'dribbble' 				=> null,
		'linkedin' 				=> null,
		'tumblr' 				=> null,
		'stumbleupon' 			=> null,
		'vk' 					=> null,
		'viadeo' 				=> null,
		'xing' 					=> null,
		'soundcloud' 			=> null,
		'yelp' 					=> null,
		'snapchat' 				=> null,
		'behance' 				=> null,
		'rss' 					=> null,
		'title' 				=> 'tooltip',
		'tooltip_dir' 			=> 'top',
		'id' 					=> rand(1, 999),
), $atts));
		if($title == 'beside') {
	    	$class = "kt-text-beside";
	    } else {
	    	$class = "";
	    }
	    ob_start(); 
		echo '<div id="kt-social-'.esc_attr($id).'" class="kadence_social_widget '.esc_attr($class).' clearfix">';

	    if(!empty($facebook)):
	        echo '<a href="'.esc_url($facebook).'" class="facebook_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Facebook"><i class="kt-icon-facebook"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Facebook</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($twitter)):
	        echo '<a href="'.esc_url($twitter).'" class="twitter_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Twitter"><i class="kt-icon-twitter"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Twitter</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instagram)):
	        echo '<a href="'.esc_url($instagram).'" class="instagram_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Instagram"><i class="kt-icon-instagram"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Instagram</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($googleplus)):
	        echo '<a href="'.esc_url($googleplus).'" class="googleplus_link" rel="publisher" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="GooglePlus"><i class="kt-icon-google-plus"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">GooglePlus</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($flickr)):
	        echo '<a href="'.esc_url($flickr).'" class="flickr_link" data-toggle="'.esc_attr($title).'" target="_blank" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Flickr"><i class="kt-icon-flickr"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Flickr</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($vimeo)):
	        echo '<a href="'.esc_url($vimeo).'" class="vimeo_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Vimeo"><i class="kt-icon-vimeo"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Vimeo</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($youtube)):
	        echo '<a href="'.esc_url($youtube).'" class="youtube_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="YouTube"><i class="kt-icon-youtube"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">YouTube</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($pinterest)):
	        echo '<a href="'.esc_url($pinterest).'" class="pinterest_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Pinterest"><i class="kt-icon-pinterest"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Pinterest</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($dribbble)):
	        echo '<a href="'.esc_url($dribbble).'" class="dribbble_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Dribbble"><i class="kt-icon-dribbble"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Dribble</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($linkedin)):
	        echo '<a href="'.esc_url($linkedin).'" class="linkedin_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="LinkedIn"><i class="kt-icon-linkedin"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">LinkedIn</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($tumblr)):
	        echo '<a href="'.esc_url($tumblr).'" class="tumblr_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Tumblr"><i class="kt-icon-tumblr"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Tumblr</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($stumbleupon)):
	        echo '<a href="'.esc_url($stumbleupon).'" class="stumbleupon_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="StumbleUpon"><i class="kt-icon-stumbleupon"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">StumbleUpon</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($vk)):
	        echo '<a href="'.esc_url($vk).'" class="vk_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="VK"><i class="kt-icon-vk"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">VK</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($viadeo)):
	        echo '<a href="'.esc_url($viadeo).'" class="viadeo_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Viadeo"><i class="kt-icon-viadeo"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Viadeo</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($xing)):
	        echo '<a href="'.esc_url($xing).'" class="xing_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Xing"><i class="kt-icon-xing"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Xing</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($soundcloud)):
	        echo '<a href="'.esc_url($soundcloud).'" class="soundcloud_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Soundcloud"><i class="kt-icon-soundcloud"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Soundcloud</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($yelp)):
	        echo '<a href="'.esc_url($yelp).'" class="yelp_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Yelp"><i class="kt-icon-yelp"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Yelp</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($snapchat)):
	        echo '<a href="'.esc_url($snapchat).'" class="snapchat_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Snapchat"><i class="kt-icon-snapchat"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Snapchat</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($behance)):
	        echo '<a href="'.esc_url($behance).'" class="behance_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="Behance"><i class="kt-icon-behance"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">Behance</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($rss)):
	        echo '<a href="'.esc_url($rss).'" class="rss_link" target="_blank" data-toggle="'.esc_attr($title).'" data-placement="'.esc_attr($tooltip_dir).'" data-original-title="RSS"><i class="kt-icon-feed"></i>';
	    	if($title == 'beside') {
	    		echo '<span class="kt-social-title">RSS</span>';
	    	}
	    	echo '</a>';
	    endif;

	    echo '</div>';

	    $output = ob_get_contents();
		ob_end_clean();
	return $output;
}

//Payment Methods
function ascend_payment_methods_shortcode_function( $atts ) {
	extract(shortcode_atts(array(
		'color' 		=> null,
		'visa' 			=> 'false',
		'mastercard' 	=> 'false',
		'amex' 			=> 'false',
		'discover' 		=> 'false',
		'paypal' 		=> 'false',
		'stripe' 		=> 'false',
		'jcb' 			=> 'false',
), $atts));
if(!empty($color)){
	$icon_color = 'color:'.$color.';';
} else {
	$icon_color = '';
}
$output = '<div class="kt-payment-methods" style="'.esc_attr($icon_color).'">';
	if($visa == 'true') {
		$output .= '<div class="payment-method-icon pm-visa-icon"><i class="kt-icon-cc-visa"></i></div>';
	}
	if($mastercard == 'true') {
		$output .= '<div class="payment-method-icon pm-mastercard-icon"><i class="kt-icon-cc-mastercard"></i></div>';
	}
	if($amex == 'true') {
		$output .= '<div class="payment-method-icon pm-amex-icon"><i class="kt-icon-cc-amex"></i></div>';
	}
	if($discover == 'true') {
		$output .= '<div class="payment-method-icon pm-discover-icon"><i class="kt-icon-cc-discover"></i></div>';
	}
	if($paypal == 'true') {
		$output .= '<div class="payment-method-icon pm-paypal-icon"><i class="kt-icon-cc-paypal"></i></div>';
	}
	if($stripe == 'true') {
		$output .= '<div class="payment-method-icon pm-stripe-icon"><i class="kt-icon-cc-stripe"></i></div>';
	}
	if($jcb == 'true') {
		$output .= '<div class="payment-method-icon pm-jcb-icon"><i class="kt-icon-cc-jcb"></i></div>';
	}
	
	$output .= '</div>';

	return $output;
}

//Typed Text
function ascend_typed_text_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'first_sentence' => 'typed text',
		'second_sentence' => '',
		'third_sentence' => '',
		'fourth_sentence' => '',
		'loop' => 'false',
		'startdelay' => '500',
		'backdelay' => '500',
		'speed' => '40',
), $atts));
if(!empty($second_sentence) && empty($third_sentence) && empty($fourth_sentence)) {
	$count = '2';
} else if(!empty($second_sentence) && !empty($third_sentence) && empty($fourth_sentence)) {
	$count = '3';
} else if(!empty($second_sentence) && !empty($third_sentence) && !empty($fourth_sentence)){
	$count = '4';
} else {
	$count = '1';
}
$output = '<span class="kt_typed_element" data-first-sentence="'.esc_attr($first_sentence).'"';
	if(!empty($second_sentence)) {
		$output .= ' data-second-sentence="'.esc_attr($second_sentence).'"';
	}
	if(!empty($third_sentence)) {
		$output .= ' data-third-sentence="'.esc_attr($third_sentence).'"';
	}
	if(!empty($fourth_sentence)) {
		$output .= ' data-fourth-sentence="'.esc_attr($fourth_sentence).'"';
	}
	$output .= 'data-sentence-count="'.esc_attr($count).'" data-loop="'.esc_attr($loop).'" data-speed="'.esc_attr($speed).'" data-start-delay="'.esc_attr($startdelay).'" data-back-delay="'.esc_attr($backdelay).'"></span>';

	return $output;
}

	//Simple Box
function ascend_simple_box_shortcode_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'padding_top' => '15',
		'padding_bottom' => '15',
		'padding_left' => '15',
		'padding_right' => '15',
		'min_height' => '1',
		'background' => '#ffffff',
		'style' => '',
		'valign' => 'top',
		'opacity' => '1'
), $atts));
	$bg_color_rgb = ascend_hex2rgb($background);
	if(!empty($style)) {$style = $style;} else {$style = '';}
    $bcolor = 'rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', '.$opacity.');';
    if($valign == "middle"){
    	$output = '<div class="kt-simple-box kt-valign-center" style="background-color:'.esc_attr($bcolor).' min-height:'.esc_attr($min_height).'px; padding-top:'.esc_attr($padding_top).'px; padding-bottom:'.esc_attr($padding_bottom).'px; padding-left:'.esc_attr($padding_left).'px; padding-right:'.esc_attr($padding_right).'px; '.esc_attr($style).'">';
    	$output .='<div class="kt-simple-box-inner" style="height:'.$min_height.'px;">';
    } else {
   		$output = '<div class="kt-simple-box" style="background-color:'.esc_attr($bcolor).' min-height:'.esc_attr($min_height).'px; padding-top:'.esc_attr($padding_top).'px; padding-bottom:'.esc_attr($padding_bottom).'px; padding-left:'.esc_attr($padding_left).'px; padding-right:'.esc_attr($padding_right).'px; '.esc_attr($style).'">';
    	$output .='<div class="kt-simple-box-inner">';
    }

    $output .= do_shortcode($content) .'</div></div>';
	return $output;
}
//Button
function ascend_button_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'id' => rand(1, 9999),
		'bcolor' => null,
		'tcolor' => null,
		'bhovercolor' => null,
		'thovercolor' => null,
		'link' => '',
		'target' => '',
		'border' => '0',
		'borderradius' => '0',
		'bordercolor' => '#000',
		'borderhovercolor' => '',
		'text' => '',
		'size' => 'medium',
		'font' => 'body',
		'icon' => '',
		'class' => '',
), $atts));
	if($target == 'true' || $target == '_blank') {$target = '_blank';} else {$target = '_self';} 
	$js_over = '';
	if(!empty($bhovercolor)) {
		$js_over .= 'this.style.background=\''.$bhovercolor.'\'';
		if(!empty($thovercolor) || !empty($borderhovercolor)) {
			$js_over .= ',';
		}
		if(empty($bcolor)) {
			$bcolor = "initial";
		}
	}
	if(!empty($thovercolor)) { 
		$js_over .= 'this.style.color=\''.$thovercolor.'\'';
		if(!empty($borderhovercolor)) {
			$js_over .= ',';
		}
		if(empty($tcolor)) {
			$tcolor = "#fff";
		}
	}
	if(!empty($borderhovercolor)) {
		$js_over .= 'this.style.borderColor=\''.$borderhovercolor.'\'';
		if(empty($bordercolor)) {
			$bordercolor = "#000";
		}
	}
	$js_out ='';
	if(!empty($bhovercolor)) {
		$js_out .= 'this.style.background=\''.$bcolor.'\'';
		if(!empty($thovercolor) || !empty($borderhovercolor)) {
			$js_out .= ',';
		}
	}
	if(!empty($thovercolor)) { 
	 	$js_out .= 'this.style.color=\''.$tcolor.'\'';
	 	if(!empty($borderhovercolor)) {
			$js_out .= ',';
		}
	}
	if(!empty($borderhovercolor)) {
		$js_out .= 'this.style.borderColor=\''.$bordercolor.'\'';
	}
	$js_out .='';

	if(!empty($bcolor)) {
		$bgc = 'background-color:'.esc_attr($bcolor).';';
	} else {
		$bgc = '';
	}
	if(!empty($tcolor)) {
		$tc = 'color:'.esc_attr($tcolor).';';
	} else {
		$tc = '';
	}
	if($size == 'large'){
		$sizeclass = "lg-kad-btn";
	} else if ($size == 'small') {
		$sizeclass = "sm-kad-btn";
	} else {
		$sizeclass = "";
	}
	if($font == 'h1-family'){
		$fontclass = "h1class";
	} else {
		$fontclass = "";
	}
	if(!empty($icon)) {
		$iconhtml = '<i class="'.esc_attr($icon).'""></i>';
	} else {
		$iconhtml = "";
	}
	if(!empty($borderradius) || $borderradius != '0') {
		$borderradius = 'border-radius:'.esc_attr($borderradius).';';
	} else {
		$borderradius = '';
	}

	$output =  '<a href="'.esc_url($link).'" id="kadbtn'.esc_attr($id).'" target="'.esc_attr($target).'" class="btn button btn-shortcode '.esc_attr($sizeclass).' '.esc_attr($fontclass).' '.esc_attr($class).'" style="'.esc_attr($bgc).' border: '.esc_attr($border).' solid; border-color:'.esc_attr($bordercolor).'; '.esc_attr($borderradius).' '.esc_attr($tc).'" onMouseOver="'.esc_attr($js_over).'" onMouseOut="'.esc_attr($js_out).'">'.esc_html($text).' '.$iconhtml.'</a>';

return $output;
}
function ascend_blockquote_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'align' => 'center',
), $atts));
		switch ($align)
	{
		case "center":
		$output = '<div class="blockquote blockquote-center clearfix">' . do_shortcode($content) . '</div>';
		break;
		
		case "left":
		$output = '<div class="blockquote blockquote-left clearfix">' . do_shortcode($content) . '</div>';
		break;
		
		case "right":
		$output = '<div class="blockquote blockquote-right clearfix">' . do_shortcode($content) . '</div>';
		break;
	}
	  return $output;
}
function ascend_pullquote_shortcode_function( $atts, $content) {
   extract( shortcode_atts( array(
	  'align' => 'center'
  ), $atts ));

	switch ($align)
	{
		case "center":
		$output = '<div class="pullquote pullquote-center">' . do_shortcode($content) . '</div>';
		break;
		
		case "right":
		$output = '<div class="pullquote pullquote-right">' . do_shortcode($content) . '</div>';
		break;
		
		case "left":
		$output = '<div class="pullquote pullquote-left">' . do_shortcode($content) . '</div>';
		break;
	}

   return $output;
}
function ascend_hrule_function($atts) {
	extract(shortcode_atts(array(
		'color' => '',
		'style' => 'line',
		'size' => ''
), $atts));
	if($style == 'dots') {
		$output = '<div class="hrule_dots clearfix" style="';
		if(!empty($color)) {$output .= 'border-color:'.esc_attr($color).';';}
		if(!empty($size)) {$output .= ' border-top-width:'.esc_attr($size); }
		$output .= '"></div>';
	} elseif ($style == 'gradient') {
		$output = '<div class="hrule_gradient"></div>';
	} else {
		$output = '<div class="hrule clearfix" style="';
		if(!empty($color)) {$output .= 'background:'.esc_attr($color).';';}
		if(!empty($size)) {$output .= ' height:'.esc_attr($size); }
		$output .= '"></div>';
	}

	return $output;
}
function ascend_fullwidth_shortcode_function($atts, $content) {
	extract(shortcode_atts(array(
		'style' 		=> '',
		'class' 		=> '',
		'bg_color' 		=> 'transparent',
		'type' 			=> 'stretched',
), $atts));
	if(!empty($bg_color)) {
		$bg_color = 'background-color:'.$bg_color.';';
	} else {
		$bg_color = '';
	}
	if(!empty($type) && $type == 'stretched') {
		$typeclass = 'kt-custom-row-full-stretch';
	} else {
		$typeclass = 'kt-custom-row-full';
	}
		$output = '<div class="'.esc_attr($typeclass).' '.esc_attr($class).'" style="'.esc_attr($bg_color).' '.esc_attr($style).'">';
		$output .= do_shortcode($content);
		$output .= '</div>';

	return $output;
}

function ascend_popover_function($atts, $content) {
	extract(shortcode_atts(array(
		'direction' => 'top',
		'text' => '',
		'title' => ''
), $atts));
		$output = '<a class="kad_popover" data-toggle="popover" data-placement="'.esc_attr($direction).'" data-content="'.esc_attr($text).'" data-original-title="'.esc_attr($title).'">';
		$output .= $content;
		$output .= '</a>';

	return $output;
}
function ascend_space_shortcode_function($atts ) {
	extract(shortcode_atts(array(
		'size' => ''
), $atts));
	if(empty($size)) {$size = '10px';}
	return '<div class="kad-spacer clearfix" style="height:'.esc_attr($size).'"></div>';
}
function ascend_hrpadding10_function( ) {
	return '<div class="space_10 clearfix"></div>';
}
function ascend_hrpadding20_function( ) {
	return '<div class="space_20 clearfix"></div>';
}
function ascend_hrpadding40_function( ) {
	return '<div class="space_40 clearfix"></div>';
}
function ascend_hrpadding30_function( ) {
	return '<div class="space_30 clearfix"></div>';
}
function ascend_hrpadding80_function( ) {
	return '<div class="space_80 clearfix"></div>';
}
function ascend_bc_shortcode( ) {
	ob_start(); ?>
	<div class="kt_shortcode_breadcrumbs">
	<?php ascend_breadcrumbs(); ?>
	</div>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
function ascend_extra_shortcodes(){
	add_shortcode('accordion', 'ascend_accordion_shortcode_function');
   	add_shortcode('pane', 'ascend_accordion_pane_function');
   	add_shortcode('tabs', 'ascend_tab_shortcode_function');
   	add_shortcode('tab', 'ascend_tab_pane_function');
   	add_shortcode('columns', 'ascend_column_shortcode_function');
  	add_shortcode('hcolumns', 'ascend_hcolumn_shortcode_function');
   	add_shortcode('span11', 'ascend_column11_function');
   	add_shortcode('span10', 'ascend_column10_function');
   	add_shortcode('span9', 'ascend_column9_function');
   	add_shortcode('span8', 'ascend_column8_function');
   	add_shortcode('span7', 'ascend_column7_function');
   	add_shortcode('span6', 'ascend_column6_function');
   	add_shortcode('span5', 'ascend_column5_function');
   	add_shortcode('span4', 'ascend_column4_function');
   	add_shortcode('span3', 'ascend_column3_function');
   	add_shortcode('span25', 'ascend_column25_function');
   	add_shortcode('span2', 'ascend_column2_function');
   	add_shortcode('span1', 'ascend_column1_function');
   	add_shortcode('icon', 'ascend_icon_shortcode_function');
   	add_shortcode('pullquote', 'ascend_pullquote_shortcode_function');
   	add_shortcode('blockquote', 'ascend_blockquote_shortcode_function');
   	add_shortcode('btn', 'ascend_button_shortcode_function');
   	add_shortcode('hr', 'ascend_hrule_function');
   	add_shortcode('space', 'ascend_space_shortcode_function');
   	// Keep for compatablitly 
   	add_shortcode('space_10', 'ascend_hrpadding10_function');
   	add_shortcode('space_20', 'ascend_hrpadding20_function');
   	add_shortcode('space_30', 'ascend_hrpadding30_function');
   	add_shortcode('space_40', 'ascend_hrpadding40_function');
   	add_shortcode('space_80', 'ascend_hrpadding80_function');

   	add_shortcode('clear', 'ascend_clearfix_function');
   	add_shortcode('infobox', 'ascend_info_boxes_shortcode_function');
   	add_shortcode('iconbox', 'ascend_icon_boxes_shortcode_function');
   	add_shortcode('carousel', 'ascend_carousel_shortcode_function');
   	add_shortcode('post_carousel', 'ascend_post_carousel_shortcode_function');
   	add_shortcode('blog_posts', 'ascend_blog_shortcode_function');
   	add_shortcode('testimonial_posts', 'ascend_testimonial_shortcode_function');
   	add_shortcode('custom_carousel', 'ascend_custom_carousel_shortcode_function');
   	add_shortcode('carousel_item', 'ascend_custom_carousel_item_shortcode_function');
   	add_shortcode('img_menu', 'ascend_image_menu_shortcode_function');
   	add_shortcode('gmap', 'ascend_map_shortcode_function');
   	add_shortcode('portfolio_posts', 'ascend_portfolio_shortcode_function');
   	add_shortcode('portfolio_types', 'ascend_portfolio_type_shortcode_function');
   	add_shortcode('staff_posts', 'ascend_staff_shortcode_function');
   	add_shortcode('kad_youtube', 'ascend_youtube_shortcode_function');
   	add_shortcode('kad_vimeo', 'ascend_vimeo_shortcode_function');
   	add_shortcode('kad_popover', 'ascend_popover_function');
   	add_shortcode('kad_modal', 'ascend_modal_shortcode_function');
   	add_shortcode('kt_box', 'ascend_simple_box_shortcode_function');
   	add_shortcode('kt_imgsplit', 'ascend_image_split_shortcode_function');
   	add_shortcode('kt_product_toggle', 'ascend_product_toggle_shortcode_function');
   	add_shortcode('kt_breadcrumbs', 'ascend_bc_shortcode');
   	add_shortcode('kt_typed', 'ascend_typed_text_shortcode_function');
   	add_shortcode('kt_flip_box', 'ascend_flip_boxes_shortcode_function');
   	add_shortcode('kad_testimonial_form', 'ascend_testimonial_form');
   	add_shortcode('kt_contact_form', 'ascend_contact_form_shortcode_function');
   	add_shortcode('kt_fullwidth_container', 'ascend_fullwidth_shortcode_function');
   	add_shortcode('kt_social', 'ascend_social_shortcode_function');
   	add_shortcode('kt_payment_methods', 'ascend_payment_methods_shortcode_function');
}
add_action( 'init', 'ascend_extra_shortcodes');

function ascend_register_shortcodes(){
	add_shortcode('the-year', 'ascend_year_shortcode_function');
	add_shortcode('copyright', 'ascend_copyright_shortcode_function');
	add_shortcode('site-name', 'ascend_sitename_shortcode_function');
	add_shortcode('site-tagline', 'ascend_sitetagline_shortcode_function');
	add_shortcode('theme-credit', 'ascend_themecredit_shortcode_function');
}
add_action( 'init', 'ascend_register_shortcodes');

function ascend_content_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'ascend_content_clean_shortcodes');

function ascend_widget_clean_shortcodes($text){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        '<p></p>' => '', 
        ']<br />' => ']',
        '<br />[' => '['
    );
    $text = strtr($text, $array);
    return $text;
}
add_filter('widget_text', 'ascend_widget_clean_shortcodes', 10);

remove_filter('widget_text', 'do_shortcode');
add_filter('widget_text', 'do_shortcode', 50);
add_action( 'init', 'ascend_remove_bstw_do_shortcode' );
function ascend_remove_bstw_do_shortcode() {
    if ( function_exists( 'bstw' ) ) {
        remove_filter( 'widget_text', array( bstw()->text_filters(), 'do_shortcode' ), 10 );
    }
}
add_filter('siteorigin_widgets_template_variables_sow-editor', 'ascend_edit_sow_editor', 10, 4);
function ascend_edit_sow_editor($template_vars, $instance, $args, $object) {
		$instance = wp_parse_args(
			$instance,
			array(  'text' => '' )
		);
		// Run some known stuff
		if( !empty($GLOBALS['wp_embed']) ) {
			$instance['text'] = $GLOBALS['wp_embed']->autoembed( $instance['text'] );
		}
		if (function_exists('wp_make_content_images_responsive')) {
			$instance['text'] = wp_make_content_images_responsive( $instance['text'] );
		}
		if( $instance['autop'] ) {
			$instance['text'] = wpautop( $instance['text'] );
		}
		$instance['text'] = do_shortcode( shortcode_unautop( $instance['text'] ) );
		$instance['text'] = apply_filters( 'widget_text', $instance['text'] );


		$text =  array('text' => $instance['text']);
		return $text;
}
/*
 * Admin Shortcode Btn
 */
function ascend_shortcode_init() {
	if(is_admin()){ 
		if(ascend_is_edit_page()){
			require_once locate_template('/lib/kad_shortcodes/kad_shortcodes.php');	
		}
	}
}
add_action('init', 'ascend_shortcode_init');

add_action( 'media_buttons', 'ascend_shortcode_button', 800 );
function ascend_shortcode_button() {
  $button = '<a href="javascript:void(0);" class="kadence-generator-button button" title="'.__('Insert Shortcode','ascend').'" data-target="content">';
  $button .= '<i class="dash-icon-generic"></i> '.__('Extra Shortcodes', 'ascend').' </a>';
  echo $button;
}
function ascend_is_edit_page(){
  if (!is_admin()) return false;
    if ( in_array( $GLOBALS['pagenow'], array( 'post.php', 'post-new.php', 'widgets.php', 'customize.php', 'post-new.php' ) ) ) {
      return true;
    }
}
