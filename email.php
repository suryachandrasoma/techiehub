<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Form</title>
</head>
<body>

  <h2>Contact Us</h2>

  <form action="sendemail.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>

    <input type="submit" value="Send Email">
  </form>
<?php
echo "";
?>
</body>
</html>
