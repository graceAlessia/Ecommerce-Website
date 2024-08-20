<?php

include('server/dbcon.php');

//search function
if (isset($_POST['search'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        //after clicking page no button //1. determine page no
        $page_no = $_GET['page_no'];
    } else {
        //first presentation//default page 1
        $page_no = 1;
    }
    $category = $_POST['category'];
    $price = $_POST['price'];
    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3, products per page 
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    //4. get all products

    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset, $total_records_per_page");
    $stmt2->bind_param('si', $category, $price);
    $stmt2->execute();

    $products = $stmt2->get_result(); //[]




    //return all products //pagination 
} else {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        //after clicking page no button //1. determine page no
        $page_no = $_GET['page_no'];
    } else {
        //first presentation//default page 1
        $page_no = 1;
    }
    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();


    //3, products per page 
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    //4. get all products

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");

    $stmt2->execute();

    $products = $stmt2->get_result();
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
                                <input class="form-check-input" value="polo_shirts" type="radio" name="category" id="category_one" <?php if (isset($category) && $category == 'polo_shirts') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="category_one">
                                    Polo Shirts
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" value="hoodies" type="radio" name="category" id="category_two" <?php if (isset($category) && $category == 'hoodies') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                <label class="form-check-label" for="category_two">
                                    Hoodies
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" value="shirts" type="radio" name="category" id="category_three" <?php if (isset($category) && $category == 'shirts') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                <label class="form-check-label" for="category_three">
                                    Shirts
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mx-auto container mt-5">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>Price</p>
                            <input type="range" name="price" value="<?php if (isset($price)) {
                                                                        echo $price;
                                                                    } else {
                                                                        echo "100";
                                                                    } ?>
" class="form-range w-50" min="10" max="500" id="customRange2">
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
                            <li class="page-item<?php if ($page_no <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                                <a class="page-link" href="<?php if ($page_no <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page_no=" . ($page_no - 1);
                                                            } ?>">Previous</a>
                            </li>


                            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                            <?php if ($page_no >= 3) { ?>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . ($page_no) ?>"><?php echo $page_no; ?></a></li>
                            <?php } ?>

                            <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page_no=" . ($page_no + 1);
                                                            } ?>">Next</a>
                            </li>

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