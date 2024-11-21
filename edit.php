<?php
$servername = "localhost";
$username = "root";
$password = "KARTHIK@2004";
$database = "om";
$conn = mysqli_connect($servername, $username, $password, $database);

$rollno = "";
$class = "";
$name = "";
$email = "";
$phone = "";
$year = "";
$errorMessage = "";
$successmsg = "";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET["id"])) {
            header("location: /admin.php");
            exit;
        }

        $id = $_GET["id"];
        $sql = "SELECT * FROM clients WHERE id=?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if (!$result) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $row = $result->fetch_assoc();

        if (!$row) {
            header("location:/admin.php");
            exit;
        }

        $rollno = htmlspecialchars($row["rollno"]);
        $class = htmlspecialchars($row["class"]);
        $name = htmlspecialchars($row["name"]);
        $email = htmlspecialchars($row["email"]);
        $phone = htmlspecialchars($row["phone"]);
        $year = htmlspecialchars($row["year"]);
        
    } else {
        $id = $_POST["id"];
        $rollno = $_POST['rollno'];
        $class = $_POST['class'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $year = $_POST['year'];
        
        if (empty($rollno) || empty($class) || empty($name) || empty($email) || empty($phone) || empty($year)) {
            throw new Exception("All fields are required");
        }

        $sql = "UPDATE clients SET rollno=?, class=?, name=?, email=?, phone=?, year=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssssssi", $rollno, $class, $name, $email, $phone, $year, $id);
        $result = $stmt->execute();
        $stmt->close();

        if (!$result) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $successmsg = "Updated";
        header("location:/admin.php");
    }
} catch (Exception $e) {
    $errorMessage = "An error occurred: " . $e->getMessage();
}
?>





<!-- Your HTML code remains unchanged -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="my-5">
        <h2>New student</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post" >
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Roll no</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="rollno" value="<?php echo $rollno;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Class</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="class" value="<?php echo $class;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Year</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="year" value="<?php echo $year;?>">
                </div>
            </div>
            <?php
            if (!empty($successmsg)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successmsg</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="admin.php" role="button">Cancel</a>
        </form>
    </div>
</body>
</html>
