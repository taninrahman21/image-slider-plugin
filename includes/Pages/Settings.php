<?php

// Process Edit Slider Settings Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['form_action']) && $_POST['form_action'] == "edit_slider_settings") {
    // Get the slider ID from the form
    $slider_id = intval($_POST['slider_id']);
    $index_edited_slide = findSliderById($all_slider_from_get_option, $slider_id);

    // Check if the slider exists
    if ($index_edited_slide !== false) {
      $slider_to_edit_from_get_option = $all_slider_from_get_option[$index_edited_slide];

      // Update the slider settings
      $slider_to_edit_from_get_option['transition_type'] = sanitize_text_field($_POST['transition_type']);
      $slider_to_edit_from_get_option['max_width'] = intval($_POST['max_width']);
      $slider_to_edit_from_get_option['transition_duration'] = intval($_POST['transition_duration']);
      $slider_to_edit_from_get_option['height'] = intval($_POST['height']);
      $slider_to_edit_from_get_option['controls_enabled'] = isset($_POST['controls_enabled']) ? 1 : 0;
      $slider_to_edit_from_get_option['pager_enabled'] = isset($_POST['pager_enabled']) ? 1 : 0;
      $slider_to_edit_from_get_option['auto_slide'] = isset($_POST['auto_slide']) ? 1 : 0;
      $slider_to_edit_from_get_option['auto_interval'] = intval($_POST['auto_interval']);

      // Update the sliders option
      $all_slider_from_get_option[$index_edited_slide] = $slider_to_edit_from_get_option;
      update_option("bplcs_all_sliders", $all_slider_from_get_option);
    }
  }
}


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<!-- Slider Settings -->
<div class="tab-content" id="tab-settings" style="display: none;">

  <?php if (!empty($slider_to_edit_from_get_option)): ?>
    <!-- Setting Form For Edit Slider -->
    <form method="POST" action="admin.php?page=content-slider" id="edit-slider-form" style="display: none;">
      <input type="hidden" name="form_action" value="edit_slider_settings">
      <input type="hidden" name="slider_id" value="<?= $slider_to_edit_from_get_option['slider_id']; ?>">

      <div class="control-group">
        <p>Transition Type</p>
        <select id="slider-type" name="transition_type">
          <option value="horizontal" <?= ($slider_to_edit_from_get_option['transition_type'] == 'horizontal') ? 'selected' : '' ?>>Horizontal</option>
          <option value="fade" <?= ($slider_to_edit_from_get_option['transition_type'] == 'fade') ? 'selected' : '' ?>>Fade
          </option>
          <option value="vertical" <?= ($slider_to_edit_from_get_option['transition_type'] == 'fertical') ? 'selected' : '' ?>>
            Vertical</option>
        </select>
      </div>

      <div class="control-group">
        <p>Max Width (px)</p>
        <input type="number" id="max-width" name="max_width" value="<?= $slider_to_edit_from_get_option['max_width'] ?>"
          placeholder="Enter max width" />
      </div>

      <div class="control-group">
        <p>Transition Duration (ms)</p>
        <input type="number" id="transition-duration" name="transition_duration"
          value="<?= $slider_to_edit_from_get_option['transition_duration'] ?>"
          placeholder="Enter duration in milliseconds" />
      </div>

      <div class="control-group">
        <p>Height (px)</p>
        <input type="number" id="slider-height" name="height" value="<?= $slider_to_edit_from_get_option['height'] ?>"
          placeholder="Enter slider height" />
      </div>

      <!-- Enable Controls -->
      <div class="control-group">
        <p>Enable Controls</p>
        <label class="switch">
          <input type="checkbox" id="controls-enabled" name="controls_enabled"
            <?= $slider_to_edit_from_get_option['controls_enabled'] ? 'checked' : '' ?> />
          <span class="slider round"></span>
        </label>
      </div>

      <!-- Enable Pagination -->
      <div class="control-group">
        <p>Enable Pagination</p>
        <label class="switch">
          <input type="checkbox" id="pager-enabled" name="pager_enabled"
            <?= $slider_to_edit_from_get_option['pager_enabled'] ? 'checked' : '' ?> />
          <span class="slider round"></span>
        </label>
      </div>

      <!-- Enable Auto Slide -->
      <div class="control-group">
        <p>Enable Auto Slide</p>
        <label class="switch">
          <input type="checkbox" id="auto-slide-enabled" name="auto_slide"
            <?= $slider_to_edit_from_get_option['auto_slide'] ? 'checked' : '' ?> />
          <span class="slider round"></span>
        </label>
      </div>

      <div class="control-group">
        <p>Auto Interval (ms)</p>
        <input type="number" id="auto-interval" name="auto_interval"
          value="<?= $slider_to_edit_from_get_option['auto_interval'] ?>" placeholder="Enter auto slide interval" />
      </div>

      <div class="control-group save-settings-button">
        <button id="save-settings" type="submit" class="save-settings-btn">Save Settings</button>
      </div>
    </form>
  <?php endif; ?>


</div>