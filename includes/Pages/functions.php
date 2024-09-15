<?php
function getUploadImageUrl(): string
{
  $image_url = "";
  if ((isset($_FILES['slide_image']) && !empty($_FILES['slide_image']['name'])) || isset($_POST['slide_link'])) {

    // If User Upload File
    if (isset($_FILES['slide_image']) && !empty($_FILES['slide_image']['name'])) {
      $uploaded_file = $_FILES['slide_image'];
      $file_name = $uploaded_file['name'];
      $file_tmp = $uploaded_file['tmp_name'];
      $file_type = $_FILES['slide_image']['type'];
      $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
      if ((in_array($file_type, $allowed_types)) && $uploaded_file['error'] === UPLOAD_ERR_OK) {
        $upload = wp_upload_bits($file_name, null, file_get_contents($file_tmp));
        if (!$upload['error']) {
          $image_url = $upload['url'];
        }
      }
    } else {
      if (filter_var($_POST['slide_link'], FILTER_VALIDATE_URL)) {
        $image_url = $_POST['slide_link'];
      }
    }
  }
  return $image_url;
}
// Function to find index of slider with specific slider_id
function findSliderById($sliders, $slider_id)
{
  foreach ($sliders as $index => $slider) {
    if ($slider['slider_id'] == $slider_id) {
      return $index;
    }
  }
  return null;
}
