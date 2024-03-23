<?php
session_start();
require('../DBinfo.php');
$cropQuery = "SELECT * FROM crop";
if (!isset($_SESSION['UN'])) {
    header("location:../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Download Select</title>
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
            text-align: center;
            /* Align buttons to center horizontally */
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-button {
            display: block;
            margin: 10px auto;
            /* Center buttons vertically */
            padding: 10px 20px;
            font-size: 16px;
            background-color: rgba(74, 174, 78, 253);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-button:hover {
            background-color: rgba(74, 174, 78, 0.8);
        }

        label,
        input,
        select {
            display: block;
            width: 100%;
        }

        select {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: #fff;
            background-image: linear-gradient(to bottom, #f9f9f9, #e8e8e8);
        }

        select {
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
        .logout {
            padding: 10px 20px;
            background-color: rgb(7, 138, 7);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .logout:hover {
            background-color: #429843;
        }

        .heading {
            position:fixed;
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
        .logout
        {
            margin-right: 1%;
        }
    </style>
</head>
<header>
    <div class='heading'>
        <button class='logout' onclick="window.location.href = 'manipulate.php';">&larr; Go Back</button>
        <h1 class="ol">Select Download</h1>
        <button class='logout' onclick="window.location.href = '../logout.php';">Logout</button>
    </div>
</header>

<body>
    <div class="container">
        <h1>Select Crop to Download</h1>
        <form name=form action="Seldownload.php" method="post">
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
                            <option value="NE">Natural Enemy</option>
                            <option value="healthy">Healthy</option>
                        </select>
                    </td>
                </tr>
            </table>
            <Input type='submit'></Input>
        </form>
    </div>
</body>

</html>
