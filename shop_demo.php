
<?php
    require_once("functions.inc.php");
    require_once("db/db_conn.php");

    // redirectIfNotLoggedIn();
?>

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
            <a href="#" class="logo">IntStore</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop_demo.php">Categories</a></li>
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
            
            <h1>Under Maintenance</h1>


            <div class="products">
			<?php
                global $pdo;

				$sql = "SELECT * FROM products";
				$result = $pdo->query($sql);
				if ($result->num_rows > 0) {
				    // Output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<div class='product'>
				        	<a href='products.php?id=" . $row["id"] . "'><img src='" . $row["image_url"] . "'></a>
				        	<h2><a href='products.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></h2>
				        	<span class='price'>$" . $row["price"] . "</span>
				        	<a href='cart.php?id=" . $row["id"] . "' class='btn'>Add to Cart</a>
				        </div>";
				    }
				} else {
				    echo "0 results";
				}
				$pdo->close();
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

!--                <section class="product">-->
    <!---->
    <!---->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2>Product Name</h2>-->
    <!--                    <img src="./Images/Chekaralu.jpg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$8.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2>Product Name</h2>-->
    <!--                    <img src="./Images/Haldiram%20Bhel%20Puri.png" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$9.10</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2>Product Name</h2>-->
    <!--                    <img src="./Images/Mathri.png" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.95</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2>Product Name</h2>-->
    <!--                    <img src="./Images/Smiths-Chips.png" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$8.65</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2>Product Name</h2>-->
    <!--                    <img src="./Images/Violet_Crumble_Chunks.jpg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$4.56</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/samosa.jpeg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/spicy-style-korean-bbq.jpeg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/naan-bread.jpeg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/channa-masala.jpg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section><section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/spam.jpeg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->
    <!--                <section class="product">-->
    <!--                    <h2> Aussie Fantales</h2>-->
    <!--                    <img src="./Images/dal-makhani.jpeg" alt="Product Image">-->
    <!--                    <p>Description of the product.</p>-->
    <!--                    <p>$5.99</p>-->
    <!--                    <button>Add to Cart</button>-->
    <!--                </section>-->

    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/gulab-jamun.jpeg" alt=" GulabJammunImage" class="img-fluid card-img">
                    <div class="card-body">
                        <h5 class="card-title">Product.</h5>
                        <p class="card-text">
                            Indian Sweat
                        </p>
                        <h5>
                            <small><s class="text-secondary">$10.19</s></small>
                            <span class="price">$7.49</span></h5>
                        <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/dal-makhani.jpeg" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>

    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/Chekaralu.jpg" alt="GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/Violet_Crumble_Chunks.jpg" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/dumpling.jpeg" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/samosa.jpeg" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/allens-fantales.jpg" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/Haldiram%20Bhel%20Puri.png" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
        <form action="index.php" method="post">
            <div class="card shadow">
                <div>
                    <img src="./Images/Mathri.png" alt=" GulabJammunImage" class="img-fluid card-img-top"></div>
                <div class="card-body">
                    <h5 class="card-title">Product.</h5>

                    <p class="card-text">
                        Indian Sweat
                    </p>
                    <h5>
                        <small><s class="text-secondary">$10.19</s></small>
                        <span class="price">$7.49</span></h5>
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>

                </div>
            </div>
    </div>
























