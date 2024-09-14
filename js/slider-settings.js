jQuery(document).ready(function ($) {
  // When any input or select field changes
  $('#slider-type, #max-width, #transition-duration, #slider-height, #controls-enabled, #pagination-enabled').on('change', function () {
    // Get the values from the fields
    let sliderType = $('#slider-type').val();
    let maxWidth = $('#max-width').val();
    let transitionDuration = $('#transition-duration').val();
    let sliderHeight = $('#slider-height').val();
    let controlsEnabled = $('#controls-enabled').is(':checked') ? 1 : 0;
    let paginationEnabled = $('#pagination-enabled').is(':checked') ? 1 : 0;

    // Send the AJAX request
    $.ajax({
      url: ajaxurl, // WordPress AJAX URL
      type: 'POST',
      data: {
        action: 'update_slider_settings',
        slider_type: sliderType,
        max_width: maxWidth,
        transition_duration: transitionDuration,
        slider_height: sliderHeight,
        controls_enabled: controlsEnabled,
        pagination_enabled: paginationEnabled,
      },
      success: function (response) {
        console.log('Settings updated successfully');
      },
      error: function (xhr, status, error) {
        console.error('Error updating settings:', error);
      }
    });
  });

  // Event listener for Save Settings button click
  $('#save-settings').on('click', function () {
    let sliderType = $('#slider-type').val();
    let maxWidth = $('#max-width').val();
    let transitionDuration = $('#transition-duration').val();
    let sliderHeight = $('#slider-height').val();
    let controlsEnabled = $('#controls-enabled').is(':checked') ? 1 : 0;
    let paginationEnabled = $('#pagination-enabled').is(':checked') ? 1 : 0;

    // Send the AJAX request to save all settings
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        action: 'update_slider_settings',
        slider_type: sliderType,
        max_width: maxWidth,
        transition_duration: transitionDuration,
        slider_height: sliderHeight,
        controls_enabled: controlsEnabled,
        pagination_enabled: paginationEnabled,
      },
      success: function (response) {
        alert('Settings saved successfully');
      },
      error: function (xhr, status, error) {
        alert('Failed to save settings');
        console.error('Error updating settings:', error);
      }
    });
  });
});
