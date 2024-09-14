<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Handle edit button clicks
    const editButtons = document.querySelectorAll('.edit-slide-btn');
    editButtons.forEach(function (button, index) {
      button.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        // Get the slide index from the clicked button
        const slideIndex = this.closest('form').querySelector('input[name="slide_index"]').value;

        // Set the slide index in the hidden field of the edit form
        document.getElementById('edit-slide-index').value = slideIndex;

        // Show the edit slide modal or section
        document.getElementById('edit-slide-content').style.display = 'block';

        // Set the current image URL in the edit form image preview
        const currentImageUrl = this.closest('.slide-item').querySelector('img').src;
        document.querySelector('.current-slide-img').src = currentImageUrl;
      });
    });

    // Handle cancel button click for edit form
    document.getElementById('cancel-edit-slide-btn').addEventListener('click', function () {
      document.getElementById('edit-slide-content').style.display = 'none';
    });
  });
</script>