<?php
$allowed = array('png', 'jpg', 'gif');
$max_width = 1600;

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
  
  $target = '../images/events/'.$_FILES['upl']['name'];

	if(move_uploaded_file($_FILES['upl']['tmp_name'], $target)){
    list($width_orig, $height_orig, $image_type) = getimagesize($target);

    if ($width_orig > $max_width) {
        switch ($image_type) {
          case 1: $im = imagecreatefromgif($target); break;
          case 2: $im = imagecreatefromjpeg($target); break;
          case 3: $im = imagecreatefrompng($target); break;
          default: trigger_error('Unsupported filetype!', E_USER_WARNING); break;
        }
 
        // Calculate resize numbers
        $aspect_ratio = (float) $height_orig / $width_orig;
        $img_height = round($max_width * $aspect_ratio);
 
        $newImg = imagecreatetruecolor($max_width, $img_height);
        imagecopyresampled($newImg, $im, 0, 0, 0, 0, $max_width, $img_height, $width_orig, $height_orig);
 
        //Generate the file, and rename it
        switch ($image_type) {
          case 1: imagegif($newImg,$target); break;
          case 2: imagejpeg($newImg,$target); break;
          case 3: imagepng($newImg,$target); break;
          default: trigger_error('Failed resize image!', E_USER_WARNING); break;
        }
 
        // Delete original file
        //unlink($target_path);
      }


		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;