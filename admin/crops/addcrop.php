<?php
session_start();
require('../../DBinfo.php');

if (!isset($_SESSION['UN'])) {
    header("location:../../index.php");
    exit;
}

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
//             This is a php-html combination file. This page contains text box for creation of new component . 
//             For further details refer to the documentation section 4.5.6.5 .
######################################################################################################### -->

<head>
    <title>Add Crop</title>
    <style>
        body {
            margin: 0;
            background: cornsilk;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: whitesmoke;
            border: 2px solid rgba(72, 172, 76, 251);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 400px;
        }


        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-button {
            margin-top: 20px;
        }

        .label-input-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            text-align: left;
        }

        .label-input-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .label-input-container input,
        .label-input-container select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: #fff;
            background-image: linear-gradient(to bottom, #f9f9f9, #e8e8e8);
        }

        .label-input-container select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 100%;
            padding-right: 30px;
        }

        .select-arrow {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #888;
            pointer-events: none;
            font-size: 20px;
        }

        input[type="submit"] {
            background-color: rgb(7, 138, 7);
            border-radius: 15px;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 10px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ADD CROP</h1>
        <div class="form-container">
            <form action="uploadcrop.php" method="POST">
                <div class="label-input-container">
                    <label for="crop_name">Crop Name</label>
                    <input type="text" id="cn" name="cn" required>
                </div>
                <input type="submit" value="Add" class="form-button">
            </form>
        </div>
    </div>
</body>
</html>
