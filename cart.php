<?php
require_once("functions.inc.php");
// redirectIfNotLoggedIn();
require_once("db/db_conn.php");
require_once("PHP/component.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if(!isset($_GET['product_id']))
    $id=0;
  else
    $id = $_GET["product_id"];
}
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
        <div class="container">
            <div class="row text-center py-5">
                <?php
                if($id>0){
                  $stmt = $pdo->prepare("SELECT * FROM products WHERE ProductID=:id");
                  $stmt->execute(['id' => $id]);
                  $row = $stmt->fetch();
                cartElement($row['Pname'], $row['Price'], "Images/" . $row['ProductImageUrl'], $row['ProductID']);
                ?>
            </div>
            <div class="row text-center py-5">
                       <div>
                          <input type="number" id='quantity' value="1"   class="form-control w-25 d-inline">
                       </div>
            </div>
            <div class="row text-center py-5">
                       <div>
                          <p id='total'>  </p>
                       </div>
            </div>
            <script>
          let  qty = parseInt(document.getElementById('quantity').value);
          function checkout(){
            let total  = document.getElementById('total').textContent;
            total.replace('CAD','');
            total = parseFloat(total);
            
            let addedItem = {
              pid : <?php echo $row['ProductID'] ?>,
              quantity : qty,
              total : total,
              price : <?php echo $row['Price'] ?>
            }
            sessionStorage.setItem('cart',JSON.stringify(addedItem)); 
            // console.log(JSON.stringify(addedProduct));
            window.location.href='\checkout.php'; 
          }

          function reset(){
            document.getElementsByClassName('container').innerHTML = '<h3> Cart is empty </h3>'
          }

          function calculateTotal(){
            let  qty = parseInt(document.getElementById('quantity').value);
            let total = qty*<?php echo $row['Price']; ?>;
            document.getElementById('total').textContent = total+"CAD";
          }
          document.addEventListener("DOMContentLoaded", calculateTotal);
          document.getElementById('quantity').addEventListener('change',calculateTotal);
        </script> 
        <?php } 
        else { 
          ?>
        <h3> Cart is empty </h3>
        <?php 
        }
        ?>
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
        