<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
function ascend_gallery_field( $field, $meta ) {
    echo '<div class="kad-gallery kad_widget_image_gallery">';
    echo '<div class="gallery_images">';
    $attachments = array_filter( explode( ',', $meta ) );
            if ( $attachments ) :
                foreach ( $attachments as $attachment_id ) {
                    $img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                    $imgfull = wp_get_attachment_image_src($attachment_id, 'full');
                    echo '<a class="of-uploaded-image edit-kt-meta-gal" data-attachment-id="'.esc_attr($attachment_id).'"  href="#">';
                    echo '<img class="gallery-widget-image" id="gallery_widget_image_'.esc_attr($attachment_id). '" src="' . esc_url($img[0]) . '" width="'.esc_attr($img[1]).'" height="'.esc_attr($img[2]).'" />';
                    echo '</a>';
                }
            endif;
    echo '</div>';
    echo ' <input type="hidden" id="' . esc_attr($field->args( 'id' )) . '" name="' . esc_attr($field->args( 'id' )) . '" class="gallery_values" value="' . esc_attr($meta) . '" />';
    echo '<a href="#" onclick="return false;" id="edit-gallery" class="gallery-attachments button button-primary">' . __('Add/Edit Gallery', 'ascend') . '</a>';
    echo '<a href="#" onclick="return false;" id="clear-gallery" class="gallery-attachments button">' . __('Clear Gallery', 'ascend') . '</a>';
    echo '</div>';
    $desc = $field->args('desc');
    if ( !empty( $desc)) {
        echo '<p class="cmb_metabox_description">' . $field->args( 'desc' ) . '</p>';
    }
}
add_filter( 'cmb2_render_kad_gallery', 'ascend_gallery_field', 10, 2 );


function ascend_cmb_sidebar_options() {
    global $ascend;
    $sidebars = array(
        'default' => __('Default', 'ascend')
    );
    $nonsidebars = array(
    	'header_extras_widget_second',
    	'header_extras_widget',
    	'topbar_widget',
        'homewidget',
        'footer_1',
        'footer_2',
        'footer_3',
        'footer_4',
        'footer_5',
        );
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
        if(!in_array($sidebar['id'], $nonsidebars) ){
            $sidebars[ $sidebar['id'] ] = $sidebar['name'];
        }
    }
    return $sidebars;
}

add_action( 'cmb2_render_kt_text_number', 'ascend_render_kt_text_number', 10, 5 );
function ascend_render_kt_text_number($field, $meta, $object_id, $object_type, $field_type_object) {
    echo $field_type_object->input( array( 'class' => 'cmb_text_small', 'type' => 'number' ) );
}
add_action( 'cmb2_render_kt_select_category', 'ascend_render_select_category', 10, 2 );
function ascend_render_select_category( $field, $meta ) {
    wp_dropdown_categories(array(
            'show_option_none' => __( "All Blog Posts", 'ascend' ),
            'hierarchical' => 1,
            'taxonomy' => 'category',
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field->args( 'id' ),
            'selected' => $meta  

        ));
    $desc = $field->args( 'desc' );
    if ( !empty( $desc ) ) {
    	echo '<p class="cmb_metabox_description">' . $desc . '</p>';
    }
}
add_action( 'cmb2_render_kt_select_group', 'ascend_render_select_group', 10, 2 );
function ascend_render_select_group( $field, $meta ) {
    wp_dropdown_categories(array(
            'show_option_none' => __( "All Groups", 'ascend' ),
            'hierarchical' => 1,
            'taxonomy' => $field->args( 'taxonomy'),
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field->args( 'id' ),
            'selected' => $meta  

        ));
    $desc = $field->args( 'desc' );
    if ( !empty( $desc ) ) {
    	echo '<p class="cmb_metabox_description">' . $desc . '</p>';
    }
}
add_action( 'cmb2_render_kt_select_type', 'ascend_render_select_type', 10, 2 );
function ascend_render_select_type( $field, $meta ) {
    wp_dropdown_categories(array(
            'show_option_none' => __( "All Types", 'ascend' ),
            'hierarchical' => 1,
            'taxonomy' => $field->args( 'taxonomy'),
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field->args( 'id' ),
            'selected' => $meta  

        ));
    $desc = $field->args( 'desc' );
    if ( !empty( $desc ) ) {
    	echo '<p class="cmb_metabox_description">' . $desc . '</p>';
    }
}
function ascend_metabox_include_home_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'blog-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }
    $response = false;
    if(get_page_template_slug($post_id ) == 'template-blog.php') {
    	$response = true;
    } else if($post_id == get_option( 'page_for_posts' )) {
    	$response = true;
    }
    return $response;
}
add_filter( 'cmb2_show_on', 'ascend_metabox_include_home_page', 10, 2 );
function ascend_all_custom_posts() {
    $args = array(
       'public'   => true,
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    $post_types = get_post_types( $args, $output, $operator ); 
    $all_post_types = array();
    foreach ( $post_types  as $post_type ) {
    	if('kt_gallery' == $post_type || 'kad_slider' == $post_type) {
    	} else {
        	array_push($all_post_types, $post_type);
    	}
    }
    return $all_post_types;
}