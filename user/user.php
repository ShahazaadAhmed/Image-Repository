<?php
    session_start();
    if (!isset($_SESSION['UN'])) {
        header("location:../index.php");
        exit;
    }
    require('../DBinfo.php');
    $cropQuery = "SELECT * FROM crop";
    ?>
<!--
#########################################################################################################    
author: Satya Sreekar Pattaswami
last change: made changes to the redirections as to accomodate for the implementation of the directories.
last cahnge date: 29 February 2023
email: satyasreekarpattaswami@gmail.com
description: this is a php-html combination file. This is page renders the form that the user fills.
            for further details refer to the documentation section 4.3.1.
#########################################################################################################
-->
<html>    
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Form</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <div class="heading">
        <div></div>
        <center>
            <h1>Upload Crop Details</h1>
        </center>
        <button onclick="window.location.href = '../logout.php';">Logout</button>
    </div>
    <div id="box">
        <form action="upro.php" method="POST">
            <table align="center" cellpadding="3px">
                <tr>
                    <td colspan="2" align="center">
                        <h2>Select Crop</h2>
                    </td>
                    <td colspan="2" align="center">
                        <h2>Select Month</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
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
                        <select name="month" id="month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h2>Select Year</h2>
                    </td>
                    <td colspan="2" align="center">
                        <h2>Crop Stage</h2>
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
                        <select id="cstage" name="cstage">
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
                        <h3>Parts Affected</h3>
                    </td>
                    <td colspan="2" align="center">
                        <h2>Device/Shot</h2>
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
                        <h2>Season</h2>
                    </td>
                    <td colspan="2" align="center">
                        <h3>State</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
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
                        <h3>Plant Health Status</h3>
                    </td>
                    <td colspan="2" align="center">
                        <h3>Place</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select name="pord" id="pord">
                            <option value="pest">Pest</option>
                            <option value="disease">Disease</option>
                            <option value="NaturalEnemy">Natural Enemy</option>
                            <option value="Nutrient Defficiency">Nutrient Deficiency</option>
                            <option value="healthy">Healthy</option>
                        </select>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" name="Area" id="Area" oninput="this.value=this.value.replace(/[^a-zA-Z]/g,'');" required>
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

</html>
