<?php
function component($product_name, $product_price,$product_desc ,$image, $id){
    $product_image = "Images/{$image}";
    $element = "
     <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
            <a href='product.php?id=$id'>
                <form action=\"cart.php\" method=\"get\">
                    <div class=\"card shadow\">
                    <div>
                    <img src='$product_image' alt=\"Image1\" class=\" img-fluid card-img-top\" id=\"pImage\">
                </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$product_name</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                $product_desc
                            </p>
                            <h5> 
                                <span class=\"price\">$product_price CAD</span>
                            </h5>
                            <button type=\"submit\" class=\" my-3\" name=\"add\" id=\"btnATC\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$id'>
                        </div>
                    </div>
                </form>
                </a>
            </div>
    ";
    echo $element;
}

function cartElement($product_name, $product_price, $product_image, $id)
{   
    
    $element = "
    
    <div class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$product_image alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$product_name</h5>
                                <small class=\"text-secondary\">Seller: Nightowls</small>
                                <h5 class=\"pt-2\">$product_price CAD</h5>
                                <button onclick='checkout()' class=\"btn btn-warning\">Proceed to Checkout</button>
                                <form method='get' action='cart.php'>
                                <input type='hidden' value='0'  id='productID' name='product_id' /> 
                                <button type='submit' class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    ";
    echo  $element;
}
function Index_Component($product_name, $product_price,$image, $id){
    $product_image = "Images/{$image}";
    $element = "
     <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
     <a href='product.php?id=$id'>
                <form action=\"cart.php\" method=\"get\">
                    <div class=\"card shadow\">
                        <div class=\"imageclass\">
                            <img src='$product_image' alt=\"Image1\" class=\" img-fluid card-img-top\" id=\"pImage2\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$product_name</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                         
                            <h5>
                                
                                <span class=\"price\">$product_price CAD</span>
                            </h5>

                            <button type=\"submit\" class=\" my-3\" name=\"add\"id=\"btnATC\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_id' value='$id'>
                        </div>
                    </div>
                </form>
                </a> 
            </div>
    ";
    echo $element;
}