<?php

include('dbcon.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category IN ('hoodies', 'shirts') ORDER BY RAND() LIMIT 8");

$stmt->execute();

$category_hoodies = $stmt->get_result();
