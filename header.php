<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
  <div class="wrapper">
    <header class="py-2">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <img src="<?php echo get_template_directory_uri() . '/dist/images/logo.png' ?>" alt="image description">
          </div>
          <div class="col-6">
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'primary',
                'menu_class' => 'main-menu',
                'container' => 'nav',
              )
            );
            ?>
          </div>
        </div>
      </div>
    </header>
    <main>