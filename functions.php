<?php


// Theme scripts and styles
function theme_enqueue_styles_scripts()
{
  wp_enqueue_style('style', get_stylesheet_uri());

  wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/dist/style.css');

  wp_enqueue_script('theme-js', get_template_directory_uri() . '/dist/js/app.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');


// Register Menu
register_nav_menus(array(
  'primary' => __('Main Nav Primary', 'base'),
));

// Theme Global options menu
function custom_acf_options_page()
{
  if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
      'page_title'     => 'Global Options',
      'menu_title'     => 'Global Options',
      'menu_slug'      => 'theme-options',
      'capability'     => 'edit_posts',
      'redirect'       => false
    ));
  }
}
add_action('acf/init', 'custom_acf_options_page');

// Register ACF Blocks
add_action('acf/init', function () {
  if (function_exists('acf_register_block')) {
    $blocks_folder = get_theme_file_path('/blocks/acf/');
    if (file_exists($blocks_folder) && $block_fiels = scandir($blocks_folder)) {
      $block_fiels = array_diff($block_fiels, ['.', '..']);
      $block_fiels = array_filter($block_fiels, function ($file) {
        if (!is_dir($file)) return $file;
      });
      $block_fiels = array_filter($block_fiels, function ($file) {
        if (preg_match("/(.php)$/", $file)) return $file;
      });
      foreach ($block_fiels as $file_name) {
        $block_name = str_replace('.php', '', $file_name);
        $block_name = str_replace('.', '-', $block_name);
        $file_path = $blocks_folder . $file_name;
        $file_data = get_file_data($file_path, ['title' => 'Block title', 'description' => 'Description', 'keywords' => 'Keywords', 'category' => 'Category', 'icon' => 'Icon']);
        $file_data['keywords'] = explode(', ', $file_data['keywords']);
        $file_data['keywords'] = array_map('trim', $file_data['keywords']);
        //fallback options
        $file_data['title'] = $file_data['title'] ? $file_data['title'] : $block_name;
        $file_data['description'] = $file_data['description'] ? $file_data['description'] : $block_name;
        $file_data['category'] = $file_data['category'] ? $file_data['category'] : 'theme-blocks';
        $file_data['icon'] = $file_data['icon'] ? $file_data['icon'] : 'media-text';
        acf_register_block([
          'name'             => $block_name,
          'title'            => $file_data['title'],
          'description'      => $file_data['description'],
          'render_template'  => $file_path,
          'category'         => $file_data['category'],
          'icon'             => $file_data['icon'],
          'keywords'         => $file_data['keywords'],
          'mode'             => 'edit',
          'align'            => 'full',
          'supports'         => ['align' => false, 'mode' => false,],
          'className'        => 'acf-' . $block_name,
        ]);
      }
    }
  }
});
