<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ascend_testimonial_form($atts, $content = null) {
	extract(shortcode_atts(array(
		'location' 				=> false,
		'position' 				=> false,
		'link' 					=> false,
		'image' 				=> false,
		'login' 				=> false,
		'email' 				=> get_bloginfo('admin_email'),
		'name_label' 			=> __('Name', 'ascend'),
		'testimonial_label' 	=> __('Testimonial', 'ascend'),
		'location_label' 		=> __('Location - optional', 'ascend'),
		'position_label' 		=> __('Position or Company - optional', 'ascend'),
		'link_label' 			=> __('Link - optional', 'ascend'),
		'image_label' 			=> __('Image Upload - optional', 'ascend'),
		'submit_label' 			=> __('Submit', 'ascend'),
		'math_error' 			=> __('Check your math.', 'ascend'),
		'name_error' 			=> __('Please enter your name.', 'ascend'),
		'content_error' 		=> __('Please add testimonial content.', 'ascend'),
		'error_message' 		=> __('Sorry, an error occured.', 'ascend'),
		'login_message' 		=> __('You must be logged in to submit an testimonial.', 'ascend'),
		'success_message' 		=> __('Thank you for submitting your testimonial! It is now awaiting approval from the site administrator. Thank you!', 'ascend'),
), $atts));
	global $kt_feedback_has_run, $kt_feedback_created;

	if(isset($_POST['kt_feedback_submitted']) && wp_verify_nonce( $_POST['post-title-nonce'], 'post-title' ) ) {
		if(isset($_POST['post-location'])) {
			$temp_location = $_POST['post-location'];
		} else {
			$temp_location = '';
		}
		if(isset($_POST['post-company'])) {
			$temp_company = $_POST['post-company'];
		} else {
			$temp_company = '';
		}
		if(isset($_POST['post-link'])) {
			$temp_link = $_POST['post-link'];
		} else {
			$temp_link = '';
		}
		$post_data = array(
			'title' => sanitize_text_field($_POST['post-title']),
			'post-location' => sanitize_text_field($temp_location),
			'post-company' => sanitize_text_field($temp_company),
			'post-link' => sanitize_text_field($temp_link),
			'content' => wp_kses_post($_POST['posttext']),
			'post-verify' => sanitize_text_field($_POST['post-verify']),
			'hval' => sanitize_text_field($_POST['hval']),
		);
		$user_id = null;
 
 		if(empty($post_data['post-verify'])) { 
 			$kt_feed_error = true; 
 			$kad_captchaError = $math_error; 
 		}
 		if(md5($post_data['post-verify']) != $post_data['hval']) { 
 			$kt_feed_error = true; 
 			$kad_captchaError = $math_error;
 		}
		if (empty($post_data['title'])) {
			$kt_feed_error = true;  
			$nameError = $name_error;
		}
		if (empty($post_data['content'])) {
			$kt_feed_error = true; 
			$contentError = $content_error;
		}
 
		if ( ! isset( $kt_feed_error ) && true == $_POST['kt_feedback_submitted']  && $kt_feedback_has_run != 'yes'){
 			$kt_feedback_has_run = 'yes';
			$post_id = wp_insert_post( array(
				'post_author'	=> $user_id,
				'post_title'	=> $post_data['title'],
				'post_type'     => 'testimonial',
				'post_content'	=> $post_data['content'],
				'post_status'	=> 'pending'
				) );
				if(isset($post_data['post-location']) && !empty($post_data['post-location'])) {	
					update_post_meta($post_id, '_kad_testimonial_location', sanitize_text_field($post_data['post-location']));
					}	
				if(isset($post_data['post-company']) && !empty($post_data['post-company'])) {	
					update_post_meta($post_id, '_kad_testimonial_occupation', sanitize_text_field($post_data['post-company']));
					}	
				if(isset($post_data['post-link']) && !empty($post_data['post-link'])) {	
					update_post_meta($post_id, '_kad_testimonial_link', sanitize_text_field($post_data['post-link']));
				}
					// use Later
				if(isset($_FILES['post-img'])) {	
					require_once( ABSPATH . 'wp-admin/includes/image.php' );
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
					$attachment_id = media_handle_upload('post-img', $post_id);
						if ( is_wp_error( $attachment_id ) ) {

						} else {
							set_post_thumbnail($post_id, $attachment_id);
						}
					unset($_FILES);
       			}
	       	if(!empty($email)){
				$emailTo = $email;
			} else {
				$emailTo = get_option('admin_email');
			}
		
			$sitename = get_bloginfo('name');
			$subject = "(".get_bloginfo('name').") " . __(" Testimonial Post From: ", "ascend"). $post_data['title'];
			$body = __("Name", "ascend").':'. $post_data['title'] .'\n\nComments:'. $post_data['content'];
			$headers = '';

			wp_mail($emailTo, $subject, $body, $headers);		
	 		$kt_feedback_created = true;
		}
	}

	$feedback_form = '<div id="kt-feedback-postbox" class="testimonial-form-container">';
	if(isset($kt_feedback_created) && true == $kt_feedback_created) {
		$feedback_form .= '<div class="thanks"><p>'.esc_html($success_message).'</p></div>';
	} else {
		if(isset($kt_feed_error)) {
			$feedback_form .= '<p class="kt-error">'.esc_html($error_message).'<p>';
		}
		if($login && !is_user_logged_in()) { 
   			$feedback_form .= '<p>'.esc_html($login_message).'</p>'; 
		} else {

		}
		$feedback_form .= '<div class="kt-feedback-inputarea"><form id="kad-feedback-new-post" name="new_post" method="post" enctype="multipart/form-data" action="'.esc_url(get_the_permalink()).'">';
		$feedback_form .= '<p>';
			$feedback_form .= '<label>'.esc_html($name_label).'</label>';
			$feedback_form .= '<input type="text" class="full required requiredField" value="'.(isset($_POST['post-title']) ? esc_attr($_POST['post-title']) : '' ).'" id="kt-feedback-post-title" name="post-title" />';
			if(isset($nameError)) { 
				$feedback_form .= '<label class="error">'.esc_html($nameError).'</label>';
			}
		$feedback_form .= '</p>';
		$feedback_form .= '<p>';
			$feedback_form .= '<label>'.esc_html($testimonial_label).'</label>';
			$feedback_form .= '<textarea class="required requiredField" name="posttext" id="kt-feedback-post-text" cols="60" rows="10">'.(isset($_POST['posttext']) ? esc_textarea($_POST['posttext']) : '' ).'</textarea>';
			if(isset($contentError)) { 
				$feedback_form .= '<label class="error">'.esc_html($contentError).'</label>';
			}
		$feedback_form .= '</p>';

		if('true' == $location) {
			$feedback_form .= '<p>';
				$feedback_form .= '<label>'.esc_html($location_label).'</label>';
				$feedback_form .= '<input type="text" class="full" value="'.(isset($_POST['post-location']) ? esc_attr($_POST['post-location']) : '' ).'" id="kt-feedback-post-location" name="post-location" />';
			$feedback_form .= '</p>';
		}

		if('true' == $position) {
			$feedback_form .= '<p>';
				$feedback_form .= '<label>'.esc_html($position_label).'</label>';
				$feedback_form .= '<input type="text" class="full" value="'.(isset($_POST['post-company']) ? esc_attr($_POST['post-company']) : '' ).'" id="kt-feedback-post-company" name="post-company" />';
			$feedback_form .= '</p>';
		}

		if('true' == $link) {
			$feedback_form .= '<p>';
				$feedback_form .= '<label>'.esc_html($link_label).'</label>';
				$feedback_form .= '<input type="text" class="full" value="'.(isset($_POST['post-link']) ? esc_url($_POST['post-link']) : '' ).'" id="kt-feedback-post-link" name="post-company" />';
			$feedback_form .= '</p>';
		}

		if('true' == $image) {
			$feedback_form .= '<p>';
				$feedback_form .= '<label>'.esc_html($image_label).'</label>';
				$feedback_form .= '<input type="file" class="full kad_file_input" id="post-img"  multiple="false" value="'.(isset($_POST['post-img']) ? esc_url($_POST['post-img']) : '' ).'" name="post-img" />';
			$feedback_form .= '</p>';
		}
		$one = rand(5, 50);
		$two = rand(1, 9);
		$result = md5($one + $two);
		$feedback_form .= '<p>';
			$feedback_form .= '<label>'.esc_html($one.' + '.$two.' =').'</label>';
			$feedback_form .= '<input type="text" id="kt-feedback-post-verify" class="kad-quarter required requiredField" name="post-verify" />';
			if(isset($kad_captchaError)) { 
				$feedback_form .= '<label class="error">'.esc_html($kad_captchaError).'</label>';
			}
		$feedback_form .= '</p>';
		$feedback_form .= '<input type="hidden" name="hval" id="hval" value="'.esc_attr($result).'" />';
		$feedback_form .= wp_nonce_field('post-title', 'post-title-nonce', true, false);
		$feedback_form .= '<input id="submit" type="submit" class="kad-btn kad-btn-primary" tabindex="3" value="'.esc_attr($submit_label).'" />';
		$feedback_form .= '<input type="hidden" name="kt_feedback_submitted" id="kt_feedback_submitted" value="true" />';
		$feedback_form .= '</form></div>';
	}
	$feedback_form .= '</div>';

  	return  $feedback_form;
}
