<!-- For Edit Slide -->
<div id="edit-slide-content" style="display: none;">
  <h3>Edit Slide</h3>
  <form action="admin.php?page=content-slider" id="edit-slide-form" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="form_action" value="update_slide">
    <input type="hidden" name="slide_index" value="<?php echo $index; ?>">
    <img class="current-slide-img" src="<?php echo esc_url($slide); ?>" alt="image">
    <input type="file" id="slide-image" name="slide_image" accept="image/*">

    <label for="slide-link">Enter Image Link</label>
    <input type="url" id="slide-link" name="slide_link" placeholder="https://example.com" />

    <br>
    <button type="submit" class="button button-primary">Update Slide</button>
    <button type="button" id="cancel-edit-slide-btn" class="button">Cancel</button>
  </form>
</div>