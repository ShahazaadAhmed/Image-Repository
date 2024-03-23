<?php
require('DBinfo.php');
session_start();

// Assign a specific value to $_SESSION['ID']
$_SESSION['ID'] = $_POST["id"];
$id = $_SESSION['ID'];

// Create a new PDO instance
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Query to retrieve the image from the table where IName matches $id
$sql = "SELECT IName, IMAGE FROM permdb WHERE IName = '$id'";

// Execute the query
$stmt = $conn->query($sql);

// Fetch the row
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $image_data = $row['IMAGE'];
    $filename = $id . '.jpg'; // Rename the file using the ID

    // Set the appropriate headers for image download
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename='.$filename);

    // Output the image data directly
    echo $image_data;
    exit;
}
?>
<html>
    <body>
        <?php if ($row) : ?>
            <h1>Download Successful for ID: <?php echo $id; ?></h1>
        <?php else : ?>
            <h1>No image found for ID: <?php echo $id; ?></h1>
        <?php endif; ?>
    </body>
</html>