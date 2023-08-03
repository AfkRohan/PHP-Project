
<?php
// Start session
session_start();

// Include necessary files
require_once 'config.php';
require_once 'functions.php';

// Get products from database
$products = get_products();

// Check if product was added to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_qty = $_POST['product_qty'];
    add_to_cart($product_id, $product_qty);
}

// Display products
foreach ($products as $product) {
    ?>
    <div class="product">
        <h2><?php echo $product['name']; ?></h2>
        <p><?php echo $product['description']; ?></p>
        <p>$<?php echo $product['price']; ?></p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="product_qty">Quantity:</label>
            <input type="number" name="product_qty" value="1" min="1" max="10">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
    <?php
}

// Display shopping cart
$cart = get_cart();
if (!empty($cart)) {
    ?>
    <h2>Shopping Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cart as $item) {
                $product = get_product($item['product_id']);
                $subtotal = $product['price'] * $item['product_qty'];
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                    <td><?php echo $item['product_qty']; ?></td>
                    <td>$<?php echo $subtotal; ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="3">Total:</td>
                <td>$<?php echo get_cart_total(); ?></td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>
