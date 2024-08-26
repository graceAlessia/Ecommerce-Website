<?php
include('../server/dbcon.php');

if (isset($_POST['update_images'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name']; // Ensure $product_name is defined

    // Define paths and file names
    $image_names = [
        'image1' => $product_name . "1.jpg",
        'image2' => $product_name . "2.jpg",
        'image3' => $product_name . "3.jpg",
        'image4' => $product_name . "4.jpg"
    ];

    // Upload images
    $upload_dir = "../assets/imgs/";
    $upload_success = true;

    foreach ($_FILES as $key => $file) {
        if (isset($image_names[$key])) {
            $tmp_name = $file['tmp_name'];
            $image_name = $image_names[$key];
            if (!move_uploaded_file($tmp_name, $upload_dir . $image_name)) {
                $upload_success = false;
                break;
            }
        }
    }

    if ($upload_success) {
        // Prepare and execute update query
        $stmt = $conn->prepare("UPDATE products SET product_image=?, product_image2=?, product_image3=?, product_image4=? WHERE product_id=?");
        $stmt->bind_param('ssssi', $image_names['image1'], $image_names['image2'], $image_names['image3'], $image_names['image4'], $product_id);

        if ($stmt->execute()) {
            header('Location: products.php?product_created=Images have been updated successfully');
            exit;
        } else {
            header('Location: products.php?product_failed=Error occurred, try again.');
            exit;
        }
    } else {
        header('Location: products.php?product_failed=File upload failed');
        exit;
    }
}
