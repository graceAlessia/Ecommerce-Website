<?php

include('dbcon.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='hoodies' LIMIT 4");

$stmt->execute();

$category_hoodies = $stmt->get_result();
