<?php
session_start();
if (!isset($_SESSION['UN'])) {
    header("location:../../index.php");
    exit;
}
require('../../DBinfo.php');

$_SESSION['usertype'] = $_POST['usertype'];
?>

<!DOCTYPE html>
<html>
<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page contains selection option for deletion of the
//             user with the prviously chosen privilage . 
//             For further details refer to the documentation section 4.5.5.5 .
######################################################################################################### -->

<head>
    <title>Remove USERS</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        select {
            margin-bottom: 20px;
            appearance: none;
            padding: 10px;
            border: 1px solid #999;
            border-radius: 5px;
            width: 200px;
            background-color: white;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #555;
        }

        .logout,input[type="submit"] {
            padding: 10px 20px;
            background-color: #4AAF4E;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .logout,input[type="submit"]:hover {
            background-color: #429843;
        }

        .heading {
            position:fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4AAF4E;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 9999;
        }
        .logout
        {
            margin-right: 1%;
        }
    </style>
</head>
<header>
    <div class='heading'>
        <button class='logout' onclick="window.location.href = 'removeuser.php';">&larr; Go Back</button>
        <h1 class="ol">Remove Existing User</h1>
        <button class='logout' onclick="window.location.href = '../../logout.php';">Logout</button>
    </div>
</header>
<body>
<div class="container">
    <h1>Select User To Delete</h1>
    <form action="DeleteUsers.php" method="POST">
        <div>
            <select id="user" name="user">
           <?php 
           $query = "SELECT * FROM ".$_SESSION['usertype'];
                $result = $conn->query($query);

                // Check if the query was successful
                foreach ($result as $row) {
                        $uid = $row['Uid'];
                        echo "<option value='$uid'>".$uid."</option>";
                    }
                    $result->free();
                ?>
            </select>
        </div>
        <input type="submit" value="DELETE" onclick="confirm">
    </form>
</div>

</body>
</html>