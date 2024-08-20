<?php
include('dbcon.php');

// Example category, replace 'hoodies' with a dynamic value if needed
$category = 'hoodies';

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? ORDER BY RAND() LIMIT 4");
$stmt->bind_param('s', $category);
$stmt->execute();

$result = $stmt->get_result();
