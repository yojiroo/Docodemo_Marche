 <?php 
 global $post, $ascend, $ascend_has_sidebar, $kt_feat_width;

    if($ascend_has_sidebar){
        $kt_feat_width = apply_filters('kt_blog_full_image_width_sidebar', ascend_post_sidebar_image_width()); 
    } else {
        $kt_feat_width = apply_filters('kt_blog_full_image_width', ascend_post_image_width()); 
    }
    $postclass = array('postclass');
    $kt_headcontent = ascend_get_post_head_content();
    if($kt_headcontent != 'none'){
        $postclass[] = 'kt_post_header_content-'.$kt_headcontent;
    } else {
        $postclass[] = 'kt_no_post_header_content';
    }
    $postclass[] = 'kad_blog_item';
    
    /**
    * @hooked ascend_single_post_upper_headcontent - 10
    */
    do_action( 'ascend_single_post_begin' ); 

    do_action( 'kadence_single_post_before' ); 
    ?> 
    <article <?php post_class($postclass); ?> itemscope itemtype="http://schema.org/BlogPosting">
         <?php 
          /**
          * @hooked ascend_single_post_headcontent - 10
          * @hooked ascend_post_header_meta_categories - 20
          */
          do_action( 'kadence_single_post_before_header' );
          ?>
        <header>
          <?php 
            /**
            * @hooked ascend_post_full_loop_title - 20
            * @hooked ascend_single_post_meta_date_author - 30
            */
            do_action( 'ascend_single_loop_post_header' );
            ?>
        </header>
        <div class="entry-content clearfix" itemprop="articleBody">
        <?php 
            do_action( 'kadence_single_post_content_before' );

            global $more; $more = 0; 
            if(!empty($ascend['post_readmore_text'])) {
                $readmore = $ascend['post_readmore_text'];
            } else { 
                $readmore =  __('Read More', 'ascend') ;
            }
            the_content($readmore); 

            do_action( 'kadence_single_post_content_after' );
        ?>
        </div>
        <footer class="single-footer">
        <?php 
            /**
            * @hooked ascend_post_footer_meta - 30
            * @hooked ascend_post_footer_image_meta - 35
            */
            do_action( 'ascend_single_loop_post_footer' );

            if ( comments_open() ) :
                echo '<p class="kad_comments_link">';
                  	comments_popup_link( 
	                    '<i class="kt-icon-comments-o"></i>'. __( 'Leave a Reply', 'ascend' ), 
	                    '<i class="kt-icon-comments-o"></i>'. __( '1 Comment', 'ascend' ), 
	                   	'<i class="kt-icon-comments-o"></i>'. __( '% Comments', 'ascend' ),
	                    'comments-link',
	                    '<i class="kt-icon-comments-o"></i>'. __( 'Comments are Closed', 'ascend' )
                	);
                echo '</p>';
            endif;
        ?>
        </footer>
    </article>

