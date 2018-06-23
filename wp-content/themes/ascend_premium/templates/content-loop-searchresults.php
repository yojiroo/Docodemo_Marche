  <?php 
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
global $post, $ascend, $ascend_has_sidebar;
if($ascend_has_sidebar) {
	$image_width = 360;
	$image_height = 240;
} else {
	$image_width = 420;
	$image_height = 280;
}

if(isset($ascend['postexcerpt_hard_crop']) && $ascend['postexcerpt_hard_crop'] == 1) {
    $image_crop = true;
} else {
    $image_height = null;
    $image_crop = false;
}
    ?>
    <article id="post-<?php the_ID(); ?>" class="search_results_item postclass kt_item_fade_in grid_item">
        <?php 
        if (has_post_thumbnail( $post->ID ) ) {
	        $img = ascend_get_image($image_width, $image_height, $image_crop, null, null, null, true);
	        if( ascend_lazy_load_filter() ) {
	            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
	        } else {
	            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
	        }
        ?>
        	<a href="<?php the_permalink() ?>" class="imghoverclass img-margin-center">
	            <div class="kt-intrinsic" style="padding-bottom:<?php echo ($img['height']/$img['width']) * 100;?>%;">
	                <?php 
	                echo '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
	                    echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'">';
	                    echo '<meta itemprop="url" content="'.esc_url($img['src']).'">';
	                    echo '<meta itemprop="width" content="'.esc_attr($img['width']).'px">';
	                    echo '<meta itemprop="height" content="'.esc_attr($img['height']).'>px">';
	                echo '</div>';
	               ?>
	            </div> 
	        </a>
        <?php }
        ?>
        <div class="postcontent">
          	<header>
	            <a href="<?php the_permalink() ?>">
	            	<h5 class="entry-title"><?php the_title(); ?></h5>
	            </a>
	            <span class="kt_search_post_type">
	              	<?php echo get_post_type( $post->ID ); ?>
	            </span>
          	</header>
        	<div class="entry-content">
	            <?php 
	            the_excerpt();
	            ?>
        	</div>
      	</div><!-- search content -->
	</article> 