

<?php
// MySQL database configuration
$servername = "localhost";
$username = "xxxxxxxxxxxx";
$password = "xxxxxxxxxxxx";
$dbname = "xxxxxxxxxxxx";

// Retrieve the value from the GET request
$value = $_GET["value"];
$pin = $_GET["pin"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the value in the database table
$sql = "UPDATE nodemcu SET value = $value  , frequency = 0 WHERE pin = '$pin'";; // Assuming you have a column named 'value' and a primary key column named 'pin'
if ($conn->query($sql) === TRUE) {
    echo "Database updated successfully";
} else {
    echo "Error updating database: " . $conn->error;
}

$conn->close();
?>
