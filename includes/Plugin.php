<?php
/**
 * Primary class file for the ContentSlider.
 *
 * @package ContentSlider
 */

namespace ContentSlider;

require_once BPLCS_DIR . 'includes/RegisterAdmin/RegisterAdmin.php';
require_once BPLCS_DIR . 'includes/RegisterPluginActivation/RegisterPluginActivation.php';

use ContentSlider\Admin\RegisterAdmin;
use ContentSlider\PluginActivation\RegisterPluginActivation;

class Plugin
{
  public function __construct()
  {
    // Load the admin and activation classes
    $this->load_register_admin_class();
    $this->load_activation_class();

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

  public function enqueue_styles_scripts()
  {
    global $pagenow;
    echo $pagenow;
    echo "find Me";

    // Enqueue WordPress's built-in jQuery
    wp_enqueue_script('jquery');

    // Enqueue your custom script
    wp_enqueue_script('content-slider-jquery-scripts', BPLCS_URL . '/js/content-slider.js', ['jquery'], null, true);

    // Enqueue your custom style
    
    if("admin.php" == $pagenow) {
      wp_enqueue_style('content-slider-admin-style', BPLCS_URL . '/css/admin.css');
      wp_enqueue_style('content-slider-jquery-style', BPLCS_URL . '/css/content_slider.css');

    }

  }


}
