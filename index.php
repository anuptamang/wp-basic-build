<?php get_header(); ?>
<div id="content" class="container py-5">
  <?php if (have_posts()) : ?>
    <?php
    the_archive_title('<h1 class="page-title">', '</h1>');
    the_archive_description('<div class="archive-description">', '</div>');
    ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/archive-content', get_post_type()); ?>
    <?php endwhile; ?>
  <?php else : ?>
    <?php get_template_part('template-parts/not-found'); ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>