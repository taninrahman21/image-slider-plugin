<?php
include 'functions.php';
?>
<div class="wrap">

  <!-- Slider Settings -->
  <div class="slider-settings">
    <div class="tab-container">
      <!-- Tab Buttons -->
      <ul class="tab-buttons">
        <li class="tab active" data-tab="tab-all-slider">All Slider</li>
        <li class="tab" data-tab="tab-slide">Slides</li>
        <li class="tab" data-tab="tab-settings">Settings</li>
      </ul>
      <?php
      require_once BPLCS_DIR . '/includes/Pages/AllSlider.php';
      require_once BPLCS_DIR . '/includes/Pages/Slides.php';
      require_once BPLCS_DIR . '/includes/Pages/Settings.php';
      ?>
    </div>

  </div>

  <?php require_once BPLCS_DIR . '/includes/Pages/Slider.php'; ?>

</div>
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
require_once BPLCS_DIR . '/includes/Pages/sliderScript.php';
?>