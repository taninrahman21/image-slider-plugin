<!-- Slider Container -->
<?php if (!empty($slider_to_display)) {
  ?>
  <style>
    .bx-wrapper {
      height:
        <?php print $slider_to_display['height'] . "px"; ?>
        !important;
    }

    .bx-wrapper img {
      height:
        <?php print $slider_to_display['height'] . "px"; ?>
        !important;
    }
  </style>
<?php } ?>
<div>
  <ul class="bxslider">
    <?php
    // Loop through the images and create an <li> element for each image
    foreach ($frontend_slides as $image) {
      printf("<li><img src='%s' alt='image'  /></li>", $image);
    }
    ?>
  </ul>
</div>
<script>
  <?php if (!empty($slider_to_display)) {
    ?>
    jQuery(document).ready(function ($) {
      $(".bxslider").bxSlider({
        mode: "<?php echo esc_js($slider_to_display['transition_type']); ?>",
        controls: <?php echo $slider_to_display['controls_enabled'] ? 'true' : 'false'; ?>,
        auto: <?php echo $slider_to_display['auto_slide'] ? 'true' : 'false'; ?>,
        pager: <?php echo $slider_to_display['pager_enabled'] ? 'true' : 'false'; ?>,
        pause: <?php echo esc_js($slider_to_display['auto_interval']); ?>,
        speed: <?php echo esc_js($slider_to_display['transition_duration']); ?>,
        nextText: "Next",
        prevText: "Prev"
      });
    });
    <?php
  }
  ?>
</script>