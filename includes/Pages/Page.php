<?php
include 'functions.php';
$slider_to_edit_from_get_option = get_option("slider_to_edit");
?>
<div class="wrap">

  <!-- Slider Settings -->
  <div class="slider-settings">
    <div class="tab-container">
      <!-- Tab Buttons -->
      <ul class="tab-buttons">
        <li class="tab active" data-tab="tab-all-slider">All Slider</li>
          <li class="tab" data-tab="tab-slide" style="display:none">Slides</li>
          <li class="tab" data-tab="tab-settings" style="display:none">Settings</li>
      </ul>
      <?php
      require_once BPLCS_DIR . '/includes/Pages/AllSlider.php';
      if (!empty($slider_to_edit_from_get_option)) {
        require_once BPLCS_DIR . '/includes/Pages/Slides.php';
        require_once BPLCS_DIR . '/includes/Pages/Settings.php';
      }
      ?>
    </div>

  </div>

  <?php
  if (!empty($slider_to_edit_from_get_option)) {
    require_once BPLCS_DIR . '/includes/Pages/Slider.php';
  } else {
    ?>
    <div>
      <h1>Please Add A Slider To Preview</h1>
    </div>
    <?php
  }
  ?>

</div>
<?php if (isset($slider_to_edit_from_get_option)) {
  ?>
  <style>
    .bx-wrapper {
      height:
        <?php print $slider_to_edit_from_get_option['height'] . "px"; ?>
        !important;
    }

    .bx-wrapper img {
      height:
        <?php print $slider_to_edit_from_get_option['height'] . "px"; ?>
        !important;
    }
  </style>
  <?php
}
require_once BPLCS_DIR . '/includes/Pages/sliderScript.php';
?>