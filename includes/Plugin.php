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

    // Load Scripts and Styles in Frontend
    add_action('wp_enqueue_scripts', array($this, 'load_styles_scripts'));


  }

  private function load_activation_class()
  {
    new RegisterPluginActivation();
  }

  private function load_register_admin_class()
  {
    new RegisterAdmin();
  }

  private function load_register_shortcode_class()
  {
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

  public function load_styles_scripts() {
    wp_register_script('content-slider-jquery-script-frontend', BPLCS_URL . '/js/content-slider.js', ['jquery'], null, true);
    wp_register_style('content-slider-jquery-style-frontend', BPLCS_URL . '/css/content_slider.css');
  }


  function update_slider_settings()
  {
    // Check for required POST data
    if (isset($_POST['slider_type']) && isset($_POST['max_width']) && isset($_POST['transition_duration'])) {
      $active_customized_slides = get_option('active_customized_slides', array());

      // Check if required fields are available
      if (!isset($_POST['slider_type']) || !isset($_POST['max_width']) || !isset($_POST['transition_duration']) || !isset($_POST['slider_height']) || !isset($_POST['controls_enabled']) || !isset($_POST['pagination_enabled'])) {
        wp_send_json_error('Missing fields');
        wp_die();
      }
      // Update the values with the new data from the request
      $active_customized_slides['transition_type'] = sanitize_text_field($_POST['slider_type']);
      $active_customized_slides['max_width'] = intval($_POST['max_width']);
      $active_customized_slides['transition_duration'] = intval($_POST['transition_duration']);
      $active_customized_slides['height'] = intval($_POST['slider_height']);
      $active_customized_slides['controls_enabled'] = intval($_POST['controls_enabled']);
      $active_customized_slides['pager_enabled'] = intval($_POST['pagination_enabled']);

      // Save the updated settings
      update_option('active_customized_slides', $active_customized_slides);

      // Send a success response
      wp_send_json_success('Settings updated');
    } else {
      wp_send_json_error('Missing data');
    }

    // Always exit in AJAX handlers
    wp_die();
  }

}
