<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS -->
    <link rel="stylesheet" href="../css.css">
</head>
<style>
body{
  overflow-x: hidden;
}
.product_img{
  object-fit: contain;
  width: 100px;
}
</style>
<body>
    <!--First-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/Logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">

                            <?php
                            //displaying user name
                            if (!isset($_SESSION['admin_name'])) {
                              echo "<li class='nav-item'>
                                  <a class='nav-link' href='#'>Welcome Guest</a>
                              </li>";
                            }else {
                              echo "<li class='nav-item'>
                                  <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_name']."</a>
                              </li>";
                            }
                            //login and logout
                              if (!isset($_SESSION['admin_name'])) {
                                echo "<li class='nav-item'>
                                    <a class='nav-link' href='Admin_login.php'>login</a>
                                </li>";
                                  echo "<script>window.open('index.php', '_self')</script>";
                              }else {
                                echo "<li class='nav-item'>
                                    <a class='nav-link' href='Admin_logout.php'>logout</a>
                                </li>";
                              }
                             ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
      </div>
        <!--Second-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!--Third-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-1">
                    <a href="#"><img src="../images/Gym.jpeg" alt="" class="Gym"></a>


                </div>
                <div class="button text-center">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-alight bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-alight bg-info my-1">View Products</a></button>
                    <button><a href="index.php?insert_catergory" class="nav-link text-alight bg-info my-1">insert_catergory</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-alight bg-info my-1">View Catergories</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-alight bg-info my-1">Insert Brand</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-alight bg-info my-1">View Brand</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-alight bg-info my-1">All Orders</a></button>
                    <button><a href="index.php?list_payment" class="nav-link text-alight bg-info my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-alight bg-info my-1">List Users</a></button>
                    <button><a href="index.php?Admin_logout" class="nav-link text-alight bg-info my-1">Log Out</a></button>
                    <button><a href="index.php?Admin_registration" class="nav-link text-alight bg-info my-1">Registration</a></button>
                </div>
            </div>
        </div>
        <!--four-->
        <div class="container my-5">
            <?php
            if(isset($_GET['insert_catergory'])){
                include('insert_catergories.php');
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brand.php');
            }
            if (isset($_GET['insert_product'])) {
                include('insert_product.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_products'])) {
                include('delete_products.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            if (isset($_GET['edit_categories'])) {
                include('edit_categories.php');
            }
            if (isset($_GET['edit_brands'])) {
                include('edit_brands.php');
            }
            if (isset($_GET['delete_categories'])) {
                include('delete_categories.php');
            }
            if (isset($_GET['delete_brands'])) {
                include('delete_brands.php');
            }
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['delete_order'])) {
                include('delete_order.php');
            }
            if (isset($_GET['list_payment'])) {
                include('list_payment.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            if (isset($_GET['delete_order'])) {
                include('delete_order.php');
            }
            if (isset($_GET['Admin_logout'])) {
                include('Admin_logout.php');
            }
            if (isset($_GET['Admin_registration'])) {
                include('Admin_registration.php');
            }
            ?>
        </div>

        <!--footer-->
        <div class="bg-info p-3 text-center">
            <p>All Rights Resereved - Nathan Desgined in 2025 </p>
        </div>
    </div>

    </div>



    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>
