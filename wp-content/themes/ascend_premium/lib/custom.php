<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Custom functions
 */

function ascend_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);

   return $rgb;
}
function ascend_rgb2hsl($rgb) {
    $r = $rgb[0] / 255.0;
    $g = $rgb[1] / 255.0;
    $b = $rgb[2] / 255.0;

    $maxC = max($r, $g, $b);
    $minC = min($r, $g, $b);

    $l = ($maxC + $minC) / 2.0;

    if($maxC == $minC) {
      	$s = 0;
      	$h = 0;
    } else {
		if($l < .5) {
			$s = ($maxC - $minC) / ($maxC + $minC);
		} else {
			$s = ($maxC - $minC) / (2.0 - $maxC - $minC);
		}
		if($r == $maxC)
			$h = ($g - $b) / ($maxC - $minC);
		if($g == $maxC)
			$h = 2.0 + ($b - $r) / ($maxC - $minC);
		if($b == $maxC)
			$h = 4.0 + ($r - $g) / ($maxC - $minC);
		$h = $h / 6.0; 
    }

    $h = (int)round(255.0 * $h);
    $s = (int)round(255.0 * $s);
    $l = (int)round(255.0 * $l);

    return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
}

// Page Navigation

function ascend_wp_pagenav() {

  	global $wp_query, $wp_rewrite;
  	$pages = '';
  	$big = 999999999; // need an unlikely integer
  	$max = $wp_query->max_num_pages;
  	if (!$current = get_query_var('paged')) $current = 1;
  	$args['base'] = str_replace($big, '%#%', esc_url( get_pagenum_link( $big ) ) );
  	$args['total'] = $max;
  	$args['current'] = $current;
  	$args['add_args'] = false;

  	$total = 1;
  	$args['mid_size'] = 3;
  	$args['end_size'] = 1;
  	$args['prev_text'] = '<i class="kt-icon-chevron-left"></i>';
  	$args['next_text'] = '<i class="kt-icon-chevron-right"></i>';

  	if ($max > 1) {
  		echo '<div class="scroller-status"><div class="loader-ellips infinite-scroll-request"><span class="loader-ellips__dot"></span><span class="loader-ellips__dot"></span><span class="loader-ellips__dot"></span><span class="loader-ellips__dot"></span></div></div>';
   		echo '<div class="wp-pagenavi">';
   	}
 		if ($total == 1 && $max > 1) {
 			echo paginate_links($args);
 		}
 	if ($max > 1) {
 		echo '</div>';
 	}
}


/**
 * Schema type
 */
function ascend_html_tag_schema() {
    $schema = 'http://schema.org/';

    if( is_singular( 'post' ) ) {
        $type = "WebPage";
    } elseif( is_author() ) {
        $type = 'ProfilePage';
    } elseif( is_search() ) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }

    echo apply_filters('kadence_html_schema', 'itemscope="itemscope" itemtype="' .  esc_attr( $schema ) . esc_attr( $type ) . '"' );
}

// Custom Excerpt by length
function ascend_excerpt($limit) {
   	// get Read more text
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    $excerpt = str_replace($readmore,'><',$excerpt);
    
    return $excerpt;
}
// Custom content by length
function ascend_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
       	$content = implode(" ",$content);
    } 
    
    return $content;
}
add_action('kadence_gallery_post_before', 'ascend_kt_gallery_before');
function ascend_kt_gallery_before(){
		/**
	    * @hooked asencd_single_post_header - 20
	    */
	    do_action('ascend_post_header');
	    ?>
		<div id="content" class="container clearfix">
    		<div class="row single-article">
    			<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
    			<?php 
}
add_action('kadence_gallery_album_before', 'ascend_kt_gallery_album_before');
function ascend_kt_gallery_album_before(){
		/**
	    * @hooked ascend_archive_title - 20
	    */
	     do_action('kadence_archive_title_container');
	    ?>
		<div id="content" class="container clearfix">
    		<div class="row single-article">
    			<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
    			<?php 
}

add_action('kadence_gallery_post_after', 'ascend_kt_gallery_after');
add_action('kadence_gallery_album_after', 'ascend_kt_gallery_after');
function ascend_kt_gallery_after(){
	?>
		</div><!-- /.main-->

				<?php
				/**
			    * Sidebar
			    */
				if (ascend_display_sidebar()) : 
				      	get_sidebar();
			    endif; ?>
    		</div><!-- /.row-->
    	</div><!-- /#content -->
    	<?php 
}
