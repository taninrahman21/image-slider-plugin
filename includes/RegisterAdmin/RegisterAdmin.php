<?php
/**
 * Plugin Activation class.
 *
 * @package ContentSlider
 */

namespace ContentSlider\Admin;

class RegisterAdmin
{

  public function __construct()
  {
    // This is the hook to create a new page
    add_action('admin_menu', [$this, 'add_admin_menu']);

  }

  public function add_admin_menu()
  {
    add_menu_page(
      'Content Slider Edit',       // Page title
      'Content Slider',       // Menu title
      'manage_options',       // Capability
      'content-slider',       // Menu slug
      [$this, 'display_slider_page'], // Function to display page content
      '',                     // Icon URL (empty for no icon)
      25                      // Position in menu
    );
  }

  public function display_slider_page()
  {
    ob_start();
    // Path of Images
    $images_dir = BPLCS_DIR . 'images/slider-images/';
    $images_url = BPLCS_URL . '/images/slider-images/';

    // Fetch all images from the directory (jpg, jpeg, png, gif)
    $slides = glob($images_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    require_once BPLCS_DIR . '/includes/Pages/Page.php';
  }

}