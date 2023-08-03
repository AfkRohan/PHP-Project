<?php
    require_once("functions.inc.php");
    // redirectIfNotLoggedIn();
    require_once("db/db_conn.php");
    $id=1;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE ProductID=:id");
    $stmt->execute(['id' => $id]); 
    $product = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
   <!-- Test-3 -->
    <head>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <style>
            .error {
                color:red;
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <a href="#" class="logo">IntStore</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <?php if (!empty($_SESSION["UserId"])) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </nav>

        <div class="product">
                <div class="product_image">
                    <img src="<?php echo $product['ProductImageUrl']
                    ?>" alt="Product Image" width="300px" height="400px">
                </div>
                <div class="product_content">
                    <h3> <?php echo $product['Pname']
                    ?> </h3>
                    <p> <?php echo $product['ProductDescription']
                    ?>
                </p>
                </div>
        </div>        
        <div>
          <h3> <?php $product['Price'] ?>  </h3>
          <button> Add to cart </button>
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
    </body>
</html>
        