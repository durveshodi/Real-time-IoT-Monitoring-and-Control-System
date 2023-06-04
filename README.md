# Real-time IoT Monitoring and Control System

This project demonstrates real-time database updates using NodeMCU (ESP8266) and PHP. It allows you to update and retrieve data from a MySQL database using PHP scripts, and display the data in real-time on a web page. Additionally, it provides functionality to control NodeMCU pins via POST requests.

## Project Components

The project consists of the following components:

1. NodeMCU (ESP8266): A microcontroller board that connects to a Wi-Fi network and interacts with the MySQL database.

2. MySQL Database: Stores the data and allows for retrieval and updates.

3. PHP Scripts: Handle database operations (read, write, update) and provide an API for communication between NodeMCU and the database. It also allows controlling NodeMCU pins via POST requests.

4. HTML/JavaScript: Displays the real-time data on a web page using AJAX and jQuery.

## Prerequisites

Before running this project, make sure you have the following:

1. NodeMCU (ESP8266) board.
2. Web server with PHP support (e.g., Apache, XAMPP).
3. MySQL database server.
4. Arduino IDE with the ESP8266 board package installed.

## Instructions

Follow these steps to set up and run the project:

### 1. Set up the MySQL Database

1. Create a database in MySQL. You can use phpMyAdmin or any other MySQL administration tool. For example, let's assume the database name is `id20859912_data`.

2. Import the `nodemcu.sql` file provided in this repository into the `id20859912_data` database. This will create the necessary table and insert some sample data.

### 2. Configure PHP Files

1. Open the `api.php` file and update the MySQL database configuration variables:
   - `$servername`: Set the server name or IP address of your MySQL server.
   - `$username`: Set the MySQL username.
   - `$password`: Set the MySQL password.
   - `$dbname`: Set the name of the database (`id20859912_data` in this example).

2. Open the `data.php` file and update the MySQL database configuration variables with the same values used in `api.php`.

3. Open the `update_data.php` file and update the MySQL database configuration variables with the same values used in `api.php`.

### 3. Upload PHP Files

1. Upload the `api.php`, `data.php`, and `update_data.php` files to your web server in a directory accessible by the web server.

### 4. Set up the NodeMCU

1. Connect your NodeMCU board to your computer.

2. Open the `nodemcu.ino` file provided in this repository using the Arduino IDE.

3. Update the Wi-Fi credentials in the `nodemcu.ino` file with your network SSID and password.

4. Upload the sketch to your NodeMCU board.

### 5. Access the Web Page

1. Copy the `index.php` file provided in this repository to the same directory as the PHP files on your web server.

2. Open a web browser and navigate to the URL where the `index.php` file is hosted.

3. The web page will display a table with real-time data retrieved from the database. The table will be automatically updated at regular intervals.

4. You can also manually update the database values by interacting with the NodeMCU using the provided API functions.

### 6. Controlling NodeMCU Pins via

 API

To control the NodeMCU pins via POST requests, use the following JSON data for different actions:

1. JSON data for "read" action:
```json
{
  "action": "read",
  "pin": "D4"
}
```

2. JSON data for "write" action:
```json
{
  "action": "write",
  "pin": "D9",
  "value": 1
}
```

3. JSON data for "pwm" action:
```json
{
  "action": "pwm",
  "pin": "D6",
  "value": 128
}
```

4. JSON data for "enable_high_frequency" action:
```json
{
  "action": "enable_high_frequency",
  "pin": "D2",
  "frequency": 1000
}
```

You can send POST requests to the `api.php` file with the respective JSON data to control the NodeMCU pins.

## Contributing

Contributions to this project are welcome. Feel free to open issues and submit pull requests to improve the project.


