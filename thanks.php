<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <!--CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" integrity="sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        .error {
                color:red;
        }
        </style>
        <!--Jss-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </head>

    <body>
        <nav class="navbar">
            <a href="#" class="logo">NightOwls Utility Store</a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <?php if (!empty($_SESSION["CID"])) { ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="login.php">Login</a></li>
                    <?php } ?>
                </ul>
        </nav>
        <?php 
            require_once("functions.inc.php");
            redirectIfNotLoggedIn();
   
            $ProductAddedBy = "Admin";
            $cid = htmlspecialchars($_SESSION["CID"]);
            $stmt = $pdo->prepare("SELECT * FROM Customer WHERE CID=:id");
                  $stmt->execute(['id' => $cid]);
                  $crow = $stmt->fetch();
            $cname = $crow['Name'];
        ?>
        <div class="container" style="height:300px">
            <h1 style="color: Blue">Thank You <?php echo isset($cname) ? $cname : ''; ?>, For Choosing to Shop with Us.</h1>
            <p>your order has been placed.</p>
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