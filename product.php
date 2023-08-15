<?php
    require_once("functions.inc.php");
    require_once("db/db_conn.php");
    if(isset($_GET['id']))
      $id=htmlspecialchars($_GET['id']);
    else
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

            .product{
              gap:10px;
              margin-top:4px;
              margin-bottom:4px;
            }
            
            .product-content{
                display: flex;
                flex-direction: column;
                place-content: center;
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <a href="#" class="logo"> NightOwls Utility Store </a>
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
                <div class="product-image">
                    <img src="Images/<?php echo $product['ProductImageUrl']
                    ?>" alt="Product Image"  >
                </div>
                <div class="product-content">
                    <h2> <?php echo $product['Pname']
                    ?> </h2>
                    <p> <?php echo $product['ProductDescription']
                    ?>
                </p>
                <h3> <?php echo $product['Price']." CAD"; ?>  </h3>
                <div>
                  <form method='get' action='cart.php'>
                    <input type='hidden' value='<?php echo $id ?>' name='product_id'>
                <button type='submit' class=" my-3" > Add to cart </button> 
                </form>
               </div>   
                </div>
        </div>        
        <footer class="footer">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <h3>About Us</h3>
                <p>We provide Utility goods,and other household products at affordable prices..</p>
              </div>
              <div class="col-md-4">
                <h3>Contact Us</h3>
                <p>999 Barrie Street<br>Barrie, Canada<br>Phone: 456-888-9090<br>Email: support@nightowls.com</p>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container">
              <p>&copy; 2023NightOwls Utility Store All Rights Reserved.</p>
            </div>
          </div>
        </footer>
    </body>
</html>
        