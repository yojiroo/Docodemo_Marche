<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(!function_exists('ascend_author_box')) {
    function ascend_author_box() { ?>
    <div class="author-box post-footer-section">
    	<ul class="nav kt-tabs kt-sc-tabs">
      <li class="active"><a href="#about"><?php _e('About Author', 'ascend'); ?></a></li>
      <li><a href="#latest"><?php _e('Latest Posts', 'ascend'); ?></a></li>
    </ul>
     
    <div class="kt-tab-content postclass">
      <div class="tab-pane clearfix active" id="about">
      	<div class="author-profile vcard">
            <div class="kt_author_avatar">
    		  <?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
              </div>
    		<h5 class="author-name"><?php the_author_posts_link(); ?></h5>
            <?php if ( get_the_author_meta( 'occupation' ) ) { ?>
            <p class="author-occupation"><strong><?php the_author_meta( 'occupation' ); ?></strong></p>
            <?php } ?>
    		<p class="author-description author-bio">
    			<?php the_author_meta( 'description' ); ?>
    		</p>
            <div class="author-follow kadence_social_widget">
                <?php if ( get_the_author_meta( 'facebook' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'facebook' )); ?>" class="facebook_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Facebook', 'ascend'));?>"><i class="kt-icon-facebook"></i></a>
                <?php } 
                if ( get_the_author_meta( 'twitter' ) ) { ?>
                        <a href="https://twitter.com/<?php esc_attr(the_author_meta( 'twitter' )); ?>" class="twitter_link target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Twitter', 'ascend'));?>"><i class="kt-icon-twitter"></i></a>
                <?php } 
                if ( get_the_author_meta( 'google' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'google' )); ?>" class="googleplus_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Google Plus', 'ascend'));?>"><i class="kt-icon-google-plus"></i></a>
                <?php } 
                if ( get_the_author_meta( 'youtube' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'youtube' )); ?>" target="_blank" class="youtube_link" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on YouTube', 'ascend'));?>"><i class="kt-icon-youtube"></i></a>
                <?php }
                if ( get_the_author_meta( 'flickr' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'flickr' )); ?>"  class="flickr_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Flickr', 'ascend'));?>"><i class="kt-icon-flickr"></i></a>
                <?php } 
                if ( get_the_author_meta( 'vimeo' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'vimeo' )); ?>" class="vimeo_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Vimeo', 'ascend'));?>"><i class="kt-icon-vimeo"></i></a>
                <?php } 
                if ( get_the_author_meta( 'linkedin' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'linkedin' )); ?>" class="linkedin_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on linkedin', 'ascend'));?>"><i class="kt-icon-linkedin"></i></a>
                <?php } 
                if ( get_the_author_meta( 'dribbble' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'dribbble' )); ?>" class="dribbble_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Dribbble', 'ascend'));?>"><i class="kt-icon-dribbble"></i></a>
              	<?php } 
              	if ( get_the_author_meta( 'pinterest' ) ) { ?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'pinterest' )); ?>" class="pinterest_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Pinterest', 'ascend'));?>"><i class="kt-icon-pinterest"></i></a>
              	<?php }
              	if ( get_the_author_meta( 'instagram' ) ) { ?>
                		<a href="<?php echo esc_url(get_the_author_meta( 'instagram' )); ?>" class="instagram_link" target="_blank" title="<?php echo esc_attr(__('Follow', 'ascend').' '.get_the_author_meta( 'display_name' ).' '.__('on Instagram', 'ascend'));?>"><i class="kt-icon-instagram"></i></a>
                <?php } ?>
            </div><!--Author Follow-->
            </div>
       </div><!--pane-->
      <div class="tab-pane clearfix" id="latest">
        <div class="author-latestposts author-profile">
            <div class="kt_author_avatar">
                <?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
            </div>
            <h5><?php _e('Latest posts from', 'ascend'); ?> <?php the_author_posts_link(); ?></h5>
      			<ul>
    			<?php
                    global $authordata, $post;
                  	$loop = new WP_Query(array('author' => $authordata->ID,'posts_per_page'	=> 3));
                    if ( $loop ) : 
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink();?>"><?php the_title(); ?></a><span class="recentpost-date"> - <?php echo get_the_time('F j, Y'); ?></span></li>
                        <?php endwhile; 
                    endif;  
                     wp_reset_postdata(); ?>
    			</ul>
    	       </div><!--Latest Post -->
            </div><!--Latest pane -->
        </div><!--Tab content -->
    </div><!--Author Box -->
    <?php } 
}

