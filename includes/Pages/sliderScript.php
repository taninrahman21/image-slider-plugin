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

    $('#add-slide-btn').on('click', function () {
      $('#slides-list').hide();
      $('#add-slide-content').show();
    });

    const $editForm = $('#edit-slide-content');

    $('.edit-slide-btn').on('click', function (e) {
      e.preventDefault();
      // Hide the slide list and show the edit slide form

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

  });
</script>