<?php
/**
* Single Template
*/
	/**
    * Header
    */
	get_header(); 

		/**
	    * @hooked asencd_single_post_header - 20
	    */
	    do_action('ascend_post_header');

	    do_action( 'ascend_single_event_begin' ); 
	    ?>
		<div id="content" class="container clearfix">
    		<div class="row single-article">
    			<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
			    	<?php 
					/**
				    * Content
				    */
				    $postclass = array('postclass');

						while (have_posts()) : the_post(); 
					         
					         do_action( 'ascend_single_event_before' ); 

					         ?>
					            <article id="post-<?php the_ID(); ?>" <?php post_class($postclass); ?>>
					            <?php
					              do_action( 'ascend_single_event_before_header' );
					            ?>
					                <header>
					                    <?php 
					                    do_action( 'ascend_single_event_header' );
					                    ?>
					                    <h1 class="entry-title"><?php the_title(); ?></h1>
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
					                <div class="row kt-event-row">
					                	<div class="event-details-side col-md-4">
						                    <?php
						                    if(function_exists('eo_get_template_part')){
						                    	eo_get_template_part( 'event-meta', 'event-single' );
						                    }
						                    ?>
						                </div>
						                <div class="entry-content col-md-8">
						                    <?php
						                    do_action( 'kadence_single_event_content_before' );
						                    
						                        the_content(); 
						                  
						                    do_action( 'kadence_single_event_content_after' );
						                    ?>
						                </div>
						                </div>
					                <footer class="single-footer">
					                <?php 
					                  do_action( 'ascend_single_event_footer' );
					                  ?>
					                </footer>
					            </article>
					            <?php
					              do_action( 'ascend_single_event_after' );

					            endwhile; 

						do_action( 'ascend_single_event_end' ); 
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
    /**
    * Footer
    */
	get_footer(); ?>