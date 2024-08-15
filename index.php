<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets\css\style.css">

</head>

<body>
    <!--Nav Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
            <img src="assets\imgs\main imgs\logo.png" alt="Cozy_Shark" style="height:50px; width:auto;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-bottons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
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
    <!--HOME-->
    <section id="home">
        <div class="container">
            <h5>Welcome to Cozy Shark</h5>
            <h1><span>Best Deals</span></h1>
            <p>Eshop offers the best products for the most affordable prices</p>
            <button class="main-button mt-3">Shop Now</button>
        </div>
    </section>

    <!--Brand-->
    <!-- <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12"
                src="https://m.media-amazon.com/images/I/71WPPI73PHL.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12"
                src="https://m.media-amazon.com/images/I/71WPPI73PHL.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12"
                src="https://m.media-amazon.com/images/I/71WPPI73PHL.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12"
                src="https://m.media-amazon.com/images/I/71WPPI73PHL.jpg">
        </div>
    </section> -->

    <!--New-->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!--One-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\1.jpg" alt="">
                <div class="details">
                    <h2>Extremely Awesome Shoes</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>

            <!--Two-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\2.jpg" alt="">
                <div class="details">
                    <h2>Awesome Jackets</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>
            <!--Three-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\3.jpg" alt="">
                <div class="details">
                    <h2>50% off tops</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>
        </div>
    </section>

    <!--Featured-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our featured products</h3>
            <hr class="mx-auto">
            <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php
            include('server/get_featured_products.php');
            while ($row = $featured_products->fetch_assoc()) {
            ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                    <a href="<?php echo "item.php?product_id=" . $row['product_id']; ?>">
                        <button class="buy-btn">Buy Now</button>
                    </a>

                </div>
            <?php
            }
            ?>
        </div>
    </section>


    <!--Banner-->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>MID SEASON SALE</h4>
            <h1>Autumn Collection <br> UP to 30% OFF</h1>
            <button class="text-uppercase">Shop Now</button>
        </div>
    </section>

    <!--Clothes-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Dress & Coats</h3>
            <hr class="mx-auto">
            <p>Here you can check out our amazing cloths</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php
            include('server/get_hoodies_products.php');
            while ($row = $category_hoodies->fetch_assoc()) {
            ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                    <a href="<?php echo "item.php?product_id=" . $row['product_id']; ?>">
                        <button class="buy-btn">Buy Now</button>
                    </a>

                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets\imgs\main imgs\logoW.svg" style="height:50px; width: auto; color:white;">
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