<?php
require('../DBinfo.php');

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to retrieve all images from the table
    $sql = "SELECT `IName`, `IMAGE` FROM permdb;";

    // Prepare the SQL query
    $stmt = $conn->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Create a new folder to store the downloaded images
    $folder_name = "downloaded_images";
    if (!file_exists($folder_name)) {
        mkdir($folder_name);
    }

    // Loop through the results and download each image
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $image_data = $row['IMAGE'];
        $iname = $row['IName']; // Get the IName column value

        // Generate a unique filename for each image
        $filename = $iname . '.jpg'; // Rename the file using IName

        // Save the image to the folder
        file_put_contents($folder_name . '/' . $filename, $image_data);
    }

    // Create a zip file containing the downloaded images
    $zip = new ZipArchive();
    $zipFileName = $folder_name . '.zip';
    if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder_name));
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder_name) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    // Set headers to force download the zip file
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename=' . basename($zipFileName));
    header('Content-Length: ' . filesize($zipFileName));

    // Send the zip file to the browser
    readfile($zipFileName);

    // Remove the temporary files and folder
    unlink($zipFileName);
    $conn = null;
    rmdir($folder_name);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
