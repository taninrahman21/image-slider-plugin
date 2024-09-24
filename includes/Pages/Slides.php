<?php


$all_slider_from_get_option = get_option("bplcs_all_sliders");

// echo "<pre>";
// print_r($slider_to_edit_from_get_option);
// echo "</pre>";



?>

<!-- Slides -->
<div class="tab-content" id="tab-slide">

  <?php if (isset($slider_to_edit_from_get_option)): ?>
    <!-- Div After Click Edit Slider -->
    <div id="edit-slider-section" style="display: none;">
      <form action="admin.php?page=content-slider" method="POST" class="slide-name-form">
        <p>Slider Name</p>
        <div>
          <input type="hidden" name="form_action" value="slider_name_form">
          <input type="hidden" name="slider_id" value="<?= $slider_to_edit_from_get_option['slider_id']; ?>">
          <input type="text" id="name" name="slider_name" placeholder="Slider Name"
            value="<?= esc_attr($slider_to_edit_from_get_option['slider_name']) ?>" required>
          <input type="submit" class="button button-primary" value="Save">
        </div>
      </form>

      <!-- Slide List Container -->
      <div id="slides-list">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Ensure 'form_action' exists before accessing it
          if (isset($_POST['form_action'])) {
            if ($_POST['form_action'] === 'add_slide') {
              // Handle adding a slide
              $image_url = getUploadImageUrl();
              $slider_to_edit_from_get_option["slides"][] = $image_url;
              $edit_slider_index = findSliderById($all_slider_from_get_option, $slider_to_edit_from_get_option['slider_id']);
              $all_slider_from_get_option[$edit_slider_index] = $slider_to_edit_from_get_option;

              update_option("slider_to_edit", $slider_to_edit_from_get_option);
              update_option("bplcs_all_sliders", $all_slider_from_get_option);
            } elseif ($_POST['form_action'] === 'delete_slide') {
              // Handle deleting a slide
              $slide_index = intval($_POST['slide_index']);
              if (isset($slider_to_edit_from_get_option['slides'][$slide_index])) {
                unset($slider_to_edit_from_get_option['slides'][$slide_index]);
                // Re-index the array after deletion to maintain proper ordering
                $slider_to_edit_from_get_option['slides'] = array_values($slider_to_edit_from_get_option['slides']);
                $edit_slider_index = findSliderById($all_slider_from_get_option, $slider_to_edit_from_get_option['slider_id']);
                $all_slider_from_get_option[$edit_slider_index] = $slider_to_edit_from_get_option;

                update_option("slider_to_edit", $slider_to_edit_from_get_option);
                update_option("bplcs_all_sliders", $all_slider_from_get_option);
              }
            } elseif ($_POST['form_action'] === 'edit_slide') {
              // Handle editing a slide
              $slide_index = intval($_POST['slide_index']);
              $slider_to_edit_from_get_option["slides"][$slide_index] = getUploadImageUrl();
              $edit_slider_index = findSliderById($all_slider_from_get_option, $slider_to_edit_from_get_option['slider_id']);
              $all_slider_from_get_option[$edit_slider_index] = $slider_to_edit_from_get_option;

              update_option("slider_to_edit", $slider_to_edit_from_get_option);
              update_option("bplcs_all_sliders", $all_slider_from_get_option);
            }
          }
        }

        $slides = $slider_to_edit_from_get_option['slides'];


        // Check if there are any images found
        if (!empty($slides)) {
          // Loop through each image and display it
          foreach ($slides as $index => $slide) {
            ?>
            <div class="slide-item">
              <div>
                <img src="<?php echo esc_url($slide); ?>" alt="Slide Image" class="slide-img">
              </div>
              <div class="slide-actions">
                <form method="POST" action="admin.php?page=content-slider" style="display:inline;">
                  <input type="hidden" name="form_action" value="edit_slide">
                  <input type="hidden" name="slide_index" value="<?php echo $index; ?>">
                  <button type="submit" class="edit-slide-btn">Edit</button>
                </form>

                <form method="POST" action="admin.php?page=content-slider">
                  <input type="hidden" name="form_action" value="delete_slide">
                  <input type="hidden" name="slide_index" value="<?php echo $index; ?>">
                  <button type="submit" class="delete-slide-btn">Delete</button>
                </form>
              </div>
            </div>
            <?php
          }
        } else {
          echo '<p>No slides added yet.</p>';
        }
        ?>

        <!-- Add Slide Button -->
        <div class="add-slide-btn">
          <button id="add-slide-btn" class="button button-primary">Add New Slide</button>
        </div>
      </div>

      <!-- For Add Slide -->
      <div id="add-slide-content" style="display: none;">
        <h3>Add New Slide</h3>
        <form action="admin.php?page=content-slider" id="add-slide-form" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="form_action" value="add_slide">

          <label for="slide-image">Choose Slide Image:</label>
          <input type="file" id="slide-image" name="slide_image" accept="image/*">

          <h2>Or</h2>

          <label for="slide-link">Enter Slide Link</label>
          <input type="url" id="slide-link" name="slide_link" placeholder="https://example.com" />

          <br>
          <button type="submit" class="button button-primary">Upload Slide</button>
          <button type="button" id="cancel-slide-btn" class="button">Cancel</button>
        </form>
      </div>

      <!-- For Edit Slide -->
      <div id="edit-slide-content" style="display: none;">
        <h3>Edit Slide</h3>
        <form action="admin.php?page=content-slider" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="form_action" value="edit_slide">
          <input type="hidden" name="slide_index" id="edit-slide-index" value="">
          <img class="current-slide-img" src="" alt="image">
          <input type="file" id="slide-image" name="slide_image" accept="image/*">

          <label for="slide-link">Enter Image Link</label>
          <input type="url" id="slide-link" name="slide_link" placeholder="https://example.com" />

          <br>
          <button type="submit" class="button button-primary">Update Slide</button>
          <button type="button" id="cancel-edit-slide-btn" class="button">Cancel</button>
        </form>
      </div>

    </div>
  <?php endif; ?>
</div>