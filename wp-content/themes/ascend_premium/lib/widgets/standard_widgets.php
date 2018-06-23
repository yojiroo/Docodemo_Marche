<?php

/**
 * Tag Cloud Adjustments
 */
function ascend_widget_tag_cloud_args( $args ) {
    $args['largest'] = 13;
    $args['smallest'] = 13;
    $args['unit'] = 'px';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'ascend_widget_tag_cloud_args' );
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'ascend_widget_tag_cloud_args' );

/**
 * Contact widget
 */
class kad_contact_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'widget_kadence_contact', 'description' => __('Use this widget to add a Vcard to your site', 'ascend'));
        parent::__construct('widget_kadence_contact', __('Ascend: Contact/Vcard', 'ascend'), $widget_ops);
    }

    public function widget($args, $instance) {
        if (!isset($args['widget_id'])) {
          $args['widget_id'] = null;
        }

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $company = empty($instance['company']) ? ' ' : apply_filters('widget_text', $instance['company']);
        if (!isset($instance['name'])) { $instance['name'] = ''; }
        if (!isset($instance['street_address'])) { $instance['street_address'] = ''; }
        if (!isset($instance['locality'])) { $instance['locality'] = ''; }
        if (!isset($instance['region'])) { $instance['region'] = ''; }
        if (!isset($instance['postal_code'])) { $instance['postal_code'] = ''; }
        if (!isset($instance['tel'])) { $instance['tel'] = ''; }
        if (!isset($instance['fixedtel'])) { $instance['fixedtel'] = ''; }
        if (!isset($instance['email'])) { $instance['email'] = ''; }

        echo $before_widget;
        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }
        ?>
        <div class="vcard">
      
            <?php if(!empty($instance['company'])):?><p class="vcard-company"><i class="kt-icon-office"></i><?php echo $company; ?></p><?php endif;?>
            <?php if(!empty($instance['name'])):?><p class="vcard-name fn"><i class="kt-icon-user2"></i><?php echo $instance['name']; ?></p><?php endif;?>
            <?php if(!empty($instance['street_address']) || !empty($instance['locality']) || !empty($instance['region']) ):?>
                <p class="vcard-address"><i class="kt-icon-location2"></i><?php echo $instance['street_address']; ?>
                <span><?php echo $instance['locality']; ?> <?php echo $instance['region']; ?> <?php echo $instance['postal_code']; ?></span></p>
            <?php endif;?>
            <?php if(!empty($instance['tel'])):?><p class="tel"><i class="kt-icon-mobile"></i><?php echo $instance['tel']; ?></p><?php endif;?>
            <?php if(!empty($instance['fixedtel'])):?><p class="tel fixedtel"><i class="kt-icon-phone2"></i><?php echo $instance['fixedtel']; ?></p><?php endif;?>
            <?php if(!empty($instance['email'])):?><p><a class="email" href="mailto:<?php echo antispambot($instance['email']);?>"><i class="kt-icon-envelop4"></i><?php echo antispambot($instance['email']); ?></a></p> <?php endif;?>
            
        </div>
        <?php
        echo $after_widget;

    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['company'] = strip_tags($new_instance['company']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['street_address'] = strip_tags($new_instance['street_address']);
        $instance['locality'] = strip_tags($new_instance['locality']);
        $instance['region'] = strip_tags($new_instance['region']);
        $instance['postal_code'] = strip_tags($new_instance['postal_code']);
        $instance['tel'] = strip_tags($new_instance['tel']);
        $instance['fixedtel'] = strip_tags($new_instance['fixedtel']);
        $instance['email'] = strip_tags($new_instance['email']);

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $company = isset($instance['company']) ? esc_attr($instance['company']) : '';
        $name = isset($instance['name']) ? esc_attr($instance['name']) : '';
        $street_address = isset($instance['street_address']) ? esc_attr($instance['street_address']) : '';
        $locality = isset($instance['locality']) ? esc_attr($instance['locality']) : '';
        $region = isset($instance['region']) ? esc_attr($instance['region']) : '';
        $postal_code = isset($instance['postal_code']) ? esc_attr($instance['postal_code']) : '';
        $tel = isset($instance['tel']) ? esc_attr($instance['tel']) : '';
        $fixedtel = isset($instance['fixedtel']) ? esc_attr($instance['fixedtel']) : '';
        $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
        ?>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('company')); ?>"><?php _e('Company Name:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('company')); ?>" name="<?php echo esc_attr($this->get_field_name('company')); ?>" type="text" value="<?php echo esc_attr($company); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('name')); ?>"><?php _e('Name:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('street_address')); ?>"><?php _e('Street Address:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('street_address')); ?>" type="text" value="<?php echo esc_attr($street_address); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('locality')); ?>"><?php _e('City/Locality:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('locality')); ?>" name="<?php echo esc_attr($this->get_field_name('locality')); ?>" type="text" value="<?php echo esc_attr($locality); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('region')); ?>"><?php _e('State/Region:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('region')); ?>" name="<?php echo esc_attr($this->get_field_name('region')); ?>" type="text" value="<?php echo esc_attr($region); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('postal_code')); ?>"><?php _e('Zipcode/Postal Code:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('postal_code')); ?>" type="text" value="<?php echo esc_attr($postal_code); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('tel')); ?>"><?php _e('Mobile Telephone:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel')); ?>" name="<?php echo esc_attr($this->get_field_name('tel')); ?>" type="text" value="<?php echo esc_attr($tel); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>"><?php _e('Fixed Telephone:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>" name="<?php echo esc_attr($this->get_field_name('fixedtel')); ?>" type="text" value="<?php echo esc_attr($fixedtel); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </p>
      <?php
    }
}
/**
 * Social widget
 */
