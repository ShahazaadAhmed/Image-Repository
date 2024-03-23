<?php
require '../../DBinfo.php';
$_SESSION['cn'] = $_POST['cn'];
$cn = $_SESSION['cn'];

$stmt = $conn->prepare("INSERT INTO crop (CName) VALUES (?)");
$stmt->bind_param("s", $cn);

// Execute the statement
$stmt->execute();

// Create the table if it doesn't exist
$tableName = $cn . "pest";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
            Id INT(11) AUTO_INCREMENT PRIMARY KEY,
            PName VARCHAR(255),
            SCName VARCHAR(255)
        )";
$conn->query($sql);
// Create the table if it doesn't exist
$tableName = $cn . "disease";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
            Id INT(11) AUTO_INCREMENT PRIMARY KEY,
            PName VARCHAR(255),
            SCName VARCHAR(255)
        )";
$conn->query($sql);
// Close the statement and database connection
$stmt->close();
$conn->close();

?>
<html>
<head>
    <title>
        UPLOAD
    </title>
</head>
<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links and DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page puts the modification in the database. 
//             For further details refer to the documentation section 4.5.6.6 .
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
            Upload Sucessful
        </h1>
        <div>
            <h2><a href="../manipulate.php" class="button">Home</a></h2>
            <h2 class="a"><a href="../../logout.php" class="button">Logout</a></h2>
        </div>
    </center>
</body>

</html>
