<?php
include 'functions.php';

$default_display_slides = array(
  "slides" => array(
    "https://img.freepik.com/free-photo/portrait-young-adult-listening-radio-transmission_23-2151063310.jpg?t=st=1726166591~exp=1726170191~hmac=4f98ad7252416f5a9e0dd28ff56700ca9fc3ae264c6c1fb0f785402ddb63f33d&w=740",
    "https://img.freepik.com/premium-vector/illustration-realistic-rapper-eminem-tshirt-design-hand-drawn-engraving-vector-illustration_969863-199184.jpg?w=500"
  ),
  "transition_type" => "Fade",
  "max_width" => "500",
  "transition_duration" => 1000,
  "controls_enabled" => true,
  "pager_enabled" => true,
  "auto_slide" => false,
  "height" => 500,
  "auto_interval" => 2000
);

$active_customized_slides = $default_display_slides;


// echo count($active_customized_slides['slides']);




add_option("active_customized_slides", $active_customized_slides);
$active_customized_slides = get_option("active_customized_slides");



// $all_customized_slides = array();
// $patterns1 = $active_customized_slides;
// $all_customized_slides[] = $active_customized_slides;


?>

<!-- Slides -->
<div class="tab-content" id="tab-slide">
  <!-- Slide List Container -->
  <div id="slides-list">
    <?php


    if (isset($_POST['form_action'])) {
      if ($_POST['form_action'] === 'add_slide') {
        $image_url = getUploadImageUrl();
        $active_customized_slides["slides"][] = $image_url;
        update_option("active_customized_slides", $active_customized_slides);
      } elseif ($_POST['form_action'] === 'delete_slide') {
        // Deleting a slide by its index
        $slide_index = intval($_POST['slide_index']);
        if (isset($active_customized_slides['slides'][$slide_index])) {
          unset($active_customized_slides['slides'][$slide_index]);
          // Re-index the array after deletion to maintain proper ordering
          $active_customized_slides['slides'] = array_values($active_customized_slides['slides']);
          update_option("active_customized_slides", $active_customized_slides);
        }
      } elseif ($_POST['form_action'] === 'edit_slide') {
        $slide_index = intval($_POST['slide_index']);
        if (isset($active_customized_slides['slides'][$slide_index])) {
          $active_customized_slides['slides'][$slide_index] = getUploadImageUrl();
          update_option("active_customized_slides", $active_customized_slides);
        }
      }
    }

    $displayed_slides = get_option('active_customized_slides');
    $slides = $displayed_slides['slides'];


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

  <?php
  echo "<pre>";
  // print_r($_FILES);
  // print_r($_POST);
  // print_r($values);
  // print_r($active_customized_slides);
  // print_r($all_customized_slides);
  echo "</pre>";
  ?>

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
    <form action="admin.php?page=content-slider" id="edit-slide-form" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="form_action" value="edit_slide">
      <input type="hidden" name="slide_index" id="edit-slide-index" value="">
      <img class="current-slide-img" src="<?php echo esc_url($current_slide_image_url); ?>" alt="image">
      <input type="file" id="slide-image" name="slide_image" accept="image/*">

      <label for="slide-link">Enter Image Link</label>
      <input type="url" id="slide-link" name="slide_link" placeholder="https://example.com" />

      <br>
      <button type="submit" class="button button-primary">Update Slide</button>
      <button type="button" id="cancel-edit-slide-btn" class="button">Cancel</button>
    </form>
  </div>
</div>