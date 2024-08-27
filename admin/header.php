<?php
session_start();
?>
<?php include('../server/dbcon.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .pagination .page-item {
            margin: 0 2px;

            /* Optional: space between pagination items */
        }

        .pagination .page-link {
            color: white;
            /* Default color for page links */
            background-color: #1A2130;
            /* Default background color */
            border: 1px solid #dee2e6;
            /* Border color */
        }

        .pagination .page-item.active .page-link {
            color: #1A2130;
            /* Text color for the active page */
            background-color: whitesmoke;
            /* Background color for the active page */
            border-color: #dee2e6;
            /* Border color for the active page */
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            /* Text color for disabled items */
            background-color: #fff;
            /* Background color for disabled items */
            border-color: #dee2e6;
            /* Border color for disabled items */
        }

        .pagination .page-link:hover {
            color: white;
            /* Text color on hover */
            background-color: #6c757d;
            /* Background color on hover */
            border-color: #dee2e6;
            /* Border color on hover */
        }
    </style>

    </style>

</head>

<body>

    <header class="navbar navbar-dark styiky-top bg-dark glex-d-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Cozy Shark</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                    <a class="nav-link px-3" href="logout.php?logout=1">Sign out</a>
                <?php } ?>
            </div>
        </div>

    </header>