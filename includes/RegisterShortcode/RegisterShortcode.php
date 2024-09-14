<?php
/**
 * Primary class file for the ContentSlider.
 *
 * @package ContentSlider
 */

namespace ContentSlider\RegisterShortcode;



class RegisterShortcode
{
  public function __construct()
  {
    // Add Shortcode
    add_shortcode('content_slider', [$this, 'content_slider_shortcode_handler']);
  }

  function content_slider_shortcode_handler($atts)
  {
    $atts = shortcode_atts(array(
      "id" => ""
    ), $atts, "content_slider");

    if (!$atts['id']) {
      return "Content Slider ID is required";
    }
    $frontend_slider = get_option('active_customized_slides');
    $frontend_slides = $frontend_slider['slides'];


    if ($atts['id'] != $frontend_slider['slider_id']) {
      return "Content Slider is not found.";
    }
    wp_enqueue_script('content-slider-jquery-script-frontend');
    wp_enqueue_style('content-slider-jquery-style-frontend');

    ob_start();
    require_once 'FrontendSlider.php';
    return ob_get_clean();
  }

}
