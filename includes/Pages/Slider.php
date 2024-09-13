<!-- Slider Container -->
<ul class="bxslider">
  <?php
  // Loop through the images and create an <li> element for each image
  foreach ($slides as $image) {
    // Get the image URL
    $image_url = str_replace($images_dir, $images_url, $image);
    echo '<li><img src="' . esc_url($image_url) . '" /></li>';
  }
  ?>
  </u>