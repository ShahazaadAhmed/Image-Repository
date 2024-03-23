<?php
session_start();
require('../../DBinfo.php');
$tn = $_POST["usertype"];
$sql = "SELECT * FROM $tn";
// Redirect to index.php if user is not logged in
if (!isset($_SESSION['UN'])) {
    header("location: ../../index.php");
    exit;
}
?>
<html>

<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page displays the list of selected privilage users
//             in a tabular format . 
//             For further details refer to the documentation section 4.5.5.8 .
######################################################################################################### -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW USERS</title>
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

        table {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        td
        {
            font-size: large;
            text-align: center;
        }
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
            align-content: center;
        }

        select:focus {
            outline: none;
            border-color: #555;
        }

        .logout,
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4AAF4E;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .logout,
        input[type="submit"]:hover {
            background-color: #429843;
        }

        .heading {
            position: fixed;
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

        .logout {
            margin-right: 1%;
        }
    </style>
</head>
<header>
    <div class='heading'>
        <button class='logout' onclick="window.location.href = 'viewuser.php';">&larr; Go Back</button>
        <h1 class="ol">View Users</h1>
        <button class='logout' onclick="window.location.href = '../../logout.php';">Logout</button>
    </div>
</header>

<body>
    <div class="container">
        <h1>Select Privilage</h1>
        <table border="1">
            <tr>
                <th>User</th>
                <th>Password</th>
                <?php
                if ($tn=='moderator')
                {   
                    echo"<th>Specialization</th>";
                }
                ?>
            </tr>
            <?php
            if ($result = $conn->query($sql)) {
                foreach ($result as $row) {
                    $Uname = $row['Uid'];
                    $Pass = $row['pd'];
                    echo "<tr><td>".$Uname."</td><td>".$Pass."</td>";
                    if ($tn=='moderator')
                    {   
                        echo"<td>".$row['spz']."</td>";
                    }
                    echo"</tr>";
                }
                $result->free();
            }
            ?>
        </table>
    </div>
</body>

</html>