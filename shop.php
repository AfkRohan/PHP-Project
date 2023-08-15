<?php
    require_once('functions.inc.php');
    require_once ('./PHP/component.php');
    require_once('db/db_conn.php');
    
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_POST['filter']))
            $_POST['filter']=="";
    }

    if (isset($_POST['add'])){
        if(isset($_SESSION['cart'])){

            $item_array_id = array_column($_SESSION['cart'], "product_id");

            if(in_array($_POST['product_id'], $item_array_id)){
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo "<script>window.location = 'index.php'</script>";
            }else{

                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_id' => $_POST['product_id']
                );

                $_SESSION['cart'][$count] = $item_array;
            }

        }else{
//            echo("Adding item 0");
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            // Create new session variable
            $_SESSION['cart'][0] = $item_array;
            echo($_SESSION['cart']);
        }
    }
?>


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

        a{
            color: #000504;
        }

        a:hover{
            text-decoration: none;
            color: #000504;
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
                <?php if (!empty($_SESSION["UserId"])) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </nav>

      
        <div class="container">
            <div class="row text-center py-5">
             <form method='post' action ="<?php echo $_SERVER['PHP_SELF']; ?>" >      
            <select name='filter' class="form-select form-select-lg mb-3" id='filter'>
            <option value='' selected>  Choose a category... </option>
            <option value='2'> Electronics </option>
            <option value='3'> Utensil </option>
            <option value='4'> Beverages </option>
            <option value='5'> Bakery </option>
            <option value='6'> Dairy </option>
            <option value='7'> Stationary </option>
            <option value='1'> Ready to eat </option>
            </select>
            <button type='submit' > filter Items </button>
            </form>
        </div>
            <div class="row text-center py-5">
                <?php
                if(isset($_POST['filter']) && $_POST['filter']!=""){
                    $filter = htmlspecialchars($_POST['filter']);
                    $stmt = $pdo->prepare("SELECT * FROM Products WHERE Categories_CategoryID=:id");
                    $stmt->execute(['id' => $filter]);

                while($row=$stmt->fetch()){
                   new Component($row['Pname'], $row['Price'],$row['ProductDescription'] ,$row['ProductImageUrl'], $row['ProductID']);
                }

                }
                else{
                $stmt = $pdo->query("SELECT * FROM products");

                while($row=$stmt->fetch()){
                   new Component($row['Pname'], $row['Price'],$row['ProductDescription'] ,$row['ProductImageUrl'], $row['ProductID']);
                }
                 }
                ?>
            </div>
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







