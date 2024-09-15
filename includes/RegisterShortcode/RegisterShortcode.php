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

    $all_slider_from_get_option = get_option("bplcs_all_sliders");

    $slider_to_display = null;

    // Find the slider by ID
    foreach ($all_slider_from_get_option as $slider) {
      if ($slider['slider_id'] == $atts['id']) {
        $slider_to_display = $slider;
        break;
      }
    }

    if (!$slider_to_display) {
      return "Slider not found";
    }

    

    $frontend_slides = $slider_to_display["slides"];



    wp_enqueue_script('content-slider-jquery-script-frontend');
    wp_enqueue_style('content-slider-jquery-style-frontend');

    ob_start();
    require_once 'FrontendSlider.php';
    return ob_get_clean();
  }
}
