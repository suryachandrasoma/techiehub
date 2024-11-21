
                    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Gallery</title>
    <link rel="stylesheet" href="lightbox.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="home.js">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f2a4b9346f.js" crossorigin="anonymous"></script>
    <style>
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
      
      @media(max-width: 700px){
        .intro h3{
          font-size: 20px;
        }
        .text h3{
          font-size: 25vw;
        }
        .card h2{
          font-size: 20px
        }
        .card p{
          font-size: 2vw;
          line-height: 1;
        }
       
        .card--display i{
          font-size: 20px;
        }
        }
       
        .x,
.y,
.z{
  width: 500px;
  height: 300px;
  padding: 20px;
  background-color: wheat;
  overflow: auto;
  border-radius: 10px;
  box-shadow: 0 9px 8px rgba(0,0,0,0.1);
}
    </style>
</head>
<body>
  <!-------------header image-------------->
  <div class="header">
    <img src="images/gallerybg.png" height="150px" width="1400px" alt="nature" class="responsive">
  </div>
    
    <!------------------Navbar----------->
    <section id="nav-bar">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa-solid fa-bars" style="color: #f7f9fc;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <div class="auto">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="gallery.html">Gallery</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Events
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="competitions.html">Competitions</a></li>
                    <li><a class="dropdown-item" href="upcomingevents.html">Upcoming Events</a></li>
                    <li><a class="dropdown-item" href="#">Past Events</a></li>
                   </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contactUs.html">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        </nav>
        
      </section>

<!--------------------Gallery-------------------->
<div class="heading">
    <h1>Photo Gallery</h1>
</div>
<div class="gallcontainer">
    <div class="gallery">
    <?php
                $servername = "localhost";
                $username = "root";
                $password = "KARTHIK@2004";
                $database = "om";
                $conn = mysqli_connect($servername, $username, $password, $database);
                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM gallery";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . mysqli_error($conn));
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<td><img src='img.php?id={$row['id']}' width='350' height='250' onclick='toggleFullScreen(this)'></td>";
                }
                ?>
    </div>
</div>
<script src="lightbox-plus-jquery.js"></script>
<br><br>

<!---------------Footer-------------------->
<footer>
  <div class="row">
      <div class="col">
        <a href="https://mrce.in/"><img src="images/footer_logo.png" class="logo"></a>
        <p>For any college related queries please refer our Official website. Stay tuned to this website regularly for information regarding compettions being held.</p>
      </div>
      <div class="col">
        <h3>Techie-hub@MRCE</h3>
        <p>Mysammaguda</p>
        <p>Medchal, PIN 500034, India</p>
        <a href="contactUs.html"><p class="email-id">tpavani04@email.com</p></a>
            <h4>+91 - 0123456789</h4>
          </div>
        <div class="col">
        <h3>Links <div class="underline"><span></span></div></h3>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="gallery.html">Gallery</a></li>
          <li><a href="competitions.html">Events</a></li>
          <li><a href="contactUs.html">Contact Us</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>Blog<div class="underline"><span></span></div></h3>
        <!--<form>
          <i class="fa-regular fa-envelope"></i>
          <input type="email" placeholder="Enter your email id">
          <button type="submit"><i class="fa-solid fa-arrow-right" style="color: white; font-size: 16px;"></i></button>
        </form>-->
        <a href="https://techiehublog.wordpress.com/2024/01/19/exploring-the-thriving-world-of-computer-science-events-and-cutting-edge-technologies-in-college/"><button class="button">Visit the blog</button><br><br><br><br></a>
        <div class="social-icons">
          <a href=""><i class="fa-brands fa-facebook"></i></a>
          <a href=""><i class="fa-brands fa-whatsapp"></i></a>
          <a href=""><i class="fa-brands fa-instagram"></i></a>
          <a href=""><i class="fa-brands fa-linkedin"></i></a>
        </div>
      </div>
    </div>
    <hr>
    <p class="copyright">&copy; Techie hub <i class="fa-regular fa-copyright"></i> 2023 - All Rights Reserved </p>
  </footer>
  <script>
    function toggleFullScreen(image) {
        image.classList.toggle('full-screen');
    }
</script>

  </body>
  </html>