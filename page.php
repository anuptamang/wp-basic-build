<?php
get_header() ?>

<?php if (have_posts()) : ?>
  <div class="primary-link-page py-5">
    <?php while (have_posts()) : ?>
      <?php the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php get_footer(); ?>