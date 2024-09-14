<!-- Slider Container -->
<ul class="bxslider">
  <?php
  // Loop through the images and create an <li> element for each image
  foreach ($slides as $image) {
     printf("<li><img src='%s' alt='image' /></li>", $image);
  }
  ?>
  </u>