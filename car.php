<?php
if(isset($_POST['name'])){
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'soil';
$port = 4410; // Change this to the appropriate port if not using the default (3306)

// Create connection
$conn = mysqli_connect($host, $username, $password, $database, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "connected";
$name=$_POST['name'];
$mail=$_POST['mail'];
$passkey=$_POST['passkey'];
$sql="INSERT INTO `meri` (`name`, `mail`, `passkey`) VALUES ('$name', '$mail', '$passkey');";
echo $sql;
if ($conn->query($sql) == true) {
  echo "con";
} 
else {
    echo "error";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="car.php" method="post">
    <input type="text" name="name" id="name"><br>
    <input type="text" name="mail" id="mail"><br>
    <input type="password" name="passkey" id="passkey">
    <input type="submit">
    </form>
    
</body>
</html>
