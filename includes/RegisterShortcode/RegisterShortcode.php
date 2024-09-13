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
    add_shortcode('feature_list', [$this, 'content_slider_shortcode_handler']);
  }

  function content_slider_shortcode_handler($atts)
  {
    

    ob_start();
    return ob_get_clean();
  }



}
