<html>
<head>
    <title>
        Edit Form
    </title>
    <link rel="stylesheet" href="../user/user.css">
</head>
<!-- // #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             Interchanged state and parts affected in the table headers as they were in the wrong places
//
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page only the header to index page, css file, logout button and the DBinfo have been
//             changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page shows the previous data and the approver can 
//             change what data is incorrect and approve the images.
//             For further details refer to the documentation section 4.4.2 .
######################################################################################################### -->

<body>
    <?php
    session_start();
    if (!isset($_SESSION['UN'])) {
        header("location:../index.php");
        exit;
    }
    if(!isset($_SESSION['id'])){
        $_SESSION['id'] =  $_POST["id"];
    }
    $id=$_SESSION['id'];
    require('../DBinfo.php');
    $C = "SELECT * FROM crop";
    ?>
    <div class='Edit'>
    <div class='heading'>
    <button onclick="window.location.href ='display.php';">&#8249; Go Back</button>
        <center>
            <h1>
                Edit Crop Details of Image:
                <?php
                echo $_SESSION['id'];
                ?>
            </h1>
            <h3>Note: Scroll down to view old Details</h3>
        </center>
        <button onclick="window.location.href = '../logout.php';">Logout</button>
    </div>
    <div id="box">
        <form action="../user/upro.php" method="POST">
            <table align="center" cellpadding="3px">
                <tr>
                    <td colspan="2" align="center">
                        <h2>Select Crop<h2>
                    </td>
                    <td colspan="2" align="center">
                        <h2>Select Month</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select id="Crop" name="Crop">'
                            <?php

                            if ($result = $conn->query($C)) {
                                while ($row = $result->fetch_assoc()) {
                                    $Crop = $row["CName"];
                                    echo '<H1><option value=' . $Crop . '>' . $Crop . '</option></h1>';
                                }
                                echo
                                    '</select>
                                </td>';
                                $result->free();
                            }
                            ?>
                    </td>
                    <td>
                        <select name="month" id="month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="Septmember">Septmember</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h2>
                            Select Year
                        </h2>
                    </td>
                    <td colspan="2" align="center">
                        <h2>
                            Crop stage
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="year" id="year">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </td>
                    <td colspan="2" align="center">
                        <select class='l' id="cstage" name="cstage">
                            <option value="Germination">Germination stage</option>
                            <option value="Seedling">Seedling stage</option>
                            <option value="Rosette">Rosette stage</option>
                            <option value="Vegetative">Vegetative stage</option>
                            <option value="Flowering">Flowering stage</option>
                            <option value="Seed Setting">Seed Setting stage</option>
                            <option value="Seed Filling">Seed Filling stage</option>
                            <option value="Ripening">Ripening stage</option>
                            <option value="Harvesting">Harvesting stage</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h3>
                            Parts Affected
                        </h3>
                    </td>
                    <td colspan="2" align="center">
                        <h2>
                            Device/shot
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select id="part" name="part">
                            <option value="Leaves">Leaves</option>
                            <option value="Stem">Stem</option>
                            <option value="Flowers">Flowers</option>
                            <option value="Capsules">Capsules</option>
                            <option value="Spikes">Spikes</option>
                            <option value="Whole Plant">Whole Plant</option>
                            <option value="Flower Head">Flower Head</option>
                        </select>
                    </td>
                    <td colspan="2" align="center">
                        <select id="device" name="device">
                            <option value="Camera-Long">Camera-Long</option>
                            <option value="Camera-CloseUp">Camera-CloseUp</option>
                            <option value="Mobile-Long">Mobile-Long</option>
                            <option value="Mobile-CloseUp">Mobile-CloseUp</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h2>
                            Season
                        </h2>
                    </td>
                    <td colspan="2" align="center">
                        <h3>
                            State
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="cetner">
                        <select id="season" name="season" class="pageElement">
                            <option value="Kharif">Kharif</option>
                            <option value="Rabi">Rabi</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </td>
                    <td colspan="2" align="center">
                        <select id="state" name="state">
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chattisgarh">Chattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h3>
                            Pest Or Disease
                        </h3>
                    </td>
                    <td colspan="2" align="center">
                        <h3>
                            Place
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select name="pord" id="pord">
                            <option value="pest">Pest</option>
                            <option value="disease">Disease</option>
                            <option value="NaturalEnemy">Natural Enemy</option>
                            <option value="healthy">Healthy</option>
                        </select>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" name="Area" id="Area"
                            oninput="this.value=this.value.replace(/[^a-zA-Z]/g,'');" required>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="4">
                        <input type="submit" value="Next">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
