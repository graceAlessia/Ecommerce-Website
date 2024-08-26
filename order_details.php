<?php
include('server/dbcon.php');
include('layouts/header.php');
if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    // Calculate total price and set in session
    $order_total_price = calculateTotalOrderPrice($order_details);
    $_SESSION['total'] = $order_total_price;
} else {
    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details)
{
    $total = 0;
    while ($row = $order_details->fetch_assoc()) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += $product_price * $product_quantity;
    }
    return $total;
}
?>

<?php include('layouts/header.php') ?>

<!--Order Details-->
<section class="orders container my-5 py-3" id="order_table">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Order Details</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php $order_details->data_seek(0);
        while ($row = $order_details->fetch_assoc()) { ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="item_image">
                        <div>
                            <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <span>$<?php echo $row['product_price']; ?></span>
                </td>
                <td>
                    <span><?php echo $row['product_quantity']; ?></span>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if ($order_status == "not paid") { ?>
        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
        </form>
    <?php } ?>
</section>

<?php include('layouts/footer.php') ?>