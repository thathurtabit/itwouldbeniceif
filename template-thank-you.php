<?php
/**
 * Template Name: Thank You
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'thank-you'); ?>
<?php endwhile; ?>
