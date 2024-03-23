<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: cornsilk;
        }

        button {
            background-color: rgb(7, 138, 7);
            padding: 0.23em 2%;
            color: white;
            border-radius: 15px;
            font-size: 1em;
            padding: 16px 20px;
            border: none;
            transition: border 1ms;
            margin: 10px 0 0;
            cursor: pointer;
        }
        header {
            display: flex;
            justify-content: space-between;
            background-color: #4AAE4E;
            text-align: center;
            margin-top: 0;
            padding: 2%;
            max-height: min-content;
        }

        h1 {
            margin-right: 45%;
        }

        h2 {
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            align: center;
            gap: 20px;
            margin: 0 auto;
            max-width: max-content;
        }

        .chart-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: center;
            max-width: 400px;
        }

        table {
            border-collapse: collapse;
            border: 1px solid black;
            width: 300px;
            align-self: center;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        canvas {
            width: 300px;
            height: 300px;
        }
        #filtered-table {
        margin: 0 auto;
        text-align: center;
        width:100%;

    }

    #filtered-table th,
    #filtered-table tr {
        vertical-align: top;
    }
    .filter
    {
        margin-left: 10vh;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function applyFilters() {
            var cropSelect = document.getElementById("crop-select");
            var pordSelect = document.getElementById("pord-select");

            var cropFilter = cropSelect.options[cropSelect.selectedIndex].value;
            var pordFilter = pordSelect.options[pordSelect.selectedIndex].value;

            fetchFilteredData(cropFilter, pordFilter);
        }

        function fetchFilteredData(cropFilter, pordFilter) {
            var table = document.getElementById("filtered-table");

            // Clear previous data
            table.innerHTML = "<tr><th>CROP</th><th>Classification</th><th>Scientific Name</th><th>Count</th></tr>";

            // Fetch filtered data
            fetch("fetch_filtered_data.php?crop=" + cropFilter + "&pord=" + pordFilter)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        table.innerHTML += "<tr><td colspan='4'>N/A</td></tr>";
                    } else {
                        data.forEach(row => {
                            table.innerHTML += "<tr><td>" + row.CROP + "</td><td>" + row.PORD + "</td><td>" + row.PORDNAME + "</td><td>" + row.count + "</td></tr>";
                        });
                    }
                });
        }
    </script>
</head>
<body>
    <header>
        <button onclick="window.location.href = 'index.php';">&#x3c Back</button>
        <h1>Dashboard</h1>
    </header>
    <?php
    // Step 1: Connect to the database
    require 'DBinfo.php';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 0: Display total image count
    $query = "SELECT COUNT(*) as total FROM permdb";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalImages = $result['total'];
    echo "<h2>Total Number of Images: $totalImages</h2>
    <div class='container'>";

    // Function to generate table and chart
    function generateTableAndChart($conn, $columnName, $tableName)
    {
        // Step 2: Retrieve data from the database
        $query = "SELECT $columnName, COUNT(*) as count FROM $tableName GROUP BY $columnName";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Step 3: Create the table and chart
        ?>
        <tr>
        <th colspan="2"><?= $columnName === 'PORD' ? 'Classification' : ($columnName === 'User' ? 'Contributors' : $columnName) ?></th>
        </tr>
        <tr>
            <td>
                <div class='chart-container'>
                    <table>
                        <tr>
                            <th><?= $columnName ?></th>
                            <th>Count</th>
                        </tr>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?= $row[$columnName] ?></td>
                                <td><?= $row['count'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </td>
            <td>
                <div class='chart-container'>
                    <canvas id='<?= $columnName ?>-chart'></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('<?= $columnName ?>-chart').getContext('2d');
                    var data = {
                        labels: [
                            <?php foreach ($data as $row) : ?>
                                '<?= $row[$columnName] ?>',
                            <?php endforeach; ?>
                        ],
                        datasets: [{
                            data: [
                                <?php foreach ($data as $row) : ?>
                                    <?= $row['count'] ?>,
                                <?php endforeach; ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ]
                        }]
                    };
                    var options = {
                        responsive: true,
                        maintainAspectRatio: false
                    };
                    new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: options
                    });
                </script>
            </td>
        </tr>
    <?php
    }

    // Step 5: Generate tables and charts
    ?>
    <table>
        <tr>
            <td>
                <table>
                    <?php generateTableAndChart($conn, 'User', 'permdb') ?>
                </table>
            </td>
            <td>
                <table>
                    <?php generateTableAndChart($conn, 'PORD', 'permdb') ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <?php generateTableAndChart($conn, 'CROP', 'permdb') ?>
                </table>
            </td>
            <td>
                <table id="filtered-table">
                    <tr>
                        <div class="filter">
                    <label for="crop-select">CROP:</label>
                    <select id="crop-select">
                        <option value="">All</option>
                        <?php
                        $query = "SELECT DISTINCT CROP FROM permdb";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $crops = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($crops as $crop) {
                            echo "<option value='" . $crop['CROP'] . "'>" . $crop['CROP'] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="pord-select">Classification:</label>
                    <select id="pord-select">
                        <option value="">All</option>
                        <?php
                        $query = "SELECT DISTINCT PORD FROM permdb";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $pords = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($pords as $pord) {
                            echo "<option value='" . $pord['PORD'] . "'>" . $pord['PORD'] . "</option>";
                        }
                        ?>
                    </select>

                    <button onclick="applyFilters()">Apply</button>
                    </div>
                    </tr>
                    <tr>
                        <th>CROP</th>
                        <th>Classification</th>
                        <th>Scientific Name</th>
                        <th>Count</th>
                    </tr>
                </table>

            </td>
        </tr>
    </table>


    <?php

    // Step 6: Close the database connection
    $conn = null;
    ?>
    </div>

</body>

</html>
