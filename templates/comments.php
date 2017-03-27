<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">
  <?php if (have_comments()) : ?>
    
    <ol class="comment-list">
      <?php
      /* Loop through and list the comments. Tell wp_list_comments()
       * to use qwota_comment() to format the comments.
       */
      //wp_list_comments( array( 'callback' => 'qwota_comment' ) ); - working, but without reverse order
      wp_list_comments( array( 'callback' => 'iwbni_comment' ) )
      
    ?>
    </ol>

    <button class="btn quote-form-open-close add-quote__open--lg" data-toggle="tooltip" data-placement="right" title="Add your suggestion" data-animation="false"><span class="sr-only">Add your suggestion</span> <span class="fa fa-plus"></span></button>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav class="pager-wrap row">
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li  data-toggle="tooltip" data-placement="top" title="Prev page" data-animation="false" class="prev"><?php previous_comments_link(__('<i class="fa fa-angle-left"></i>', 'sage')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li  data-toggle="tooltip" data-placement="top" title="Next page" data-animation="false" class="next"><?php next_comments_link(__('<i class="fa fa-angle-right"></i>', 'sage')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
