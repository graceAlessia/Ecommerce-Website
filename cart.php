<?php
include('layouts/header.php');

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    // If user has already added a product to cart
    if (isset($_SESSION['cart'])) {

        $product_array_ids = array_column($_SESSION['cart'], "product_id");

        // If product has not already been added to cart
        if (!in_array($product_id, $product_array_ids)) {


            // $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("Product was already added to cart")</script>';
        }
    } else {
        // If this is the first product
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );
        $_SESSION['cart'][$product_id] = $product_array;
        // [ 2=>[], 3=>[], 5=>[]]
    }

    //calculate total
    calculateTotalCart();








    //remove product from cart
} else if (isset($_POST['remove_product'])) {

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]); //unset function for removing  
    calculateTotalCart();
} else if (isset($_POST['edit_quantity'])) {
    //to get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];
    //update product quantity 
    $product_array['product_quantity'] = $product_quantity;
    //return array back
    $_SESSION['cart'][$product_id] = $product_array;
    calculateTotalCart();
} else {
    // header('location: index.php');
}


//calculate Total Price
function calculateTotalCart()
{

    $total_price = 0;

    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];

        $quantity = $product['product_quantity'];

        $total_price =  $total_price + ($price * $quantity);

        $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}




?>


<?php include('layouts/header.php') ?>


<!--Cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Your Shopping List</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php if (isset($_SESSION['cart'])) { ?>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                            <div class="product-details">
                                <p class="mb-0"><?php echo $value['product_name']; ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>

                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                                    <input type="submit" name="remove_product" value="Remove" class="remove-btn width=100%" />
                                </form>

                            </div>
                        </div>
                    </td>
                    <td>

                        <form method="POST" action="cart.php" class="container row">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" class="quantity-btn" value="<?php echo $value['product_quantity'] ?>" />
                            <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
                        </form>

                    </td>
                    <td>
                        <span>$</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>


    </table>
    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <?php if (isset($_SESSION['cart'])) { ?>
                    <td>$<?php echo $_SESSION['total']; ?></td>
                <?php } ?>
            </tr>
        </table>
    </div>


    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="submit" class="button checkout-btn" name="checkout" value="Check Out" />
        </form>

    </div>
</section>








<?php include('layouts/footer.php') ?>