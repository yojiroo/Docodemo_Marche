<div class="post-grid-footer-meta kt_color_gray">
	<?php do_action( 'ascend_before_grid_post_footer_meta' ); ?>
    <span class="postdate kt-post-date updated" itemprop="datePublished">
        <?php echo get_the_date(get_option( 'date_format' ));?>
    </span> 
    <?php 
    if(get_comments_number() != 0){
        echo '<span class="postcommentscount kt-post-comments"><a href="'.get_the_permalink().'#comments" class="kt_color_gray"><i class="kt-icon-comments-o"></i>'.get_comments_number( '0', '1', '%' ).'</a></span>';
    } ?>
    <span class="postauthor kt-post-author author vcard">
            <span>
                <span class="kt_color_gray" rel="author" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_the_author() ?>">
	                <meta itemprop="author" class="fn" content="<?php echo get_the_author() ?>">
	                 <i class="kt-icon-user2"></i>
                </span>
            </span>
    </span>
    <?php do_action( 'ascend_after_grid_post_footer_meta' ); ?>
</div>