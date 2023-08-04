<?php
function component($product_name, $product_price,$product_desc ,$image, $id){
    $product_image = "Images/{$image}";
    $element = "
     <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
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
                                <span class=\"price\">$product_price</span>
                            </h5>
                            <button type=\"submit\" class=\" my-3\" name=\"add\" id=\"btnATC\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$id'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($product_name, $product_price, $product_image, $id)
{   
    
    $element = "
    
    <form action=\"cart.php\" method=\"get\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$product_image alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$product_name</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$product_price</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                          
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <input type=\"number\" id='quantity' value=\"1\" class=\"form-control w-25 d-inline\">
                                </div>
                            </div>
                        </div>
                        <div id='total'>
                        </div>
                    </div>
                </form>
    ";
    echo  $element;
}
function Index_Component($product_name, $product_price,$image, $id){
    $product_image = "Images/{$image}";
    $element = "
     <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
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
                                
                                <span class=\"price\">$product_price</span>
                            </h5>

                            <button type=\"submit\" class=\" my-3\" name=\"add\"id=\"btnATC\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$id'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}