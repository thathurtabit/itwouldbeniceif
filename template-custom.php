<?php
/**
 * Template Name: Suggestion Link
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'suggestion'); ?>
<?php endwhile; ?>
