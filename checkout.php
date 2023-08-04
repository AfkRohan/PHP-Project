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
                    <?php if (!empty($_SESSION["UserId"])) { ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="login.php">Login</a></li>
                    <?php } ?>
                </ul>
        </nav>
        
        <div class="container">
            <form class="form" method="POST">
                <h2>Checkout</h2>
                <div class="input-group">
                    <label for="fullname"> Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="House Number">House Number</label>
                    <input type="text" id="housenum" name="housenum" value="<?php echo isset($housenum) ? $housenum : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['housenum']) ? $errors['housenum'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="Street Name">Street Name</label>
                    <input type="text" id="Street" name="Street" value="<?php echo isset($street) ? $street : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['street']) ? $errors['street'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="City">City</label>
                    <input type="text" id="city" name="city" value="<?php echo isset($city) ? $city : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['city']) ? $errors['city'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="Province">Province</label>
                    <input type="text" id="province" name="province" value="<?php echo isset($province) ? $province : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['province']) ? $errors['province'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="Postal Code">Postal Code</label>
                    <input type="text" id="postal" name="postal" value="<?php echo isset($postal) ? $postal : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['postal']) ? $errors['postal'] : ''; ?></span>
                </div>
                <button type="submit">Proceed To Pay</button>
            </form>
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
                <p>123 Main Street<br>Any town, USA<br>Phone: 555-555-5555<br>Email: info@grocerystore.com</p>
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