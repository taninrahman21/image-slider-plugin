<!-- Initialize bxSlider with jQuery -->
<script>
  // This is jQuery Slider Plugin
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

    // Hide add-new-slider-section by default
    $('#add-new-slider-section').hide();
    $('#edit-slider-section').hide();
    $('#edit-slider-form').hide();


    // $('#add-new-slider-btn').click(function (e) {
    //   e.preventDefault();
    //   $('#tab-all-slider').hide();
    //   $('.tab').removeClass('active');
    //   // After click active tab should 
    //   $('#tab-slide').show();
    //   $('li[data-tab="tab-slide"]').addClass('active');
    //   $('#add-new-slider-section').show();
    //   $('#edit-slider-form').show();
    //   $(this).closest('form').submit();


    //   // Update active tab in localStorage
    //   localStorage.setItem('activeTab', 'tab-slide');
    // });

    $('.edit-slider-btn').click(function (e) {
      e.preventDefault();
      $('#tab-all-slider').hide();
      $('.tab').removeClass('active');
      // After click active tab should 
      $('#tab-slide').show();
      $('li[data-tab="tab-slide"]').addClass('active');
      $('#add-new-slider-section').hide();
      $('#edit-slider-section').show();
      $('#edit-slider-form').show();
      $(this).closest('form').submit();

      // Update active tab in localStorage
      localStorage.setItem('activeTab', 'tab-slide');
      localStorage.setItem('section', 'edit-slider-section');
      localStorage.setItem('form', 'edit-slider-form');
    });

    // Add logic to hide add-new-slider-section when returning to the "All Slider" tab
    $('li[data-tab="tab-all-slider"]').click(function () {
      $('#add-new-slider-section').hide(); // Hide the add-new-slider-section
      $('#tab-all-slider').show(); // Show the "All Slider" content
      $('#edit-slider-section').hide();
      $('#edit-slider-form').hide();

      // Update active tab in localStorage
      localStorage.setItem('activeTab', 'tab-all-slider');
      localStorage.removeItem('section');
      localStorage.removeItem('form');
    });

    $('.copy-shortcode').click(function () {
      // Get the shortcode from the data attribute
      var shortcode = $(this).attr('data-shortcode');
      // Create a temporary input element to hold the shortcode
      var tempInput = $('<input>');
      $('body').append(tempInput);
      tempInput.val(shortcode).select();
      // Copy the content to the clipboard
      document.execCommand('copy');
      // Remove the temporary input element
      tempInput.remove();
      // Show tooltip
      var $tooltip = $(this).find('.tooltip');
      $(this).addClass('show-tooltip');  // Add class to show the tooltip
      // Hide tooltip after 2 seconds
      setTimeout(function () {
        $('.copy-shortcode').removeClass('show-tooltip'); // Hide tooltip
      }, 1500);
    });
    // Show the first tab content by default
    let lastActiveTab = localStorage.getItem('activeTab') || 'tab-all-slider';

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

    // Show the appropriate section if the last active tab was "tab-slide"
    let lastSection = localStorage.getItem('section');
    if (lastActiveTab === 'tab-slide' && lastSection) {
      $('#' + lastSection).show(); // Show the last saved section (add or edit slider)
    } else if (lastActiveTab === 'tab-slide') {
      $('#add-new-slider-section').show(); // Default to showing add-new-slider-section
    }

    // Display The Form which is lastly active
    let lastForm = localStorage.getItem('form');
    if (lastActiveTab === 'tab-slide' && lastForm) {
      $('#' + lastForm).show(); // Show the last saved section (add or edit slider)
    } else if (lastActiveTab === 'tab-slide') {
      $('#edit-slider-form').show(); // Default to showing add-new-slider-section
    }

  });
</script>