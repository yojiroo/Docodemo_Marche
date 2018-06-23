<?php

if ( post_password_required() ) {
  return;
}
?>
<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>
    <h4 class="comments-title kt-title">
        <span>
        <?php
        printf( _n( 'One Response ', '%1$s Responses ', get_comments_number(), 'ascend' ), number_format_i18n(get_comments_number()), get_the_title());
        ?>
        </span>
    </h4>

    <?php the_comments_navigation(); ?>

    <ul class="comment-list">
      <?php
        wp_list_comments( array('avatar_size' => 60) );
      ?>
    </ul><!-- .comment-list -->

    <?php the_comments_navigation(); ?>

  <?php endif; // Check for have_comments(). ?>

  <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'ascend' ); ?></p>
    <?php
    endif; ?>

  <?php
    comment_form( array(
      'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title kt-title"><span>',
      'title_reply_after'  => '</span></h4>',
    ) );
  ?>

</div><!-- .comments-area -->