class kad_social_widget extends WP_Widget {
  	private static $instance = 0;
    public function __construct() {
    	$widget_ops = array('classname' => 'widget_kadence_social', 'description' => __('Simple way to add Social Icons', 'ascend'));
    	parent::__construct('widget_kadence_social', __('Ascend: Social Links', 'ascend'), $widget_ops);
  	}

  	function widget($args, $instance) {

	    if (!isset($args['widget_id'])) {
	      $args['widget_id'] = null;
	    }
	    extract($args);

	    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
	    if (!isset($instance['facebook'])) { $instance['facebook'] = ''; }
	    if (!isset($instance['twitter'])) { $instance['twitter'] = ''; }
	    if (!isset($instance['instagram'])) { $instance['instagram'] = ''; }
	    if (!isset($instance['googleplus'])) { $instance['googleplus'] = ''; }
	    if (!isset($instance['flickr'])) { $instance['flickr'] = ''; }
	    if (!isset($instance['vimeo'])) { $instance['vimeo'] = ''; }
	    if (!isset($instance['youtube'])) { $instance['youtube'] = ''; }
	    if (!isset($instance['pinterest'])) { $instance['pinterest'] = ''; }
	    if (!isset($instance['dribbble'])) { $instance['dribbble'] = ''; }
	    if (!isset($instance['linkedin'])) { $instance['linkedin'] = ''; }
	    if (!isset($instance['tumblr'])) { $instance['tumblr'] = ''; }
	    if (!isset($instance['stumbleupon'])) { $instance['stumbleupon'] = ''; }
	    if (!isset($instance['vk'])) { $instance['vk'] = ''; }
	    if (!isset($instance['viadeo'])) { $instance['viadeo'] = ''; }
	    if (!isset($instance['xing'])) { $instance['xing'] = ''; }
	    if (!isset($instance['yelp'])) { $instance['yelp'] = ''; }
	    if (!isset($instance['soundcloud'])) { $instance['soundcloud'] = ''; }
	    if (!isset($instance['snapchat'])) { $instance['snapchat'] = ''; }
	    if (!isset($instance['behance'])) { $instance['behance'] = ''; }
	    if (!isset($instance['rss'])) { $instance['rss'] = ''; }
	    if (!isset($instance['tooltip'])) { $instance['tooltip'] = 'tooltip'; }
	    if (!isset($instance['tooltip_dir'])) { $instance['tooltip_dir'] = 'top'; }
	    if($instance['tooltip'] == 'beside') {
	    	$class = "kt-text-beside";
	    } else {
	    	$class = "";
	    }
	    echo $before_widget;
	    if ($title) {
	      echo $before_title;
	      echo $title;
	      echo $after_title;
	    }

	    echo '<div class="kadence_social_widget '.esc_attr($class).' clearfix">';

	    if(!empty($instance['facebook'])):
	        echo '<a href="'.esc_url($instance['facebook']).'" class="facebook_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Facebook"><i class="kt-icon-facebook"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Facebook</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['twitter'])):
	        echo '<a href="'.esc_url($instance['twitter']).'" class="twitter_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Twitter"><i class="kt-icon-twitter"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Twitter</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['instagram'])):
	        echo '<a href="'.esc_url($instance['instagram']).'" class="instagram_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Instagram"><i class="kt-icon-instagram"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Instagram</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['googleplus'])):
	        echo '<a href="'.esc_url($instance['googleplus']).'" class="googleplus_link" rel="publisher" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="GooglePlus"><i class="kt-icon-google-plus"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">GooglePlus</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['flickr'])):
	        echo '<a href="'.esc_url($instance['flickr']).'" class="flickr_link" data-toggle="'.esc_attr($instance['tooltip']).'" target="_blank" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Flickr"><i class="kt-icon-flickr"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Flickr</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['vimeo'])):
	        echo '<a href="'.esc_url($instance['vimeo']).'" class="vimeo_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Vimeo"><i class="kt-icon-vimeo"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Vimeo</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['youtube'])):
	        echo '<a href="'.esc_url($instance['youtube']).'" class="youtube_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="YouTube"><i class="kt-icon-youtube"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">YouTube</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['pinterest'])):
	        echo '<a href="'.esc_url($instance['pinterest']).'" class="pinterest_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Pinterest"><i class="kt-icon-pinterest"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Pinterest</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['dribbble'])):
	        echo '<a href="'.esc_url($instance['dribbble']).'" class="dribbble_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Dribbble"><i class="kt-icon-dribbble"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Dribble</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['linkedin'])):
	        echo '<a href="'.esc_url($instance['linkedin']).'" class="linkedin_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="LinkedIn"><i class="kt-icon-linkedin"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">LinkedIn</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['tumblr'])):
	        echo '<a href="'.esc_url($instance['tumblr']).'" class="tumblr_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Tumblr"><i class="kt-icon-tumblr"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Tumblr</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['stumbleupon'])):
	        echo '<a href="'.esc_url($instance['stumbleupon']).'" class="stumbleupon_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="StumbleUpon"><i class="kt-icon-stumbleupon"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">StumbleUpon</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['vk'])):
	        echo '<a href="'.esc_url($instance['vk']).'" class="vk_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="VK"><i class="kt-icon-vk"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">VK</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['viadeo'])):
	        echo '<a href="'.esc_url($instance['viadeo']).'" class="viadeo_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Viadeo"><i class="kt-icon-viadeo"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Viadeo</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['xing'])):
	        echo '<a href="'.esc_url($instance['xing']).'" class="xing_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Xing"><i class="kt-icon-xing"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Xing</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['soundcloud'])):
	        echo '<a href="'.esc_url($instance['soundcloud']).'" class="soundcloud_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Soundcloud"><i class="kt-icon-soundcloud"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Soundcloud</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['yelp'])):
	        echo '<a href="'.esc_url($instance['yelp']).'" class="yelp_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Yelp"><i class="kt-icon-yelp"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Yelp</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['snapchat'])):
	        echo '<a href="'.esc_url($instance['snapchat']).'" class="snapchat_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Snapchat"><i class="kt-icon-snapchat"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Snapchat</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['behance'])):
	        echo '<a href="'.esc_url($instance['behance']).'" class="behance_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Behance"><i class="kt-icon-behance"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">Behance</span>';
	    	}
	    	echo '</a>';
	    endif;
	    if(!empty($instance['rss'])):
	        echo '<a href="'.esc_url($instance['rss']).'" class="rss_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="RSS"><i class="kt-icon-feed"></i>';
	    	if($instance['tooltip'] == 'beside') {
	    		echo '<span class="kt-social-title">RSS</span>';
	    	}
	    	echo '</a>';
	    endif;

