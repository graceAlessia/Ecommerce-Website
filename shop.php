<?php

include('server/dbcon.php');
include('layouts/header.php');
//search function

// Search and Pagination Functionality
if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Determine the page number
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    // Get the total number of records based on the search criteria
    if ($category == 'all') {
        // If "All" category is selected, count all products under the specified price
        $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_price<=?");
        $stmt1->bind_param('i', $price);
    } else {
        // Otherwise, count products in the selected category under the specified price
        $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
        $stmt1->bind_param('si', $category, $price);
    }
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // Products per page
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // Fetch the products based on the search criteria
    if ($category == 'all') {
        $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_price<=? LIMIT ?, ?");
        $stmt2->bind_param('iii', $price, $offset, $total_records_per_page);
    } else {
        $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT ?, ?");
        $stmt2->bind_param('siii', $category, $price, $offset, $total_records_per_page);
    }
    $stmt2->execute();
    $products = $stmt2->get_result();
} else {
    // Default behavior when no search is performed

    // Determine the page number
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    // Get the total number of records in the products table
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // Products per page
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // Fetch all products for the current page
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt2->bind_param('ii', $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
}


?>

<?php include('layouts/header.php') ?>

<!-- Container to hold both search and shop sections side by side -->
<section id="main-section" class="my-5 py-5 mx-3">
    <div class="container mt-5 py-5 mx-auto">
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
                                <input class="form-check-input" value="all" type="radio" name="category" id="category_all" <?php if (isset($category) && $category == 'all') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="form-check-label" for="category_all">
                                    All
                                </label>
                            </div>

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
                            <div class="d-flex justify-content-center mb-2">
                                <span id="rangeValue" style="color: black;  "><?php echo isset($price) ? $price : '100'; ?>$</span>
                            </div>
                            <input type="range" style="background: black;" name="price" value="<?php echo isset($price) ? $price : '100'; ?>"
                                class="form-range w-50" min="10" max="500" id="customRange2"
                                oninput="updateRangeValue(this.value)">
                            <div class="w-50 d-flex justify-content-between">
                                <span>10</span>
                                <span>500</span>
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
                        <div onclick="window.location.href='item.php?product_id=<?php echo $row['product_id']; ?>';" class="Shop text-center col-lg-3 col-md-4 col-sm-12 mb-4">
                            <img class="img-fluid item-img mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
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
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-5">
                        <li class="page-item <?php if ($page_no <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($page_no > 1) {
                                                            echo "?page_no=" . ($page_no - 1);
                                                        } else {
                                                            echo '#';
                                                        } ?>">Previous</a>
                        </li>

                        <?php
                        $adjacents = 2;
                        $start_page = max(1, $page_no - $adjacents);
                        $end_page = min($total_no_of_pages, $page_no + $adjacents);

                        if ($start_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>';
                            if ($start_page > 2) {
                                echo '<li class="page-item"><a class="page-link">...</a></li>';
                            }
                        }

                        for ($i = $start_page; $i <= $end_page; $i++) {
                            echo '<li class="page-item';
                            if ($i == $page_no) {
                                echo ' active';
                            }
                            echo '"><a class="page-link" href="?page_no=' . $i . '">' . $i . '</a></li>';
                        }

                        if ($end_page < $total_no_of_pages) {
                            if ($end_page < $total_no_of_pages - 1) {
                                echo '<li class="page-item"><a class="page-link">...</a></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a></li>';
                        }
                        ?>

                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($page_no < $total_no_of_pages) {
                                                            echo "?page_no=" . ($page_no + 1);
                                                        } else {
                                                            echo '#';
                                                        } ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</section>


<script>
    function updateRangeValue(value) {
        document.getElementById('rangeValue').textContent = value + '$';
    }
</script>

<style>
    input[type=range] {
        -webkit-appearance: none;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #ff0000, #00ff00);
        border-radius: 5px;
        outline: none;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;

        cursor: pointer;
        border-radius: 50%;
    }

    input[type=range]::-moz-range-thumb {
        width: 25px;
        height: 25px;
        background: #4CAF50;
        cursor: pointer;
        border-radius: 50%;
    }
</style>

<?php include('layouts/footer.php');
