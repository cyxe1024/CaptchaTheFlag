<?php
ini_set('display_errors', 1);
$servername = "db-cats-do-user-7278862-0.a.db.ondigitalocean.com:25060";
$username = "Security";
$password = "r3lewksuhj8mc8kf";

echo "$username";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>