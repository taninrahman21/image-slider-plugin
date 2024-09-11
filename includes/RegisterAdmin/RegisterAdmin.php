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
    // Path of Images
    $images_dir = BPLCS_DIR . 'images/slider-images/';
    $images_url = BPLCS_URL . '/images/slider-images/';

    // Get all images
    $images = glob($images_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    ?>
    <div class="wrap">

      <!-- Slider Settings -->
      <div class="slider-settings">
        <div class="tab-container">
          <!-- Tab Buttons -->
          <ul class="tab-buttons">
            <li class="tab active" data-tab="tab-slide">Slides</li>
            <li class="tab" data-tab="tab-settings">Settings</li>
            <li class="tab" data-tab="tab-patterns">Patterns</li>
          </ul>

          <!-- Slides -->
          <div class="tab-content" id="tab-slide">

            <!-- Add Slide Button -->
            <div class="add-slide-btn">
              <button id="add-slide-btn" class="button button-primary">Add New Slide</button>
            </div>

            <!-- Slide List Container -->
            <div id="slides-list">
              <!-- Existing slides will be displayed here dynamically -->
              <?php
              // This will be a loop that fetches slides from the database or file
              // Example placeholder for dynamic content:
              $slides = [
                ['id' => 1, 'src' => 'images/slide1.jpg'],
                ['id' => 2, 'src' => 'images/slide2.jpg'],
                ['id' => 3, 'src' => 'images/slide3.jpg'],
              ];

              if (!empty($slides)) {
                foreach ($slides as $slide) {
                  ?>
                  <div class="slide-item" data-slide-id="<?php echo $slide['id']; ?>">
                    <div>
                      <img src="<?php echo esc_url($slide['src']); ?>" alt="Slide Image" class="slide-img">
                    </div>
                    <div>
                      <button class="edit-slide-btn">Edit</button>
                      <button class="delete-slide-btn">Delete</button>
                    </div>
                  </div>
                  <?php
                }
              } else {
                echo '<p>No slides added yet.</p>';
              }
              ?>
            </div>
          </div>

          <!-- Slider Settings -->
          <div class="tab-content" id="tab-settings" style="display: none;">

            <!-- Select Control for Slider Type -->
            <div class="control-group">
              <p for="slider-type">Slider Type</p>
              <select id="slider-type">
                <option value="horizontal">Horizontal</option>
                <option value="fade">Fade</option>
                <option value="vertical">Vertical</option>
              </select>
            </div>

            <!-- Number Input Controls -->
            <div class="control-group">
              <p>Max Width (px)</p>
              <input type="number" id="max-width" placeholder="Enter max width" />
            </div>

            <div class="control-group">
              <p>Transition Duration (ms)</p>
              <input type="number" id="transition-duration" placeholder="Enter duration in milliseconds" />
            </div>

            <div class="control-group">
              <p>Height (px)</p>
              <input type="number" id="slider-height" placeholder="Enter slider height" />
            </div>

            <!-- Toggle Controls -->
            <div class="control-group">
              <p>Enable Controls</p>
              <label class="switch">
                <input type="checkbox" id="controls-enabled" />
                <span class="slider round"></span>
              </label>
            </div>

            <div class="control-group">
              <p>Enable Pagination</p>
              <label class="switch">
                <input type="checkbox" id="pagination-enabled" />
                <span class="slider round"></span>
              </label>
            </div>

            <!-- Save Settings Button -->
            <div class="control-group save-settings-button">
              <button id="save-settings" class="save-settings-btn">Save Settings</button>
            </div>

          </div>

          <!-- Patterns -->
          <div class="tab-content" id="tab-patterns" style="display: none;">
            <h3>Patterns</h3>
            <p>Add different background patterns or themes for the slider.</p>
          </div>

        </div>

      </div>

      <!-- Slider Container -->
      <ul class="bxslider">
        <?php
        // Loop through the images and create an <li> element for each image
        foreach ($images as $image) {
          // Get the image URL
          $image_url = str_replace($images_dir, $images_url, $image);
          echo '<li><img src="' . esc_url($image_url) . '" /></li>';
        }
        ?>
        </u>

        <!-- Initialize bxSlider with jQuery -->
        <script>
          // This is jQuery Slider Plugin
          jQuery(document).ready(function ($) {
            $(".bxslider").bxSlider({
              controls: true,
              nextText: "Next",
              prevText: "Prev"
            });
          });

          // This is For Tab Click
          jQuery(document).ready(function ($) {
            // Handle tab click
            $('.tab').click(function () {
              // Remove active class from all tabs
              $('.tab').removeClass('active');

              // Add active class to clicked tab
              $(this).addClass('active');

              // Hide all tab contents
              $('.tab-content').hide();

              // Show the corresponding tab content
              var tabToShow = $(this).attr('data-tab');
              $('#' + tabToShow).fadeIn();
            });

            // Show the first tab content by default
            $('#tab-slide').show();
          });
        </script>
    </div>

    <?php
  }

}