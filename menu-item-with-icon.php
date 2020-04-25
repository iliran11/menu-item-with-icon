<?php

/*
Plugin Name: menu-item-with-icon
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: adds icon to the start of a menu item
Version: The Plugin's Version Number, e.g.: 1.0
Author: Liran Cohen
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

function wpdocs_register_plugin_styles()
{
  $plugin_url = plugin_dir_url(__FILE__);
  wp_enqueue_style('menu-item-with-icon', $plugin_url . 'style.css');
}
// Register style sheet.

function my_wp_nav_menu_objects($items, $args)
{

  // loop
  foreach ($items as &$item) {

    // vars
    $icon = get_field('svg-markup', $item);

    // append icon
    if ($icon) {
      write_log($item->title);
      ob_start(); ?>
      <div class="menu-item-with-icon">
        <div class="icon"><?php echo $icon ?></div>
        <span><?php echo $item->title ?></span>
      </div>
<?php $item->title = ob_get_clean();
    }
  }


  // return
  return $items;
}
add_action('wp_enqueue_scripts', 'wpdocs_register_plugin_styles');
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
