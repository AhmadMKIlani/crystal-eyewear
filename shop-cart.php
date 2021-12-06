<?php
session_start();

require_once "includes/db.php";
$cartCheck=isset($_SESSION['shopping_cart']);

//clear cart
if($cartCheck){
    if(isset($_GET['clear_cart'])){
        unset($_SESSION['shopping_cart']);
        header("Location: shop-cart.php");
        exit();
    }

}
//delete the cart
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $i = 0;
    foreach ($_SESSION['shopping_cart'] as $product) {
        if ($product['product_id'] === $id) {
            if (count($_SESSION['shopping_cart']) === 1) {
                unset($_SESSION['shopping_cart']);
                header("Location:shop-cart.php");
            }
            unset($_SESSION['shopping_cart'][$i]);
            header("Location:shop-cart.php");
        }
        $i++;
    }
}
//----------------------------------------------------------------
//adding to the shopping cart
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $quantity=$_GET['quantity']??1;
    //check if the product is already in the session
    $check = false;
    $products_counter=0;
    if (isset($_SESSION['shopping_cart'])) {
        //loop through all products in the session to check if it's excists

        foreach ($_SESSION['shopping_cart'] as $product) {
            if ($id === $product["product_id"]) {
                $check = true;
                $_SESSION['shopping_cart'][$products_counter]['product_quantity']=$quantity;
            }
            $products_counter++;
        }
    } else {
        $check = false;
    }
    if (!$check) {
        $statement = $connection->prepare("SELECT * FROM products WHERE product_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);
        if ($product):
            $_SESSION['shopping_cart'][] =$product;
            $_SESSION['shopping_cart'][$products_counter]["product_quantity"]=(int)$quantity;
            $products_counter++;
            if(isset($_GET['shop'])){
                header("location:shop.php");
                exit();
            }


        endif;

    }
    else{
        if(isset($_GET['shop'])){
            header("location:shop.php");
            exit();
        }

    }

}
//-------------------------------------------
//update shopping cart
if(isset($_GET['update'])){
    if(!$cartCheck){
        header("location: shop-cart.php");
        exit();
    }
    if($cartCheck):
    $total_products=count($_SESSION['shopping_cart']);
    for($i=0;$i<$total_products;$i++){
        if($_SESSION['shopping_cart'][$i]['product_id'])
        $product_id= $_SESSION['shopping_cart'][$i]['product_id'];

        //if(($_GET["quantity{$product_id}"]!==1)):
        $_SESSION['shopping_cart'][$i]['product_quantity']=(int)$_GET["quantity{$product_id}"];
        //endif;
    }


    endif;

    
}
// var_dump($_SESSION['shopping_cart']);
// die;
//
include("./includes/public-header.php");

?>

    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="container">

        <div class="page-header-area" >
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Shopping Cart</h2>
                        </div>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Shopping Cart</li>
                                </ul>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Blog Area Wrapper ==-->
        <section class="shopping-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shopping-cart-form table-responsive">
                            <form action="" method="get">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumb">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!isset($_SESSION['shopping_cart'])): ?>
                                        <h4 class="center-cart" >Your cart is empty</h4>
                                    <?php endif; ?>
                                    <?php
                                    if (isset($_SESSION["shopping_cart"])):
                                        $i=0;


                                        foreach ($_SESSION["shopping_cart"] as $product):
                                            $price=0;
                                            $order_total=0;
                                            if ($product["product_percentage_price"]) {
                                                $price=$product['product_price']-((int)$product['product_price'])*(((int)$product['product_percentage_price'])*0.01);
                                                $price=(int)$price;

                                            }
                                            else{
                                            $price=$product['product_price'];
                                            }
                                            $order_total+=(int)($price)*$product['product_quantity'];
                                            ?>
                                            <tr class="cart-product-item">
                                                <td class="product-remove">
                                                    <a href="shop-cart.php?delete=<?php echo $product['product_id'] ?>"><i
                                                                class="fa fa-trash-o"></i></a>
                                                </td>
                                                <td class="product-thumb">
                                                    <a href="single-product.php">
                                                        <img src="<?php echo "admin/assets/media/products_images/{$product['product_image']}" ?>" width="90"
                                                             height="110"
                                                             alt="<?php echo $product['product_description']; ?>">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <h4 class="title"><a
                                                                href="single-product.php?id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name'] ?></a>
                                                    </h4>
                                                </td>
                                                <td class="product-price">
                                                        <span class="price">$<?php echo $price;?></span>
                                                </td>
                                                <td class="product-quantity">
                                                    <div><?php echo $product['product_quantity']?? "1"; ?></div>
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity<?php echo $product['product_id'];?>" value="<?php echo $product['product_quantity']?>" class="quantity"
                                                               title="Quantity" value="1">
                                                    </div>


                                                </td>
                                                <td class="product-subtotal">
                                                    <span class="price">$<?php echo $order_total ?></span>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach;
                                    endif;
                                    ?>


                                    <tr class="actions">
                                        <td class="border-0" colspan="6">
                                            <button type="submit" name="update" class="update-cart">Update cart</button>
                                           <button type="button"> <a  href="shop-cart.php?clear_cart=true" class="clear-cart">Clear Cart</a></button>
                                            <a href="shop.php" >Continue Shopping</a>
                                        </td>

                                    </tr>
                                    <tr class="actions">
                                        <td class="border-0" colspan="9">
                                        <a class="btn-theme btn-flat22" href="shop-checkout.php">Proceed to checkout</a>

                                        </td>

                                    </tr>

                                    </tbody>
                                </table>

                            </form>

                        </div>
                    </div>
                </div>
           
            </div>
        </section>
        <!--== End Blog Area Wrapper ==-->
    </main>
<?php
include("./includes/public-footer.php");
?>