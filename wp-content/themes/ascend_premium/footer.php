<?php
/* 
- Force plugins to stop stating incorrect errors -
wp_footer();
*/
			/**
			* 
			* @hooked ascend_above_footer_widget_output - 20
			*
			*/
			do_action('ascend_after_content'); ?>
			</div><!-- /.wrap -->
			<?php 
		  	get_template_part('templates/footer'); ?>
		</div><!--Wrapper-->
		<?php wp_footer(); ?>
	</body>
</html>
