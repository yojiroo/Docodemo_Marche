<?php 
add_filter( 'cmb2_admin_init', 'ascend_product_metaboxes');
function ascend_product_metaboxes(){
	$prefix = '_kad_';
	global $ascend;

	if(isset($ascend['custom_tab_01']) && $ascend['custom_tab_01'] == '1') {
		$kt_custom_tab_01 = new_cmb2_box( array(
			'id'         	=> 'kad_custom_tab_01',
			'title'      	=> __("Custom Tab 01", 'ascend'),
			'object_types'  => array('product'),
			'priority'   	=> 'default',
		) );
		$kt_custom_tab_01->add_field( array(
			'name' => __( "Tab Title", 'ascend' ),
			'desc' => __( "This will show on the tab", 'ascend' ),
			'id'   => $prefix . 'tab_title_01',
			'type' => 'text',
		) );
		$kt_custom_tab_01->add_field( array(
			'name'    => __("Tab Content", 'ascend' ),
			'desc'    =>  __( "Add Tab Content", 'ascend' ),
			'id'      => $prefix . 'tab_content_01',
			'type'    => 'wysiwyg',
		) );
		$kt_custom_tab_01->add_field( array(
			'name' => __( "Tab priority", 'ascend' ),
			'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'ascend' ),
			'id'   => $prefix . 'tab_priority_01',
			'type' => 'text',
		) );
	}
	if(isset($ascend['custom_tab_02']) && $ascend['custom_tab_02'] == '1') {
		$kt_custom_tab_02 = new_cmb2_box( array(
			'id'         	=> 'kad_custom_tab_02',
			'title'      	=> __("Custom Tab 02", 'ascend'),
			'object_types'  => array('product'),
			'priority'   	=> 'default',
		) );
		$kt_custom_tab_02->add_field( array(
			'name' => __( "Tab Title", 'ascend' ),
			'desc' => __( "This will show on the tab", 'ascend' ),
			'id'   => $prefix . 'tab_title_02',
			'type' => 'text',
		) );
		$kt_custom_tab_02->add_field( array(
			'name'    => __("Tab Content", 'ascend' ),
			'desc'    =>  __( "Add Tab Content", 'ascend' ),
			'id'      => $prefix . 'tab_content_02',
			'type'    => 'wysiwyg',
		) );
		$kt_custom_tab_02->add_field( array(
			'name' => __( "Tab priority", 'ascend' ),
			'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'ascend' ),
			'id'   => $prefix . 'tab_priority_02',
			'type' => 'text',
		) );
	}
	if(isset($ascend['custom_tab_03']) && $ascend['custom_tab_03'] == '1') {
		$kt_custom_tab_03 = new_cmb2_box( array(
			'id'         	=> 'kad_custom_tab_03',
			'title'      	=> __("Custom Tab 03", 'ascend'),
			'object_types'  => array('product'),
			'priority'   	=> 'default',
		) );
		$kt_custom_tab_03->add_field( array(
			'name' => __( "Tab Title", 'ascend' ),
			'desc' => __( "This will show on the tab", 'ascend' ),
			'id'   => $prefix . 'tab_title_03',
			'type' => 'text',
		) );
		$kt_custom_tab_03->add_field( array(
			'name'    => __("Tab Content", 'ascend' ),
			'desc'    =>  __( "Add Tab Content", 'ascend' ),
			'id'      => $prefix . 'tab_content_03',
			'type'    => 'wysiwyg',
		) );
		$kt_custom_tab_03->add_field( array(
			'name' => __( "Tab priority", 'ascend' ),
			'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'ascend' ),
			'id'   => $prefix . 'tab_priority_03',
			'type' => 'text',
		) );
	}
}