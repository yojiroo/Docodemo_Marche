<?php 

 /**
   * Custom Woocommerce Account Functions 2.6
   */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
function ascend_page_endpoint_title( $title ) {
	global $wp_query;

	if ( ! is_null( $wp_query ) && ! is_admin() && is_main_query() && in_the_loop() && is_page() && is_wc_endpoint_url() ) {
		$endpoint = WC()->query->get_current_endpoint();

		if ( $endpoint_title = WC()->query->get_endpoint_title( $endpoint ) ) {
			$title = $endpoint_title;
		}
	}

	return $title;
}
function ascend_add_woo_endpoint_title() {
    echo '<h2 class="kad_endpointtitle">';
     	echo ascend_page_endpoint_title(get_the_title());
    echo '</h2>';
}

add_action('kadence_woo_thank_you_start', 'ascend_add_woo_endpoint_title');
add_action('woocommerce_account_content', 'ascend_add_woo_endpoint_title', 2);


function ascend_woo_account_before_div() {
	echo '<div class="kt-woo-account-nav">';
}
add_action('woocommerce_before_account_navigation', 'ascend_woo_account_before_div', 5);

function ascend_woo_account_after_div() {
	echo '</div>';
}
add_action('woocommerce_after_account_navigation', 'ascend_woo_account_after_div', 5);

function ascend_woo_account_avatar(){
 	$current_user = wp_get_current_user();
  	if ( 0 == $current_user->ID ) {
      
  	} else { ?> 
  	<div class="kad-account-avatar">
      	<div class="kad-customer-image">
        	<?php echo get_avatar($current_user->ID, 120 ); ?>
        	<a class="kt-link-to-gravatar" href="https://gravatar.com/" target="_blank">
          		<i class="kt-icon-cloud-upload"></i>
          		<span class="kt-profile-photo-text"><?php echo __('Update Profile Photo', 'ascend');?>
       		</a>
      	</div>
      	<div class="kad-customer-name">
        	<h5>
          		<?php echo esc_html($current_user->display_name); ?>
        	</h5>
      	</div> 
  	</div>

  <?php }
}
add_action('woocommerce_before_account_navigation', 'ascend_woo_account_avatar', 20);
