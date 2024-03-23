<?php
session_start ();
if (!isset($_SESSION['UN']))
{
    header("location:../index.php");
    exit;
    
}
    require('../DBinfo.php');

$_SESSION['CROP'] =  $_POST["Crop"];
$_SESSION['PORD'] = $_POST["pord"];
$_SESSION['month'] = $_POST["month"];
$_SESSION['year'] = $_POST["year"];
$_SESSION['cs'] =  $_POST["cstage"];
$_SESSION['state'] = $_POST["state"];
$_SESSION['part'] = $_POST["part"];
$_SESSION['device'] = $_POST["device"];
$_SESSION['season'] = $_POST["season"];
$_SESSION['Area'] = $_POST["Area"];
if(!isset($_SESSION['id']))
{
    header("location:imup.php");
}
// ##########################################
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections
// as to accomodate for the implementation of the
// directories.In this page only the header to 
// index page, image editing page(imed) and the 
// DBinfo have been changed 
// 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a pure php file. This page is for
// storing all the data from the form to the session.
//  For further details refer to the documentation section 4.3.3 .
###################################################

else
{
    header("location:../approver/imed.php");
}
 ?>