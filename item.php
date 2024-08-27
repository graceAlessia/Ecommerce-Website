<?php

// Ensure $conn is already initialized and represents a valid MySQLi connection
include('server\dbcon.php');
include('layouts/header.php');
if (isset($_GET['product_id'])) {


    $product_id = $_GET['product_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

    // Bind the parameter
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $product = $stmt->get_result(); //one item

    // Fetch the product data (if you want to get the row as an associative array)
    // $product = $result->fetch_assoc();
} else {
    // Redirect if product_id is not set
    header('Location: index.php');
    exit(); // It's good practice to use exit after a header redirection
}

?>

<?php include('layouts/header.php') ?>


<!--Item-->
<section class="container item my-5 pt-5">
    <?php while ($row = $product->fetch_assoc()) { ?>

        <div class="row mt-5">

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets\imgs\<?php echo $row['product_image']; ?>" id="mainImg">
                <div class="small-img-group my-2">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" height="auto" class="small-img" data-main-image="assets/imgs/<?php echo $row['product_image']; ?>">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" height="auto" class="small-img" data-main-image="assets/imgs/<?php echo $row['product_image2']; ?>">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" height="auto" class="small-img" data-main-image="assets/imgs/<?php echo $row['product_image3']; ?>">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" height="auto" class="small-img" data-main-image="assets/imgs/<?php echo $row['product_image4']; ?>">
                    </div>
                </div>

            </div>


            <div class="col-lg-6 col-md-12 col-12">
                <h6 class="text-uppercase"><?php echo $row['product_category']; ?></h6>
                <h4 class="py-4"><?php echo $row['product_name']; ?></h4>
                <h2>$<?php echo $row['product_price']; ?></h2>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1" />
                    <button class="btn add-to-cart" type="submit" name="add_to_cart">Add To Cart</button>
                </form>
                <h4 class="mt-5 mb-3">Product Details</h4>
                <hr>
                <h5><span><?php echo $row['product_description']; ?>
                    </span></h5>
                <br>
                <p><b>Color: </b><span><?php echo $row['product_color']; ?> </p>
            </div>


        </div>

    <?php } ?>
</section>



<!--Related products-->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h4 class="text-uppercase">Other related Products</h4>
        <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
        <?php
        include('server/get_other_products.php');
        while ($row = $result->fetch_assoc()) {
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
                    <button class="btn buy-btn">Buy Now</button>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</section>








<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
        smallImg[i].onclick = function() {
            mainImg.src = smallImg[i].src
        }

    }
</script>
<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < smallImg.length; i++) {
        smallImg[i].addEventListener("mouseover", function() {
            mainImg.src = this.getAttribute("data-main-image");
        });
    }
</script>

<?php include('layouts/footer.php') ?>