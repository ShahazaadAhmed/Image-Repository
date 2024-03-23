<?php
session_start();

if (!isset($_SESSION['UN'])) {
    header("location:../index.php");
    exit;
}
// Connect to the database
require('../DBinfo.php');
// #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page only the header to index page and the require DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description: this is a php-html combination file. This is page deletes the entry form the table "tempdb".
//              For further details refer to the documentation section 4.4.3.
// #########################################################################################################

$id = $_POST['id'];
$sql = "DELETE FROM tempdb WHERE IName =" . $id;
$result = $conn->query($sql);

echo
    "
<html>
    <style>
    html
    {
        background-color:cornsilk;
    }
    h1
    {
        margin-top:25%;
    }
    </style>
    <body>
        <center>
            <h1>
                Success
            </h1>
        </center>
    </body>
</html>
";
header('Refresh:1;URL=display.php');
?>