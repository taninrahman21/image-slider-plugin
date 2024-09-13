<?php
/**
 * Primary class file for the ContentSlider.
 *
 * @package ContentSlider
 */

namespace ContentSlider;

require_once BPLCS_DIR . 'includes/RegisterAdmin/RegisterAdmin.php';
require_once BPLCS_DIR . 'includes/RegisterPluginActivation/RegisterPluginActivation.php';
require_once BPLCS_DIR . 'includes/RegisterShortcode/RegisterShortcode.php';

use ContentSlider\Admin\RegisterAdmin;
use ContentSlider\PluginActivation\RegisterPluginActivation;
use ContentSlider\RegisterShortcode\RegisterShortcode;

class Plugin
{
  public function __construct()
  {
    // Load the admin and activation classes
    $this->load_register_admin_class();
    $this->load_activation_class();
    $this->load_register_shortcode_class();

    // Load Scripts and Styles in Backend
    add_action('admin_enqueue_scripts', array($this, 'enqueue_styles_scripts'));

  }

  private function load_activation_class()
  {
    new RegisterPluginActivation();
  }

  private function load_register_admin_class()
  {
    new RegisterAdmin();
  }

  private function load_register_shortcode_class() {
    new RegisterShortcode();
  }

  public function enqueue_styles_scripts()
  {
    global $pagenow;


    // Enqueue your custom script

    // Enqueue your custom style

    if ("admin.php" == $pagenow) {
      wp_enqueue_script('content-slider-jquery-scripts', BPLCS_URL . '/js/content-slider.js', ['jquery'], null, true);
      wp_enqueue_style('content-slider-admin-style', BPLCS_URL . '/css/admin.css');
      wp_enqueue_style('content-slider-jquery-style', BPLCS_URL . '/css/content_slider.css');
    }
  }


}