	    echo '</div>';
	    echo $after_widget;

  	}

  	public function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['title'] 			= strip_tags($new_instance['title']);
	    $instance['facebook'] 		= strip_tags($new_instance['facebook']);
	    $instance['twitter'] 		= strip_tags($new_instance['twitter']);
	    $instance['instagram'] 		= strip_tags($new_instance['instagram']);
	    $instance['googleplus'] 	= strip_tags($new_instance['googleplus']);
	    $instance['flickr'] 		= strip_tags($new_instance['flickr']);
	    $instance['vimeo'] 			= strip_tags($new_instance['vimeo']);
	    $instance['youtube'] 		= strip_tags($new_instance['youtube']);
	    $instance['pinterest'] 		= strip_tags($new_instance['pinterest']);
	    $instance['dribbble'] 		= strip_tags($new_instance['dribbble']);
	    $instance['linkedin'] 		= strip_tags($new_instance['linkedin']);
	    $instance['tumblr'] 		= strip_tags($new_instance['tumblr']);
	    $instance['stumbleupon'] 	= strip_tags($new_instance['stumbleupon']);
	    $instance['vk'] 			= strip_tags($new_instance['vk']);
	    $instance['viadeo'] 		= strip_tags($new_instance['viadeo']);
	    $instance['xing'] 			= strip_tags($new_instance['xing']);
	    $instance['yelp'] 			= strip_tags($new_instance['yelp']);
	    $instance['soundcloud'] 	= strip_tags($new_instance['soundcloud']);
	    $instance['snapchat'] 		= strip_tags($new_instance['snapchat']);
	    $instance['behance'] 		= strip_tags($new_instance['behance']);
	    $instance['rss'] 			= strip_tags($new_instance['rss']);
	    $instance['tooltip'] 		= strip_tags($new_instance['tooltip']);
	    $instance['tooltip_dir'] 	= strip_tags($new_instance['tooltip_dir']);

	    return $instance;
  	}

  	public function form($instance) {
	    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	    $facebook = isset($instance['facebook']) ? esc_attr($instance['facebook']) : '';
	    $twitter = isset($instance['twitter']) ? esc_attr($instance['twitter']) : '';
	    $instagram = isset($instance['instagram']) ? esc_attr($instance['instagram']) : '';
	    $googleplus = isset($instance['googleplus']) ? esc_attr($instance['googleplus']) : '';
	    $flickr = isset($instance['flickr']) ? esc_attr($instance['flickr']) : '';
	    $vimeo = isset($instance['vimeo']) ? esc_attr($instance['vimeo']) : '';
	    $youtube = isset($instance['youtube']) ? esc_attr($instance['youtube']) : '';
	    $pinterest = isset($instance['pinterest']) ? esc_attr($instance['pinterest']) : '';
	    $dribbble = isset($instance['dribbble']) ? esc_attr($instance['dribbble']) : '';
	    $linkedin = isset($instance['linkedin']) ? esc_attr($instance['linkedin']) : '';
	    $tumblr = isset($instance['tumblr']) ? esc_attr($instance['tumblr']) : '';
	    $stumbleupon = isset($instance['stumbleupon']) ? esc_attr($instance['stumbleupon']) : '';
	    $vk = isset($instance['vk']) ? esc_attr($instance['vk']) : '';
	    $viadeo = isset($instance['viadeo']) ? esc_attr($instance['viadeo']) : '';
	    $xing = isset($instance['xing']) ? esc_attr($instance['xing']) : '';
	    $yelp = isset($instance['yelp']) ? esc_attr($instance['yelp']) : '';
	    $soundcloud = isset($instance['soundcloud']) ? esc_attr($instance['soundcloud']) : '';
	    $snapchat = isset($instance['snapchat']) ? esc_attr($instance['snapchat']) : '';
	    $behance = isset($instance['behance']) ? esc_attr($instance['behance']) : '';
	    $rss = isset($instance['rss']) ? esc_attr($instance['rss']) : '';
	    $tooltip = isset($instance['tooltip']) ? esc_attr($instance['tooltip']) : 'tooltip';
	    $tooltip_dir = isset($instance['tooltip_dir']) ? esc_attr($instance['tooltip_dir']) : 'top';
	    $tool_options = array(array("slug" => "tooltip", "name" => __('Show in Tooltip', 'ascend')),array("slug" => "beside", "name" => __('Show Text Beside', 'ascend')), array("slug" => "none", "name" => __('Disable', 'ascend')));
	    $tool_options_array = array();
	    foreach ($tool_options as $tool_option) {
	      	if ($tooltip == $tool_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$tool_options_array[] = '<option value="' . $tool_option['slug'] .'"' . $selected . '>' . $tool_option['name'] . '</option>';
	    }
	    $tool_directions = array(array("slug" => "top", "name" => __('Top', 'ascend')), array("slug" => "bottom", "name" => __('Bottom', 'ascend')), array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')));
	    $tool_directions_array = array();
	    foreach ($tool_directions as $tool_direction) {
	      	if ($tooltip_dir == $tool_direction['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$tool_directions_array[] = '<option value="' . $tool_direction['slug'] .'"' . $selected . '>' . $tool_direction['name'] . '</option>';
	    }
	  	?>
	  	<p>
	      	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php _e('Instagram:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php _e('GooglePlus:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php _e('Flickr:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php _e('Vimeo:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php _e('Youtube:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php _e('Pinterest:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php _e('Dribbble:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e('Linkedin:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php _e('Tumblr:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>"><?php _e('Stumbleupon:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>" name="<?php echo esc_attr($this->get_field_name('stumbleupon')); ?>" type="text" value="<?php echo esc_attr($stumbleupon); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('vk')); ?>"><?php _e('VK:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vk')); ?>" name="<?php echo esc_attr($this->get_field_name('vk')); ?>" type="text" value="<?php echo esc_attr($vk); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('viadeo')); ?>"><?php _e('Viadeo:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('viadeo')); ?>" name="<?php echo esc_attr($this->get_field_name('viadeo')); ?>" type="text" value="<?php echo esc_attr($viadeo); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('xing')); ?>"><?php _e('xing:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('xing')); ?>" name="<?php echo esc_attr($this->get_field_name('xing')); ?>" type="text" value="<?php echo esc_attr($xing); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('yelp')); ?>"><?php _e('Yelp:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('yelp')); ?>" name="<?php echo esc_attr($this->get_field_name('yelp')); ?>" type="text" value="<?php echo esc_attr($yelp); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('soundcloud')); ?>"><?php _e('Soundcloud:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('soundcloud')); ?>" name="<?php echo esc_attr($this->get_field_name('soundcloud')); ?>" type="text" value="<?php echo esc_attr($soundcloud); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('snapchat')); ?>"><?php _e('Snapchat:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('snapchat')); ?>" name="<?php echo esc_attr($this->get_field_name('snapchat')); ?>" type="text" value="<?php echo esc_attr($snapchat); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('behance')); ?>"><?php _e('Behance:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('behance')); ?>" name="<?php echo esc_attr($this->get_field_name('behance')); ?>" type="text" value="<?php echo esc_attr($behance); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php _e('RSS:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" type="text" value="<?php echo esc_attr($rss); ?>" />
	    </p>
	    <p>
	   		<label for="<?php echo $this->get_field_id('tooltip'); ?>"><?php _e('Title options', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('tooltip'); ?>" name="<?php echo $this->get_field_name('tooltip'); ?>"><?php echo implode('', $tool_options_array); ?></select>
	    </p>
	    <p>
	   		<label for="<?php echo $this->get_field_id('tooltip_dir'); ?>"><?php _e('Tooltip Direction', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('tooltip_dir'); ?>" name="<?php echo $this->get_field_name('tooltip_dir'); ?>"><?php echo implode('', $tool_directions_array); ?></select>
	    </p>
	  	<?php
  	}
}
/**
 * Kadence Recent_Posts widget class
 *  Just a rewite of wp recent post
 * 
 */
class kad_recent_posts_widget extends WP_Widget {

  	private static $instance = 0;
	public function __construct() {
  		$widget_ops = array('classname' => 'kadence_recent_posts', 'description' => __('This shows the most recent posts on your site with a thumbnail', 'ascend'));
  		parent::__construct('kadence_recent_posts', __('Ascend: Recent Posts', 'ascend'), $widget_ops);
	}

  	public function widget($args, $instance) {

	    if ( ! isset( $args['widget_id'] ) ) {
	      $args['widget_id'] = $this->id;
	    }

	    extract($args);

    	$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
    	if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
    		$number = 10; 
    	}
    	if(isset($instance['orderby'])) {
	      	$orderby = $instance['orderby'];
	    } else {
	      	$orderby = 'date';
	    }
	    if($orderby == "menu_order" || $orderby == "title") {
	      	$order = "ASC";
	    } else {
	      	$order = "DESC";
	    }
	    if(isset($instance['first_feature']) && $instance['first_feature'] == "true") {
	      	$feature = "true";
	    } else {
	      	$feature = "false";
	    }
	    if(isset($instance['read_more']) && $instance['read_more'] == "true") {
	      	$readmore = "true";
	    } else {
	      	$readmore = "false";
	    }
	    if(isset($instance['read_more_txt']) && !empty($instance['read_more_txt'])) {
	      	$readmore_txt = $instance['read_more_txt'];
	    } else {
	      	$readmore_txt = __('Read More', 'ascend');
	    }
    	$r = new WP_Query( apply_filters( 'widget_posts_args', array( 
	        'posts_per_page' => $number,
	        'category_name' => $instance['thecate'],
	        'no_found_rows' => true,
	        'post_status' => 'publish',
	        'orderby' => $orderby,
	        'order' => $order,
	        'ignore_sticky_posts' => true 
	        ) 
	    ) );
    	if ($r->have_posts()) :
	    	$image_size = apply_filters('kadence_post_widget_image_size', array('width'=> 60, 'height' => 60));
	    	$feature_image_size = apply_filters('kadence_post_feature_widget_image_size', array('width'=> 420, 'height' => 280));

	    	echo $before_widget; 
	    	
	    	if ( $title ) {
	    		echo $before_title . $title . $after_title; 
	    	}
		    
		    echo '<ul>';
		    	$i = 1;
		        while ($r->have_posts()) : $r->the_post();
		        global $post;
		        if($feature == "true" && $i == 1) { 
	    			echo '<li class="clearfix postclass kt-top-featured">';
	    			if(has_post_thumbnail( $post->ID ) ) {
	    				echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'" class="recentpost_featimg">';
	                	echo ascend_get_image_output($feature_image_size['width'], $feature_image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
	                	echo '</a>';
	                } 
          		} else {
		        	echo '<li class="clearfix postclass">';
		            if(has_post_thumbnail( $post->ID ) ) { 
		                echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'" class="recentpost_featimg">';
		                echo ascend_get_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
		                echo '</a>';
		            }
		        }
		            echo '<div class="recent_posts_widget_content">';
			            echo '<div class="recent_posts_widget_content_inner">';
			            echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'" class="recentpost_title">';
			                        the_title(); 
			            echo '</a>';
			            echo '<span class="recentpost_date kt_color_gray">'.get_the_date(get_option( 'date_format' )).'</span>';
			            echo '</div>';
		            echo '</div>';
		        echo '</li>';
		        $i ++;
		        endwhile; 
		    echo '</ul>';
	    	if($readmore == 'true') {
	    		if(isset($instance['thecate']) && !empty($instance['thecate'])) {
	    			$cat = get_category_by_slug($instance['thecate']); 
	    			$link = get_category_link($cat->term_id);
	    		} else {
	    			$post_id = get_option( 'page_for_posts' );
	    			if(isset($post_id) && !empty($post_id)) {
	    				$link = get_the_permalink($post_id);
	    			} else {
	    				$link = home_url();
	    			}
	    		}
	    		echo '<div class="rpw_readmore_container">';
	    			echo '<a href="'.esc_url($link).'" class="button posts_widget_readmore"><span>'.esc_html($readmore_txt).'</span></a>';
	    		echo '</div>';
	    	}
	    	echo $after_widget;

    		wp_reset_postdata();
    	endif;
	}

  	public function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;
	    $instance['title'] 			= strip_tags($new_instance['title']);
	    $instance['orderby'] 		= $new_instance['orderby'];
	    $instance['number'] 		= (int) $new_instance['number'];
	    $instance['thecate'] 		= $new_instance['thecate'];
	    $instance['first_feature'] 	= $new_instance['first_feature'];
	    $instance['read_more'] 		= $new_instance['read_more'];
	    $instance['read_more_txt'] 	= $new_instance['read_more_txt'];
	    return $instance;
  	}

  	public function form( $instance ) {
	    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	    $number = isset($instance['number']) ? absint($instance['number']) : 5;
	    if (isset($instance['thecate'])) { $thecate = esc_attr($instance['thecate']); } else {$thecate = '';}
	    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'date';}
	    $first_feature = isset($instance['first_feature']) ? $instance['first_feature'] : "false";
	    $read_more = isset($instance['read_more']) ? $instance['read_more'] : "false";
	    $read_more_txt = isset($instance['read_more_txt']) ? esc_attr($instance['read_more_txt']) : '';
	    $orderoptions = array(array('name' => 'Date', 'slug' => 'date'), array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Comment Count', 'slug' => 'comment_count'), array('name' => 'Modified', 'slug' => 'modified'));
	    $true_false_options = array(array('name' => 'False', 'slug' => 'false'), array('name' => 'True', 'slug' => 'true'));
	    $categories= get_categories();
	    $cate_options = array();
	    $cate_options[] = '<option value="">All</option>';
	    foreach ($categories as $cate) {
	      	if ($thecate==$cate->slug) { $selected=' selected="selected"';} else { $selected=""; }
	      	$cate_options[] = '<option value="' . $cate->slug .'"' . $selected . '>' . $cate->name . '</option>';
	    }
	    $order_options = array();
	    foreach ($orderoptions as $ooption) {
	      	if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$order_options[] = '<option value="' . $ooption['slug'] .'"' . $selected . '>' . $ooption['name'] . '</option>';
	    }
	    $feature_options = array();
    	foreach ($true_false_options as $foption) {
      		if ($first_feature==$foption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      		$feature_options[] = '<option value="' . $foption['slug'] .'"' . $selected . '>' . $foption['name'] . '</option>';
    	}
    	$readmore_options = array();
    	foreach ($true_false_options as $roption) {
      		if ($read_more ==$roption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      		$readmore_options[] = '<option value="' . $roption['slug'] .'"' . $selected . '>' . $roption['name'] . '</option>';
    	}
		?>
	    <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'ascend'); ?></label>
	    	<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
	    </p>
        <p>
    		<label for="<?php echo $this->get_field_id('thecate'); ?>"><?php _e('Limit to Catagory (Optional):', 'ascend'); ?></label>
    		<select id="<?php echo $this->get_field_id('thecate'); ?>" name="<?php echo $this->get_field_name('thecate'); ?>"><?php echo implode('', $cate_options); ?></select>
  		</p>
  		<p>
	    	<label for="<?php echo $this->get_field_id('first_feature'); ?>"><?php _e('Feature first item:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('first_feature'); ?>" name="<?php echo $this->get_field_name('first_feature'); ?>"><?php echo implode('', $feature_options); ?></select>
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('View more link at end of post list?:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>"><?php echo implode('', $readmore_options); ?></select>
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('read_more_txt'); ?>"><?php _e('View more link text:', 'ascend'); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id('read_more_txt'); ?>" name="<?php echo $this->get_field_name('read_more_txt'); ?>" type="text" value="<?php echo $read_more_txt; ?>" />
	    </p>
<?php
  }
}


/**
 * Kadence_Image_Grid_Widget widget class
 * 
 */
class kad_post_grid_widget extends WP_Widget {

  private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_image_grid', 'description' => __('This shows a grid of featured images from recent posts or portfolio items', 'ascend'));
      parent::__construct('kadence_image_grid', __('Ascend: Post Grid', 'ascend'), $widget_ops);
  }

  public function widget($args, $instance) {

    extract($args);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
    if(isset($instance['orderby'])) {
      $orderby = $instance['orderby'];
    } else {
      $orderby = 'date';
    }
    if($orderby == "menu_order" || $orderby == "title") {
      $order = "ASC";
    } else {
      $order = "DESC";
    }

    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
      $number = 8; 
    }
    
    echo $before_widget; 

    if ( $title ) echo $before_title . $title . $after_title;
        
       switch ($instance['gridchoice']) {
      
        case "portfolio" :
        
            $r = new WP_Query( 
                apply_filters('widget_posts_args', array( 
                'post_type' => 'portfolio', 
                'portfolio-type' => $instance['thetype'], 
                'no_found_rows' => true, 
                'posts_per_page' => $number, 
                'post_status' => 'publish', 
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true 
                ) ) 
            );
            if ($r->have_posts()) :       
                $image_size = apply_filters('kadence_widget_image_size', array('width'=> 60, 'height' => 60));
                echo '<div class="imagegrid-widget clearfix">';
                    while ($r->have_posts()) : $r->the_post(); 
                        global $post; 
                        if(has_post_thumbnail( $post->ID ) ) {
                            echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'" class="imagegrid_item lightboxhover">';
                                echo ascend_get_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
                            echo '</a>';
                        } 
                endwhile; 
                echo '</div>';
                wp_reset_postdata(); 
            endif;

        break;
        case "post":          
            $r = new WP_Query( 
                apply_filters('widget_posts_args', array( 
                    'posts_per_page' => $number, 
                    'category_name' => $instance['thecat'], 
                    'no_found_rows' => true, 
                    'orderby' => $orderby,
                    'order' => $order,
                    'post_status' => 'publish', 
                    'ignore_sticky_posts' => true 
                ) ) 
            );

            if ($r->have_posts()) : 
                $image_size = apply_filters('kadence_widget_image_size', array('width'=> 60, 'height' => 60));
                echo '<div class="imagegrid-widget clearfix">';
                while ($r->have_posts()) : $r->the_post(); 
                    global $post; 
                    if(has_post_thumbnail( $post->ID ) ) {
                         echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'" class="imagegrid_item lightboxhover">';
                            echo ascend_get_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
                        echo '</a>';
                    }
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            endif;
        break; 
    } 
    echo $after_widget;

  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['thecat'] = $new_instance['thecat'];
    $instance['orderby'] = $new_instance['orderby'];
    $instance['thetype'] = $new_instance['thetype'];
    $instance['gridchoice'] = $new_instance['gridchoice'];

    return $instance;
  }

  public function form( $instance ) {
    
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $gridchoice = isset($instance['gridchoice']) ? esc_attr($instance['gridchoice']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 6;
    if (isset($instance['thecat'])) { $thecat = esc_attr($instance['thecat']); } else {$thecat = '';}
    if (isset($instance['thetype'])) { $thetype = esc_attr($instance['thetype']); } else {$thetype = '';}
    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'date';}
    $orderoptions = array(array('name' => 'Date', 'slug' => 'date'), array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Comment Count', 'slug' => 'comment_count'), array('name' => 'Modified', 'slug' => 'modified'), array('name' => 'Menu Order', 'slug' => 'menu_order'), array('name' => 'Title', 'slug' => 'title'));
     $types= get_terms('portfolio-type');
     $type_options = array();
          $type_options[] = '<option value="">All</option>';
    if(!empty($types) && !is_wp_error($types) ) {
      foreach ($types as $type) {
        if ($thetype==$type->slug) { $selected=' selected="selected"';} else { $selected=""; }
        $type_options[] = '<option value="' . $type->slug .'"' . $selected . '>' . $type->name . '</option>';
      }
    }
     $categories= get_categories();
     $cat_options = array();
          $cat_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cat) {
      if ($thecat==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . $cat->slug .'"' . $selected . '>' . $cat->name . '</option>';
    }
    $order_options = array();
    foreach ($orderoptions as $ooption) {
      if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $order_options[] = '<option value="' . $ooption['slug'] .'"' . $selected . '>' . $ooption['name'] . '</option>';
    }


?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('gridchoice'); ?>"><?php _e('Grid Choice:','ascend'); ?></label>
        <select id="<?php echo $this->get_field_id('gridchoice'); ?>" name="<?php echo $this->get_field_name('gridchoice'); ?>">
            <option value="post"<?php echo ($gridchoice === 'post' ? ' selected="selected"' : ''); ?>><?php _e('Blog Posts', 'ascend'); ?></option>
            <option value="portfolio"<?php echo ($gridchoice === 'portfolio' ? ' selected="selected"' : ''); ?>><?php _e('Portfolio', 'ascend'); ?></option>
        </select></p>
        
        <p><label for="<?php echo $this->get_field_id('thecat'); ?>"><?php _e('If Post - Choose Category (Optional):', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('thecat'); ?>" name="<?php echo $this->get_field_name('thecat'); ?>"><?php echo implode('', $cat_options); ?></select></p>
        
    <p><label for="<?php echo $this->get_field_id('thetype'); ?>"><?php _e('If Portfolio - Choose Type (Optional):', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('thetype'); ?>" name="<?php echo $this->get_field_name('thetype'); ?>"><?php echo implode('', $type_options); ?></select></p>
        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of images to show:', 'ascend'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
     <p>
    <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
    </p>
  
<?php
  }
}