<footer>
<div class='Table'>
    <?php
    // Create database connection
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo " ";

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // select all data from the table
      $stmt = $conn->query("SELECT * FROM tempdb where IName=$id ");
      $data = $stmt->fetchAll();
      ?>
      <table border=1>
        <tr>
          <th>
            <h2 class="z">CROP</h2>
          </th>
          <th>
            <h2 class="z">MONTH</h2>
          </th>
          <th>
            <h2 class="z">YEAR</h2>
          </th>
          <th>
            <h2 class="z">CROP STAGE</h2>
          </th>
          <th>
            <h2 class="z">PARTS AFFECTED</h2>
          </th>
          <th>
            <h2 class="z">DEVICE</h2>
          </th>
          <th>
            <h2 class="z">PEST STAGE</h2>
          </th>
        </tr>
        <!-- ************************************************** -->
        <tr>
          <th>
            <h2 class="z">SEASON</h2>
          </th>
          <th>
            <h2 class="z">STATE</h2>
          </th>
          <th>
            <h2 class="z">PORD</h2>
          </th>
          <th>
            <h2 class="z">AREA</h2>
          </th>
          <th>
            <h2 class="z">BACKGROUND</h2>
          </th>
          <th>
            <h2 class="z">IMAGEDESC</h2>
          </th>
          <th>
            <h2 class="z">IMAGECONT</h2>
          </th>
        </tr>
        <?php
        foreach ($data as $row) {
          $_SESSION['ID'] = $row['IName'];
          $id = $_SESSION['ID'];
          echo "<tr style='margin-top: 1%;'>
                    <td><center>{$row['CROP']}</center></td>
                    <td><center>{$row['MONTH']}</center></td>
                    <td><center>{$row['YEAR']}</center></td>
                    <td><center>{$row['CROP STAGE']}</center></td>
                    <td><center>{$row['PARTS-AFFECTED']}</center></td>
                    <td><center>{$row['DEVICE/SHOT']}</center></td>
                    <td><center>{$row['STAGE']}</center></td>
              </tr>
              <style>
                  .butt1{
                    background-color:white;
                    padding:3%;
                    border-radius:10px;
                    margin-bottom:15px;
                  }
                  .butt1:hover{
                    background-color:green;
                    color:white;
                  }
                  .butt1:active{
                    opacity:0.7;
                  }
                  .butt2{
                    background-color:white;
                    padding:3%;
                    border-radius:10px;
                    margin-bottom:15px;
                  }
                  .butt2:hover{
                    background-color:red;
                    color:white;
                  }
                  .butt2:active{
                    opacity:0.7;
                  }
                  .butt3{
                    background-color:white;
                    padding:3%;
                    border-radius:10px;
                    margin-bottom:15px;
                  }
                  .butt3:hover{
                    background-color:#FFD700;
                    color:cornsilk;
                  }
                  .butt3:active{
                    opacity:0.7;
                  }
              </style>
              <tr>
                    <td><center>{$row['SEASON']}</center></td>
                    <td><center>{$row['STATE']}</center></td>
                    <td><center>{$row['PORD']}</center></td>
                    <td><center>{$row['AREA']}</center></td>
                    <td><center>{$row['BACKGROUND']}</center></td>
                    <td><center>{$row['PORDNAME']}</center></td>
                    <td><center>{$row['IMGCONTAINS']}</center></td>
              </tr>
              <tr>
                <td colspan=" . "9" . ">
                <br>
                </td>
              </tr>
                  ";
        }
        echo "</table>";

    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    ?>
    </div>
</footer>

</html>