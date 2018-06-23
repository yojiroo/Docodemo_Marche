<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Ascend Shortcode Generator 

function ascend_shortcode_option( $name, $attr_option, $shortcode ){
	
	$kad_option_element = null;
	
	(isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';
	
		
	switch( $attr_option['type'] ){
		
		case 'radio':
	    
		$kad_option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
	    foreach( $attr_option['values'] as $val => $title ){
	    
		(isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';
		
		 $kad_option_element .= '
			<label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
		    <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
	    }
		
		$kad_option_element .= $desc . '</div>';
		
	    break;
	    case 'checkbox':
		
		$kad_option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" data-attrname="'.$name.'" id="' . $name . '" />'. $desc. '</div> ';
		
		break;
		case 'select':

		$kad_option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="kad-sc-select">';
			$values = $attr_option['values'];
			foreach( $values as $value => $vname ){
				if($value == $attr_option['default']) { $selected=' selected="selected"';} else { $selected=""; }
		    	$kad_option_element .= '<option value="'.$value.'" ' . $selected .'>'.$vname.'</option>';
			}
		$kad_option_element .= '</select>' . $desc . '</div>';

		break;
		case 'icon-select':

		$kad_option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="kad-icon-select">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$kad_option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$kad_option_element .= '</select>' . $desc . '</div>';

		break;
		case 'color':
			
	           $kad_option_element .= '
	           <div class="label"><label><strong>'.$attr_option['title'].' </strong></label></div>
			   <div class="content"><input type="text" value="'. ( isset($attr_option['default']) ? $attr_option['default'] : "" ) . '" class="kad-popup-colorpicker" data-attrname="'.$name.'" style="width: 70px;" data-default-color="'. ( isset($attr_option['default']) ? $attr_option['default'] : "" ) . '"/>';
			   $kad_option_element .= $desc . '</div>';
		break;
		case 'textarea':
		$kad_option_element .= '
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><textarea class="kad-sc-'.$name.'" data-attrname="'.$name.'"></textarea> ' . $desc . '</div>';
		break;
		case 'text':
		default:
		    $kad_option_element .= '
			<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
			<div class="content"><input class="attr kad-sc-textinput kad-sc-'.$name.'" type="text" data-attrname="'.$name.'" value="" />' . $desc . '</div>';
		break;
	}
	
	$kad_option_element .= '<div class="clear"></div>';
    
	
    return $kad_option_element;
}

function ascend_shortcode_content(){
$screen = get_current_screen();
if($screen->base != 'post' && $screen->base != 'widgets') {
        return;
}
	//Columns
$kadence_shortcodes['columns'] = array( 
	'title'=>__('Columns', 'ascend'), 
	'attr'=>array(
		'columns'=>array(
			'type'=>'radio', 
			'title'=>__('Columns','ascend'),
			'values' => array(
				"span6" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumn.jpg" />' . __("Two Columns", "ascend"),
				"span4right" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumnleft.jpg" />' . __("Two Columns offset Right", "ascend"),
				"span4left" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumnright.jpg" />' . __("Two Columns offset Left", "ascend"),
				"span4" => '<img src="'. get_template_directory_uri().'/assets/img/threecolumn.jpg" />' . __("Three Columns", "ascend"),
				"span3" => '<img src="'. get_template_directory_uri().'/assets/img/fourcolumn.jpg" />' . __("Four Columns", "ascend"),
				)
		),
	) 
);
// Fullwidth Container
$kadence_shortcodes['kt_fullwidth_container'] = array( 
	'title'=>__('Fullwidth Box', 'ascend'), 
	'attr'=>array(
		'type'=>array(
			'type'=>'select', 
			'title'=>__('Type','ascend'),
			'default' => 'stretched',
			'values' => array(
				"stretched" 	=> __('Full Stretched Content', 'ascend'),
				'fullbg' 		=> __('Full Background Only', 'ascend'),
				),
		),
		'bg_color'=>array(
			'type'=>'color', 
			'title'  => __('Background Color','ascend'),
		)
	) 
);
//table
$kadence_shortcodes['table'] = array( 
	'title'=>__('Table', 'ascend'), 
	'attr'=>array(
		'head'=>array(
			'type'=>'checkbox', 
			'title'=>__('Use a table head?','ascend')
		),
		'columns'=>array(
			'type'=>'text', 
			'title'=>__('Columns (just a number)', 'ascend'),
			'default' => '2',
		),
		'rows'=>array(
			'type'=>'text', 
			'title'=>__('Extra Rows (just a number)', 'ascend'),
			'default' => '2',
		),
	) 
);
	// Divider 
$kadence_shortcodes['hr'] = array( 
	'title'=>__('Divider', 'ascend'), 
	'attr'=>array(
		'style'=>array(
			'type'=>'select', 
			'title'=>__('Style', 'ascend'),
			'default' => 'line',
			'values' => array(
				"line" => __("Line", "ascend"),
				"dots" => __("Dots", "ascend"),
				"gradient" => __("Gradient", "ascend"),
				)
		),
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Size','ascend'),
			'default' => '1px',
			'values' => array(
				"1px" => "1px",
				"2px" => "2px",
				"3px" => "3px",
				"4px" => "4px",
				"5px" => "5px",
				)
		),
		'color'=>array(
			'type'=>'color', 
			'title'  => __('Color','ascend'),
		)
	) 
);
// Spacer
$kadence_shortcodes['space'] = array( 
	'title'=>__('Spacing', 'ascend'), 
	'attr'=>array(
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Size','ascend'),
			'default' => '10px',
			'values' => array(
				"10px" => "10px",
				"20px" => "20px",
				"30px" => "30px",
				"40px" => "40px",
				"50px" => "50px",
				)
		)
	) 
);
// Spacer
$kadence_shortcodes['tabs'] = array( 
	'title'=>__('Tabs', 'ascend'), 
);
$kadence_shortcodes['accordion'] = array( 
	'title'=>__('Accordion', 'ascend'),
);
$kadence_shortcodes['pullquote'] = array( 
	'title'=>__('Pull-Quotes', 'ascend'), 
	'attr'=>array(
		'align'=>array(
			'type'=>'select', 
			'title'=>__('Align', 'ascend'),
			'default' => 'center',
			'values' => array(
				"center" => __('Center','ascend'),
				"left" => __('Left','ascend'),
				"right" => __('Right','ascend'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Pull-Quote Text', 'ascend')
		)
	) 
);
$kadence_shortcodes['blockquote'] = array( 
	'title'=>__('Block-Quotes', 'ascend'), 
	'attr'=>array(
		'align'=>array(
			'type'=>'select', 
			'title'=>__('Align', 'ascend'),
			'default' => 'left',
			'values' => array(
				"left" => __('Left','ascend'),
				"right" => __('Right','ascend'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Block-Quote Text', 'ascend')
		)
	) 
);
$kadence_shortcodes['kt_box'] = array( 
	'title'=>__('Simple Box', 'ascend'), 
	'attr'=>array(
		'padding_top'=>array(
			'type'=>'text', 
			'title'=>__('Padding Top (just a number)', 'ascend'),
			'default' => '15',
		),
		'padding_bottom'=>array(
			'type'=>'text', 
			'title'=>__('Padding Bottom (just a number)', 'ascend'),
			'default' => '15',
		),
		'padding_left'=>array(
			'type'=>'text', 
			'title'=>__('Padding Left (just a number)', 'ascend'),
			'default' => '15',
		),
		'padding_right'=>array(
			'type'=>'text', 
			'title'=>__('Padding Right (just a number)', 'ascend'),
			'default' => '15',
		),
		'min_height'=>array(
			'type'=>'text', 
			'title'=>__('Min Height (just a number)', 'ascend'),
			'default' => '0',
		),
		'valign'=>array(
			'type'=>'checkbox', 
			'title'=>__('Vertical align middle?','ascend')
		),
		'background'=>array(
			'type'=>'color', 
			'title'  => __('Background Color','ascend'),
			'default' => '',
		),
		'opacity'=>array(
			'type'=>'select', 
			'title'=>__('Background Color Opacity', 'ascend'),
			'default' => '1',
			'values' => array(
				"1" => __('1.0','ascend'),
				"0.9" => __('0.9','ascend'),
				"0.8" => __('0.8','ascend'),
				"0.7" => __('0.7','ascend'),
				"0.6" => __('0.6','ascend'),
				"0.5" => __('0.5','ascend'),
				"0.4" => __('0.4','ascend'),
				"0.3" => __('0.3','ascend'),
				"0.2" => __('0.2','ascend'),
				"0.1" => __('0.1','ascend'),
				"0.0" => __('0.0','ascend'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Content Text', 'ascend')
		)
	) 
);
$icons = ascend_icon_list();

	//Button
$kadence_shortcodes['btn'] = array( 
	'title'=>__('Button', 'ascend'), 
	'attr'=>array(
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Button Text', 'ascend')
		),
		'target'=>array(
			'type'=>'checkbox', 
			'title'=>__('Open Link In New Tab?','ascend')
		),
		'tcolor'=>array(
			'type'=>'color', 
			'title'  => __('Font Color','ascend'),
			'default' => '#ffffff',
		),
		'bcolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Color','ascend'),
			'default' => '',
		),
		'border'=>array(
			'type'=>'text',
			'desc'=>__('Example = 2px', 'ascend'), 
			'title'=>__('Button Border Size', 'ascend')
		),
		'bordercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Border Color','ascend'),
			'default' => '',
		),
		'borderradius'=>array(
			'type'=>'text',
			'desc'=>__('Example = 6px', 'ascend'), 
			'title'=>__('Button Border Radius', 'ascend')
		),
		'thovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Font Hover Color','ascend'),
			'default' => '#ffffff',
		),
		'bhovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Hover Color','ascend'),
			'default' => '',
		),
		'borderhovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Border Hover Color','ascend'),
			'default' => '',
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>__('Link URL', 'ascend')
		),
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Button Size', 'ascend'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'ascend'),
				"large" => __('Large', 'ascend'),
				"small" => __('Small', 'ascend'),
				)
		),
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon (optional)', 'ascend'),
			'values' => $icons
		),
	) 
);
$kadence_shortcodes['gmap'] = array( 
	'title'=>__('Google Map', 'ascend'), 
	'attr'=>array(
		'address'=>array(
			'type'=>'text', 
			'title'=>__('Address', 'ascend')
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Map Height', 'ascend'),
			'desc'=>__('Just a number e.g. = 400', 'ascend'), 
		),
		'zoom'=>array(
			'type'=>'select', 
			'title'=>__('Map Zoom','ascend'),
			'default' => '15',
			'values' => array(
				"1" => "1",
				"2" => "2",
				"3" => "3",
				"4" => "4",
				"5" => "5",
				"6" => "6",
				"7" => "7",
				"8" => "8",
				"9" => "9",
				"10" => "10",
				"11" => "11",
				"12" => "12",
				"13" => "13",
				"14" => "14",
				"15" => "15",
				"16" => "16",
				"17" => "17",
				"18" => "18",
				"19" => "19",
				"20" => "20",
				)
		),
		'maptype'=>array(
			'type'=>'select', 
			'title'=>__('Map Type','ascend'),
			'default' => 'ROADMAP',
			'values' => array(
				"ROADMAP" => __('ROADMAP', 'ascend'),
				"HYBRID" => __('HYBRID', 'ascend'),
				"TERRAIN" => __('TERRAIN', 'ascend'),
				"SATELLITE" => __('SATELLITE', 'ascend'),
				)
		),
	) 
);

