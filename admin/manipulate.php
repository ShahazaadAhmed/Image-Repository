<?php
session_start();
if (!isset($_SESSION['UN'])) {
    header("location:../index.php");
    exit;
} ?>
<html>
<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page the header to index page and the button links have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page contains all the buttons for the admin. 
//             For further details refer to the documentation section 4.5.1.1 .
######################################################################################################### -->


<head>
    <title>Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="manipulate.css">
</head>

<body>
    <div class='heading'>
        <i></i>
        <h1 class="ol">ADMIN</h1>
        <button class='Logout' onclick="window.location.href = '../logout.php';">Logout</button>
    </div>
    <div class="login">  
        <form>
            <table>
                <tr>
                    <td><button type="submit" formaction="users/adduser.php" style="--clr:#39FF14"><span>CREATE USERS</span><i></i></button></td>
                    <td><button type="submit" formaction="users/removeuser.php" style="--clr:#39FF14"><span>DELETE USERS</span><i></i></button></td>
                    <td><button type="submit" formaction="users/viewuser.php" style="--clr:#39FF14"><span>View USERS</span><i></i></button></td>
                </tr>
                <tr>
                    <td><button type="submit" formaction="crops/manipulatedata.php" style="--clr:#39FF14"><span>MODIFY CROPS</span><i></i></button></td>
                    <td><button type="submit" formaction="crops/addcrop.php" style="--clr:#39FF14"><span>A D D CROPS</span><i></i></button></td>
                    <td><button type="submit" formaction="crops/viewcrop.php" style="--clr:#39FF14"><span>VIEW CROPS</span><i></i></button></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><button type="submit" formaction="AdminDisplay.php" style="--clr:#39FF14"><span>VIEW APPROVED ENTRIES</span><i></i></button></td>
                </tr>
                <tr>
                    <td><button type="submit" formaction="download.php" style="--clr:#39FF14"><span>Download All</span><i></i></button></td>
                    <td><button type="submit" formaction="downloadsel.php" style="--clr:#39FF14"><span>Select Download</span><i></i></button></td>
                    <td><button type="submit" formaction="gallery.php" style="--clr:#39FF14"><span>Image Gallery</span><i></i></button></td>
                </tr>
            </table>

        </form>
    </div>
</body>

</html>