<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for Google Maps

 function ascend_map_shortcode_function($atts, $content = null) {
    extract(shortcode_atts(array(
    'title'	 		=> null,
    'description'	=> null,
    'height'	 	=> '380',
    'address' 		=> '',
	'info_window' 	=> 'A',
	'zoom' 			=> '15',
	'companycode' 	=> '',
	'maptype' 		=> 'm'
    ), $atts));
    if($maptype == 'TERRAIN') {
    	$maptype = 'p';
    } elseif ($maptype == 'HYBRID') {
    	$maptype = 'h';
    } elseif ($maptype == 'SATELLITE') {
    	$maptype = 'k';
    } elseif ($maptype == 'ROADMAP') {
    	$maptype = 'm';
    }
    if(!empty($title) || !empty($description)) {
    	$overlay = '<div class="kt-map-overlay">';
        if(!empty($title)) {
            $overlay .= '<h4>'.$title.'</h4>';
        }
        if(!empty($description)) {
            $overlay .= '<div class="map-over-des">'.$description.'</div>';
        }
        $overlay .= '</div>';
    } else {
    	$overlay = '';
    }
	$query_string = 'q=' . urlencode($address) . '&cid=' . urlencode($companycode) . '&t=' . urlencode($maptype) . '&center=' . urlencode($address);
    return '<div class="kt-map"><iframe height="'.$height.'" src="https://maps.google.com/maps?&'.htmlentities($query_string).'&output=embed&z='.esc_attr($zoom).'&iwloc='.esc_attr($info_window).'&visual_refresh=true"></iframe>'.$overlay.'</div>';
    }