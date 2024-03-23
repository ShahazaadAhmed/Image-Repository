<?php
session_start();
require('../../DBinfo.php');
$cropQuery = "SELECT * FROM crop";
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
//             This is a php-html combination file. This page contains selection crop and health state . 
//             For further details refer to the documentation section 4.5.6.1 .
######################################################################################################### -->

<head>
    <title>Delete Crop</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class='heading'>
        <button class='logout' onclick="window.location.href = '../manipulate.php';">&larr; Go Back</button>
        <h1 class="ol">Modify Crop Details</h1>
        <button class='logout' onclick="window.location.href = '../../logout.php';">Logout</button>
    </div>
</header>

<body>
    <div class="container">
        <h1>Modify Crop</h1>
        <form name=form action="DelSel.php" method="post">
            <table>
                <tr>
                    <th>Select Crop</th>
                    <th>Select Health State</th>
                </tr>
                <tr>
                    <td>
                        <select id="Crop" name="Crop">
                            <?php
                            if ($result = $conn->query($cropQuery)) {
                                foreach ($result as $row) {
                                    $crop = $row["CName"];
                                    echo '<option value="' . $crop . '">' . $crop . '</option>';
                                }
                                echo '</select></td>';
                                $result->free();
                            }
                            ?>
                    </td>
                    <td>
                        <select name="hs" id="hs">
                            <option value="pest">Pest</option>
                            <option value="disease">Disease</option>
                            <option value="ND">Nutrient Deficiency</option>
                        </select>
                    </td>
                </tr>
            </table>
            <Input type='submit' value='Delete'></Input>
            <Input type='submit' value='ADD' onclick="form.action='add.php';return true;"></Input>
        </form>
    </div>
</body>

</html>