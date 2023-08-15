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
            <a href="#" class="logo">NightOwls Utility Store</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        
        <?php
            require_once("functions.inc.php");
            redirectIfLoggedIn();
            $errors=[];
   
            
            if($_SERVER["REQUEST_METHOD"]=="POST") {
                if (isset($_POST['Name'])) {
                    $Name = validateData($_POST['Name']);
                    if (empty($Name)) {
                        $errors['Name'] = 'Name is required.';
                    } elseif (!preg_match('/^[A-Za-z\'\-\s]+$/', $Name)) {
                        $errors['Name'] = 'Please enter a valid Name.';
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
                    
             
                if (isset($_POST['password'])) {
                    $password = validateData($_POST['password']);
                    if (empty($password)) {
                        $errors['password'] = 'Password is required.';
                    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $password)) {
                        $errors['password'] = 'Please enter a valid password.';
                    }
                    $_POST['password']=password_hash($password, PASSWORD_DEFAULT);
                }
                if (isset($_POST['housenumber'])) {
                    $housenumber = validateData($_POST['housenumber']);
                    if (empty($housenumber)) {
                        $errors['housenumber'] = 'housenumber is required.';
                    } elseif (!preg_match('/^\d+[A-Za-z]?$/', $housenumber)) {
                        $errors['housenumber'] = 'Please enter a valid housenumber.';
                    }
                }
                if (isset($_POST['streetname'])) {
                    $streetname = validateData($_POST['streetname']);
                    if (empty($streetname)) {
                        $errors['streetname'] = 'streetname is required.';
                    } 
                }
                if (isset($_POST['city'])) {
                    $city = validateData($_POST['city']);
                    if (empty($city)) {
                        $errors['city'] = 'City is required.';
                    } 
                }
                if(empty($_POST["province"])){
                    $errors['province']="<p> province is required. </p>";
                    }
                    else{
                        $province=htmlspecialchars($_POST["province"]);
                        if(!in_array($province, ["AB","BC","MB","NB","NL","NS","NT","NU","ON","PE","QC","SK","YT"])){
                            $errors['province']="<p> Province is invalid </p>";
                        }
                    }
                    
                    if (isset($_POST['postalcode'])) {
                        $postalcode = validateData($_POST['postalcode']);
                        if (empty($postalcode)) {
                            $errors['postalcode'] = 'postalcode is required.';
                        } elseif (!preg_match('/^[A-Za-z]\d[A-Za-z] ?\d[A-Za-z]\d$/', $postalcode)) {
                            $errors['postalcode'] = 'Please enter a valid postalcode.';
                        }
                    }
                    
                    
                if (count($errors) == 0)
                {
                    $sql = "INSERT INTO address (houseNumber, streetName, City,Province, postalCode) 
                    VALUES ('$housenumber', '$streetname', '$city','$province', '$postalcode')";
                $result = $pdo->query($sql);
                    if($result){
                      
                        $AddressID = $pdo->lastInsertId(); 
                       // echo $AddressID;
                        $sqlCustomer = "INSERT INTO customer (Name, Email, Password_hash, Address_AddressID) 
                                         VALUES ('$Name', '$email','$password',' $AddressID')";
                                          $result1 = $pdo->query($sqlCustomer);
                                        
                    }

                    
                    // Redirect the user to the login page
                    header("Location: login.php");
                    exit();
                }
            }
            function validateData($data) {
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        
        <div class="container">
            <form class="form" method="POST" autocomplete="off">
                <h2>Sign Up</h2>
                <div class="input-group">
                    <label for="Name"> Name</label>
                    <input type="text" id="Name" name="Name" value="<?php echo isset($Name) ? $Name : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['Name']) ? $errors['Name'] : ''; ?></span>
                </div>
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
                    <label for="housenumber"> House Number</label>
                    <input type="text" id="housenumber" name="housenumber" value="<?php echo isset($housenumber) ? $housenumber : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['housenumber']) ? $errors['housenumber'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="streetname"> Street Name</label>
                    <input type="text" id="streetname" name="streetname" value="<?php echo isset($streetname) ? $streetname : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['streetname']) ? $errors['streetname'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="city"> City</label>
                    <input type="text" id="city" name="city" value="<?php echo isset($city) ? $city : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['city']) ? $errors['city'] : ''; ?></span>
                </div>
                <div class="input-group">
                    <label for="province"> Province</label>
                    <select class="input" id='province' name='province' >
                <?php
                    $provinces=["AB","BC","MB","NB","NL","NS","NT","NU","ON","PE","QC","SK","YT"];
                    foreach($provinces as $value){
                        echo " <option value='$value'>$value</option>";
                        
                    }
                    
                ?>
            </select>
                    <span class="error"><?php echo isset($errors['province']) ? $errors['province'] : ''; ?></span>
                </div>

          
                <div class="input-group">
                    <label for="postalcode"> Postal Code</label>
                    <input type="text" id="postalcode" name="postalcode" value="<?php echo isset($postalcode) ? $postalcode : ''; ?>" autocomplete="off"/>
                    <span class="error"><?php echo isset($errors['postalcode']) ? $errors['postalcode'] : ''; ?></span>
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