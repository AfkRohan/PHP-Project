<!DOCTYPE html>
<html>
    <head>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="style.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        
        <?php
            require_once("functions.inc.php");
            redirectIfLoggedIn();
            $errors=[];
            global $pdo;
            $ProductAddedBy = "Deepika Koti";
            
            if($_SERVER["REQUEST_METHOD"]=="POST") {
                if (isset($_POST['fullname'])) {
                    $fullname = validateData($_POST['fullname']);
                    if (empty($fullname)) {
                        $errors['fullname'] = 'Fullname is required.';
                    } elseif (!preg_match("/^[a-zA-Z ]{10,}$/", $fullname)) {
                        $errors['fullname'] = 'Please enter a valid fullname.';
                    }
                }
                    
                if (isset($_POST['email'])) {
                    $email = validateData($_POST['email']);
                    if (empty($email)) {
                        $errors['email'] = 'Email is required.';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = 'Please enter a valid email address.';
                    }
                }
                    
                if (isset($_POST['username'])) {
                    $username = validateData($_POST['username']);
                    if (empty($username)) {
                        $errors['username'] = 'Username is required.';
                    } elseif (!preg_match("/^[a-zA-Z\s.,]*$/", $username)) {
                        $errors['username'] = 'Please enter a valid username.';
                    }
                }
                    
                if (isset($_POST['password'])) {
                    $password = validateData($_POST['password']);
                    if (empty($password)) {
                        $errors['password'] = 'Password is required.';
                    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $password)) {
                        $errors['password'] = 'Please enter a valid password.';
                    }
                }
                
                if (count($errors) == 0)
                {
                    $sql = "INSERT INTO user (FullName, Email, UserName, PasswordHash) VALUES (?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$fullname, $email, $username, password_hash($password, PASSWORD_DEFAULT)]);
                
                    // Redirect the user to the login page
                    header("Location: login.php");
                    exit();
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
                <h2>Sign Up</h2>
                <div class="input-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['fullname']) ? $errors['fullname'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
                </div>
                <button type="submit">Sign Up</button>
                <p class="signup">Already have an account? <a href="login.php">Log in</a></p>
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




























