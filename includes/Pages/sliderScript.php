<!-- Initialize bxSlider with jQuery -->
<script>
  // This is jQuery Slider Plugin
  <?php if (!empty($slider_to_edit_from_get_option)): ?>
    jQuery(document).ready(function ($) {
      $(".bxslider").bxSlider({
        mode: "<?php echo esc_js($slider_to_edit_from_get_option['transition_type']); ?>",
        controls: <?php echo $slider_to_edit_from_get_option['controls_enabled'] ? 'true' : 'false'; ?>,
        auto: <?php echo $slider_to_edit_from_get_option['auto_slide'] ? 'true' : 'false'; ?>,
        pager: <?php echo $slider_to_edit_from_get_option['pager_enabled'] ? 'true' : 'false'; ?>,
        pause: <?php echo esc_js($slider_to_edit_from_get_option['auto_interval']); ?>,
        speed: <?php echo esc_js($slider_to_edit_from_get_option['transition_duration']); ?>,
        nextText: "Next",
        prevText: "Prev"
      });
    });
  <?php endif; ?>

  // This is For Tab Click
  jQuery(document).ready(function ($) {

    // Hide Slide and Settings Tab by default
    $('li[data-tab="tab-slide"]').hide();
    $('li[data-tab="tab-settings"]').hide();


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


    $('.edit-slider-btn').click(function (e) {
      e.preventDefault();

      // Hide the All Sliders tab content and the "All Sliders" tab
      $('#tab-all-slider').hide();
      $('li[data-tab="tab-all-slider"]').removeClass('active');

      // Show the Slide and Settings tabs
      $('li[data-tab="tab-slide"]').show();
      $('li[data-tab="tab-settings"]').show();

      // Activate the Slide tab and show its content
      $('#tab-slide').show();
      $('li[data-tab="tab-slide"]').addClass('active');


      $(this).closest('form').submit();

      // Update active tab in localStorage
      localStorage.setItem('activeTab', 'tab-slide');
      localStorage.setItem('showSlideAndSettingsTab', true);
    });

    $('li[data-tab="tab-settings"]').on('click', function () {
      localStorage.setItem('activeTab', 'tab-settings');
    })

    $('li[data-tab="tab-slide"]').on('click', function () {
      localStorage.setItem('activeTab', 'tab-slide');
    })

    $('li[data-tab="tab-all-slider"]').click(function () {
      localStorage.setItem('activeTab', 'tab-all-slider');
      localStorage.setItem('showSlideAndSettingsTab', false);
    });

    $('.copy-shortcode').click(function () {
      // Get the shortcode from the data attribute
      var shortcode = $(this).attr('data-shortcode');
      // Create a temporary input element to hold the shortcode
      var tempInput = $('<input>');
      $('body').append(tempInput);
      tempInput.val(shortcode).select();
      document.execCommand('copy');
      tempInput.remove();
      var $tooltip = $(this).find('.tooltip');
      $(this).addClass('show-tooltip');
      setTimeout(function () {
        $('.copy-shortcode').removeClass('show-tooltip'); // Hide tooltip
      }, 1500);
    });

    // Show the first tab content by default
    let lastActiveTab = localStorage.getItem('activeTab');

    $('#add-slide-btn').on('click', function () {
      $('#slides-list').hide();
      $('#add-slide-content').show();
    });

    const $editForm = $('#edit-slide-content');

    $('.edit-slide-btn').on('click', function (e) {
      e.preventDefault();

      // Get the slide index from the clicked button
      const $form = $(this).closest('form');
      const slideIndex = $form.find('input[name="slide_index"]').val();

      // Set the slide index in the hidden field of the edit form
      $('#edit-slide-index').val(slideIndex);

      $('#edit-slide-content').show();

      // Set the current image URL in the edit form image preview
      const currentImageUrl = $(this).closest('.slide-item').find('img').attr('src');
      $('.current-slide-img').attr('src', currentImageUrl);

      $('#slides-list').hide();
    });

    $('#cancel-edit-slide-btn').on('click', function () {
      $('#edit-slide-content').hide();
      $('#slides-list').show();
      $('#edit-slide-form')[0].reset();
      $('#edit-slide-file').prop('disabled', false);
    });

    // Function to handle the changes in the file input or URL input
    function handleInputChange() {
      var fileInput = $('#slide-image').val();
      var urlInput = $('#slide-link').val();

      if (fileInput) {
        $('#slide-link').prop('disabled', true); // Disable URL input
      } else if (urlInput) {
        $('#slide-image').prop('disabled', true); // Disable file input
      } else {
        $('#slide-image').prop('disabled', false); // Enable file input
        $('#slide-link').prop('disabled', false); // Enable URL input
      }


      // Hide modal and reset form on cancel
      $('#cancel-slide-btn').on('click', function () {
        $('#add-slide-content').hide();
        $('#slides-list').show();

        // Reset form fields
        $('#add-slide-form')[0].reset(); // Reset form fields
        $('#slide-link').prop('disabled', false); // Ensure URL input is enabled
        $('#slide-image').prop('disabled', false); // Ensure file input is enabled
      });

    }

    // Attach event listeners to the input fields
    $('#slide-image').on('change', handleInputChange);
    $('#slide-link').on('input', handleInputChange);

    // Initialize the state of the inputs
    handleInputChange();

    // Show the last active tab on page load
    $('.tab').removeClass('active');
    $('#' + lastActiveTab).show(); // Show the content of the last active tab
    $('li[data-tab="' + lastActiveTab + '"]').addClass('active');

    <?php
    if (empty($slider_to_edit_from_get_option)) {
      ?>
      localStorage.setItem('showSlideAndSettingsTab', false); // Hide Slide and Settings Tab by default
      <?php
    } else {
      ?>
      localStorage.setItem('showSlideAndSettingsTab', true); // Show Slide and Settings Tab by default
      <?php
    }
    ?>

    let displaySettingsAndSlidesTab = localStorage.getItem('showSlideAndSettingsTab');
    if (displaySettingsAndSlidesTab === 'true') {
      $('li[data-tab="tab-slide"]').show(); // Show the Slide tab
      $('li[data-tab="tab-settings"]').show(); // Show the Settings tab
      $('#edit-slider-section').show(); // Show the edit-slider-section
      $('#edit-slider-form').show(); // Show the edit-slider-form
    } else {
      $('li[data-tab="tab-slide"]').hide(); // Hide the Slide tab
      $('li[data-tab="tab-settings"]').hide(); // Hide the Settings tab
      $('#tab-all-slider').show(); // Show the "All Sliders" content
      $('li[data-tab="tab-all-slider"]').addClass('active'); // Mark the "All Sliders" tab as active
    }

  });
</script>