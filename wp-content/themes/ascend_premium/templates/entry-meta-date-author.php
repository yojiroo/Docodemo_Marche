<?php if ( 'post' == get_post_type() ) { ?>
	<div class="post-top-meta kt_color_gray">
		<?php do_action( 'ascend_before_post_meta' ); ?>
	    <span class="postdate kt-post-date updated" itemprop="datePublished">
	        <?php echo get_the_date(get_option( 'date_format' ));?>
	    </span>   
	    <span class="postauthortop kt-post-author author vcard">
	        <?php global $ascend; 
	        	if(!empty($ascend['post_by_text'])) {
	        		$authorbytext = $ascend['post_by_text'];
	        	} else {
	        		$authorbytext = __('by', 'ascend');
	        	} 
	        	echo '<span class="kt-by-author">'.$authorbytext.'</span>'; ?>
	        	<span itemprop="author">
	        		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fn kt_color_gray" rel="author">
	        		<?php echo get_the_author() ?>
	        		</a>
	        	</span>
	    </span> 
		<?php do_action( 'ascend_after_post_meta' ); ?>
	</div>
<?php }