// Author Profile Feilds
add_action( 'show_user_profile', 'ascend_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'ascend_show_extra_profile_fields' );
function ascend_show_extra_profile_fields( $user ) { 
	if(current_user_can( 'edit_posts') ) { ?>
		<h3><?php echo __('Extra profile information for author box', 'ascend');?></h3>
		
		<table class="form-table">
	  		<tr>
	    		<th>
	    			<label for="occupation">
	    				<?php _e('Occupation', 'ascend');?>
	    			</label>
	    		</th>
	    		<td>
	      			<input type="text" name="occupation" id="occupation" value="<?php echo esc_attr( get_the_author_meta( 'occupation', $user->ID ) ); ?>" class="regular-text" /><br />
	      			<span class="description"><?php _e('Please enter your Occupation.', 'ascend');?></span>
	    		</td>
	  		</tr>
	  		<tr>
		    	<th>
		    		<label for="twitter">Twitter</label>
		    	</th>
	    		<td>
	      			<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
	      			<span class="description"><?php _e('Please enter your Twitter username.', 'ascend'); ?></span>
	    		</td>
	  		</tr>
	    	<tr>
	    		<th>
	    			<label for="facebook">Facebook</label></th>
	    		<td>
			      	<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
			      	<span class="description"><?php _e('Please enter your Facebook url. (be sure to include http://)', 'ascend'); ?></span>
	    		</td>
	  		</tr>
	    	<tr>
		    	<th>
		    		<label for="google">Google Plus</label>
		    	</th>
		    	<td>
		      		<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Google Plus url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
	  		</tr>
	   		<tr>
	    		<th>
	    			<label for="youtube">YouTube</label>
	    		</th>
	    		<td>
		      		<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your YouTube url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
	    	<tr>
		    	<th>
		    		<label for="flickr">Flickr</label>
		    	</th>
		    	<td>
		      		<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Flickr url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
	    	<tr>
	    		<th>
	    			<label for="vimeo">Vimeo</label>
	    		</th>
		    	<td>
		      		<input type="text" name="vimeo" id="vimeo" value="<?php echo esc_attr( get_the_author_meta( 'vimeo', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Vimeo url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
	    	<tr>
		    	<th>
		    		<label for="linkedin">Linkedin</label>
		    	</th>
		    	<td>
		      		<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Linkedin url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
	    	<tr>
		    	<th>
		    		<label for="dribbble">Dribbble</label>
		    	</th>
		    	<td>
		      		<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Dribbble url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
		    <tr>
		    	<th>
		    		<label for="pinterest">Pinterest</label>
		    	</th>
		    	<td>
		      		<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
		      		<span class="description"><?php _e('Please enter your Pinterest url. (be sure to include http://)', 'ascend'); ?></span>
		    	</td>
		  	</tr>
		  	<tr>
		    	<th>
		    		<label for="instagram">Instagram</label>
		    	</th>
	    		<td>
	      			<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
	      			<span class="description"><?php _e('Please enter your Instagram url. (be sure to include http://)', 'ascend'); ?></span>
	    		</td>
	  		</tr>
		</table>
	<?php
	} 
}

add_action( 'personal_options_update', 'ascend_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ascend_save_extra_profile_fields' );

function ascend_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if(isset($_POST['occupation'])){
  		update_user_meta( $user_id, 'occupation', wp_filter_post_kses($_POST['occupation']) );
  	}
  	if(isset($_POST['twitter'])) {
    	update_user_meta( $user_id, 'twitter', sanitize_title(wp_unslash($_POST['twitter']) ));
    }
    if(isset($_POST['facebook'])) {
  		update_user_meta( $user_id, 'facebook', esc_url_raw($_POST['facebook']) );
  	}
  	if(isset($_POST['google'])) {
  		update_user_meta( $user_id, 'google', esc_url_raw($_POST['google']) );
  	}
  	if(isset($_POST['youtube'])) {
  		update_user_meta( $user_id, 'youtube', esc_url_raw($_POST['youtube']) );
  	}
  	if(isset($_POST['flickr'])) {
  		update_user_meta( $user_id, 'flickr', esc_url_raw($_POST['flickr']) );
  	}
  	if(isset($_POST['vimeo'])) {
  		update_user_meta( $user_id, 'vimeo', esc_url_raw($_POST['vimeo']) );
  	}
  	if(isset($_POST['linkedin'])) {
  		update_user_meta( $user_id, 'linkedin', esc_url_raw($_POST['linkedin']) );
  	}
  	if(isset($_POST['dribbble'])) {
  		update_user_meta( $user_id, 'dribbble', esc_url_raw($_POST['dribbble']) );
  	}
  	if(isset($_POST['pinterest'])) {
  		update_user_meta( $user_id, 'pinterest', esc_url_raw($_POST['pinterest']) );
  	}
  	if(isset($_POST['instagram'])) {
  		update_user_meta( $user_id, 'instagram', esc_url_raw($_POST['instagram']) );
  	}
}