<?php 

global $post, $ascend, $ascend_has_sidebar, $ascend_grid_columns;
        if(!empty($ascend_grid_columns)) {
            if($ascend_grid_columns == '3') {
                $image_width = 420;
                $image_height = 280;
                $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
            } else if($ascend_grid_columns == '2') {
                $image_width = 660;
                $image_height = 440;
                $itemsize 	= 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
            } else if($ascend_grid_columns == '5') {
                $image_width = 360;
                $image_height = 240;
               	$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
            } else if($ascend_grid_columns == '6') {
                $image_width = 360;
                $image_height = 240;
               	$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
            } else if($ascend_grid_columns == '1') {
                $image_width = 660;
                $image_height = 440;
                $itemsize 	= 'col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
            } else {
                $image_width = 360;
                $image_height = 240;
                $itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
            }
        } else {
            $image_width = 360;
            $image_height = 240;
            $itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
        }

    $image_width = apply_filters('ascend_event_grid_image_width', $image_width);
    $image_height = apply_filters('ascend_event_grid_image_height', $image_height);
 	$image_crop = true;
 	$terms = get_the_terms( $post->ID, 'event-category' );
	if ( $terms && ! is_wp_error( $terms ) ) : 
		$links = array();
		foreach ( $terms as $term ) { 
			$links[] = $term->slug;
		}
		$tax = join( " ", $links );		
	else :	
		$tax = '';	
	endif;
    ?>
<div class="<?php echo esc_attr($itemsize);?> <?php echo esc_attr($tax); ?> e_item">
    <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in grid_item kt-event-grid postclass">
    <?php 
    if(has_post_thumbnail()) { ?>
        <div class="imghoverclass img-margin-center blog-grid-media">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <?php echo ascend_get_image_output($image_width, $image_height, $image_crop, 'attachment-thumb wp-post-image kt-image-link', null, null, true, false, true); ?>
            </a> 
        </div>
    <?php } ?>
    <div class="postcontent">
        <?php 
        do_action( 'ascend_event_grid_before_header' );
        ?>
        <header>
            <?php 
            do_action( 'ascend_event_grid_header' );
            ?>
             <h5 class="entry-title"><?php the_title(); ?></h5>
	            <div class="kt-event-date">
					<?php 
					if(function_exists('eo_get_template_part')){

						if ( eo_recurs() ) :?>
							<!-- Event recurs - is there a next occurrence? -->
							<?php $next = eo_get_next_occurrence( eo_get_event_datetime_format() );?>

							<?php if ( $next ) : ?>
								<!-- If the event is occurring again in the future, display the date -->
								<?php echo $next; ?>

							<?php else : ?>
								<!-- Otherwise the event has finished (no more occurrences) -->
								<?php echo eo_get_schedule_last( 'd F Y', '' );?>
								
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( ! eo_recurs() ) { ?>
								<!-- Single event -->
								<?php echo eo_format_event_occurrence();?>
						<?php } ?>
					<?php } ?>
				</div>
        </header>
        <div class="entry-content">
             <?php 
             do_action( 'kadence_event_grid_content_before' );

             the_excerpt();

             do_action( 'kadence_event_grid_content_after' );
            ?>
        </div>

        <footer>
        <?php 
        do_action( 'ascend_event_grid_footer' );
        ?>
        </footer>
    </div><!-- Text size -->
    <?php 
    /**
    * 
    */
    do_action( 'ascend_event_grid_after_footer' );
    ?>
	</div>
</div> <!-- Event Item -->