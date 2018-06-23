<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Extend - Site Origin Panels 
 */
function ascend_pb_animation_settings( $fields ) {
	$fields['animation'] = array(
			'title'  => __( 'Animation', 'ascend' ),
			'fields' => array(),
		);
	$fields['animation']['fields']['kt-animation-duration'] = array(
			'type'        => 'select',
			'options'     => array(
				'300' => __( '300 Milliseconds','ascend'),
				'600' => __( '600 Milliseconds','ascend'),
				'900' => __( '900 Milliseconds','ascend'),
				'1200' => __( '1200 Milliseconds','ascend'),
				'1500' => __( '1500 Milliseconds','ascend'),
				'1800' => __( '1800 Milliseconds','ascend'),
				'2100' => __( '2100 Milliseconds','ascend'),
				'2400' => __( '2400 Milliseconds','ascend'),
				'2700' => __( '2700 Milliseconds','ascend'),
				'3000' => __( '3000 Milliseconds','ascend'),
			),
			'label'       => __( 'Default Animation Duration', 'ascend' ),
			'description' => __( 'Default animation duration time in milliseconds.', 'ascend' ),
		);
	$fields['animation']['fields']['kt-animation-delay'] = array(
			'type'        => 'select',
			'options'     => array(
				'0' => __( 'None','ascend'),
				'300' => __( '300 Milliseconds','ascend'),
				'600' => __( '600 Milliseconds','ascend'),
				'900' => __( '900 Milliseconds','ascend'),
				'1200' => __( '1200 Milliseconds','ascend'),
				'1500' => __( '1500 Milliseconds','ascend'),
				'1800' => __( '1800 Milliseconds','ascend'),
				'2100' => __( '2100 Milliseconds','ascend'),
				'2400' => __( '2400 Milliseconds','ascend'),
				'2700' => __( '2700 Milliseconds','ascend'),
				'3000' => __( '3000 Milliseconds','ascend'),
			),
			'label'       => __( 'Default Animation Delay', 'ascend' ),
			'description' => __( 'Default animation delay time in milliseconds.', 'ascend' ),
		);
	return $fields;
}
add_filter( 'siteorigin_panels_settings_fields', 'ascend_pb_animation_settings', 50);
function ascend_pb_animation_settings_defaults($defaults) {
	$defaults['display-teaser']    		= false;
	$defaults['display-learn']     		= false;
	$defaults['kt-animation-duration']  = '900';
	$defaults['kt-animation-delay']  	= '0';

	return $defaults;
}
add_filter( 'siteorigin_panels_settings_defaults', 'ascend_pb_animation_settings_defaults', 50);
function ascend_pb_animation_group( $groups ) {

	$groups['kt_animation'] = array(
		'name'		=> __( 'Animation', 'ascend' ),
		'priority' 	=> 40,
		);

	return $groups;
}
add_filter( 'siteorigin_panels_widget_style_groups', 'ascend_pb_animation_group', 10, 3 );

function ascend_pb_animation_fields( $fields ) {
	$animations = array(
	'' => 'No Animations',
	'fadeIn' => 'Fade In',
	'fadeInUp' => 'Fade In Up',
	'fadeInUpBig' => 'Fade In Up Big',
	'fadeInDown' => 'Fade In Down',
	'fadeInDownBig' => 'Fade In Down Big',
	'fadeInLeft' => 'Fade In Left',
	'fadeInLeftBig' => 'Fade In Left Big',
	'fadeInRight' => 'Fade In Right',
	'fadeInRightBig' => 'Fade In Right Big',
	'slideInLeft' => 'Slide In Left',
	'slideInDown' => 'Slide In Down',
	'slideInRight' => 'Slide In Right',
	'slideInUp' => 'Slide In Up',
	'zoomIn' => 'Zoom In',
	'zoomInUp' => 'Zoom In Up',
	'zoomInDown' => 'Zoom In Down',
	'zoomInLeft' => 'Zoom In Left',
	'zoomInRight' => 'Zoom In Right',
	//'flipInX' => 'Flip Horizontal',
	//'flipInY' => 'Flip Vertical',
	);
	$fields['kt_animation_type'] = array(
		'name' => __( 'Animation Type','ascend'),
		'type' => 'select',
		'options' => $animations,
		'group' => 'kt_animation',
		'description' => __( 'Choose an animation style', 'ascend'),
		'priority' => 5,
	);
	$fields['kt_animation_duration'] = array(
		'name' => 'Duration',
		'type' => 'select',
		'options' => array(
			'default' => __( 'Default Duration','ascend'),
			'300' => __( '300 Milliseconds','ascend'),
			'600' => __( '600 Milliseconds','ascend'),
			'900' => __( '900 Milliseconds','ascend'),
			'1200' => __( '1200 Milliseconds','ascend'),
			'1500' => __( '1500 Milliseconds','ascend'),
			'1800' => __( '1800 Milliseconds','ascend'),
			'2100' => __( '2100 Milliseconds','ascend'),
			'2400' => __( '2400 Milliseconds','ascend'),
			'2700' => __( '2700 Milliseconds','ascend'),
			'3000' => __( '3000 Milliseconds','ascend'),
		),
		'group' => 'kt_animation',
		'description' => 'Choose the animation duration',
		'priority' => 10,
	);

	$fields['kt_animation_delay'] = array(
		'name' => __( 'Delay','ascend'),
		'type' => 'select',
		'options' => array(
			'default' => __( 'Default Delay','ascend'),
			'none' => __( 'None','ascend'),
			'300' => __( '300 Milliseconds','ascend'),
			'600' => __( '600 Milliseconds','ascend'),
			'900' => __( '900 Milliseconds','ascend'),
			'1200' => __( '1200 Milliseconds','ascend'),
			'1500' => __( '1500 Milliseconds','ascend'),
			'1800' => __( '1800 Milliseconds','ascend'),
			'2100' => __( '2100 Milliseconds','ascend'),
			'2400' => __( '2400 Milliseconds','ascend'),
			'2700' => __( '2700 Milliseconds','ascend'),
			'3000' => __( '3000 Milliseconds','ascend'),
		),
		'group' => 'kt_animation',
		'description' => __( 'Delay before the animation starts.','ascend'),
		'priority' => 15,
	);

	return $fields;

}
add_filter( 'siteorigin_panels_widget_style_fields', 'ascend_pb_animation_fields', 1, 3 );

function ascend_pb_animation_attributes( $atts, $value ) {

	if ( empty( $value['kt_animation_type'] ) ) {
		return $atts;
	}

	// Add the animate class to the class attribute.
	if ( ! empty( $value['kt_animation_type'] ) ) {
		if ( empty( $value['kt_animation_duration'] ) || 'default' == $value['kt_animation_duration']) {
			$duration = 'kt-pb-duration-'.siteorigin_panels_setting( 'kt-animation-duration' );
		} else {
			$duration = 'kt-pb-duration-'.$value['kt_animation_duration'];
		}
		if ( empty( $value['kt_animation_delay'] ) || 'default' == $value['kt_animation_delay']) {
			$delay = 'kt-pb-delay-'.siteorigin_panels_setting( 'kt-animation-delay' );
		} else {
			$delay = 'kt-pb-delay-'.$value['kt_animation_delay'];
		}
		$atts['class'] = array( 'kt-pb-animation', 'kt-pb-'.$value['kt_animation_type'], $duration, $delay );
	}

	return $atts;
}
add_filter( 'siteorigin_panels_widget_style_attributes', 'ascend_pb_animation_attributes', 10, 2 );
