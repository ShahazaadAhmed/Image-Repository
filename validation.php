<?php

require 'DBinfo.php';



$un = $_POST["UserName"];

$pwd = $_POST["password"];

$rl = $_POST["role"];



// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}


// #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
// last change date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is pure php file. This page contains the validation of the user login and the redirection to
//             to the appropriate pages and initiating the session variables. 
//             For further details refer to the documentation section 4.1.3 .
#########################################################################################################


// Prepare the query based on the role

$query = "";

$table = "";



switch ($rl) {

    case "User":

        $table = "user";

        break;

    case "Moderator":

        $table = "moderator";

        break;

    case "Admin":

        $table = "admin";

        break;

    default:

        echo "<script>alert('User Not found! Try Again')</script>";

        echo "<script>location.href='index.php'</script>";

}



$query = "SELECT * FROM $table WHERE Uid = '$un'";



$result = $conn->query($query);



if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    if ($row["pd"] === $pwd) {

        session_start();

        $_SESSION['UN'] = $un;

        $_SESSION['Role'] = $rl;

        if($rl=="Moderator"){

            $_SESSION['spz']=$row['spz'];

        }



        switch ($rl) {

            case "User":

                header('Location: user/user.php');

                break;

            case "Moderator":

                $string = $_SESSION['spz'];

                $pattern = '/(.+)(dis|pest|disease)/';

                if (preg_match($pattern, $string, $matches)) {

                    $b = $matches[1];

                    $pe = $matches[2];

                    } 

                    else {

                    echo "No match found.";

                    }



                header('Location: approver/display.php?crop='.$b.'&pord='.$pe);

                break;

            case "Admin":

                header('Location: admin/manipulate.php');

                break;

        }

    } else {

        echo "<script>alert('Incorrect Password! Try Again')</script>";

        echo "<script>location.href='index.php'</script>";

    }

} else {

    echo "<script>alert('User Not found! Try Again')</script>";

    echo "<script>location.href='index.php'</script>";

}

?>