$kadence_shortcodes['icon'] = array( 
	'title'=>__('Icon', 'ascend'), 
	'attr'=>array(
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon', 'ascend'),
			'values' => $icons
		),
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Icon Size','ascend'),
			'default' => '14px',
			'values' => array(
				"5px" => "5px",
				"6px" => "6px",
				"7px" => "7px",
				"8px" => "8px",
				"9px" => "9px",
				"10px" => "10px",
				"11px" => "11px",
				"12px" => "12px",
				"13px" => "13px",
				"14px" => "14px",
				"15px" => "15px",
				"16px" => "16px",
				"17px" => "17px",
				"18px" => "18px",
				"19px" => "19px",
				"20px" => "20px",
				"21px" => "21px",
				"22px" => "22px",
				"23px" => "23px",
				"24px" => "24px",
				"25px" => "25px",
				"26px" => "26px",
				"27px" => "27px",
				"28px" => "28px",
				"29px" => "29px",
				"30px" => "30px",
				"31px" => "31px",
				"32px" => "32px",
				"33px" => "33px",
				"34px" => "34px",
				"35px" => "35px",
				"36px" => "36px",
				"37px" => "37px",
				"38px" => "38px",
				"39px" => "39px",
				"40px" => "40px",
				"41px" => "41px",
				"42px" => "42px",
				"43px" => "43px",
				"44px" => "44px",
				"45px" => "45px",
				"46px" => "46px",
				"47px" => "47px",
				"48px" => "48px",
				"49px" => "49px",
				"50px" => "50px",
				"51px" => "51px",
				"52px" => "52px",
				"53px" => "53px",
				"54px" => "54px",
				"55px" => "55px",
				"56px" => "56px",
				"57px" => "57px",
				"58px" => "58px",
				"59px" => "59px",
				"60px" => "60px",
				"61px" => "61px",
				"62px" => "62px",
				"63px" => "63px",
				"64px" => "64px",
				"65px" => "65px",
				"66px" => "66px",
				"67px" => "67px",
				"68px" => "68px",
				"69px" => "69px",
				"70px" => "70px",
				"71px" => "71px",
				"72px" => "72px",
				"73px" => "73px",
				"74px" => "74px",
				"75px" => "75px",
				"76px" => "76px",
				"77px" => "77px",
				"78px" => "78px",
				"79px" => "79px",
				"80px" => "80px",
			)
		),
		'color'=>array(
			'type'=>'color', 
			'title'  => __('Icon Color','ascend'),
			'default' => '',
		),
		'float'=>array(
			'type'=>'select', 
			'title'=>__('Icon Float', 'ascend'),
			'default' => '',
			'values' => array(
				"" => "none",
				"left" => "Left",
				"right" => "Right",
				)
		),
		'style'=>array(
			'type'=>'select', 
			'title'=>__('Icon Style', 'ascend'),
			'default' => '',
			'values' => array(
				"" => "none",
				"circle" => __('Circle', 'ascend'),
				"square" => __('Square', 'ascend'),
				)
		),
		'background'=>array(
			'type'=>'color', 
			'title'  => __('Background Color','ascend'),
			'default' => '',
		)
	) 
);
$kadence_shortcodes['iconbox'] = array( 
	'title'=>__('Icon Box', 'ascend'), 
	'attr'=>array(
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon', 'ascend'),
			'values' => $icons
		),
		'iconsize'=>array(
			'type'=>'select', 
			'title'=>__('Icon Size','ascend'),
			'default' => '48px',
			'values' => array(
				"5" => "5px",
				"6" => "6px",
				"7" => "7px",
				"8" => "8px",
				"9" => "9px",
				"10" => "10px",
				"11" => "11px",
				"12" => "12px",
				"13" => "13px",
				"14" => "14px",
				"15" => "15px",
				"16" => "16px",
				"17" => "17px",
				"18" => "18px",
				"19" => "19px",
				"20" => "20px",
				"21" => "21px",
				"22" => "22px",
				"23" => "23px",
				"24" => "24px",
				"25" => "25px",
				"26" => "26px",
				"27" => "27px",
				"28" => "28px",
				"29" => "29px",
				"30" => "30px",
				"31" => "31px",
				"32" => "32px",
				"33" => "33px",
				"34" => "34px",
				"35" => "35px",
				"36" => "36px",
				"37" => "37px",
				"38" => "38px",
				"39" => "39px",
				"40" => "40px",
				"41" => "41px",
				"42" => "42px",
				"43" => "43px",
				"44" => "44px",
				"45" => "45px",
				"46" => "46px",
				"47" => "47px",
				"48" => "48px",
				"49" => "49px",
				"50" => "50px",
				"51" => "51px",
				"52" => "52px",
				"53" => "53px",
				"54" => "54px",
				"55" => "55px",
				"56" => "56px",
				"57" => "57px",
				"58" => "58px",
				"59" => "59px",
				"60" => "60px",
				"61" => "61px",
				"62" => "62px",
				"63" => "63px",
				"64" => "64px",
				"65" => "65px",
				"66" => "66px",
				"67" => "67px",
				"68" => "68px",
				"69" => "69px",
				"70" => "70px",
				"71" => "71px",
				"72" => "72px",
				"73" => "73px",
				"74" => "74px",
				"75" => "75px",
				"76" => "76px",
				"77" => "77px",
				"78" => "78px",
				"79" => "79px",
				"80" => "80px",
			)
		),
		'iconcolor'=>array(
			'type'=>'color', 
			'title'  => __('Icon Color','ascend'),
			'default' => '',
		),
		'iconbackground'=>array(
			'type'=>'color', 
			'title'  => __('Icon Background Color','ascend'),
			'default' => '',
		),
		'iconborder'=>array(
			'type'=>'color', 
			'title'  => __('Icon Border Color','ascend'),
			'default' => '',
		),
		'textcolor'=>array(
			'type'=>'color', 
			'title'  => __('Text Color','ascend'),
			'default' => '',
		),
		'highlight'=>array(
			'type'=>'color', 
			'title'  => __('Hover Highlight Color','ascend'),
			'default' => '',
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>__('Link URL', 'ascend')
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'ascend')
		),
		'description'=>array(
			'type'=>'textarea', 
			'title'=>__('Description', 'ascend')
		),
		'readmore'=>array(
			'type'=>'text', 
			'title'=>__('Bottom "read more" link title - optional', 'ascend')
		),

	) 
);
$kadence_shortcodes['kt_typed'] = array( 
	'title'=>__('Animated Typed Text', 'ascend'), 
	'attr'=>array(
		'first_sentence'=>array(
			'type'=>'text', 
			'title'=>__('First Sentence', 'ascend')
		),
		'second_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Second Sentence (optional)', 'ascend')
		),
		'third_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Third Sentence (optional)', 'ascend')
		),
		'fourth_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Fourth Sentence (optional)', 'ascend')
		),
		'startdelay'=>array(
			'type'=>'text', 
			'title'=>__('Start Delay (milliseconds eg: 500)', 'ascend')
		),
		'backdelay'=>array(
			'type'=>'text', 
			'title'=>__('Pause Delay (milliseconds eg: 500)', 'ascend')
		),
		'loop'=>array(
			'type'=>'checkbox', 
			'title'=>__('Loop','ascend')
		)
	) 
);

