<?php
// Instamojo API Configuration
$mode = "sandbox"; // Change to "live" for production
$api_key = "";
$api_secret = "";
$redirect_url = "http://www.example.com"; // Redirect URL after successful payment
$webhook_url = "https://www.instamojo.com/@ashwch/d66cb29dd059482e8072999f995c4eef"; // Webhook URL for payment updates

// Database Configuration (if needed)
$db_host = "localhost";
$db_user = "root";
$db_password = "123";
$db_name = "om";

// Create a connection to the database (if needed)
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

