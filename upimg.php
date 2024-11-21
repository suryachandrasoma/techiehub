<?php
$insert = false;

if (isset($_POST['submit'])) {
    $server = "localhost";
    $username = "root";
    $password = "KARTHIK@2004";
    $database = "om";
    $con = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $rollno = $_POST['rollno'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $other = $_POST['other'];

    // Check if file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }

    try {
        // Check for duplicate entries
        $duplicate = mysqli_query($con, "SELECT * FROM kar WHERE phone='$phone' OR rollno='$rollno'");
        if (mysqli_num_rows($duplicate) > 0) {
            throw new Exception("Rollno or phone number already exists");
        }

        // Perform the database operation using prepared statements
        $stmt = $con->prepare("INSERT INTO `om`.`kar` (`name`, `phone`, `rollno`, `password`, `other`, `image`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $phone, $rollno, $password, $other, $targetFile);
        $stmt->execute();
        $insert = true;
        echo "Registration successful!";
        // Consider redirecting the user to a success page instead of echoing the message.
        header("Location: index.html");
        exit();
    } catch (Exception $e) {
        // Handle the exception
        echo "<p>Error: " . $e->getMessage() . "</p>";
    } finally {
        // Close the database connection
        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        .m {
            border-radius: 30px;
            background: linear-gradient(skyblue,pink);
            padding-left: 60px;
            width: 300px;
            height: auto;
            margin-left: 550px;
            margin-top: 30px;
            padding: 50px;
        }
        * {
            margin: 0px;
            padding: 0px;
        }
        input {
            display: block;
            margin-left: 30px;
            margin-top: 12px;
            width: 240px;
            padding: 6px;
            border-radius: 10px;
        }
        .bg {
            width: 100%;
            position: absolute;
            z-index: -1;
            opacity: 0.6;
        }
        .v {
            margin-left: 100px;
            background-color: limegreen;
            color: black;
            padding: 4px;
            font-weight: bold;
            width: 100px;
            border-radius: 20px;
            font-size: 20px;
        }
        h3 {
            margin-left: 60px;
            font-size: 35px;
        }
        .z {
            color: orange;
            font-size: 40px;
            margin-left: 500px;
        }
        .g {
            margin-left: 100px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="m">
    <h3>REGISTER</h3><br>

    <form action="upimg.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" class="name" id="name" placeholder="Enter your name" required><br>
        <input type="phone" name="phone" class="phone" id="phone" placeholder="Enter your phone"><br>
        <input type="text" name="rollno" class="rollno" id="rollno" placeholder="Enter your rollno" required><br>
        <input type="password" name="password" class="password" id="password" placeholder="Enter your password"><br>
        <input type="text" name="other" class="other" id="other" placeholder="other" required><br>
        <input type="file" name="image" class="image" id="image" placeholder="Enter your Year"><br>

        <button class="v" type="submit" name="submit">Submit</button>
    </form><br>
</div>
</body>
</html>
