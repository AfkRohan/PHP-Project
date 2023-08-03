<?php
require_once("functions.inc.php");
// redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Test -->
     <!--CSS-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" integrity="sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" rel="stylesheet">
    <style>
        .error {
            color:red;
        }
    </style>
      <!--Jss-->
      <script src="script.js">
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar">
    <a href="#" class="logo">IntStore</a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="cart.php">Cart</a></li>
        <?php if (!empty($_SESSION["UserId"])) { ?>
            <li><a href="logout.php">Logout</a></li>
        <?php } else { ?>
            <li><a href="login.php">Login</a></li>
        <?php } ?>
    </ul>
</nav>
<header>
<div class="slideshow-container">
            <div class="slide">
                <img src="1.jpg" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="2.jpg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="3.jpeg" alt="Slide 3">
            </div>
            </header>
<div class="header">
    <div class="row">
        <div class="col-2">
            <h1>It's raining Rollbacks</h1>
            <p>Save m000re on 1000s of your faves..!!</p>
            <p>Shop great sales & offers on select grocery items during<br>
                Instore's Rollback Event.</p>
            <a href="shop.php" class="btn">Explore Now &#8594;</a>
        </div>
        <div class="col-2">
            <img src="images/banner.jpg" width="750px">
        </div>
    </div>
</div>
<?php require_once("db/db_conn.php");

require_once ("php/component.php");
 ?>

<div class="container">
<h1 class="FeaturedProduct">Electronics</h1>
            <div class="row text-left py-2">
               
                <?php
                global $pdo;
                $stmt = $pdo->query("SELECT * FROM products where Categories_CategoryID=2");

                while($row=$stmt->fetch()){
                    Index_Component($row['Pname'],$row['Price'], $row['ProductImageUrl'], $row['ProductID']);
                }

                ?>
            </div>
        </div>
        <div class="container">
<h1 class="FeaturedProduct">Dairy Products</h1>
            <div class="row text-left py-2">
               
                <?php
                global $pdo;
                $stmt = $pdo->query("SELECT * FROM products where Categories_CategoryID=6");

                while($row=$stmt->fetch()){
                    Index_Component($row['Pname'],$row['Price'], $row['ProductImageUrl'], $row['ProductID']);
                }

                ?>
            </div>
        </div>





<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>About Us</h3>
                <p>We are a grocery store that provides fresh produce and quality products at affordable prices.</p>
            </div>
            <div class="col-md-4">
                <h3>Contact Us</h3>
                <p>123 Main Street<br>Anytown, USA<br>Phone: 555-555-5555<br>Email: info@grocerystore.com</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; 2023 IntStore. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>






































































