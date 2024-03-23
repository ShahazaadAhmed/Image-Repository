<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['UN'])) {
    header("Location:../../index.php");
    exit;
}

require('../../DBinfo.php');
$_SESSION['Name'] = $_POST['Name'];
$_SESSION['SN'] = $_POST['SN'];
$cn=$_SESSION['Crop'];
$hs=$_SESSION['hs'];
$tb=$cn.$hs;
////////////////////////////////////////////////////////////////////////////////
//Author: Satya Sreekar Pattaswmi                                             //
//Date: 7th June 2023                                                         //
//Desc: This is the backend for adding more pests and diseases to the table   //
//email: satyasreekarpattaswami@gmail.com                                     //
////////////////////////////////////////////////////////////////////////////////

// Build the SQL query according to the selected user type
if ($_SESSION['hs'] != 'ND') {
    $sql = "INSERT INTO  $tb(PName, SCName) VALUES ('" . $_SESSION['Name'] . "', '" . $_SESSION['SN'] . "')";
}
else{
    $sql = "INSERT INTO nutrients(name) VALUES('" . $_SESSION['Name'] . "')";
}

// Execute the query
if ($conn->query($sql) === TRUE) {
    $message = 'Record created successfully';
} else {
    $message = "'Error:' . $sql . '<br>' . $conn->error";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ADD USERS</title>
    <style>
        body {
            background: cornsilk;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            border: 2px solid rgba(72, 172, 76, 251);
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        p {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        button
        {
            padding: 10px 20px;
            background-color: #4AAF4E;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?=$message;?></h1>
        <center><button onclick="window.location.href = '../manipulate.php';">Home</button></center>
        <br>
        <center><button onclick="window.location.href = '../../logout.php';">Logout</button></center>
        
    </div>
</body>
</html>
