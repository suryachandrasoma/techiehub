<?php
// Establish a database connection (replace with your actual connection code)
$mysqli = new mysqli("localhost", "root", "KARTHIK@2004", "om");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch image data based on an identifier (e.g., image ID)
$imageId = isset($_GET['id']) ? $_GET['id'] : 0;  // Use a default value or handle the absence of 'id' parameter

// Retrieve image data from the database
$result = $mysqli->query("SELECT image FROM clients WHERE id = $imageId");

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set appropriate headers
        header("Content-type: image/jpeg/png/jpg");  // Change to the appropriate image type
        header("Content-Length: " . strlen($row['image']));

        // Output the image data
        echo $row['image'];
    } else {
        // Handle the case where the image is not found
        header("HTTP/1.0 404 Not Found");
        echo "Image not found.";
    }
} else {
    // Handle query error
    echo "Error: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>