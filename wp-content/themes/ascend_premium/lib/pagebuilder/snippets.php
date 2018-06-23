<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


function ascend_panels_dump(){
	echo "<!--\n\n";
	echo "// Page Builder Data\n\n";

	if(isset($_GET['page']) && $_GET['page'] == 'so_panels_home_page') {
		var_export( get_option( 'siteorigin_panels_home_page', null ) );
	}
	else{
		global $post;
		var_export( get_post_meta($post->ID, 'panels_data', true));
	}
	echo "\n\n-->";
}
//add_action('siteorigin_panels_metabox_end', 'ascend_panels_dump');

/**
 * Extend - Site Origin Panels 
 */
function ascend_snippet_prebuilt_page_layouts($layouts){
	$layouts['snip-about-us-numbers'] = array (
	'name' => __('SNIP: About us with number points', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_numbers-min.jpg',
	'description' => 'Text section with numbered promo sections',
	'widgets' => array (
		 0 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h2>Hello! We are a <strong>Design Agency</strong></h2><h5>A Brand and Marketing agency based out of Los Angeles.</h5><p>Donec a eleifend nisl. Morbi rutrum, nisi vel pellentesque suscipit, magna orci fringilla libero, quis varius quam odio non lacus. Sed pretium tempus condimentum. Suspendisse vel maximus neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam molestie lacinia ipsum ut sagittis.</p><p>Nullam sollicitudin ornare faucibus. Proin a eros <strong>14 years experiance</strong> eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc. Nulla enim metus, <strong>top rated support</strong> dictum finibus lobortis sed, vestibulum ut libero. Aenean volutpat mollis auctor.</p><p>Suspendisse vel maximus neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam <strong>brand identity</strong> molestie lacinia ipsum ut sagittis.</p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'a8608e92-8ed3-4abf-a0f9-97abac979508',
        'style' => 
        array (
          'padding' => '0px 20px 0px 0px',
          'mobile_padding' => '0px 0px 0px 0px',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'panels_data' => 
      array (
        'widgets' => 
        array (
          0 => 
          array (
            'type' => 'html',
            'title' => '',
            'text' => '<div><span style="font-size: 50px; font-weight:bold; line-height:50px; color: #dddddd;">01</span></div>
<h4>Quality</h4>
Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc.',
            'filter' => '1',
            'panels_info' => 
            array (
              'class' => 'WP_Widget_Black_Studio_TinyMCE',
              'grid' => 0,
              'cell' => 0,
              'id' => 0,
              'widget_id' => '28f338b3-f777-47e7-9bc9-f5ad214c3d07',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          1 => 
          array (
            'type' => 'html',
            'title' => '',
            'text' => '<div><span style="font-size: 50px; font-weight:bold; line-height:50px; color: #dddddd;">02</span></div>
<h4>Service</h4>
Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc.',
            'filter' => '1',
            'panels_info' => 
            array (
              'class' => 'WP_Widget_Black_Studio_TinyMCE',
              'grid' => 0,
              'cell' => 1,
              'id' => 1,
              'widget_id' => '41710d7e-2874-4e1a-b5cb-994435ad661f',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          2 => 
          array (
            'type' => 'html',
            'title' => '',
            'text' => '<div><span style="font-size: 50px; font-weight:bold; line-height:50px; color: #dddddd;">03</span></div>
<h4>Marketing</h4>
Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc.',
            'filter' => '1',
            'panels_info' => 
            array (
              'class' => 'WP_Widget_Black_Studio_TinyMCE',
              'grid' => 1,
              'cell' => 0,
              'id' => 2,
              'widget_id' => '9b18336d-6222-4b89-b1c1-8e7fd60a4ed7',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          3 => 
          array (
            'type' => 'html',
            'title' => '',
            'text' => '<div><span style="font-size: 50px; font-weight:bold; line-height:50px; color: #dddddd;">04</span></div>
<h4>Support</h4>
Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc.',
            'filter' => '1',
            'panels_info' => 
            array (
              'class' => 'WP_Widget_Black_Studio_TinyMCE',
              'grid' => 1,
              'cell' => 1,
              'id' => 3,
              'widget_id' => 'f82fce00-e6a7-4171-9292-3ab3e65187fc',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
        ),
        'grids' => 
        array (
          0 => 
          array (
            'cells' => 2,
            'style' => 
            array (
              'id' => '',
              'class' => '',
              'cell_class' => '',
              'row_css' => '',
              'mobile_css' => '',
              'bottom_margin' => '0px',
              'gutter' => '30px',
              'vertical_gutter' => 'default',
              'padding' => '',
              'mobile_padding' => '',
              'row_stretch' => '',
              'collapse_behaviour' => 'no_collapse',
              'collapse_order' => '',
              'cell_alignment' => 'flex-start',
              'background_image_url' => '',
              'background_image' => '0',
              'background' => '',
              'background_image_style' => 'cover',
              'background_image_position' => 'center top',
              'border_top' => '',
              'border_top_color' => '',
              'border_bottom' => '',
              'border_bottom_color' => '',
              'row_separator' => 'none',
              'next_row_background_color' => 'none',
            ),
          ),
          1 => 
          array (
            'cells' => 2,
            'style' => 
            array (
              'id' => '',
              'class' => '',
              'cell_class' => '',
              'row_css' => '',
              'mobile_css' => '',
              'bottom_margin' => '0px',
              'gutter' => '30px',
              'vertical_gutter' => 'default',
              'padding' => '',
              'mobile_padding' => '',
              'row_stretch' => '',
              'collapse_behaviour' => 'no_collapse',
              'collapse_order' => '',
              'cell_alignment' => 'flex-start',
              'background_image_url' => '',
              'background_image' => '0',
              'background' => '',
              'background_image_style' => 'cover',
              'background_image_position' => 'center top',
              'border_top' => '',
              'border_top_color' => '',
              'border_bottom' => '',
              'border_bottom_color' => '',
              'row_separator' => 'none',
              'next_row_background_color' => 'none',
            ),
          ),
        ),
        'grid_cells' => 
        array (
          0 => 
          array (
            'grid' => 0,
            'index' => 0,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          1 => 
          array (
            'grid' => 0,
            'index' => 1,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          2 => 
          array (
            'grid' => 1,
            'index' => 0,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          3 => 
          array (
            'grid' => 1,
            'index' => 1,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
        ),
      ),
      'builder_id' => '59ee876add107',
      'panels_info' => 
      array (
        'class' => 'SiteOrigin_Panels_Widgets_Layout',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'a90a8462-454c-4504-a396-ff308da7dfb1',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '60px 0px 60px 0px',
        'background' => '#ffffff',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'no-margin',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
  ),
);

	$layouts['snip-slit-two-image'] = array (
	'name' => __('SNIP: Split text with images', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_split_two_image-min.jpg',
	'description' => 'Two rows of text split with images.',
	'widgets' => array (
		0 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h2 style="text-align: center;">ABOUT US</h2>
<h5 style="text-align: center;">we strive for <strong>perfection</strong></h5>
<p style="text-align: center;">Nullam sollicitudin ornare faucibus. Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc. Nulla enim metus, dictum finibus lobortis sed, vestibulum ut libero. Aenean volutpat mollis auctor.</p>
<p style="text-align: center;">[btn text="Learn More" link="#" tcolor="#ffffff" thovercolor="#ffffff"]</p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'a8608e92-8ed3-4abf-a0f9-97abac979508',
        'style' => 
        array (
          'padding' => '0px 30px 0px 30px',
          'mobile_padding' => '0px 0px 0px 0px',
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/coffee_tables-min.jpg',
      'image_id' => '',
      'align' => 'center',
      'image_shape' => 'standard',
      'image_size' => 'custom',
      'width' => 300,
      'height' => 500,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '00541d57-6dab-4318-ab32-d60544d268fd',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    2 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/coffee_lights-min.jpg',
      'image_id' => '',
      'align' => 'center',
      'image_shape' => 'standard',
      'image_size' => 'custom',
      'width' => 300,
      'height' => 500,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 2,
        'id' => 2,
        'widget_id' => '6875985b-905e-4ada-9f7d-78ad1fcea5f0',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    3 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/phone_app-min.jpg',
      'image_id' => '',
      'align' => 'center',
      'image_shape' => 'standard',
      'image_size' => 'custom',
      'width' => 300,
      'height' => 500,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 3,
        'widget_id' => '5a4a4b2c-122f-4450-a11c-01c843e88c8f',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    4 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/watch_app-min.jpg',
      'image_id' => '',
      'align' => 'center',
      'image_shape' => 'standard',
      'image_size' => 'custom',
      'width' => 300,
      'height' => 500,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '82ea4dac-16d8-4545-b636-5fa9f9523105',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    5 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h2 style="text-align: center;">FEATURED WORK</h2>
<h5 style="text-align: center;">we focus on the <strong>customer</strong></h5>
<p style="text-align: center;">Nullam sollicitudin ornare faucibus. Proin a eros eget nisl mattis fermentum. Aenean vel faucibus nibh. Integer ut consectetur nunc. Nulla enim metus, dictum finibus lobortis sed, vestibulum ut libero. Aenean volutpat mollis auctor.</p>
<p style="text-align: center;">[btn text="Learn More" link="#" tcolor="#ffffff" thovercolor="#ffffff"]</p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 1,
        'cell' => 2,
        'id' => 5,
        'widget_id' => 'af9c2754-17d3-4c77-9033-88d823733114',
        'style' => 
        array (
          'padding' => '0px 30px 0px 30px',
          'mobile_padding' => '0px 0px 0px 0px',
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '50px 0px 50px 0px',
        'background' => '#ffffff',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '50px 0px 50px 0px',
        'background' => '#f9f9f9',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image' => false,
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
        'next_row_background_color' => '',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.50000000000000011102230246251565404236316680908203125,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.2496991576413959135205544725977233611047267913818359375,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 0,
      'index' => 2,
      'weight' => 0.250300842358604114235021143031190149486064910888671875,
      'style' => 
      array (
      ),
    ),
    3 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.2496023831763904132774456456900225020945072174072265625,
      'style' => 
      array (
      ),
    ),
    4 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.250000000000000055511151231257827021181583404541015625,
      'style' => 
      array (
      ),
    ),
    5 => 
    array (
      'grid' => 1,
      'index' => 2,
      'weight' => 0.50039761682360961447812996993889100849628448486328125,
      'style' => 
      array (
      ),
    ),
  ),
);

$layouts['snip-hexagon-text'] = array (
	'name' => __('SNIP: Hexagon image beside text', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_diamond-min.jpg',
	'description' => 'An image in Hexagon shape beside promo text.',
	'widgets' => array (
    0 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/coffee_shop-min.jpg',
      'image_id' => '',
      'image_shape' => 'hexagon',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'none',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'ac8ac463-0c89-4957-af83-2e52d6313adf',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h3>Let us show you what it feels like to be an exclusive customer</h3>
[space  size="20px"]
<strong>We take the hassle out of every day</strong> </br> With our aggressive work in development and marketing, you get the most exclusive experience. We can guarantee product success and advancement.

<strong>We make the most of every opportunity</strong></br> Never worry about missing some major opportunity, with us on our side we make things happen. Fast action and real time monitoring.',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '629251c9-9cb3-4442-9459-c36d3690ba30',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '80px 0px 80px 0px',
        'mobile_padding' => '30px 0px 30px 0px',
        'bottom_margin' => '0px',
        'gutter' => '80px',
        'cell_alignment' => 'center',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.400105570425622170116497500202967785298824310302734375,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.59989442957437777437235126853920519351959228515625,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-parallax-anim'] = array (
	'name' => __('SNIP: Parallax with Animated Text', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_parallax-min.jpg',
	'description' => 'A parallax hero section with clean animation.',
	'widgets' =>  array (
    0 => 
    array (
      'title' => 'The Ultimate Experience',
      'tsize' => 70,
      'tsmallsize' => 40,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'subtitle' => '',
      'ssize' => 24,
      'ssmallsize' => 18,
      'scolor' => '#efefef',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 0,
        'widget_id' => 'b50e6e53-d9b9-4435-813b-50a64c448be2',
        'style' => 
        array (
          'widget_css' => 'margin-bottom:0',
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'tsize' => 120,
      'tsmallsize' => 50,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'subtitle' => 'Aliquam fringilla blandit efficitur. Ut malesuada feugiat tortor, at fermentum quam efficitur sed. Cras nulla arcu, volutpat quis justo faucibus, pharetra consequat neque.',
      'ssize' => 24,
      'ssmallsize' => 18,
      'scolor' => '#efefef',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'f3180970-6ba3-4e24-8b88-53e365c7c713',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    2 => 
    array (
      'title' => '',
      'tsize' => 60,
      'tsmallsize' => 0,
      'tcolor' => '',
      'title_html_tag' => 'h2',
      'subtitle' => '',
      'ssize' => 30,
      'ssmallsize' => 0,
      'scolor' => '',
      'align' => 'center',
      'btn_text' => 'EXPLORE MORE',
      'btn_link' => '#',
      'btn_target' => 'false',
      'btn_color' => '#ffffff',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '4px',
      'btn_border_color' => '#ffffff',
      'btn_hover_color' => '#444444',
      'btn_hover_background' => '#ffffff',
      'btn_hover_border_color' => '#ffffff',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 2,
        'widget_id' => '40b0efad-b835-4c90-bf78-e4c3ba9f99b7',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '600',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '300px 0px 300px 0px',
        'mobile_padding' => '100px 0px 100px 0px',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'no-margin',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_parallax_scroll_02-min.jpg',
        'background_image' => false,
        'background_image_position' => 'center center',
        'background_image_style' => 'parallax',
        'row_separator' => 'none',
        'next_row_background_color' => '',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.125047947832757910813228363622329197824001312255859375,
      'style' => 
      array (
        'background_image_attachment' => false,
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.74990410433448417837354327275534160435199737548828125,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 0,
      'index' => 2,
      'weight' => 0.1250479478327579385688039792512427084147930145263671875,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-icon-promo'] = array (
	'name' => __('SNIP: Hero beside Icon List', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_promo_righticon-min.jpg',
	'description' => 'An image Hero beside a list of Icons and text.',
	'widgets' => array (
    0 => 
    array (
      'abovetitle' => 'Need help?',
      'atsize' => 30,
      'atsmallsize' => 0,
      'atcolor' => '#ffffff',
      'title' => 'INCREASE YOUR SALES',
      'tsize' => 80,
      'tsmallsize' => 30,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h3',
      'tweight' => '800',
      'subtitle' => 'Proin hendrerit tincidunt metus, sed rutrum felis ultricies sed. Nullam porta vitae enim eu vulputate. Etiam quis dignissim magna. Vestibulum in eleifend massa.',
      'ssize' => 18,
      'ssmallsize' => 14,
      'scolor' => '#ffffff',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => '63999054-0375-4f1a-ac51-b280175ad0cd',
        'style' => 
        array (
          'widget_css' => 'max-width:600px;
margin:0 auto;',
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeIn',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '600',
        ),
      ),
    ),
    1 => 
    array (
      'info_icon' => 'kt-icon-rocket2',
      'image_uri' => '',
      'image_id' => '',
      'title' => 'PRODUCTION OPTIMIZATION',
      'description' => 'Fusce mollis justo ligula, a elementum leo imperdiet ac. In hendrerit cursus neque. Aenean feugiat risus velit, vel rhoncus.',
      'background' => '',
      'tcolor' => '#575757',
      'size' => 40,
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#444444',
      'color' => '#ffffff',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '09d67770-0fb4-4154-ae45-845abbe13868',
        'style' => 
        array (
          'padding' => '100px 30px 20px 30px',
          'mobile_padding' => '20px 30px 20px 30px',
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'slideInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    2 => 
    array (
      'info_icon' => 'kt-icon-bar-chart',
      'image_uri' => '',
      'image_id' => '',
      'title' => 'MARKETING SPECIALIST',
      'description' => 'Ut malesuada feugiat tortor, at fermentum quam efficitur sed. Cras nulla arcu, volutpat quis justo faucibus.',
      'background' => '',
      'tcolor' => '#575757',
      'size' => 40,
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#444444',
      'color' => '#ffffff',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 0,
        'cell' => 1,
        'id' => 2,
        'widget_id' => '09d67770-0fb4-4154-ae45-845abbe13868',
        'style' => 
        array (
          'padding' => '20px 30px 20px 30px',
          'mobile_padding' => '20px 30px 20px 30px',
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'slideInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    3 => 
    array (
      'info_icon' => 'kt-icon-pie-chart8',
      'image_uri' => '',
      'image_id' => '',
      'title' => 'ADVANCED REPORTS',
      'description' => 'Maecenas varius ante a quam imperdiet elementum. Vivamus porta diam neque.',
      'background' => '',
      'tcolor' => '#575757',
      'size' => 40,
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#444444',
      'color' => '#ffffff',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 0,
        'cell' => 1,
        'id' => 3,
        'widget_id' => '09d67770-0fb4-4154-ae45-845abbe13868',
        'style' => 
        array (
          'padding' => '20px 30px 20px 30px',
          'mobile_padding' => '20px 30px 20px 30px',
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'slideInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    4 => 
    array (
      'info_icon' => 'kt-icon-trophy',
      'image_uri' => '',
      'image_id' => '',
      'title' => 'COMPLETE GOALS',
      'description' => 'Vivamus porta diam neque. Maecenas varius ante a quam imperdiet elementum varius ante.',
      'background' => '',
      'tcolor' => '#575757',
      'size' => 40,
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#444444',
      'color' => '#ffffff',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 0,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '09d67770-0fb4-4154-ae45-845abbe13868',
        'style' => 
        array (
          'padding' => '20px 30px 100px 30px',
          'mobile_padding' => '20px 30px 20px 30px',
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'slideInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '0px 0px 0px 0px',
        'mobile_padding' => '0px 0px 0px 0px',
        'bottom_margin' => '0px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'no-margin',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/evergreens.jpg',
        'background_image' => false,
        'background_image_position' => 'center center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
        'next_row_background_color' => '',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.64962312828814250398323792978771962225437164306640625,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.350376871711857551527913301470107398927211761474609375,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-contact-beside-text'] = array (
	'name' => __('SNIP: Title beside contact form', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_contact_beside_title-min.jpg',
	'description' => 'Large title beside simple contact form',
	'widgets' => array (
	0 => 
    array (
      'abovetitle' => 'THOUGHTS, HOPES, DREAMS',
      'atsize' => 12,
      'atsmallsize' => 0,
      'atcolor' => '#555555',
      'atweight' => '600',
      'title' => 'Share with us</br>all the great</br>things you</br>have to say.',
      'tsize' => 50,
      'tsmallsize' => 0,
      'tcolor' => '#2b2b2b',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => '',
      'ssize' => 16,
      'ssmallsize' => 0,
      'scolor' => '',
      'sweight' => '600',
      'align' => 'right',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'c5e8d119-209b-4ffc-9402-82323724f016',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '[kt_contact_form style="light" enable_math="false"]',
      'filter' => '0',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'b7cf4c42-1f4b-4416-afbb-36af2542f114',
        'style' => 
        array (
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '100px 0px 100px 0px',
        'bottom_margin' => '0px',
        'gutter' => '60px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.350081037277147455455406088731251657009124755859375,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.649918962722852544544593911268748342990875244140625,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-hex-services'] = array (
	'name' => __('SNIP: Services with hexagon images', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_hexagon_services-min.jpg',
	'description' => 'A services section with hexagon promo images',
	'widgets' =>  array (
	0 => 
    array (
      'abovetitle' => 'WE SOLVE PROBLEMS',
      'atsize' => 20,
      'atsmallsize' => 0,
      'atcolor' => '#555555',
      'title' => 'Tailored Services',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#444444',
      'title_html_tag' => 'h2',
      'tweight' => '600',
      'subtitle' => '',
      'ssize' => 16,
      'ssmallsize' => 0,
      'scolor' => '#777777',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'c924fd30-0f8b-4427-b938-d7c82fddfb3f',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeIn',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/meeting_outside-min.jpg',
      'image_id' => '',
      'image_shape' => 'hexagon',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'widget_id' => '2d5b8045-374a-4823-91f8-660572a9707b',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    2 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h4>STRATEGIC ONLINE MARKETING TECHNIQUES</h4><p>Proin dolor lorem, placerat vitae lacinia in, dapibus vitae justo. Nullam euismod enim risus. Duis nec est eu purus feugiat bibendum ut at ante. Aliquam ac consectetur metus, vel porttitor ante. </p><p><a href="#">Learn More</a></p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'widget_id' => '4628e7e6-49ce-40bd-ac17-aab3efa697ee',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    3 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/coffee_shop-min.jpg',
      'image_id' => '',
      'image_shape' => 'hexagon',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'grid' => 1,
        'cell' => 1,
        'id' => 3,
        'widget_id' => '2d5b8045-374a-4823-91f8-660572a9707b',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    4 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h4>CONNECTING YOUR BRANDS AND IDEAS</h4><p>Proin dolor lorem, placerat vitae lacinia in, dapibus vitae justo. Nullam euismod enim risus. Duis nec est eu purus feugiat bibendum ut at ante. Aliquam ac consectetur metus, vel porttitor ante. </p><p><a href="#">Learn More</a></p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 1,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '4628e7e6-49ce-40bd-ac17-aab3efa697ee',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    5 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/phone_girl-min.jpg',
      'image_id' => '',
      'image_shape' => 'hexagon',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 2,
        'id' => 5,
        'widget_id' => '2d5b8045-374a-4823-91f8-660572a9707b',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    6 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h4>ADVANCED SUPPORT MANAGEMENT SYSTEMS</h4><p>Proin dolor lorem, placerat vitae lacinia in, dapibus vitae justo. Nullam euismod enim risus. Duis nec est eu purus feugiat bibendum ut at ante. Aliquam ac consectetur metus, vel porttitor ante. </p><p><a href="#">Learn More</a></p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 1,
        'cell' => 2,
        'id' => 6,
        'widget_id' => '4628e7e6-49ce-40bd-ac17-aab3efa697ee',
        'style' => 
        array (
          'background_display' => 'tile',
          'animation_offset' => '10',
          'animation_iteration' => '1',
          'kt_animation_type' => 'fadeInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding' => '40px 0px 60px 0px',
        'bottom_margin' => '0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '0px 0px 40px 0px',
        'bottom_margin' => '0px',
        'gutter' => '100px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.33333333333333337034076748750521801412105560302734375,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.33333333333333337034076748750521801412105560302734375,
      'style' => 
      array (
      ),
    ),
    3 => 
    array (
      'grid' => 1,
      'index' => 2,
      'weight' => 0.33333333333333337034076748750521801412105560302734375,
      'style' => 
      array (
      ),
    ),
  ),
);
	$layouts['snip-three-image-menu'] = array (
    'name' => __('SNIP: Three image menu', 'ascend'),
    'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_image_menu-min.jpg',
    'description' => 'Three column image menu layout',
    'widgets' =>
   array (
    0 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/lush.jpg',
      'image_id' => 0,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'Travel Secrets',
      'subtitle' => 'FIND WIDE OPEN SPACES',
      'link' => '#',
      'target' => 'false',
      'align' => 'right',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'b8e3fa2b-870c-46af-8a5b-5660f8422556',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '600',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/backpack.jpg',
      'image_id' => 0,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'Travel Gear',
      'subtitle' => 'TRIED AND TESTED',
      'link' => '#',
      'target' => 'false',
      'align' => 'center',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'ae543861-56c9-4f6c-86fc-1fe8b1ba022b',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '600',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    2 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/surf.jpg',
      'image_id' => 0,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'NEW Adventures',
      'subtitle' => 'ULTIMATE TRAVEL TIPS',
      'link' => '#',
      'target' => 'false',
      'align' => 'left',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'grid' => 0,
        'cell' => 2,
        'id' => 2,
        'widget_id' => 'b8e3fa2b-870c-46af-8a5b-5660f8422556',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '600',
          'kt_animation_delay' => '600',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '80px 0px 80px 0px',
        'mobile_padding' => '30px 0px 30px 0px',
        'bottom_margin' => '0px',
        'gutter' => '10px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'left top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.24977391933441850380148707699845544993877410888671875,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.49990956773376737931613433829625137150287628173828125,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 0,
      'index' => 2,
      'weight' => 0.250316512931814061371227353447466157376766204833984375,
      'style' => 
      array (
      ),
    ),
  ),
);

$layouts['snip-product-display'] = array (
	'name' => __('SNIP: App promo call to action', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_app_promo-min.jpg',
	'description' => 'Promo Text with a app image beside',
	'widgets' => array (
    0 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'We help develop your <b>digital commerce</b> business',
      'tsize' => 30,
      'tsmallsize' => 24,
      'tcolor' => '#333333',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus scelerisque est at viverra mollis. Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam. Sed venenatis vehicula elit, at rutrum urna vestibulum non. ',
      'ssize' => 18,
      'ssmallsize' => 16,
      'scolor' => '#555555',
      'sweight' => 'default',
      'align' => 'left',
      'btn_text' => 'LEARN MORE',
      'btn_link' => '#',
      'btn_target' => 'false',
      'btn_color' => '#555555',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#555555',
      'btn_hover_color' => '#ffffff',
      'btn_hover_background' => '#555555',
      'btn_hover_border_color' => '#555555',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => '2d44a755-cbaf-48b1-9bf8-5e4ba2bd4521',
        'style' => 
        array (
          'padding' => '0px 0px 30px 0px',
          'mobile_padding' => '0px 20px 30px 20px',
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/flat_screens_mock-min.png',
      'image_id' => '',
      'image_shape' => 'standard',
      'image_size' => 'medium_large',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '8e7126c5-bff4-47a1-8504-76992b993394',
        'style' => 
        array (
          'padding' => '50px 0px 0px 0px',
          'mobile_padding' => '0px 20px 0px 20px',
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'row_css' => '',
        'mobile_css' => '',
        'padding' => '50px 0px 0px 0px',
        'mobile_padding' => '40px 0px 0px 0px',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'right bottom',
        'background_image_style' => 'no-repeat',
        'border_bottom' => '1px',
        'border_bottom_color' => '#eeeeee',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-coffeeshop-grid'] = array (
	'name' => __('SNIP: Coffee Shop Grid', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_shop_boxes-min.jpg',
	'description' => 'Image and Text Box grid',
	'widgets' => array (
    0 => 
    array (
      'panels_data' => 
      array (
        'widgets' => 
        array (
          0 => 
          array (
            'abovetitle' => 'BREWED WITH',
            'atsize' => 16,
            'atsmallsize' => 0,
            'atcolor' => '#777777',
            'atweight' => '600',
            'title' => 'ALL OUR PASSION',
            'tsize' => 24,
            'tsmallsize' => 0,
            'tcolor' => '#444444',
            'title_html_tag' => 'h3',
            'tweight' => '800',
            'subtitle' => '',
            'ssize' => 30,
            'ssmallsize' => 0,
            'scolor' => '',
            'sweight' => 'default',
            'align' => 'left',
            'btn_text' => 'LEARN MORE',
            'btn_link' => '#',
            'btn_target' => 'false',
            'btn_color' => '#444444',
            'btn_background' => 'transparent',
            'btn_border' => '2px',
            'btn_border_radius' => '2px',
            'btn_border_color' => '#444444',
            'btn_hover_color' => '#ffffff',
            'btn_hover_background' => '#444444',
            'btn_hover_border_color' => '#444444',
            'btn_size' => 'normal',
            'panels_info' => 
            array (
              'class' => 'kad_calltoaction_widget',
              'raw' => false,
              'grid' => 0,
              'cell' => 0,
              'id' => 0,
              'widget_id' => '597c63b0-3496-4312-831c-2deb752887f9',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '20px 20px 20px 20px',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          1 => 
          array (
            'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/espresso-min.jpg',
            'image_id' => '',
            'image_shape' => 'standard',
            'image_size' => 'full',
            'width' => 0,
            'height' => 0,
            'image_link_open' => 'lightbox',
            'image_link' => '',
            'box_shadow' => 'none',
            'text' => '',
            'panels_info' => 
            array (
              'class' => 'kad_image_widget',
              'raw' => false,
              'grid' => 0,
              'cell' => 1,
              'id' => 1,
              'widget_id' => '81d70185-66b0-413c-b4ff-9af4e076c2bd',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          2 => 
          array (
            'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pastries-min.jpg',
            'image_id' => '',
            'image_shape' => 'standard',
            'image_size' => 'full',
            'width' => 0,
            'height' => 0,
            'image_link_open' => 'lightbox',
            'image_link' => '',
            'box_shadow' => 'none',
            'text' => '',
            'panels_info' => 
            array (
              'class' => 'kad_image_widget',
              'raw' => false,
              'grid' => 1,
              'cell' => 0,
              'id' => 2,
              'widget_id' => 'df454c96-e550-4539-9548-ded5d7f95598',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          3 => 
          array (
            'abovetitle' => 'CREATED WITH',
            'atsize' => 16,
            'atsmallsize' => 0,
            'atcolor' => '#777777',
            'atweight' => '600',
            'title' => 'ALL OUR LOVE</br>AND CARE',
            'tsize' => 44,
            'tsmallsize' => 0,
            'tcolor' => '#444444',
            'title_html_tag' => 'h3',
            'tweight' => '800',
            'subtitle' => '',
            'ssize' => 30,
            'ssmallsize' => 0,
            'scolor' => '',
            'sweight' => 'default',
            'align' => 'right',
            'btn_text' => 'LEARN MORE',
            'btn_link' => '#',
            'btn_target' => 'false',
            'btn_color' => '#444444',
            'btn_background' => 'transparent',
            'btn_border' => '2px',
            'btn_border_radius' => '2px',
            'btn_border_color' => '#444444',
            'btn_hover_color' => '#ffffff',
            'btn_hover_background' => '#444444',
            'btn_hover_border_color' => '#444444',
            'btn_size' => 'normal',
            'panels_info' => 
            array (
              'class' => 'kad_calltoaction_widget',
              'raw' => false,
              'grid' => 1,
              'cell' => 1,
              'id' => 3,
              'widget_id' => '597c63b0-3496-4312-831c-2deb752887f9',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '20px 20px 20px 20px',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
        ),
        'grids' => 
        array (
          0 => 
          array (
            'cells' => 2,
            'style' => 
            array (
              'id' => '',
              'class' => '',
              'cell_class' => '',
              'row_css' => '',
              'mobile_css' => '',
              'bottom_margin' => '0px',
              'gutter' => '0px',
              'vertical_gutter' => 'no-margin',
              'padding' => '',
              'mobile_padding' => '',
              'row_stretch' => '',
              'collapse_behaviour' => '',
              'collapse_order' => '',
              'cell_alignment' => 'center',
              'background_image_url' => '',
              'background_image' => '0',
              'background' => '#ffffff',
              'background_image_style' => 'cover',
              'background_image_position' => 'center top',
              'border_top' => '',
              'border_top_color' => '',
              'border_bottom' => '',
              'border_bottom_color' => '',
              'row_separator' => 'none',
              'next_row_background_color' => 'none',
            ),
          ),
          1 => 
          array (
            'cells' => 2,
            'style' => 
            array (
              'id' => '',
              'class' => '',
              'cell_class' => '',
              'row_css' => '',
              'mobile_css' => '',
              'bottom_margin' => '0px',
              'gutter' => '0px',
              'vertical_gutter' => 'no-margin',
              'padding' => '',
              'mobile_padding' => '',
              'row_stretch' => '',
              'collapse_behaviour' => 'no_collapse',
              'collapse_order' => '',
              'cell_alignment' => 'center',
              'background_image_url' => '',
              'background_image' => '0',
              'background' => '#ffffff',
              'background_image_style' => 'cover',
              'background_image_position' => 'center top',
              'border_top' => '',
              'border_top_color' => '',
              'border_bottom' => '',
              'border_bottom_color' => '',
              'row_separator' => 'none',
              'next_row_background_color' => 'none',
            ),
          ),
        ),
        'grid_cells' => 
        array (
          0 => 
          array (
            'grid' => 0,
            'index' => 0,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          1 => 
          array (
            'grid' => 0,
            'index' => 1,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          2 => 
          array (
            'grid' => 1,
            'index' => 0,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
          3 => 
          array (
            'grid' => 1,
            'index' => 1,
            'weight' => 0.5,
            'style' => 
            array (
            ),
          ),
        ),
      ),
      'builder_id' => '5978f8d23ef62',
      'panels_info' => 
      array (
        'class' => 'SiteOrigin_Panels_Widgets_Layout',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'bd5dcedb-9356-41f3-a663-be8b1bf90c6b',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'The smell of</br><b>fresh-made</b> coffee is one</br>of the greatest <b>inventions.</b>',
      'tsize' => 60,
      'tsmallsize' => 30,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => '',
      'ssize' => 30,
      'ssmallsize' => 0,
      'scolor' => '',
      'sweight' => 'default',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'b6af4a55-8ffa-4eb6-a269-ee79e7d4bc55',
        'style' => 
        array (
          'padding' => '80px 80px 80px 80px',
          'mobile_padding' => '30px 30px 30px 30px',
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'gutter' => '0px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'no-margin',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/coffee_shop_tables-min.jpg',
        'background_image_position' => 'right center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['contact-page'] = array (
        'name' => __('SNIP: Contact Page', 'ascend'),
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_contact_page.jpg',
        'description' => 'A Contact page example with map',
        'widgets' =>
  			array (
		    0 => 
    array (
      'location' => '1337 S Flower St, Los Angeles, CA 90015',
      'maptype' => 'ROADMAP',
      'zoom' => '15',
      'height' => 400,
      'title' => '1337 S Flower Street',
      'description' => 'Stop by for friendly fast service',
      'panels_info' => 
      array (
        'class' => 'kad_gmap_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'c89cf89e-fc20-44ae-b6af-225232086e0c',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'type' => 'html',
      'title' => 'Frequently Asked Questions',
      'text' => '[accordion][pane title="What are your store hours?" start=open]

Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.

Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.

[/pane][pane title="What kind of delivery options are available?"]Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.[/pane][pane title="What payment methods are accepted?"]Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.[/pane][pane title="What is your return policy?"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/pane][pane title="Do you offer bulk pricing?"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/pane][/accordion]',
      'filter' => '0',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'widget_id' => 'b7cf4c42-1f4b-4416-afbb-36af2542f114',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    2 => 
    array (
      'type' => 'html',
      'title' => 'Send us an email',
      'text' => '[kt_contact_form]',
      'filter' => '0',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'grid' => 1,
        'cell' => 1,
        'id' => 2,
        'widget_id' => 'b7cf4c42-1f4b-4416-afbb-36af2542f114',
        'style' => 
        array (
          'background' => '#ffffff',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding' => '0px 0px 0px 0px',
        'background' => '#eeeeee',
        'bottom_margin' => '0px',
        'gutter' => '0px',
        'row_stretch' => 'full-stretched',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '40px 0px 0px 0px',
        'bottom_margin' => '30px',
        'gutter' => '60px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image' => false,
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['snip-client-carousel'] = array (
	'name' => __('SNIP: Client Carousel', 'ascend'),
	'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_client_carousel-min.jpg',
	'description' => 'Carousel of images with custom link.',
	'widgets' => array (
		0 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'Our <b>Partners</b>',
      'tsize' => 60,
      'tsmallsize' => 0,
      'tcolor' => '#444444',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => 'we keep good company',
      'ssize' => 20,
      'ssmallsize' => 0,
      'scolor' => '#777777',
      'sweight' => '300',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'af466a2b-a7f6-4abc-8274-db74a06f74ec',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '1200',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'widget_title' => '',
      'speed' => 9000,
      'columns' => 4,
      'autoplay' => 'true',
      'scroll' => '1',
      'arrows' => 'false',
      'gutter' => 'row',
      'pagination' => 'true',
      'items' => 
      array (
        0 => 
        array (
          'id' => '0',
          'builder_id' => '599d15ba5e729',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_01-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => '0c789b43-2279-4ca9-afa5-58b8b50709b8',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
        1 => 
        array (
          'id' => '1',
          'builder_id' => '599d15ba5e73d',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_02-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => '3803bfb3-ed0f-4b57-9de5-274ec9686624',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
        2 => 
        array (
          'id' => '2',
          'builder_id' => '599d15ba5e74d',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_03-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => '3b0c7b15-3dff-4672-b90a-67f21a2659e5',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                  'id' => '',
                  'class' => '',
                  'cell_class' => '',
                  'row_css' => '',
                  'mobile_css' => '',
                  'bottom_margin' => '',
                  'vertical_gutter' => 'default',
                  'gutter' => '',
                  'padding' => '',
                  'mobile_padding' => '',
                  'row_stretch' => '',
                  'collapse_behaviour' => '',
                  'collapse_order' => '',
                  'cell_alignment' => 'flex-start',
                  'background_image_url' => '',
                  'background_image' => '0',
                  'background' => '',
                  'background_image_position' => 'center top',
                  'background_image_style' => 'cover',
                  'border_top' => '',
                  'border_top_color' => '',
                  'border_bottom' => '',
                  'border_bottom_color' => '',
                  'row_separator' => 'none',
                  'next_row_background_color' => 'none',
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
        3 => 
        array (
          'id' => '3',
          'builder_id' => '599d15ba5e75c',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_04-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => 'f1b8cb3e-0604-44b9-887b-25cc33fdd4c8',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
        4 => 
        array (
          'id' => '4',
          'builder_id' => '599d15ba5e76b',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_05-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => '214cee3f-e421-47a0-9bfe-b8f936fb3d2e',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
        5 => 
        array (
          'id' => '5',
          'builder_id' => '599d15ba5e77a',
          'panels_data' => 
          array (
            'widgets' => 
            array (
              0 => 
              array (
                'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/mock_logo_06-min.png',
                'image_id' => '',
                'image_shape' => 'standard',
                'image_size' => 'full',
                'width' => '',
                'height' => '',
                'image_link_open' => '_blank',
                'image_link' => 'https://www.google.com',
                'box_shadow' => 'none',
                'text' => '',
                'panels_info' => 
                array (
                  'class' => 'kad_image_widget',
                  'raw' => true,
                  'grid' => 0,
                  'cell' => 0,
                  'id' => 0,
                  'widget_id' => 'f16ef91c-b61a-4203-b12e-2f687a62ea03',
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'widget_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                    'kt_animation_type' => '',
                    'kt_animation_duration' => 'default',
                    'kt_animation_delay' => 'default',
                  ),
                ),
              ),
            ),
            'grids' => 
            array (
              0 => 
              array (
                'cells' => 1,
                'style' => 
                array (
                ),
              ),
            ),
            'grid_cells' => 
            array (
              0 => 
              array (
                'grid' => 0,
                'index' => 0,
                'weight' => 1,
                'style' => 
                array (
                ),
              ),
            ),
          ),
        ),
      ),
      'panels_info' => 
      array (
        'class' => 'kad_custom_carousel_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 1,
        'widget_id' => 'f3f416ab-2470-45ca-bc83-8dfcb1181a3a',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '1200',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding' => '60px 0px 60px 0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
  ),
);
$layouts['info_box_list'] = array (
        'name' => __('SNIP: Services with icons', 'ascend'),
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/snip_info_box-min.jpg',
        'description' => 'A two column grid of icons with information',
        'widgets' =>
  			array (
		    0 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'Our <b>Services</b>',
      'tsize' => 60,
      'tsmallsize' => 0,
      'tcolor' => '#444444',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => '',
      'ssize' => 20,
      'ssmallsize' => 0,
      'scolor' => '#777777',
      'sweight' => '300',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'af466a2b-a7f6-4abc-8274-db74a06f74ec',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeIn',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    1 => 
    array (
      'info_icon' => 'kt-icon-line-chart',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'ADVANCED MARKETING STRATEGIES',
      'description' => 'Cras blandit semper egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas malesuada fames. ',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'right',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'widget_id' => 'e9b9c601-bb01-4d76-a68c-6beb75131855',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    2 => 
    array (
      'info_icon' => 'kt-icon-rocket2',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'PRODUCT OPTIMIZATION',
      'description' => 'Mauris quis nisi lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam eu eros luctus, sodales justo',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'left',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'raw' => false,
        'grid' => 1,
        'cell' => 1,
        'id' => 2,
        'widget_id' => 'fea35f64-66ef-4c34-96f0-4ad2835cf42b',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    3 => 
    array (
      'info_icon' => 'kt-icon-pencil6',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'CONTENT CREATION',
      'description' => 'Cras blandit semper egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas malesuada fames. ',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'right',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'widget_id' => 'a29568e7-7a13-4c72-b733-15a24421828d',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    4 => 
    array (
      'info_icon' => 'kt-icon-pie-chart8',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'ANALYTICS ASSESSMENT',
      'description' => 'Mauris quis nisi lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam eu eros luctus, sodales justo',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'left',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'grid' => 2,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '93f98cec-6843-4081-aded-108dfe01f09e',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    5 => 
    array (
      'info_icon' => 'kt-icon-trophy',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'BRAND MANAGEMENT',
      'description' => 'Mauris quis nisi lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam eu eros luctus, sodales justo',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'right',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 5,
        'widget_id' => '2751a20f-f9b1-4821-a811-74b6648218e8',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    6 => 
    array (
      'info_icon' => 'kt-icon-comments-o',
      'image_uri' => '',
      'image_id' => 0,
      'title' => 'RELIABLE CUSTOMER SUPPORT',
      'description' => 'Cras blandit semper egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas malesuada fames. ',
      'background' => '',
      'tcolor' => '#444444',
      'size' => 30,
      'icon_side' => 'left',
      'style' => 'kad-circle-iconclass',
      'iconbackground' => '#eeeeee',
      'color' => '#444444',
      'link' => '#',
      'target' => '_self',
      'panels_info' => 
      array (
        'class' => 'kad_infobox_widget',
        'raw' => false,
        'grid' => 3,
        'cell' => 1,
        'id' => 6,
        'widget_id' => '155ba35e-bab0-4a69-bf77-1926210fdc05',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInRight',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding' => '60px 0px 10px 0px',
        'bottom_margin' => '0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '0px 0px 40px 0px',
        'bottom_margin' => '0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    2 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '0px 0px 40px 0px',
        'bottom_margin' => '0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    3 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '0px 0px 80px 0px',
        'cell_alignment' => 'flex-start',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    3 => 
    array (
      'grid' => 2,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    4 => 
    array (
      'grid' => 2,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    5 => 
    array (
      'grid' => 3,
      'index' => 0,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
    6 => 
    array (
      'grid' => 3,
      'index' => 1,
      'weight' => 0.5,
      'style' => 
      array (
      ),
    ),
  ),
);


  return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'ascend_snippet_prebuilt_page_layouts');

