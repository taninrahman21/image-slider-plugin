<?php
/**
 * Plugin Name: Content Slider
 * Description: The Content Slider WordPress Plugin lets you create stunning, customizable slider with a lot of functionality.
 * Version: 1.0.0
 * Author: bPlugins
 * Author URI: https://bplugins.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: content-slider
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

define('BPLCS_URL', plugins_url('', __FILE__));
define('BPLCS_DIR', plugin_dir_path(__FILE__));

// Include the main plugin class file
require_once BPLCS_DIR . 'includes/Plugin.php';




// Initialize the main plugin class
if (class_exists('ContentSlider\Plugin')) {
  new \ContentSlider\Plugin();
}
