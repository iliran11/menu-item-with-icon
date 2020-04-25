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
  wp_register_style('menu-item-with-icon', plugins_url('style.css'));
  wp_enqueue_style('menu-item-with-icon');
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
      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-184">hii</li>
<?php $item->title = ob_get_clean();
    }
  }


  // return
  return $items;
}
add_action('wp_enqueue_scripts', 'wpdocs_register_plugin_styles');
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
