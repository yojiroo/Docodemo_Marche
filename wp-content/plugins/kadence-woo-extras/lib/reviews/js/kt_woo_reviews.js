jQuery(document).ready(function ($) {
		var bootstrap_enabled = (typeof $().modal == 'function');
		if(bootstrap_enabled == false){
	         $(document).on('click','.kt-review-vote[data-toggle="modal"]', function (e) {
	         	e.preventDefault();
			    var $this   = $(this);
			    var $target = $($this.attr('data-target'));
			    if($target.hasClass('kt-modal-open')) {
			    	$target.removeClass('kt-modal-open');
			    } else {
			    	$target.addClass('kt-modal-open');
				}
			     
			  });
	         $(document).on('click','.kt-modal-open .close', function (e) {
	         	e.preventDefault();
			    $(this).parents('.kt-modal-open').removeClass('kt-modal-open');			     
			  });
	     }
        $(document).on('click', '.kt-review-vote[data-vote="review"]', function(e) {
	        e.preventDefault();
	        if ($(this).hasClass("kt-vote-review-selected")) {
	            return;
	        }
	        var comment_id = $(this).data('comment-id');
	        var vote = $(this).hasClass("kt-vote-down") ? "negative" : "positive";
	        var container = $(this).parents('.comment_container');
	        	container.find('.kt-review-overlay').fadeIn();
		    var data = {
				action: 'kt_review_vote',
				comment_id: comment_id,
				user_id: kt_product_reviews.user_id,
				vote: vote,
				wpnonce: kt_product_reviews.nonce
			};
			$(this).siblings('.kt-vote-review-selected').removeClass('kt-vote-review-selected');
			$(this).addClass('kt-vote-review-selected');

			$.post(woocommerce_params.ajax_url, data, function(response) {
	           	if( jQuery.trim(response) == 0 ) {
	           		container.find('.kt-review-helpful').empty().append(kt_product_reviews.error);
	           	} else {
	           		container.find('.kt-review-helpful').empty().append(response.value);
	           	}
                container.find('.kt-review-overlay').fadeOut();
        	});
        });
});


