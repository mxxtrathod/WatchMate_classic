<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // or your MySQL root password
$database = "watchmate_classic";
// $port = 3306; // match with phpMyAdmin port

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>