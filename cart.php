<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>

    <?php
    session_start();

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
        header('location: index.php');
    }


    //calculate Total Price
    function calculateTotalCart()
    {

        $total = 0;

        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];

            $price = $product['product_price'];

            $quantity = $product['product_quantity'];

            $total =  $total + ($price * $quantity);
        }
        $_SESSION['total'] = $total;
    }
    ?>



    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="assets\css\style.css">
        <link rel="stylesheet" href="assets\css\cart.css">

    </head>

    <body>
        <!--Nav Bar-->
        <nav class=" navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
            <div class="container">
                <img src="assets\imgs\shark.png" alt="Cozy_Shark" style="height:50px; width:auto;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav-bottons" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.html">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.html">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown d-flex ">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="login.html">Login</a></li>
                                <li><a class="dropdown-item" href="register.html">Sign up</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="login.html">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
                </div>
            </div>
        </nav>


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


            </table>
            <div class="cart-total">
                <table>
                    <!-- <tr>
                        <td>Subtotal</td>
                        <td>$155</td>
                    </tr> -->
                    <tr>
                        <td>Total</td>
                        <td>$<?php echo $_SESSION['total']; ?></td>
                    </tr>
                </table>
            </div>


            <div class="checkout-container">
                <form method="POST" action="checkout.php">
                    <input type="submit" class="btn checkout-btn" name="checkout" value="Check Out" />
                </form>

            </div>
        </section>











        <!--Footer-->
        <footer class="mt-5 py-5">
            <div class="row container mx-auto pt-5">
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <img class="logo" src="assets\imgs\shark.png" style="height:50px; width: auto;">
                    <p class="pt-3">We provide the best quality products with fair price.</p>
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Featured</h5>
                    <ul class="text-uppercase">
                        <li><a href="#">men</a></li>
                        <li><a href="#">women</a></li>
                        <li><a href="#">new arrivals</a></li>
                        <li><a href="#">clothes</a></li>
                    </ul>
                </div>

                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb2">Contact us</h5>
                    <div>
                        <h6 class="text-uppercase">Address</h6>
                        <p>1234 Street Name, City</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Phone</h6>
                        <p>123 456 789</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Email</h6>
                        <p>info@gmail.com</p>
                    </div>
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Instagram</h5>
                    <div class="row" style="height: 60px; width: auto;">
                        <img src="assets\imgs\1.jpg" class="img-fluid w-25 h-100 m-2" />
                        <img src="assets\imgs\2.jpg" class="img-fluid w-25 h-100 m-2" />
                        <img src="assets\imgs\3.jpg" class="img-fluid w-25 h-100 m-2" />
                        <img src="assets\imgs\4.jpg" class="img-fluid w-25 h-100 m-2" />

                    </div>
                </div>

            </div>

            <div class="copyright mt-5">
                <div class="row container mx-auto">
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                        <img src="assets\imgs\payment.png" style="height: 50px; width: auto;">
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                        <p>eXommerce @ 2025 All Right Reserved</p>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>


    </body>

    </html>