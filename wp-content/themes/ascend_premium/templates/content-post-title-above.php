<?php
/*
* Post loop contnet
*
*
*/
global $post, $ascend, $ascend_has_sidebar, $kt_feat_width;
    if (has_post_format( 'quote' )) { ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('kad_blog_item clearfix'); ?> itemscope itemtype="http://schema.org/CreativeWork">
              <div class="postcontent">
               <?php if (has_post_thumbnail( $post->ID ) ) { 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    $style = 'style="background-image: url('.esc_url($image[0]).');"'; 
                    $quote_class = 'kt-image-quote'; ?>
                    <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <meta itemprop="url" content="<?php echo esc_url($image[0]); ?>">
                        <meta itemprop="width" content="<?php echo esc_attr($image[1])?>">
                        <meta itemprop="height" content="<?php echo esc_attr($image[2])?>">
                    </div>
                   <?php 
                } else {
                    $quote_class = 'kt-text-quote';
                    $style = '';
                } ?>
                <div class="entry-content kt-quote-post-outer <?php echo esc_attr($quote_class);?> clearfix" itemprop="description" <?php echo $style;?> >
                    <div class="kt-quote-post">
                        <?php 
                             do_action( 'kadence_post_excerpt_content_before' );

                             the_content();

                             do_action( 'kadence_post_excerpt_content_after' );
                        ?>
                   </div>
                   </div>
                    <?php $author = get_post_meta( $post->ID, '_kad_quote_author', true ); 
		                if(!empty($author)) {
		                    echo '<div class="kt-quote-post-author">';
		                    echo '<p>- '. esc_html($author).'</p>';
		                    echo '</div>';
		                }
		                ?>
              </div><!-- Text size -->
    	</article> <!-- Article -->
    <?php
    } else {

        if($ascend_has_sidebar){
            $kt_feat_width = apply_filters('kt_blog_image_width_sidebar', ascend_post_sidebar_image_width()); 
            $kt_portraittext = 'col-xxl-95 col-xl-9 col-md-8 col-sm-8 col-xs-7';
            $kt_portraitimg_size = 'col-xxl-25 col-xl-3 col-md-4 col-sm-4 col-xs-5 col-ss-4';
        } else {
            $kt_feat_width = apply_filters('kt_blog_image_width', ascend_post_image_width()); 
            $kt_portraittext = 'col-xxl-95 col-xl-9 col-md-9 col-sm-8 col-xs-7';
            $kt_portraitimg_size = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-5 col-ss-4';
        }

        if (has_post_format( 'gallery' )) {
            $swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true ); 
            $height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
            if (!empty($height)) {
                $slideheight = $height;
                $imageheight = $height;
            } else {
                $slideheight = 400;
                $imageheight = apply_filters('kt_single_post_image_height', 400); 
            }
            if (!empty($swidth)) {
                $slidewidth = $swidth;
            } else {
                $slidewidth = $kt_feat_width;
            } 
        } elseif (has_post_format( 'image' )) {
            $swidth = get_post_meta( $post->ID, '_kad_image_posthead_width', true );
            $height = get_post_meta( $post->ID, '_kad_image_posthead_height', true );
            if (!empty($height)) {
                $imageheight = $height;
            } else {
                $imageheight = apply_filters('kt_single_post_image_height', 400); 
            }
            if (!empty($swidth)) {
                $slidewidth = $swidth;
            } else {
                $slidewidth = $kt_feat_width;
            }
        } else {
            $imageheight = apply_filters('kt_single_post_image_height', 400);
            $slidewidth = $kt_feat_width;
        }
        // get post summary
        $postsummery = ascend_get_postsummary();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('kad_blog_item clearfix'); ?> itemscope itemtype="http://schema.org/BlogPosting">
            <div class="row">
                <?php 
	          	/**
	            *
	            */
	            do_action( 'kadence_post_excerpt_before_content' );
	            ?>

              	<div class="col-md-12 post-text-container postcontent">
                	<div class="post-text-inner">
	                   	<?php 
	                    /**
	                    * @hooked ascend_post_header_meta_categories - 20
	                    */
	                    do_action( 'kadence_post_excerpt_before_header' );
	                    ?>
	                   	<header>
	                        <?php 
	                        /**
	                        * @hooked ascend_post_excerpt_header_title - 10
	                        * @hooked ascend_post_header_meta - 20
	                        */
	                        do_action( 'ascend_post_excerpt_header' );
	                        ?>
	                   	</header>
	                   	<div class="row kt-media-below-title">
	                   	<?php 
			                if($postsummery == 'img_landscape') { 
			                   $textsize = 'col-md-12'; 
			                        ?>
			                        <div class="col-md-12 post-land-image-container">
			                              <div class="imghoverclass img-margin-center">
			                                <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
			                                    <?php echo ascend_get_image_output($slidewidth, $imageheight, true, 'attachment-thumb wp-post-image kt-image-link', null, null, true); ?>
			                                </a> 
			                            </div>
			                        </div>
			                   <?php 
			              
			                } elseif($postsummery == 'img_portrait') { 

			                    $portraitwidth = apply_filters('kt_post_excerpt_image_width_portrait', 270);
			                    $portraitheight = apply_filters('kt_post_excerpt_image_height_portrait', 310);
			                    $textsize = $kt_portraittext;
			                    ?>
			                    <div class="<?php echo esc_attr($kt_portraitimg_size);?> post-image-container">
			                        <div class="imghoverclass img-margin-center">
			                            <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
			                                <?php echo ascend_get_image_output($portraitwidth, $portraitheight, true, 'attachment-thumb wp-post-image kt-image-link', null, null, true); ?>
			                            </a> 
			                        </div>
			                    </div>
			                   <?php 

			                } elseif($postsummery == 'gallery_grid') { 

			                    $textsize = 'col-md-12'; ?>
			                    <div class="col-md-12 post-photo-grid-container">
			                    <?php //get_template_part('templates/post', 'head-collage-gallery'); ?>
			                    <?php ascend_build_image_collage($post->ID, 'post', $ascend_has_sidebar); ?>
			                    </div>    
			                    <?php

			                } elseif($postsummery == 'slider_landscape') {

			                    $textsize = 'col-md-12'; 
			                    echo '<div class="col-md-12 post-land-image-container">';
			                        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
			                        ascend_build_slider($post->ID, $image_gallery, $slidewidth, $slideheight, 'post', 'kt-slider-same-image-ratio');
			                    echo '</div>';

			              	} elseif($postsummery == 'slider_portrait') { 

			                    $textsize = $kt_portraittext; 
			                    $portraitwidth = apply_filters('kt_post_excerpt_image_width_portrait', 270);
			                    $portraitheight = apply_filters('kt_post_excerpt_image_height_portrait', 310); 

			                    echo '<div class="'.esc_attr($kt_portraitimg_size).' post-image-container">';
			                        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
			                        ascend_build_slider($post->ID, $image_gallery, $portraitwidth, $portraitheight, 'post', 'kt-slider-same-image-ratio');
			                    echo '</div>';                 

			              	} elseif($postsummery == 'video') {
			                   $textsize = 'col-md-12'; ?>
			                   <div class="col-md-12 post-land-image-container">
			                             <?php 
			                                get_template_part('templates/post', 'video-output');
			                             ?>
			                   </div>
			                   <?php 

			              	} else { 
			                   $textsize = 'col-md-12 kttextpost'; 
			              	}		
	              			?>
              			<div class="<?php echo esc_attr($textsize);?> kt-media-below-text-content">
		                   	<div class="entry-content" itemprop="articleBody">
		                        <?php 
		                             do_action( 'kadence_post_excerpt_content_before' );

		                             the_excerpt();

		                             do_action( 'kadence_post_excerpt_content_after' );
		                        ?>
		                   	</div>
		                   	<footer>
		                        <?php 
		                        /**
		                        *
		                        */
		                        do_action( 'ascend_post_excerpt_footer' );
		                        ?>
		                   	</footer>
	                   	</div>
	                   	</div>
	                   	<?php 
	                   	/**
	                   	* 
	                   	*/
	                   	do_action( 'kadence_post_excerpt_after_footer' );
	                   	?>
	                </div><!-- Inner -->
              	</div><!-- Text size -->
         	</div><!-- row-->
    	</article> <!-- Article -->
    <?php }