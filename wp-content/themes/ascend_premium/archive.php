<?php
/*
* Standard post Archive
*
*/

    get_header(); 
    global $ascend, $ascend_has_sidebar, $kt_grid_columns, $kt_blog_loop, $kt_grid_carousel; 

    $kt_grid_carousel = false;
    $kt_blog_loop['loop'] = 1;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if(isset($ascend['category_post_summary'])) {
    	$layout = $ascend['category_post_summary'];
    } else {
    	$layout = 'normal';
    }
    $lay = ascend_get_postlayout($layout);
    if(isset($ascend['blog_infinitescroll']) && $ascend['blog_infinitescroll'] == 1) {
        if($lay['sum'] == 'grid' || $lay['sum'] == 'photo' || $lay['sum'] == 'mosaic' ) {
            $infinit = 'data-nextselector=".wp-pagenavi a.next" data-navselector=".wp-pagenavi" data-itemselector=".kad_blog_item" data-itemloadselector=".kt_item_fade_in"';
            $scrollclass = 'init-infinit';
        } else {
            $infinit = 'data-nextselector=".wp-pagenavi a.next" data-navselector=".wp-pagenavi" data-itemselector=".post" data-itemloadselector=".kt_item_fade_in"';
            $scrollclass = 'init-infinit-norm';
        }
    } else {
        $infinit = '';
        $scrollclass = '';
    }
    if(isset($ascend['category_post_grid_column'])) {
        $kt_grid_columns = $ascend['category_post_grid_column'];
    } else {
        $kt_grid_columns = '3';
    } 
    if(ascend_display_sidebar()) {
        $fullclass = '';
        $ascend_has_sidebar = true;
        if ($kt_grid_columns == '2') {
	        $itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($kt_grid_columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    } else {
        $fullclass = 'fullwidth';
        $ascend_has_sidebar = false;
        if ($kt_grid_columns == '2') {
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($kt_grid_columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    }
    /**
    * @hooked ascend_archive_title - 20
    */
     do_action('kadence_archive_title_container');
    ?>
<div id="content" class="container clearfix">
    <div class="row">
        <div class="main <?php echo esc_attr(ascend_main_class()); ?>  <?php echo esc_attr($lay['pclass']) .' '. esc_attr($fullclass); ?> clearfix" role="main">

        <?php if (!have_posts()) : ?>
            <div class="error-not-found">
                <?php _e('Sorry, no results were found.', 'ascend'); ?>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
        		<div class="entry-content">
      				<?php echo category_description(); ?>
      			</div>
            <div class="kt_archivecontent <?php echo esc_attr($lay['tclass']).' '.esc_attr($scrollclass); ?>" <?php echo $infinit.' '.$lay['data'] ;?>> 
                <?php 
                $kt_blog_loop['count'] = $wp_query->post_count;
                while (have_posts()) : the_post();
	                if($lay['sum'] == 'full'){ 
	                    if (has_post_format( 'quote' )) {
	                        get_template_part('templates/content', 'post-full-quote'); 
	                    } else {
	                        get_template_part('templates/content', 'post-full'); 
	                    }
	                } else if($lay['sum'] == 'grid') { 
	                    if($lay['highlight'] == 'true' && $kt_blog_loop['loop'] == 1 && $paged == 1) {
	                        get_template_part('templates/content', get_post_format());
	                    } else { ?>
	                        <div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
	                            <?php get_template_part('templates/content', 'post-grid'); ?>
	                        </div>
	                   <?php }
	                } else if($lay['sum'] == 'photo') { ?>
	                    <div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
	                        <?php get_template_part('templates/content', 'post-photo-grid'); ?>
	                    </div>
	                <?php
	                } else if($lay['sum'] == 'mosaic') { 
	                    get_template_part('templates/content', 'post-mosaic-grid'); 
	                } else if($lay['sum'] == 'below_title') {
	                    get_template_part('templates/content', 'post-title-above');
	                } else { 
	                    get_template_part('templates/content', get_post_format());
	                }
	                $kt_blog_loop['loop'] ++;
	            endwhile;
	            ?>
	            </div><!-- /.archive content -->
	            <?php
                if ($wp_query->max_num_pages > 1) : 
                      ascend_wp_pagenav(); 
                endif; ?>
        </div><!-- /.main -->
        <?php 
			/**
		    * Sidebar
		    */
			if (ascend_display_sidebar()) : 
			      	get_sidebar();
		    endif; ?>
		</div><!-- /.row-->
	</div><!-- /.content -->
	<?php 

    get_footer(); 
