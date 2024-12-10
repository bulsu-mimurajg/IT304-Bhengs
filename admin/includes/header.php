<?php
require '../config/function.php';
require 'authentication.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/custom.css?v=1.0">
    <!-- BOOTSTRAP CSS -->
    <link href="assets/css/styles.css?v=1.0" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <style>
        body {
            background-image: url(' ../assets/img/1.jpg') !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-attachment: fixed;
            /* background-color: violet; */
        }
    </style> -->
</head>

<body class="sb-nav-fixed">

    <?php include('navbar.php') ?>

    <div id="layoutSidenav">
        <?php include('sidebar.php') ?>

        <div id="layoutSidenav_content">

            <main>