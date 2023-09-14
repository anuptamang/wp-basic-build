<?php
get_header();

if (have_posts()) : ?>
  <div class="single-post-page">
    <div class="container py-5">
      <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
  </div>
  <?php wp_reset_postdata(); ?>
<?php endif;

get_footer();
?>