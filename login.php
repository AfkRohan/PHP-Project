<!DOCTYPE html>
<html>
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
            <a href="index.php" class="logo">IntStore</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login</a></li>
                 
                
            </ul>
        </nav>
        
        <?php
            require_once("functions.inc.php");
            redirectIfLoggedIn();
            
            $errors=[];
            
            if($_SERVER["REQUEST_METHOD"]=="POST") {
            
                if (isset($_POST['email'])) {
                    $email = validateData($_POST['email']);
                    if (empty($email)) {
                        $errors['email'] = 'Email is required.';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = 'Please enter a valid email address.';
                    }
                }
                    
                if (isset($_POST['password'])) {
                    $password = ValidateData($_POST['password']);
                    if (empty($password)) {
                        $errors['password'] = 'Password is required.';
                    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $password)) {
                        $errors['password'] = 'Please enter a valid password.';
                    }
                }
                    
                if (count($errors) == 0)
                {
                    // check if the user is registered
                    if (login($_POST["email"],$_POST["password"])) {
                        // Redirect the user to the home page
                        redirectIfLoggedIn();
                        exit();
                    } else {
                        $errors['login'] = 'Invalid email or password.';
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
            <form class="form" method="POST">
                <h2>Login</h2>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <span class="error"><?php echo isset($errors['login']) ? $errors['login'] : ''; ?></span>
                </div>
                
                <button type="submit">Login</button>
                <p class="signup">Don't have an account? <a href="register.php">Sign up</a></p>
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



