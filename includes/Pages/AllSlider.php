<?php

add_option("bplcs_all_sliders", array());
add_option("slider_to_edit", array());

$all_slider_from_get_option = get_option("bplcs_all_sliders");


// Add New Slider and Delete a Slider Function
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['form_action']) && $_POST['form_action'] === 'add_new_slider') {
    $randomId = rand(10, 99);

    $new_slider = array(
      "slider_name" => "Slider 1",
      "slides" => array(
        "https://img.freepik.com/free-photo/portrait-young-adult-listening-radio-transmission_23-2151063310.jpg?t=st=1726166591~exp=1726170191~hmac=4f98ad7252416f5a9e0dd28ff56700ca9fc3ae264c6c1fb0f785402ddb63f33d&w=740"
      ),
      "transition_type" => "fade",
      "max_width" => 500,
      "transition_duration" => 1000,
      "controls_enabled" => 1,
      "pager_enabled" => 1,
      "auto_slide" => 0,
      "height" => 500,
      "auto_interval" => 2000,
      "slider_id" => $randomId
    );
    // Add new slider to the array
    $all_slider_from_get_option[] = $new_slider;

    // Update the option with the new array
    update_option("bplcs_all_sliders", $all_slider_from_get_option);
  } elseif (isset($_POST['form_action']) && $_POST['form_action'] === 'delete_slider') {
    $slider_index = intval($_POST['slider_index']);
    unset($all_slider_from_get_option[$slider_index]);
    // Re-index the array after deletion to maintain proper ordering
    $all_slider_from_get_option = array_values($all_slider_from_get_option);
    update_option("bplcs_all_sliders", $all_slider_from_get_option);
  }
}

$slider_id = isset($_POST['slider_id']) ? intval($_POST['slider_id']) : null;

$slider_to_edit_from_get_option = get_option("slider_to_edit");
if ($slider_id !== null) {
  // Find the slider to edit
  foreach ($all_slider_from_get_option as $slider) {
    if ($slider['slider_id'] === $slider_id) {

      if ($slider_to_edit_from_get_option !== $slider) {
        $slider_to_edit_from_get_option = $slider;
        update_option("slider_to_edit", $slider_to_edit_from_get_option);
      }
      break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['form_action']) && $_POST['form_action'] == "slider_name_form") {
    // Get the slider ID from the form
    $slider_id = intval($_POST['slider_id']);
    $slider_to_edit_from_get_option["slider_name"] = sanitize_text_field($_POST['slider_name']);;
    $edit_slider_index = findSliderById($all_slider_from_get_option, $slider_id);
    $all_slider_from_get_option[$edit_slider_index] = $slider_to_edit_from_get_option;
    update_option("bplcs_all_sliders", $all_slider_from_get_option); // Update the correct opti
  }
}



echo "<pre>";
// print_r($slider_to_edit_from_get_option);
echo "</pre>";
?>
<!-- Patterns -->
<div class="tab-content" style="border: none;" id="tab-all-slider">
  <?php
  if (!empty($all_slider_from_get_option)) {
    ?>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>Slider Name</th>
          <th>Shortcode</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($all_slider_from_get_option as $index => $slider) {
          $shortcode = "[content_slider id=" . $slider['slider_id'] . "]"; // Generate shortcode
          ?>
          <tr>
            <td><?= esc_html($slider['slider_name']) ?></td>
            <td class="copy-shortcode" data-shortcode="<?= esc_html($shortcode) ?>">
              <code><?= esc_html($shortcode) ?></code>
              <span class="tooltip">Copied!</span> <!-- Tooltip element -->
            </td>
            <td>

              <form method="POST" action="admin.php?page=content-slider" class="edit-slider-btn" style="display:inline;">
                <input type="hidden" name="from_action" value="edit-slider">
                <input type="hidden" name="slider_id" value="<?= esc_attr($slider['slider_id']) ?>">
                <button type="submit" class="button button-secondary">Edit</button>
              </form>

              <form method="POST" action="admin.php?page=content-slider" style="display:inline;">
                <input type="hidden" name="form_action" value="delete_slider">
                <input type="hidden" name="slider_index" value="<?= $index ?>">
                <button type="submit" class="button button-danger">Delete</button>
              </form>

            </td>
          </tr>
          <?php
        }
        ?>

      </tbody>
    </table>
    <!-- Add New Slider Button -->
    <form method="POST" class="add-new-slider-btn" action="admin.php?page=content-slider">
      <input type="hidden" name="form_action" value="add_new_slider">
      <button type="submit" id="add-new-slider-btn">Add New Slider</button>
    </form>
    <?php
  } else {
    ?>
    <div>
      <p>You didn't add any slider. Please add one.</p>

      <!-- Add New Slider Button -->
      <form method="POST" class="add-new-slider-btn" action="admin.php?page=content-slider">
        <input type="hidden" name="form_action" value="add_new_slider">
        <button type="submit" id="add-new-slider-btn">Add New Slider</button>
      </form>
    </div>
    <?php
  }
  ?>
</div>