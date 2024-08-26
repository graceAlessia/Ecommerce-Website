<?php include('header.php'); ?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
} else if (isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $special_offer = $_POST['special_offer'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
                                 product_special_offer=?, product_color=?, product_category=? WHERE product_id=?");
    $stmt->bind_param('ssssssi', $title, $description, $price, $special_offer, $color, $category, $product_id);
    if ($stmt->execute()) {
        header('Location: products.php?edit_success_message=Product has been added successfully!');
    } else {
        header('Location: products.php?edit_failure_message=There is an error. Please  try again.');
    }
} else {
    header('Location: products.php');
    exit();
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>
                </div>
            </div>

            <h2>Edit Product</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-form" enctype="multipart/form-data" method="POST" action="edit_product.php">
                        <p style="color: red;">
                            <?php if (isset($_GET['error'])) {
                                echo htmlspecialchars($_GET['error']);
                            } ?>
                        </p>
                        <div class="form-group mt-2">
                            <?php foreach ($products as $product) { ?>
                                <input name="product_id" value="<?php echo $product['product_id']; ?>" type="hidden">
                                <label>Title</label>
                                <input type="text" class="form-control" id="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" name="title" placeholder="Title" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Description</label>
                            <input type="text" class="form-control" id="product_desc" value="<?php echo htmlspecialchars($product['product_description']); ?>" name="description" placeholder="Description" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Price</label>
                            <input type="text" class="form-control" id="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Category</label>
                            <select class="form-select" required name="category">
                                <option value="shirts" <?php if ($product['product_category'] == 'shirts') echo 'selected'; ?>>Shirts</option>
                                <option value="polo_shirts" <?php if ($product['product_category'] == 'polo_shirts') echo 'selected'; ?>>Polo Shirts</option>
                                <option value="hoodies" <?php if ($product['product_category'] == 'hoodies') echo 'selected'; ?>>Hoodies</option>
                                <option value="featured" <?php if ($product['product_category'] == 'featured') echo 'selected'; ?>>Featured</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Color</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($product['product_color']); ?>" id="product_color" name="color" placeholder="Color" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Special Offer/Sale</label>
                            <input type="number" class="form-control" value="<?php echo htmlspecialchars($product['product_special_offer']); ?>" id="product_special_offer" name="special_offer" placeholder="Special Offer" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit">
                        </div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>