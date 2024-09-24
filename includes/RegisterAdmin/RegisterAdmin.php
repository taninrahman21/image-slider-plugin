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
      'Content Slider',       // Page title
      'Content Slider',       // Menu title
      'manage_options',       // Capability
      'content-slider',       // Menu slug
      [$this, 'display_slider_page'], // Function to display page content
      '',                     // Icon URL (empty for no icon)
      25                      // Position in menu
    );

    // Submenu: Getting Started
    add_submenu_page(
      'content-slider',              // Parent slug
      'Getting Started',             // Page title
      'Getting Started',             // Menu title
      'manage_options',              // Capability
      'getting_started',              // Menu slug
      [$this, 'getting_started_page'] // Function to display the content of this page
    );

  }

  public function display_slider_page()
  {
    require_once BPLCS_DIR . '/includes/Pages/Page.php';
  }


  public function getting_started_page()
  {
    ?>
    <div class="content-slider-getting-started">
      <h1>Getting Started with Content Slider</h1>
      <p class="intro">Welcome to the Content Slider plugin! Follow these easy steps to create, configure, and embed sliders
        on your site in no time.</p>

      <div class="steps">
        <!-- Step 1 -->
        <h2>Step 1: Create a New Slider</h2>
        <p>To create, navigate to the "Content Slider" section in the WordPress admin dashboard and click "Add New Slider".
          After doing that you've already create your new slider.</p>
        <img src="<?php echo plugins_url('../../images/Screenshot_1.png', __FILE__); ?>" alt="Create a New Slider">

        <!-- Step 2 -->
        <h2>Step 2: Edit Your Slider</h2>
        <p>Click the "Edit" button to edit your slider. After Clicking "Edit" Button you will navigate to slides section
          where you can edit you slider name and add new slides. To add slide click "Add Slide" Button and upload image from
          you device or insert a valid image link. then click upload slide button and it will add to your slider. You can
          all edit or delete each individual slide by clicking edit button and delete button. </p>
        <div class="view-screenshot">
          <div>
            <img src="<?php echo plugins_url('../../images/Screenshot_3.png', __FILE__); ?>" alt="Add Slides">
          </div>
          <div>
            <img src="<?php echo plugins_url('../../images/Screenshot_4.png', __FILE__); ?>" alt="Add Slides">
          </div>
          <div>
            <img src="<?php echo plugins_url('../../images/Screenshot_5.png', __FILE__); ?>" alt="Use Shortcode">
          </div>
        </div>


        <!-- Step 3 -->
        <h2>Step 3: Customize Slider Settings</h2>
        <p>Navigate the "Settings" Tab to control the look and feel of your slider with advanced settings like navigation
          controls, transition speed and other's settings. Make sure to preview your changes to see how the slider will
          look. After Customize all the settings you have to save to preview.</p>
        <div class="view-screenshot">
          <div>
            <img src="<?php echo plugins_url('../../images/Screenshot_6.png', __FILE__); ?>" alt="Use Shortcode">
          </div>
          <div>
            <img src="<?php echo plugins_url('../../images/Screenshot_6.1.png', __FILE__); ?>" alt="Use Shortcode">
          </div>
        </div>

        <!-- Step 4 -->
        <h2>Step 4: Display Slider To Your Page or Wherever You Want</h2>
        <p>After Setting up your slider, go to the 'All Slides' tab. You’ll get a shortcode next to your slider name.
          Copy that shortcode by click up on the shortcode and paste it where you want to display your slider. It's that simple!</p>

        <img src="<?php echo plugins_url('../../images/Screenshot_7.png', __FILE__); ?>" alt="Use Shortcode">
      </div>

      <!-- Help Section and Market Section -->
      <div class="help-market-container">
        <!-- Help Section -->
        <div class="help-section">
          <h2>Need More Help?</h2>
          <p>If you need assistance or have questions, check out our <a
              href="https://bplugins.com/documentation">documentation</a> or contact our <a
              href="mailto:support@bplugins.com">support team</a>.</p>
          <a href="https://bplugins.com/documentation" class="button-link">View Documentation</a>
        </div>

        <!-- Market Other Plugins Section -->
        <div class="market-plugins-section">
          <h2>Discover More Plugins</h2>
          <p>Explore our collection of powerful WordPress plugins designed to enhance your website:</p>
          <a href="https://bplugins.com" class="button-link">View All Plugins</a>
        </div>
      </div>
    </div>
    <?php
  }

}