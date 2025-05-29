<?php

include('includes/connect.php');
include('functions/common_function.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecmmerce Webiste</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <!--First-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/Logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link"="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current" href="display_all_products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup> <?php cart_item(); ?> </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pr">Total Price : <?php total_price(); ?> /=</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="search_data" name="search_data" aria-label="Search">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!--calling cart function-->
        <?php
        cart();
         ?>
<!--Second -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"
                  <?php
                    //displaying user name
                    if (!isset($_SESSION['username'])) {
                      echo "<li class='nav-item'>
                          <a class='nav-link' href='#'>Welcome Guest</a>
                      </li>";
                    }else {
                      echo "<li class='nav-item'>
                          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                      </li>";
                    }
                    //login and logout
                      if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/user_login.php'>login</a>
                        </li>";
                      }else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/user_logout.php'>logout</a>
                        </li>";
                      }

                     ?>
                </li>
            </ul>
        </nav>
<!--Third-->
        <div class="bg-light">
            <h3 class="text-center">Gugues Store</h3>
            <p class="text-center">Communication is at the heart of E-commerce and community </p>
        </div>


<!--Fourth-->
        <div class="row px-1">
            <div class="col-md-10">
                <!--Products-->
                <div class="row">
                  <!--fetching products-->
                  <?php
                    get_all_products();
                    get_unique_catergories();
                   ?>
                    <!--row end-->
                </div>
                <!--col end-->
            </div>
            <div class="col-md-2 bg-secondary p-0">
                <!--BRANDS TO BE DISPLAYED-->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
                    </li>
                    <?php
                      getbrands();
                     ?>
                </ul>
                <!--Catergories to be displayed-->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Catergories</h4>
                        </a>
                    </li>
                    <?php
                      getcatergories();
                     ?>
                </ul>
            </div>
        </div>


<!--footer-->
        <div class="bg-info p-3 text-center">
            <p>All Rights Resereved - Nathan Desgined in 2025 </p>
        </div>
    </div>



    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>
