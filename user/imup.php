<?php
session_start();
require('../DBinfo.php');

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['UN'])) {
    header("location: ../index.php");
    exit;
}

/*// Database connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploads_dir = 'images/';

    if (empty($_FILES['images']['name'][0])) {
        echo "<script>alert('Please select at least one image to upload.');</script>";
    } else {
        // Perform image upload process here
    }
}
?>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="stylesheet" href="imup.css">
</head>

<body>
    <div class='heading'>
        <button onclick="window.location.href = 'user.php';">&larr; Go Back</button>
        <center>
            <h1>Image Upload</h1>
        </center>
        <button onclick="window.location.href = '../logout.php';">Logout</button>
    </div>

    <div id="box">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Image Upload</th>
                </tr>
                <tr>
                    <td>
                        <div class="file-upload">
                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="images[]" multiple required onchange="updateFileName()" id="fileInput">
                            <label for="fileInput" class="file-select-button" id="fileName"></label>
                        </div>
                        <div id="file-selected"></div>
                    </td>
                </tr>
                <tr>
                <th align="center">Background</th>
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
                    $C = "SELECT * FROM $c";
                    $result = $conn->query($C);
                    foreach ($result as $row) {
                        $PName = $row["PName"];
                        $SName = $row["SCName"];
                        $val = $PName . '-' . $SName;
                        echo '<option value=' . urlencode($val) . '>' . $val . '</option>';
                    }
                    echo '</select>
                            </td>';
                    $result = null;
                }
                ?>

                <?php
                if ($_SESSION['PORD'] == 'pest') {
                    echo '<tr>
                            <th>What is in the picture?</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="Desc" id="Desc">
                                    <option value="part">Effected Part</option>
                                    <option value="pest">Pest</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <th>Stage</th>
                        </tr>
                        <tr>
                        <td align="center">
                                <select id="Stage" name="Stage">
                                <option value="N/A">N/A</option>';
                    $c = 's' . $_SESSION['CROP'] . $_SESSION['PORD'];
                    $C = "SELECT * FROM $c";
                    $result = $conn->query($C);
                    foreach ($result as $row) {
                        $stage = $row["stages"];
                        echo '<option value=' . urlencode($stage) . '>' . $stage . '</option>';
                    }
                    echo '</select>
                            </td>
                            </tr>';
                    $result = null;
                } elseif ($_SESSION['PORD'] == 'Nutrient Defficiency') {
                    $stmt = $conn->query("SELECT * FROM nutrients");
                    $data = $stmt->fetchAll();
                    echo '<tr>
                            <th colspan="2">Nutrient Deficiency</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select>';
                    foreach ($data as $row) {
                        $o = $row['name'];
                        echo '<option value=' . $o . '>' . $o . '</option> ';
                    }
                    echo '</select>
                            </td>
                        </tr>';
                }
                ?>
            </table>
            <input type="submit" value="Upload Images">
        </form>
    </div>

    <script>
        function triggerFileInput() {
            document.getElementById('fileInput').click();
        }

        function updateFileName() {
            var fileInput = document.getElementById('fileInput');
            var fileNameContainer = document.getElementById('fileName');
            var fileSelectedContainer = document.getElementById('file-selected');
            fileNameContainer.textContent = '';

            // Display selected file names
            var fileNames = '';
            for (var i = 0; i < fileInput.files.length; i++) {
                fileNames += fileInput.files[i].name + '<br>';
            }
            fileSelectedContainer.innerHTML = fileNames;
        }
    </script>
</body>

</html>
