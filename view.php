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
   
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        Optional styling for demonstration purposes 
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .full-screen {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            object-fit: contain; 
            background-color: rgba(0, 0, 0, 0.8); 
            cursor: zoom-out;
        }
    </style>
</head>
<body>
    <div class="my-5">
        
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
        <section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <div class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" >
      <?php
echo "<td><img src='getImage.php?id={$row['id']}' width='200' height='200' onclick='toggleFullScreen(this)'></td>";
?>

</div>
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">STUDENT NAME</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?php echo $name;?></h1>
        
           <h3>Email</h3>
        <p class="leading-relaxed"><?php echo $email ?></p>
        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">

          
        </div>
        <div class="flex">
          <span class="title-font font-medium text-2xl text-gray-900"><?php echo $phone ?></span>
          <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" onclick="printPage()">Print</button>
          
        </div>
      </div>
    </div>
  </div>
</section>
<script>
        function printPage() {
            window.print();
        }
    </script>
    <script>
    function toggleFullScreen(image) {
        image.classList.toggle('full-screen');
    }
</script>

</body>
</html>
