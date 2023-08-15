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
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about.php">About</a></li>
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

            // Autofilling logged in customer's info
            $cid = htmlspecialchars($_SESSION["CID"]);
            // Retriving CUstomer info
            $stmt = $pdo->prepare("SELECT * FROM Customer WHERE CID=:id");
                  $stmt->execute(['id' => $cid]);
                  $crow = $stmt->fetch();
            $name = $crow['Name'];
            $email = $crow['Email'];
            $aid = $crow['Address_AddressID'];
            //echo $aid;
            // retriving Customer's address
            $stmt = $pdo->prepare("SELECT * FROM Address WHERE AddressID=:id");
                  $stmt->execute(['id' => $aid]);
                  $arow = $stmt->fetch();
            $housenum = $arow['houseNumber'];
            $street = $arow['streetName'];
            $city= $arow['City'];
            $province = $arow['Province'];
            $postal = $arow['postalCode'];

            
            if($_SERVER["REQUEST_METHOD"]=="POST") {
                $pid = htmlspecialchars($_POST['pid']);
                $price = htmlspecialchars($_POST['price']);
                $quantity = htmlspecialchars($_POST['quantity']);
                $total = htmlspecialchars($_POST['total']);
                $customerCID = $cid;
                // Get the current timestamp
                $timestamp = date("Y-m-d H:i:s");
                $query = "INSERT INTO `Order` (TimeStamp, BilledAmount, Customer_CID, Products_ProductID) VALUES (:timestamp, :total, :customerCID, :pid)";
                $statement = $pdo->prepare($query);

                // Bind values to the placeholders
                $statement->bindParam(':timestamp', $timestamp);
                $statement->bindParam(':total', $total);
                $statement->bindParam(':customerCID', $customerCID);
                $statement->bindParam(':pid', $pid);

                // Execute the prepared statement
                if ($statement->execute()) {
                    // Redirect to the payment page
                    header("Location: payment.php");
                } else {
                    // Handle error, e.g., display an error message
                    echo "Error inserting data into the database.";
                }
            }
        ?>

        <div class="container">
            <form class="form" method="POST">
                <h2>Checkout</h2>
                <div class="input-group">
                    <label for="fullname"> Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" autocomplete="off" disabled/>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="off" disabled/>
                </div>
                <div class="input-group">
                    <label for="House Number">House Number</label>
                    <input type="text" id="housenum" name="housenum" value="<?php echo isset($housenum) ? $housenum : ''; ?>" autocomplete="off" disabled/>
                </div>
                <div class="input-group">
                    <label for="Street Name">Street Name</label>
                    <input type="text" id="Street" name="Street" value="<?php echo isset($street) ? $street : ''; ?>" autocomplete="off" disabled/>
                </div>
                <div class="input-group">
                    <label for="City">City</label>
                    <input type="text" id="city" name="city" value="<?php echo isset($city) ? $city : ''; ?>" autocomplete="off" disabled/>
                </div>
                <div class="input-group">
                    <label for="province"> Province</label>
                    <input type="text" id='province' name='province' value="<?php echo isset($province) ? $province : ''; ?>"autocomplete="off" disabled/>
                    
                </div>
                <div class="input-group">
                    <label for="Postal Code">Postal Code</label>
                    <input type="text" id="postal" name="postal" value="<?php echo isset($postal) ? $postal : ''; ?>" autocomplete="off" disabled/>
                </div>
                <input type='hidden' name='pid' id='pid' />
                <input type='hidden' name='price' id='price' />
                <input type='hidden' name='quantity' id='quantity'/>
                <input type='hidden' name='total' id='total' /> 
                <button type="submit">Proceed To Pay</button>
            </form>
        </div>
         <script>
            window.onload = ()=> {
                let addedItem = JSON.parse(sessionStorage.getItem('cart'));
                document.getElementById('pid').value =addedItem.pid;
                document.getElementById('price').value =addedItem.price;
                document.getElementById('quantity').value =addedItem.quantity;
                document.getElementById('total').value =addedItem.total;
            }
         </script>               
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