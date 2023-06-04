<?php
// MySQL database configuration
$servername = "localhost";
$username = "xxxxxxxxxxxx";
$password = "xxxxxxxxxxxx";
$dbname = "xxxxxxxxxxxx";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all data from the table
$sql = "SELECT * FROM nodemcu";
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    // Fetch table rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

// Convert the array to JSON
$jsonData = json_encode($rows);

echo $jsonData;

$conn->close();
?>
