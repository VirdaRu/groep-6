<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
 
} 
$host = "localhost";
$databaseName = "vdlp";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";    
$password = "student";     

$id = $_POST["id"];

$conn = null;
try
{
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT naam, beschrijving, opleiding, id FROM vacature WHERE id = $id";
    $stmtSelect = $conn->prepare($sql);
    $stmtSelect->execute();
    $result = $stmtSelect->setFetchMode();
    $rows = $stmtSelect->fetchAll();


} catch (PDOException $ex) {
    echo "Connection failed:  $ex";
    die();

} finally {
    if($conn != null) {
        $conn = null;
    }
}
?>

<html lang="en">
  <head>
    <title>Van der let & Partners</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=project_5ice-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/site icon.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    
    
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    
    <div class="site-navbar-wrap">
      
      <div class="site-navbar site-navbar-target js-sticky-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-4">
              <h1 class="my-0 site-logo"><a href="index.html">Van der let & Partners<span class="text-primary">.</span> </a></h1>
            </div>
            <div class="col-6 col-md-6">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">

                  <div class="d-inline-block d-lg-block ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black">
                    <span class="icon-menu h3"></span> <span class="menu-text">Menu</span>
                  </a></div>

                  <ul class="site-menu main-menu js-clone-nav d-none d-lg-none">
                    <li><a href="index.html#wat_we_doen" class="nav-link">Home</a></li>
                    <li><a class="nav-link"></a></li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> 

    <div class="site-section" id="Contact">
      <div class="container">
        <form action="vacature_sturen.php" method="post" class="contact-form">
        <?$count = 0; 
            foreach ($rows as $row) { ?>

          <div class="section-title text-center mb-5">
            <span class="sub-title mb-2 d-block">Bij ons werken?</span>
            <h2 class="title text-primary">je reageert op de vacature: <?= $row["naam"]?></h2>
          </div>
         
          <input type="hidden" name="functie" value="<?= $row["naam"] ?>">
          <div class="row mb-4">
            <div class="col-md-6 mb-4 mb-md-0">
              <input name="naam" type="text" class="form-control" placeholder="Voornaam">
            </div>
            <div class="col-md-6">
              <input name="anaam" type="text" class="form-control" placeholder="Achternaam">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-12">
              <input name="email" type="email" class="form-control" placeholder="Email/tel.nr.">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-12">
              <textarea name="bericht" class="form-control" name="" id="" cols="30" rows="10" placeholder="Bericht"></textarea>
            </div>
          </div>
<input type="file"  name="cv" id="cv">

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-md">Stuur bericht</button>
            </div>
          </div>

        </form>
      </div>
    </div> <!-- END .site-section -->
            <?php } ?>

    <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="row mb-5">
                <div class="col-12">
                  <h3 class="footer-heading mb-4">Contactgegevens</h3>
                  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum dolorum quisquam id maiores quas rerum, laborum ullam fugiat cumque nostrum. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                </div>
              </div>
              
  
              
            </div>
            <div class="col-lg-3 ml-auto">
             
              <div class="row mb-5">
                <div class="col-md-12">
                  <h3 class="footer-heading mb-4">Navigatie</h3>
                </div>
                <div class="col-md-8 col-lg-8">
                  <ul class="list-unstyled">
                    <li><a href="index.html#wat_we_doen" class="nav-link">Home</a></li>
                </div>
                
              </div>
              
            </div>
            
  
         
  
              <div class="mb-5">
                <h3 class="footer-heading mb-2">Nieuwsbrief</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum dolorum quisquam id maiores quas rerum, laborum ullam fugiat cumque nostrum.</p>
  
                <form method="post" class="form-subscribe">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control border-white text-white bg-transparent" placeholder="uw volledige naam" aria-label="Email" aria-describedby="button-addon2">
                  </div>
                  <div class="form-group mb-3">
                    <input type="text" class="form-control border-white text-white bg-transparent" placeholder="Email" aria-label="Email" aria-describedby="button-addon2">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary px-5" type="submit">Abboneren</button>
                  </div>
                </form>
  
              </div>
  
              
  
  
            </div>
            
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="mb-4">
                    <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                  </div>
                  <p>

                <small class="block">&copy; 2020 <strong class="text-white">Van der let & Partners</strong> All Rights Reserved.</a></small> 
                </p>
            </div>
          </div>
        </div>
      </footer>
      <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");
        
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
        </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/main.js"></script>
  

  </body>
</html> 
    