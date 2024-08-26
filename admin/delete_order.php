<?php
include('../server/dbcon.php');
include('header.php');

if (isset($_GET['id'])) { // Change 'order_id' to 'id'
    $product_id = $_GET['id']; // Change 'order_id' to 'id'

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
    // Bind the parameter
    $stmt->bind_param('i', $product_id);
    // Execute the statement
    if ($stmt->execute()) {
        header('location: dashboard.php?order_delete_success=Order has been deleted.');
    } else {
        header('location: dashboard.php?order_delete_fail=Order cannot be deleted.');
    }
    // Close the statement
    $stmt->close();
}
