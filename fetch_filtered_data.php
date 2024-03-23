<?php
// Step 1: Connect to the database
require 'DBinfo.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Step 2: Retrieve filtered data
$cropFilter = $_GET['crop'];
$pordFilter = $_GET['pord'];

// Prepare the SQL query
$query = "SELECT CROP, PORD, PORDNAME, COUNT(*) as count FROM permdb WHERE (CROP = :crop OR :crop = '') AND (PORD = :pord OR :pord = '') GROUP BY CROP, PORD, PORDNAME";

$stmt = $conn->prepare($query);

// Bind the filter values to the query parameters
$stmt->bindParam(':crop', $cropFilter);
$stmt->bindParam(':pord', $pordFilter);

// Execute the query
$stmt->execute();

// Fetch the filtered data as an associative array
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 3: Return the filtered data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Step 4: Close the database connection
$conn = null;
?>
