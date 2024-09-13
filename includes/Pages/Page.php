<div class="wrap">

  <!-- Slider Settings -->
  <div class="slider-settings">
    <div class="tab-container">
      <!-- Tab Buttons -->
      <ul class="tab-buttons">
        <li class="tab active" data-tab="tab-slide">Slides</li>
        <li class="tab" data-tab="tab-settings">Settings</li>
        <li class="tab" data-tab="tab-patterns">Patterns</li>
      </ul>
      <?php
      require_once BPLCS_DIR . '/includes/Pages/Slides.php';
      require_once BPLCS_DIR . '/includes/Pages/Settings.php';
      require_once BPLCS_DIR . '/includes/Pages/CustomizedSettings.php';
      ?>
    </div>

  </div>

  <?php require_once BPLCS_DIR . '/includes/Pages/Slider.php'; ?>

</div>

<?php
require_once BPLCS_DIR . '/includes/Pages/sliderScript.php';
?>