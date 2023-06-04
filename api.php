<?php

// MySQL database configuration
$servername = "localhost";
$username = "xxxxxxxxxxxx";
$password = "xxxxxxxxxxxx";
$dbname = "xxxxxxxxxxxx";

// Function to update data in the database
function updateData($action , $pin, $value, $frequency) {
    global $servername, $username, $password, $dbname;
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Update data in the database for the specified pin
    if ($action === "write") {
        $sql = "UPDATE nodemcu SET action = '$action' ,  value = $value  , frequency = 0 WHERE pin = '$pin'";
    } 
    else if ($action === "pwm") {
        $sql = "UPDATE nodemcu SET action = '$action' ,  value = $value WHERE pin = '$pin'";
    } 
    else if ($action === "enable_high_frequency") {
       $sql = "UPDATE nodemcu SET action = 'pwm',  value = 0 , frequency = $frequency WHERE pin = '$pin'";
   } 

    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $conn->error;
    }
    
    $conn->close();
}

// Function to read the value from the database
function readData($pin) {
    global $servername, $username, $password, $dbname;
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "UPDATE nodemcu SET value =  0 , frequency = 0 , action = 'read' WHERE pin = '$pin'";
    $result = $conn->query($sql);
    
    // Read the value from the database
    $sql = "SELECT value FROM nodemcu WHERE pin = '$pin' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Fetch the value
        $row = $result->fetch_assoc();
        $value = $row["value"];
        
        // Create a JSON response with the value
        $response = array("value" => $value);
        echo json_encode($response);
    } else {
        // No data found for the specified pin
        echo json_encode(array());
    }
    
    $conn->close();
}

// Retrieve the data from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"];
$pin = $data["pin"];
$value = $data["value"];
$frequency = $data["frequency"];

if ($action === "read") {
    // Read the value from the database
    readData($pin);
} else if ($action === "write") {
    // Update the data in the database for the specified pin
    updateData($action , $pin, $value, 0); // Set frequency to 0 for write action
} else if ($action === "pwm") {
    // Update the data in the database for the specified pin
    updateData($action , $pin , $value, 0); // Set frequency to 0 for pwm action
} else if ($action === "enable_high_frequency") {
    // Update the data in the database for the specified pin
    updateData($action , $pin, 0, $frequency);
} else {
    // Invalid action
    echo "Invalid action";
}

?>
