<?php
include('header.php');


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = (int)$_GET['page_no']; // Sanitize and cast to integer
} else {
    $page_no = 1;
}

// Database connection (ensure $conn is properly initialized)
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// Products per page
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = 2;

$total_no_of_pages = ceil($total_records / $total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page); // Bind parameters to prevent SQL injection
$stmt2->execute();
$orders = $stmt2->get_result();
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

            <h2>Orders</h2>
            <?php if (isset($_GET['order_success'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['order_success'] ?></p>
            <?php } ?>
            <?php if (isset($_GET['order_fail'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['order_fail'] ?></p>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Customer Phone</th>
                            <th scope="col">Customer Address</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $orders->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_status']); ?></td>
                                <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($order['user_phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['user_address']); ?></td>
                                <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>

                                <td><a class="btn btn-danger" href="delete_order.php?id=<?php echo $order['order_id']; ?>">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-5">
                        <li class="page-item<?php if ($page_no <= 1) echo ' disabled'; ?>">
                            <a class="page-link" href="<?php echo ($page_no <= 1) ? '#' : "?page_no=" . $previous_page; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_no_of_pages; $i++) { ?>
                            <li class="page-item<?php if ($i == $page_no) echo ' active'; ?>">
                                <a class="page-link" href="?page_no=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item<?php if ($page_no >= $total_no_of_pages) echo ' disabled'; ?>">
                            <a class="page-link" href="<?php echo ($page_no >= $total_no_of_pages) ? '#' : "?page_no=" . $next_page; ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </main>

        <p>test</p>
    </div>
</div>