$kadence_shortcodes['kad_youtube'] = array( 
	'title'=>__('YouTube', 'ascend'), 
	'attr'=>array(
		'url'=>array(
			'type'=>'text', 
			'title'=>__('Video URL', 'ascend')
		),
		'width'=>array(
			'type'=>'text', 
			'title'=>__('Video Width', 'ascend'),
			'desc' =>__('Just a number e.g. = 600', 'ascend'), 
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Video Height', 'ascend'),
			'desc'=>__('Just a number e.g. = 400', 'ascend'), 
		),
		'maxwidth'=>array(
			'type'=>'text', 
			'title'=>__('Video Max Width', 'ascend'),
			'desc'=>__('Keeps the responsive video from getting too large', 'ascend'), 
		),
		'hidecontrols'=>array(
			'type'=>'checkbox', 
			'title'=>__('Hide Controls','ascend')
		),
		'autoplay'=>array(
			'type'=>'checkbox', 
			'title'=>__('Auto Play','ascend')
		),
		'rel'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Related','ascend')
		),
		'modestbranding'=>array(
			'type'=>'checkbox', 
			'title'=>__('Modest Branding?','ascend')
		)
	) 
);
$kadence_shortcodes['kad_vimeo'] = array( 
	'title'=>__('Vimeo', 'ascend'), 
	'attr'=>array(
		'url'=>array(
			'type'=>'text', 
			'title'=>__('Video URL', 'ascend')
		),
		'width'=>array(
			'type'=>'text', 
			'title'=>__('Video Width', 'ascend'),
			'desc' =>__('Just a number e.g. = 600', 'ascend'), 
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Video Height', 'ascend'),
			'desc'=>__('Just a number e.g. = 400', 'ascend'), 
		),
		'maxwidth'=>array(
			'type'=>'text', 
			'title'=>__('Video Max Width', 'ascend'),
			'desc'=>__('Keeps the responsive video from getting too large', 'ascend'), 
		),
		'autoplay'=>array(
			'type'=>'checkbox', 
			'title'=>__('Auto Play','ascend')
		)
	) 
);
$postcategories = get_categories();
$cat_options = array();
$cat_options = array("" => "All");
foreach ($postcategories as $cat) {
      $cat_options[$cat->slug] = $cat->name;
}

