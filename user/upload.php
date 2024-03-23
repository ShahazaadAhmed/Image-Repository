<?php
session_start();
if (!isset($_SESSION['UN'])) {
  header("location:../index.php");
  exit;
}
// Connect to the database
require('../DBinfo.php');
try{
//Fetching Data from imup.php
$un = $_SESSION['UN'];
$_SESSION['Efr'] = (@$_POST['Efr']);
$_SESSION['Desc'] = @$_POST['Desc'];
$_SESSION['bg'] = $_POST['bg'];
$_SESSION['Stage'] = @$_POST['Stage'];
$crop = $_SESSION['CROP'];
$month = $_SESSION['month'];
$year = $_SESSION['year'];
$cs = $_SESSION['cs'];
$part = $_SESSION['part'];
$device = $_SESSION['device'];
$season = $_SESSION['season'];
$state = $_SESSION['state'];
$pord = $_SESSION['PORD'];
$area = $_SESSION['Area'];
$bg = $_SESSION['bg'];
if ($_SESSION['PORD'] != 'pest' || $_SESSION['PORD'] != 'disease') {
  $pordname = urldecode($_SESSION['Efr']);
} else {
  $pordname = "N/A";
}
if ($_SESSION['PORD'] != 'pest') {
  $imagecont = "N/A";
  $stage = "N/A";
} else {
  $imagecont = $_SESSION['Desc'];
  $stage = urldecode($_SESSION['Stage']);
}

}catch (PDOException $e) {
  echo "Fetching Data failed: " . $e->getMessage();
  exit;
}
// Check if the form has been submitted
try{


if (isset($_FILES['images'])) {
  // Loop through all uploaded files
  for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
    $image = $_FILES['images']['tmp_name'][$i];
    $image_name = $_FILES['images']['name'][$i];
    $image_size = $_FILES['images']['size'][$i];
    $image_type = $_FILES['images']['type'][$i];

    // Check if the image is greater than 1 MiB
    if ($image_size > 1048576) {
      // Load the image
      if ($image_type === 'image/jpeg' || $image_type === 'image/jpg') {
        $source_image = imagecreatefromjpeg($image);
      } elseif ($image_type === 'image/png') {
        $source_image = imagecreatefrompng($image);
      } elseif ($image_type === 'image/gif') {
        $source_image = imagecreatefromgif($image);
      } else {
        die('Unsupported image type: ' . $image_type);
      }

      // Get the current dimensions of the image
      $width = imagesx($source_image);
      $height = imagesy($source_image);

      // Calculate the new dimensions to resize the image
      $new_width = $width / 2;
      $new_height = $height / 2;

      // Create a new image with the new dimensions
      $destination_image = imagecreatetruecolor($new_width, $new_height);

      // Resize the image
      imagecopyresampled($destination_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

      // Save the compressed image to a temporary file
      $temp_file = tempnam(sys_get_temp_dir(), 'compressed_image_');
      if ($image_type === 'image/jpeg' || $image_type === 'image/jpg') {
        imagejpeg($destination_image, $temp_file);
      } elseif ($image_type === 'image/png') {
        imagepng($destination_image, $temp_file);
      } elseif ($image_type === 'image/gif') {
        imagegif($destination_image, $temp_file);
      }

      // Read the binary data of the compressed image
      $data = file_get_contents($temp_file);

      // Delete the temporary file
      unlink($temp_file);
    } else {
      // Read the binary data of the original image
      $data = file_get_contents($image);
    }

    // Escape the binary data to prevent SQL injection
    $data = mysqli_real_escape_string($conn, $data);

    // Insert the image into the database               
    $sql = "INSERT INTO tempdb (`User`,`CROP`, `MONTH`, `YEAR`, `CROP STAGE`,`PARTS-AFFECTED`, `DEVICE/SHOT`, `SEASON`, `STATE`, `PORD`, `AREA`, `BACKGROUND`, `PORDNAME`, `IMGCONTAINS`, `STAGE`, `IMAGE`)
                       VALUES ('$un','$crop' ,'$month','$year','$cs'       ,'$part'          ,'$device'     ,'$season','$state','$pord','$area','$bg'       ,'$pordname','$imagecont','$stage', '$data')";
    mysqli_query($conn, $sql);
  }
}
}catch (PDOException $e) {
  echo "Image Resizing failed: " . $e->getMessage();
  exit;
}
?>
<html>

<body>
  <style>
    html {
      background-color: cornsilk;
    }

    h1 {
      margin-top: 15%;
    }

    div {
      background-color: white;
      width: 20%;
      height: 20%;
      border-radius: 5%;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      background-color: rgb(7, 138, 7);
      color: white;
      border: solid;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
      margin-top: 6%
    }

    button:hover {
      opacity: 0.7;
    }

    button:active {
      opacity: 0.6;
    }
  </style>
  <center>
    <h1>
      Upload Sucessful
    </h1>
    <div>
      <h2><a href="user.php" class="button">Upload More Images</a></h2>
      <h2 class="a"><a href="../logout.php" class="button">Logout</a></h2>
    </div>
  </center>
</body>

</html>