<?php include('layouts/header.php') ?>




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
<!-- <section id="new" class="w-100 mt-5">
        <div class="row p-0 m-0">
           
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\1.jpg" alt="">
                <div class="details">
                    <h2>Extremely Awesome Shoes</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>

            
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\2.jpg" alt="">
                <div class="details">
                    <h2>Awesome Jackets</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>
            
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets\imgs\3.jpg" alt="">
                <div class="details">
                    <h2>50% off tops</h2>
                    <button class="text-uppercase btn">Shop Now</button>
                </div>
            </div>
        </div>
    </section> -->

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


<?php
include('layouts/footer.php')
?>