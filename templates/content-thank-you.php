<?php


global $wpdb;


$args = array(
   // args here
	'post_id' => 7,
  'orderby' => array('comment_date'),
  'order' => 'DESC',
  'number' => 1
);

// The Query

    

$comments = get_comments($args);
foreach($comments as $comment) : ?>

<?php
  // Set params for generating link
  $my_comment_id = get_comment_ID();
  $params = array('q' => $my_comment_id);
?>
<div class="alert alert-info row">
  <p><strong>Thank you</strong> for trying to improve the world!</p>
  <p>Share this: <i class="fa fa-link"></i> <a href="<?php echo add_query_arg( $params, site_url( '/s')); ?>" class="alert-link btn-slide" title="Share this suggestion"><?php echo add_query_arg( $params, site_url( '/s')); ?></a></p>
</div>
    
<div class="suggestion">
<div class="suggestion-inner">
  <?php get_template_part('templates/content', 'suggestion-text'); ?>
</div>
</div>

<?php endforeach;
?>



