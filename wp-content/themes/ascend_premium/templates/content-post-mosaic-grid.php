<?php 

global $post, $ascend, $ascend_has_sidebar, $kt_blog_loop;
    $imosaic = ascend_mosaic_sizes($kt_blog_loop['count'],$kt_blog_loop['loop']);
	$image_width = apply_filters('kt_post_mosaic_image_width', $imosaic['width'], $kt_blog_loop['loop']);
	$image_height = apply_filters('kt_post_mosaic_image_height', $imosaic['height'], $kt_blog_loop['loop']);
	$itemsize = apply_filters('kt_post_mosaic_size', $imosaic['itemsize'], $kt_blog_loop['loop']);
    ?>
    <div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item blog_mosaic_item kt-mosaic-item-<?php echo esc_attr($kt_blog_loop['loop']);?>">
        <article id="post-<?php the_ID(); ?>" class="blog_item blog_photo_item kt_item_fade_in grid_mosiac_item grid_item" itemscope itemtype="http://schema.org/CreativeWork" style="padding-bottom:<?php echo ($image_height/$image_width) * 100;?>%;">
            <div class="blog_mosaic_item_inner">
                <div class="imghoverclass img-margin-center blog-grid-photo">
                <?php 
                $img = ascend_get_image($image_width, $image_height, true, null, null, null, true);
                if( ascend_lazy_load_filter() ) {
                    $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                } else {
                    $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                }
                ?>
                    <div class="kt-intrinsic">
                        <?php 
                        echo '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
                            echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'">';
                            echo '<meta itemprop="url" content="'.esc_url($img['src']).'">';
                            echo '<meta itemprop="width" content="'.esc_attr($img['width']).'px">';
                            echo '<meta itemprop="height" content="'.esc_attr($img['height']).'>px">';
                        echo '</div>';
                       ?>
                    </div> 
                </div>
                <div class="photo-postcontent">
                    <div class="photo-post-bg">
                    </div>
                    <div class="photo-postcontent-inner">
                        <?php 
                        /**
                        *
                        */
                        do_action( 'kadence_post_photo_grid_excerpt_before_header' );
                        ?>
                        <header>
                            <?php 
                            /**
                            * @hooked ascend_post_grid_excerpt_header_title - 10
                            */
                            do_action( 'kadence_post_photo_grid_excerpt_header' );
                            ?>
                        </header>
                        <div class="kt-post-photo-added-content">
                        <?php 
                        /**
                        * @hooked ascend_post_header_meta_categories - 20
                        */
                        do_action( 'kadence_post_photo_grid_excerpt_after_header' );
                        ?>
                        </div>
                    </div>
                    <a href="<?php the_permalink() ?>" class="photo-post-link">
                    </a>
                </div><!-- Text size -->
                <?php 
                /**
                * 
                */
                do_action( 'kadence_post_grid_excerpt_after_footer' );
                ?>
            </div>
        </article> <!-- Blog Item -->
    </div>
<?php 

