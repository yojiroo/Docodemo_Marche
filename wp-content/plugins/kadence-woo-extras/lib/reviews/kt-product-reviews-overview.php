<?php
/**
 * Display product reviews
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


global $product, $kt_reviews, $kt_woo_extras;
$review_stats = $kt_reviews->kt_review_stats($product);
$average = $kt_reviews->kt_get_average_rating( $product->get_id(), 2);
?>

<div id="kt-reviews-overview">
    <div class="kt_reviews_stats_total">
    <h3><b style="color:<?php if(isset($kt_woo_extras['kt_review_overview_highlight'])){  echo $kt_woo_extras['kt_review_overview_highlight'];}?>;"><?php echo esc_html($average);?></b> <?php echo __ ( 'out of 5 stars', 'kadence-woo-extras' );?></h3>
    </div>
    <div class="kt_review_stats_bars" style="color:<?php if(isset($kt_woo_extras['kt_review_overview_highlight'])){  echo $kt_woo_extras['kt_review_overview_highlight'];}?>;">
        <?php for ($i = 5; $i >= 1; $i--) :
            $perc = ($review_stats['total'] == '0') ? 0 : floor($review_stats[$i] / $review_stats['total'] * 100); ?>
            <div class="kt_rating_bar_row">
                <div class="kt_stars_value">
                    <?php echo $i; ?>
                    <i class="kt-reviews-icon-star-full"></i>
                </div>
                <div class="kt_rating_bar">
                    <span class="kt_rating_bar_bg">
                        <span class="kt_perc_rating" style="width:<?php echo $perc;?>%; background-color:<?php if(isset($kt_woo_extras['kt_review_overview_highlight'])){ echo $kt_woo_extras['kt_review_overview_highlight'];}?>;">
                        </span>
                    </span>
                </div>
                <div class="kt_review_single_count">
                    <?php echo $review_stats[$i]; ?>
                </div>
            </div>
            <?
        endfor; ?>
        </div>
    </div>