<html>

<head>
    <?php
    session_start();
    require('../DBinfo.php');
    if (!isset($_SESSION['UN'])) {
        header("location:../index.php");
        exit;
    }
// #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//              Changed the button text from upload images to Approve Images


//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page only the header to index page, css file,logout and the DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page is for the transfer of the data from the table 
//             "tempdb" to the table "permdb". For further details refer to the documentation section 4.4.5 .
#########################################################################################################

    ?>
    <title>
        Image Upload
    </title>
    <link rel="stylesheet" href="../user/imup.css">
</head>

<body>
    <div class='heading'>
        <button onclick="window.location.href = 'edit.php';">
            &larr; Go Back
        </button>
        <center>
            <h1>
                Image Upload
            </h1>
        </center>
        <button onclick="window.location.href = '../logout.php';">Logout</button>
    </div>
    <div id="box">
        <form action="editupload.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th align="center">
                        Background
                    </th>
                </tr>
                <tr>
                    <td>
                        <select name="bg" id="bg">
                            <option value="Lab">Lab</option>
                            <option value="Field">Field</option>
                            <option value="Background">With Background</option>
                        </select>
                    </td>
                </tr>
                <!--******************************************************************************************************* -->
                <?php
                if ($_SESSION['PORD'] == 'pest' || $_SESSION['PORD'] == 'disease') {
                    echo '<tr>
                    <th colspan="2">';
                    $c = "Select " . $_SESSION['CROP'] . " " . $_SESSION['PORD'];
                    echo $c . '-Scientific Name';
                    echo '</th>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select id="Efr" name="Efr">';
                    $c = $_SESSION['CROP'] . $_SESSION['PORD'];
                    $C = "Select * FROM $c";
                    if ($result = $conn->query($C)) {
                        while ($row = $result->fetch_assoc()) {
                            $PName = $row["PName"];
                            $SName = $row["SCName"];
                            $val = $PName . '-' . $SName;
                            echo '<h1>
                                <option value=' . urlencode($val) . '>' . $val . '</option>
                            </h1>';
                        }
                        echo '</select>
                    </td>';
                    $result->free();
                }
                }
                ; ?>
                <!-- ******************************************************************************************************* -->
                <?php
                if ($_SESSION['PORD'] == 'pest') {
                    // Do something if PORD equals 'pest', case-insensitive

                    echo
                        "<tr>
                        <th>
                            What is in the picture?
                        </th>
                        <th>
                            Stage
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <select name=" . "Desc" . " id=" . "Desc" . ">
                                <option value=" . "part" . ">Effected Part</option>
                                <option value=" . "pest" . ">Pest</option>
                            </select>
                        </td>
                        <td align=" . "center" . ">
                            <select id=" . "Stage." . " name=" . "Stage" . ">";

                    $c = 's' . $_SESSION['CROP'] . $_SESSION['PORD'];
                    $C = "Select * FROM $c";
                    if ($result = $conn->query($C)) {
                        while ($row = $result->fetch_assoc()) {
                            $stage = $row["stages"];
                            echo '<h1><option value=' . urlencode($stage) . '>' . $stage . '</option></h1>';
                        }
                        echo
                            '</select>
                        </td>';
                    $result->free();
                }
                echo "
                        </td>
                    </tr>";
                } ?>
            </table>
            <input type="submit" value="Approve Images">
        </form>
    </div>
</body>

</html>
