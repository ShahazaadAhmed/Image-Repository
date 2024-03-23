<?php
session_start();

if (!isset($_SESSION['UN'])) {
  header("location:../../index.php");
  exit;
}

require('../../DBinfo.php');
$TBD = urldecode($_POST['TBD']);

if ($_SESSION['hs'] != 'ND') {
  $c = $_SESSION['Crop'] . $_SESSION['hs'];
  $query = "DELETE FROM $c WHERE PName = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $TBD);
} else {
  $query = "DELETE FROM nutrients WHERE name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $TBD);
}

$stmt->execute(); ?>
<html>
  <head>
    <title>DELETION</title>
  </head>

<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links as well as the DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page deletes the data from the selected crop and displays
//             a sucess message. 
//             For further details refer to the documentation section 4.5.6.3 .
######################################################################################################### -->

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
      <?php if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully.";
      } else {
        echo "Error deleting record. Query: " . $query . ". Error: " . $stmt->error;
      }

      $stmt->close();
      $conn->close();
      ?>

    </h1>
    <div>
      <h2 class="a"><a href="../manipulate.php" class="button">Home</a></h2>
      <h2 class="a"><a href="../../logout.php" class="button">Logout</a></h2>
    </div>
  </center>
</body>

</html>