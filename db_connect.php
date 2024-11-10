<?php
$servername = "localhost";  // Database server (usually "localhost")
$username = "root";         // Database username (default is usually "root")
$password = "Sai_Khairnar@811";             // Database password (default is often empty for local servers)
$dbname = "library_db";     // The name of the database you created

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
