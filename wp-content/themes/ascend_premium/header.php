<?php
/*
* DO NOT ADD SCRIPTS HERE (USE THEME OPTIONS)
* 
* wp_head();
*/

	/* Load Scripts meta */
  	get_template_part('templates/head');
  	?>
	<body <?php body_class(); ?>>
	<?php do_action('ascend_after_body_open'); ?>
	<div id="wrapper" class="container">
	<?php
	   	do_action('kt_beforeheader');
	   	do_action('ascend_beforeheader');

	      	get_template_part('templates/header');
	      
	    do_action('kt_header_after');
	    do_action('ascend_header_after');
	  ?>
			  <!--[if lt IE 8]>
			    <div class="alert alert-warning">
			      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'ascend'); ?>
			    </div>
			  <![endif]-->

  			<div id="inner-wrap" class="wrap clearfix contentclass hfeed" role="document">

        	<?php 	/*
		        	* Hooked 
		        	*/
		        	do_action('kt_content_top');