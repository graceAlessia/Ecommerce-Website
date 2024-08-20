<?php

include('server/dbcon.php');

//search function
if (isset($_POST['search'])) {

    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price <=?");

    $stmt->bind_param("si", $category, $price);

    $stmt->execute();

    $products = $stmt->get_result();



    //return all products 
} else {
    $stmt = $conn->prepare("SELECT * FROM products");

    $stmt->execute();

    $products = $stmt->get_result();
}



?>
<?php include('layouts/header.php') ?>

<!-- Container to hold both search and shop sections side by side -->
<section id="main-section" class="my-5 py-5 mx-3">
    <div class="container mt-5 py-5 mx-auto"> <!-- Changed from mx-5 to mx-3 -->
        <div class="row">

            <!-- Search Section (2 columns wide) -->
            <div id="search" class="col-lg-2 col-md-3 col-sm-12">
                <h4 class="text-uppercase">Search Items</h4>
                <hr>


                <form action="shop.php" method="POST">
                    <div class="row mx-auto container">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>Category</p>
                            <div class="form-check">
                                <input class="form-check-input" value="polo_shirts" type="checkbox" name="category" id="category_one">
                                <label class="form-check-label" for="category_one">
                                    Polo Shirts
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" value="hoodies" type="checkbox" name="category" id="category_two">
                                <label class="form-check-label" for="category_two">
                                    Hoodies
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" value="shirts" type="checkbox" name="category" id="category_three">
                                <label class="form-check-label" for="category_three">
                                    Shirts
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mx-auto container mt-5">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>Price</p>
                            <input type="range" name="price" value="0" class="form-range w-50" min="10" max="500" id="customRange2">
                            <div class="w-50">
                                <span style="float: left;">10</span>
                                <span style="float: right;">500</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group my-3 mx-3">
                        <input type="submit" name="search" value="Search" class="btn">
                    </div>
                </form>
            </div>

            <!-- Shop Section (10 columns wide) -->
            <div id="shop" class="col-lg-10 col-md-9 col-sm-12">
                <h4 class="text-uppercase">Our products</h4>
                <hr>
                <p>Here you can check out our amazing products</p>
                <div class="row">

                    <?php while ($row = $products->fetch_assoc()) { ?>
                        <div onclick="window.location.href='item.html';" class="Shop text-center col-lg-3 col-md-4 col-sm-12 mb-4">
                            <img class="img-fluid item-img mb-3" src="assets\imgs\<?php echo $row['product_image']; ?>">
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                            <a class="btn buy-btn" href="<?php echo "item.php?product_id=" . $row['product_id']; ?>">Buy Now</a>
                        </div>
                    <?php } ?>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-5">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>
    </div>
</section>




<?php
include('layouts/footer.php');
?>