$kadence_shortcodes['blog_posts'] = array( 
	'title'=>__('Blog Posts', 'ascend'), 
	'attr'=>array(
		'type'=>array(
			'type'=>'select', 
			'title'=>__('Style', 'ascend'),
			'default' => 'normal',
			'values' => array(
				'normal' 		=> __('Standard', 'ascend' ),
				'below_title' 	=> __('Standard with image below title', 'ascend' ),
				'full' 			=> __('Full Post', 'ascend' ),
				'grid' 			=> __('Grid', 'ascend' ),
				'grid_standard' => __('Grid with first post as standard', 'ascend' ),
				'photo' 		=> __('Photo', 'ascend' ),
				'mosaic' 		=> __('Mosaic', 'ascend' ),
			)
		),
		'orderby'=>array(
			'type'=>'select', 
			'title'=>__('Order By', 'ascend'),
			'default' => 'date',
			'values' => array(
				"date" => __('Date','ascend'),
				"rand" => __('Random','ascend'),
				"menu_order" => __('Menu Order','ascend'),
				)
		),
		'cat'=>array(
			'type'=>'select',
			'default' => '',
			'title'=>__('Category', 'ascend'),
			'values' => $cat_options,
		),
		'items'=>array(
			'type'=>'text', 
			'title'=>__('Number of Posts', 'ascend')
		),
	) 
);
	//Button
