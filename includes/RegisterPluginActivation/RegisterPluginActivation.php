<?php
/**
 * Plugin Activation class.
 *
 * @package ContentSlider
 */

namespace ContentSlider\PluginActivation;

class RegisterPluginActivation
{
  public function __construct()
  {
    // Register the activation hook
    register_activation_hook(BPLCS_DIR . 'content-slider.php', [$this, 'content_slider_plugin_activate']);

    // Create the slider table on plugin activation
    register_activation_hook(BPLCS_DIR, [$this, 'create_slider_table']);


    // Hook to admin_init for redirection after activation
    add_action('admin_init', [$this, 'content_slider_plugin_redirect']);

  }

  // Set option for redirect on plugin activation
  public function content_slider_plugin_activate()
  {
    add_option('content_slider_plugin_do_redirect', true);
  }

  // Redirect to the Content Slider page after activation
  public function content_slider_plugin_redirect()
  {
    // Check if the redirect is needed
    if (get_option('content_slider_plugin_do_redirect', false)) {
      delete_option('content_slider_plugin_do_redirect'); // Remove option to avoid repeated redirects
      wp_redirect(admin_url('admin.php?page=content-slider'));
      exit;
    }
  }


}
