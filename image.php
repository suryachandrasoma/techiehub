<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "KARTHIK@2004";
$dbname = "om";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume you have a 'rollno' value to identify the row containing the image
 // Replace with the actual 'rollno' value

// Query to retrieve image data from the database based on 'rollno'
$sql = "SELECT image FROM hello WHERE name = 'Karthik'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the image data
    $row = $result->fetch_assoc();
    $imageData = $row['image'];

    // Output appropriate headers for image display
    header("Content-Type: image/webp/jpg/jpeg"); // Change to the appropriate content type based on your image format
    echo base64_decode($imageData);
    // Output the image data
    echo $imageData;
    
} else {
    echo "Image not found";
}

// Close the database connection
$conn->close();
?>
