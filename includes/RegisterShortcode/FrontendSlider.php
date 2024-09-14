<!-- Slider Container -->
<div>
  <ul class="bxslider">
    <?php
    // Loop through the images and create an <li> element for each image
    foreach ($frontend_slides as $image) {
      printf("<li><img src='%s' alt='image' /></li>", $image);
    }
    ?>
  </ul>
</div>
<script>
  jQuery(document).ready(function ($) {
    $(".bxslider").bxSlider({
      controls: true,
      nextText: "Next",
      prevText: "Prev"
    });
  });
</script>