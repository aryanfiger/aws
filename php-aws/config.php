<?php
$host = "database-1.c9cimumi4okn.ap-south-1.rds.amazonaws.com";
$user = "admin123";
$password = "admin123";  // Replace with actual password
$database = "mydatabase";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>