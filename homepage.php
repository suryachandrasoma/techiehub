<?php
// Check if the user is logged in by checking the login cookie
if(!isset($_COOKIE['login_status']) || $_COOKIE['login_status'] !== 'logged_in') {
    // User is not logged in, redirect to the login page
    header("Location: logins.php");
    exit();
}

// If logged in, display the homepage content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>

    <h2>Welcome to the Homepage</h2>

    <!-- Your homepage content goes here -->

</body>
</html>
