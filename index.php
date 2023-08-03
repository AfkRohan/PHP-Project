<?php
require_once("functions.inc.php");
// redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Test -->
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" rel="stylesheet">
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
        <li><a href="cart.php">Cart</a></li>
        <?php if (!empty($_SESSION["UserId"])) { ?>
            <li><a href="logout.php">Logout</a></li>
        <?php } else { ?>
            <li><a href="login.php">Login</a></li>
        <?php } ?>
    </ul>
</nav>
<div class="header">
    <div class="row">
        <div class="col-2">
            <h1>It's raining Rollbacks</h1>
            <p>Save m000re on 1000s of your faves..!!</p>
            <p>Shop great sales & offers on select grocery items during<br>
                Instore's Rollback Event.</p>
            <a href="shop.php" class="btn">Explore Now &#8594;</a>
        </div>
        <div class="col-2">
            <img src="images/banner.jpg" width="750px">
        </div>
    </div>
</div>
<?php require_once("db/db_conn.php"); ?>

<div class="container">
<div class="row text-center py-5">
    <?php
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products");
    <?php
    // Step 4: Display products on the index page
    if ($stmt->num_rows > 0) {
        while ($row = $stmt->fetch_assoc()) {
            echo "<li>";
            echo "<strong>Name:</strong> " . $row['Pname'] . "<br>";
            echo "<strong>Price:</strong> $" . $row['Price'] . "<br>";
            echo "<strong>Description:</strong> " . $row['ProductDescription'] . "<br>";
            echo " <a href='cart.php?id=" . $row["id"] . "' class='btn'>Add to Cart</a>";
            echo "</li>";
        }
    } else {
        echo "No products found.";
    }
    ?>
    
   
</div>
</div>


?>
<div>

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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>






































































