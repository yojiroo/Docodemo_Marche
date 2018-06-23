<?php
/**
 * Display product reviews
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


global $product, $kt_reviews, $kt_woo_extras;

if ( ! comments_open() ) {
    return;
}
$review_count = count( $kt_reviews->kt_get_product_reviews($product->get_id()) );
    

    do_action( 'kt_before_reviews' ); ?>

<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <h2 class="woocommerce-Reviews-title"><?php
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $review_count ) )
                printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $review_count, 'kadence-woo-extras' ), $review_count, '<span>', get_the_title(), '</span>' );
            else
                _e( 'Reviews', 'kadence-woo-extras' );
        ?></h2>

        <?php if ( $review_count ) : ?>
            <?php do_action( 'kt_before_review_list', $product ); ?>

            <ol class="commentlist">
                <?php 
                $args = array();
                if(isset($kt_woo_extras['kt_reviews_order']) && $kt_woo_extras['kt_reviews_order'] == 'desc') {
                    $args['orderby'] = 'post_date';
                    $args['order'] = 'DESC';
                } elseif(isset($kt_woo_extras['kt_reviews_order']) && $kt_woo_extras['kt_reviews_order'] == 'asc') {
                    $args['orderby'] = 'post_date';
                    $args['order'] = 'ASC';
                } else {
                    $args['orderby'] = 'meta_value_num post_date';
                    $args['order'] = 'DESC';
                }
                if(isset($kt_woo_extras['kt_reviews_featured']) && $kt_woo_extras['kt_reviews_featured'] == 1) {
                    $featured_args = $args;
                    $args[ 'meta_query' ] = array (
                        'relation' => 'AND',
                        array(
                            'key'     => $kt_reviews->review_meta_product_id,
                            'value'   => $product->get_id(),
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                        array(
                            'key'     => $kt_reviews->review_meta_approved,
                            'value'   => 1,
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                        array(
                            'key'     => $kt_reviews->review_meta_featured,
                            'value'   => 0,
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                    );
                    $featured_args[ 'meta_query' ] = array (
                        'relation' => 'AND',
                        array(
                            'key'     => $kt_reviews->review_meta_product_id,
                            'value'   => $product->get_id(),
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                        array(
                            'key'     => $kt_reviews->review_meta_approved,
                            'value'   => 1,
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                        array(
                            'key'     => $kt_reviews->review_meta_featured,
                            'value'   => 1,
                            'compare' => '=',
                            'type'    => 'numeric',
                        ),
                    );
                    $kt_reviews->kt_reviews_list( $product->get_id(), $featured_args );
                }
                $kt_reviews->kt_reviews_list( $product->get_id(), $args ); ?>
            </ol>

             <?php do_action( 'kt_after_review_list', $product ); ?>

        <?php else : ?>

            <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'kadence-woo-extras' ); ?></p>

        <?php endif; ?>

    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

        <div id="review_form_wrapper">
            <div id="review_form">
                <?php
                    $commenter = wp_get_current_commenter();

                    $comment_form = array(
                        'title_reply'          => have_comments() ? __( 'Add a review', 'kadence-woo-extras' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'kadence-woo-extras' ), get_the_title() ),
                        'title_reply_to'       => __( 'Leave a Reply to %s', 'kadence-woo-extras' ),
                        'comment_notes_after'  => '',
                        'fields'               => array(
                            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'kadence-woo-extras' ) . ' <span class="required">*</span></label> ' .
                                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
                            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'kadence-woo-extras' ) . ' <span class="required">*</span></label> ' .
                                        '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
                        ),
                        'label_submit'  => __( 'Submit', 'kadence-woo-extras' ),
                        'logged_in_as'  => '',
                        'comment_field' => ''
                    );

                    if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                        $comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'kadence-woo-extras' ), esc_url( $account_page_url ) ) . '</p>';
                    }
                    do_action('kt_add_reveiw_form_top');
                    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                        $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'kadence-woo-extras' ) .'</label><select name="rating" id="rating" aria-required="true" required>
                            <option value="">' . __( 'Rate&hellip;', 'kadence-woo-extras' ) . '</option>
                            <option value="5">' . __( 'Perfect', 'kadence-woo-extras' ) . '</option>
                            <option value="4">' . __( 'Good', 'kadence-woo-extras' ) . '</option>
                            <option value="3">' . __( 'Average', 'kadence-woo-extras' ) . '</option>
                            <option value="2">' . __( 'Not that bad', 'kadence-woo-extras' ) . '</option>
                            <option value="1">' . __( 'Very Poor', 'kadence-woo-extras' ) . '</option>
                        </select></p>';
                    }
                    if ( isset($kt_woo_extras['kt_review_title'] ) && $kt_woo_extras['kt_review_title'] == 1 ) {
                        $comment_form['comment_field'] .= '<p class="comment-form-title"><label for="title">' . __ ( 'Review title', 'kadence-woo-extras' ) . '</label><input type="text" style="width:100%;" name="title" id="title"/></p>';
                    }
                    $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'kadence-woo-extras' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

                    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>            </div>
        </div>

    <?php else : ?>

        <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may write a review.', 'kadence-woo-extras' ); ?></p>

    <?php endif; ?>

    <div class="clear"></div>
    <?php if(!is_user_logged_in() && $kt_woo_extras['vote_loggedin_only'] == 1) { ?>
        <div class="modal fade kt-review-loggin-modal" id="kt-modal-review-login" tabindex="-1" role="dialog" aria-labelledby="#kt-modal-label-review" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="kt-modal-label-review"><?php echo __('Login', 'kadence-woo-extras'); ?></h4>
                    </div>
                    <div class="modal-body"">
                        <?php 
                        wp_login_form();
                        
                        if(get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes') {
                            echo '<p>';
                            echo __("Don't have an account?", 'kadence-woo-extras'); 
                            echo ' <a href="'.wc_get_page_permalink( 'myaccount' ).'" class="kt-review-vote-signup">'.__('Sign Up', 'kadence-woo-extras').'</a>';
                            echo '</p>';
                        }?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php 
    do_action( 'kt_after_reviews' );