<?php session_start();

include('../server/dbcon.php');
?>

<?php
include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    // Bind the parameter
    $stmt->bind_param('i', $product_id);
    // Execute the statement
    if ($stmt->execute()) {
        header('location: products.php?delete_success=Product has been deleted.');
    } else {
        header('location: products.php?delete_fail=Product cannot be deleted.');
    }
    // Close the statement
    $stmt->close();
}
?>