$kadence_shortcodes['kad_modal'] = array( 
	'title'=>__('Modal', 'ascend'), 
	'attr'=>array(
		'btntitle'=>array(
			'type'=>'text', 
			'title'=>__('Button Title', 'ascend')
		),
		'btncolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Font Color','ascend'),
			'default' => '#ffffff',
		),
		'btnbackground'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Color','ascend'),
			'default' => '',
		),
		'btnsize'=>array(
			'type'=>'select', 
			'title'=>__('Button Size', 'ascend'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'ascend'),
				"large" => __('Large', 'ascend'),
				"small" => __('Small', 'ascend'),
				)
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Modal Title', 'ascend')
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Modal Content', 'ascend')
		)
	) 
);
$kadence_shortcodes['kt_contact_form'] = array( 
	'title'=>__('Contact Form', 'ascend'), 
	'attr'=>array(
		'label_name'=>array(
			'type'=>'text', 
			'title'=>__('Name Field Label', 'ascend'),
			'desc'=>__('Default: Name:', 'ascend')
		),
		'label_email'=>array(
			'type'=>'text', 
			'title'=>__('Email Field Label','ascend'),
			'desc'=>__('Default: Email:', 'ascend')
		),
		'label_subject'=>array(
			'type'=>'text', 
			'title'=>__('Subject Field Label', 'ascend'),
			'desc'=>__('Default: Subject:', 'ascend')
		),
		'label_message'=>array(
			'type'=>'text', 
			'title'=>__('Message Field Label', 'ascend'),
			'desc'=>__('Default: Message:', 'ascend')
		),
		'label_submit'=>array(
			'type'=>'text', 
			'title'=>__('Submit Field Label','ascend'),
			'desc'=>__('Default: Send Message', 'ascend')
		),
		'email_to'=>array(
			'type'=>'text', 
			'title'=>__('Email to', 'ascend'),
			'desc'=>__('Enter address you wish the form to email', 'ascend')
		),
		'message_success'=>array(
			'type'=>'text', 
			'title'=>__('Success Message','ascend'),
			'desc'=>__('Default: Thank you! Your message was sent successfully.', 'ascend')
		),
	) 
);
$kadence_shortcodes['kad_testimonial_form'] = array( 
	'title'=>__('Testimonial Form', 'ascend'), 
	'attr'=>array(
		'location'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Location Field?','ascend')
		),
		'position'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Position Field?','ascend')
		),
		'link'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Link Field?','ascend')
		),
		'name_label'=>array(
			'type'=>'text', 
			'title'=>__('Name Field Label', 'ascend'),
			'desc'=>__('Default: Name', 'ascend')
		),
		'testimonial_label'=>array(
			'type'=>'text', 
			'title'=>__('Testimonial Field Label','ascend'),
			'desc'=>__('Default: Testimonial', 'ascend')
		),
		'location_label'=>array(
			'type'=>'text', 
			'title'=>__('Location Field Label', 'ascend'),
			'desc'=>__('Default: Location - Optional', 'ascend')
		),
		'position_label'=>array(
			'type'=>'text', 
			'title'=>__('Position Field Label', 'ascend'),
			'desc'=>__('Default: Position or Company - optional', 'ascend')
		),
		'link_label'=>array(
			'type'=>'text', 
			'title'=>__('Link Field Label','ascend'),
			'desc'=>__('Default: Link - optional', 'ascend')
		),
		'submit_label'=>array(
			'type'=>'text', 
			'title'=>__('Submit Field Label', 'ascend'),
			'desc'=>__('Default: Submit', 'ascend')
		),
		'success_message'=>array(
			'type'=>'text', 
			'title'=>__('Success Message','ascend'),
			'desc'=>__('Default: Thank you for submitting your testimonial! It is now awaiting approval from the site admnistator. Thank you!', 'ascend')
		),
	) 
);

	ob_start(); ?>
	<div id="kadence-shortcode-container">
		<div id="kadence-shortcode-innercontainer" class="mfp-hide mfp-with-anim">
		 	<div class="kadenceshortcode-content">
		 		<div class="shortcodes-header">
					<div class="kadshort-header"><h3><?php echo __('Extra Shortcodes', 'ascend'); ?></h3></div>
					<div class="kadshort-select"><select id="kadence-shortcodes" data-placeholder="<?php _e("Choose a shortcode", 'ascend'); ?>">
				    <option></option>
					
					<?php $kad_sc_html = ''; $kad_options_html = '';
					$kadence_shortcodes = apply_filters('kadence_shortcodes', $kadence_shortcodes);
					foreach( $kadence_shortcodes as $shortcode => $options ){
						
							$kad_sc_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
							$kad_options_html .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'">';
							
								if( !empty($options['attr']) ){
									 foreach( $options['attr'] as $name => $attr_option ){
										$kad_options_html .= ascend_shortcode_option( $name, $attr_option, $shortcode );
									 }
								}
			
							$kad_options_html .= '</div>'; 
						
					} 
			
			$kad_sc_html .= '</select></div></div>'; 	
		
	
		 echo $kad_sc_html . $kad_options_html; ?>

 				
			<div class="kad_shortcode_insert">	
				<a href="javascript:void(0);" id="kad-shortcode-insert" class="kad-addshortcode-btn" style=""><?php _e("Add Shortcode", "ascend"); ?></a>
			</div>
	</div> 
	</div>
	</div>
<?php  $output = ob_get_contents();
		ob_end_clean();
	echo $output;
}
add_action('admin_footer','ascend_shortcode_content');
