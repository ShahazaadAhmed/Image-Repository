<?php
session_start();
if (!isset($_SESSION['UN'])) {
  header("location:../../index.php");
  exit;
}
$_SESSION['Crop'] = $_POST['Crop'];
$_SESSION['hs'] = $_POST['hs'];
require('../../DBinfo.php');
?>

<!DOCTYPE html>
<html>

<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             Cleared internal CSS to link to a shared CSS file as to reduce complexity later on
//
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page contains selection option deleting the respective
//             elements of the selected thing . 
//             For further details refer to the documentation section 4.5.6.2 .
######################################################################################################### -->

<head>
  <title>Delete Crop Details</title>
  <link rel="stylesheet" href="style.css">
</head>
<header>
  <div class='heading'>
    <button class='logout' onclick="window.location.href = 'manipulatedata.php';">&larr; Go Back</button>
    <h1 class="ol">Delete Crop Details</h1>
    <button class='logout' onclick="window.location.href = '../../logout.php';">Logout</button>
  </div>
</header>

<body>
  <div class="container">
    <h2>Select <?= $_SESSION['hs'] ?> to Delete</h2>
    <form action="finishdeletion.php" method="post">
      <select id="TBD" name="TBD">
        <?php
        if ($_SESSION['hs'] != 'ND') {
          $c = $_SESSION['Crop'] . $_SESSION['hs'];
          $C = "SELECT * FROM $c";
          if ($result = $conn->query($C)) {
            while ($row = $result->fetch_assoc()) {
              $PName = $row["PName"];
              $SName = $row["SCName"];
              echo '<option value=' . urlencode($PName) . '>' . $PName . '</option>';
            }
            $result->free();
          }
        } else {
          $stmt = $conn->query("SELECT * FROM nutrients");
          while ($row = $stmt->fetch_assoc()) {
            $o = $row['name'];
            echo '<option value=' . urlencode($o) . '>' . $o . '</option> ';
          }
          $stmt->free_result();
        }
        ?>
      </select>
      <button type="submit" name="updatechange" onclick="return confirm('Are you sure you want to delete this?')">DELETE</button>
    </form>
  </div>
</body>

</html>