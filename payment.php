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
            $errors=[];
   
            $ProductAddedBy = "Admin";
            $cid = $_SESSION["CID"];
            if($_SERVER["REQUEST_METHOD"]=="POST") {

                // Validate Card Type
                if (isset($_POST['cardType'])) {
                    $cardType = validateData($_POST['cardType']);
                    if (empty($cardType)) {
                        $errors['cardType'] = "Card type is required";
                    } elseif (!in_array($cardType, ['visa', 'master', 'american express'])) {
                        $errors['cardType'] = "Invalid card type selected";
                    }
                }
                
                //validate card number 
                if (isset($_POST['cardNumber'])) {
                    $cardNumber = validateData($_POST['cardNumber']);
                    if (empty($cardNumber)) {
                        $errors['cardNumber'] = "Card number is required";
                    } elseif (!preg_match("/^\d{16}$/", $cardNumber)){
                        $errors['cardNumber'] = "Invalid card number (16 digits required)";
                    }
                }

                //validate expiry date
                if (isset($_POST['expiryDate'])) {
                    $expiryDate = validateData($_POST['expiryDate']);
                    if (empty($expiryDate)) {
                        $errors['expiryDate'] = "Expiry Date is required";
                    } elseif (!preg_match("/^(0[1-9]|1[0-2])\/\d{4}$/", $expiryDate)){
                        $errors['expiryDate'] = "Invalid expiry date (MM/YYYY)";
                    }
                }

                //validate CVV
                if (isset($_POST['CVV'])) {
                    $cvv = validateData($_POST['CVV']);
                    if (empty($cvv)) {
                        $errors['CVV'] = "CVV is required";
                    } elseif (!preg_match("/^\d{3}$/", $cvv)){
                        $errors['CVV'] = "Invalid CVV (3 digits required)";
                    }
                }

                if (count($errors) == 0) {
                    $sql = "INSERT INTO `Card` (CardNumber, CVV, ExpiryDate, CardType, Customer_CID) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                
                    $stmt->bindParam(1, $cardNumber);
                    $stmt->bindParam(2, $cvv);
                    $stmt->bindParam(3, $expiryDate);
                    $stmt->bindParam(4, $cardType);
                    $stmt->bindParam(5, $cid);
                
                    // Execute the first insert
                    if ($stmt->execute()) {

                        // Retrieve the OrderID using Customer_CID
                        $orderSql = "SELECT OrderID FROM `Order` WHERE Customer_CID = ?";
                        $orderStmt = $pdo->prepare($orderSql);
                        $orderStmt->bindParam(1, $cid);
                        if ($orderStmt->execute()) {
                            $orderRow = $orderStmt->fetch(PDO::FETCH_ASSOC);
                            $orderId = $orderRow['OrderID'];
                
                            // Insert into Payment table
                            $paymentSql = "INSERT INTO `Payment` (Order_OrderID, Card_CardNumber) VALUES (?, ?)";
                            $paymentStmt = $pdo->prepare($paymentSql);

                            $paymentStmt->bindParam(1, $orderId);
                            $paymentStmt->bindParam(2, $cardNumber);
                
                            // Execute the second insert
                            if ($paymentStmt->execute()) {
                                header("Location: thanks.php");
                                exit();
                            } 
                        } 
                    }
                }
                
                
            }
            function validateData($data) {
                $data = strip_tags($data);
                $data = htmlentities($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <div class="container">
            <form class="form" method="POST" autocomplete="off">
                <h2>Choose Payment Option</h2>
                <div class="input-group">
                    <label for="cardType">Card Type:</label>
                    <select class="input" id="cardType" name="cardType">
                        <option value="" disabled selected>Select Card Type</option>
                        <option value="visa">Visa</option>
                        <option value="master">Master</option>
                        <option value="american express">American Express</option>
                    </select>
                    <span class="error"><?php echo isset($errors['cardType']) ? $errors['cardType'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" value="<?php echo isset($cardNumber) ? $cardNumber : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['cardNumber']) ? $errors['cardNumber'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="expiryDate">Expiry Date:</label>
                    <input type="text" id="expiryDate" name="expiryDate" value="<?php echo isset($expiryDate) ? $expiryDate : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['expiryDate']) ? $errors['expiryDate'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="CVV">CVV:</label>
                    <input type="text" id="CVV" name="CVV" value="<?php echo isset($cvv) ? $cvv : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['CVV']) ? $errors['CVV'] : ''; ?></span>
                </div>
                <button type="submit">Place Order</button>
            </form>
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
                <p>123 Main Street<br>Any town, USA<br>Phone: 555-555-5555<br>Email: info@grocerystore.com</p>
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