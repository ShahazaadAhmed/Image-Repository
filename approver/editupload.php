<?php
session_start();
if (!isset($_SESSION['UN'])) {
  header("location:../index.php");
  exit;
}
// #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page only the header to index page,logout button and the DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page is for the transfer of the data from the table 
//             "tempdb" to the table "permdb" after editing the entry.
//              For further details refer to the documentation section 4.4.6 .
#########################################################################################################

// Connect to the database
require('../DBinfo.php');
//Fetching Data from imup.php
$_SESSION['bg'] = $_POST['bg'];
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
$un=$_SESSION['UN'];
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
  $stage = $_SESSION['Stage'];
}
// Getting image from tempdb
$id = $_SESSION['id']; $query = "SELECT IMAGE FROM tempdb WHERE INAME = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$data = $row['IMAGE'];

// Insert the image into the database               
$sql = "INSERT INTO permdb (`User`,`CROP`, `MONTH`, `YEAR`, `CROP STAGE`, `PARTS-AFFECTED`, `DEVICE/SHOT`, `SEASON`, `STATE`, `PORD`, `AREA`, `BACKGROUND`, `PORDNAME`, `IMGCONTAINS`, `STAGE`, `IMAGE`)
        VALUES ('$un','$crop', '$month', '$year', '$cs', '$part', '$device', '$season', '$state', '$pord', '$area', '$bg', '$pordname', '$imagecont', '$stage', ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $data);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
$sql = "DELETE FROM tempdb WHERE IName =" . $id;
$result = $conn->query($sql);
?>
<html>
<body>
  <style>
    html {
      background-color: cornsilk;
    }
    h1 
    {
      margin-top: 15%;
    }
    div{
      background-color: white;
      width:20%;
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
button:hover{
  opacity: 0.7;
}
button:active{
  opacity: 0.6;
}
  </style>
  <center>
    <h1>
      Upload Sucessful
    </h1>
    <div>
      <h2><a href="display.php" class="button">Go Back</a></h2>
      <h2 class="a"><a href="../logout.php" class="button">Logout</a></h2>
    </div>
    </center>
</body>
</html>