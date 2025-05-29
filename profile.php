<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="../css.css">
</head>
<body>
  <style media="screen">
  .profile_img{
    width: 90%;
    margin: auto;
    display: block;
    height: 100%;
  }
  </style>
    <!--First-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/Logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all_products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup> <?php cart_item(); ?> </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price : <?php total_price(); ?> /= </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
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
                <li class="nav-item">

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
                            <a class='nav-link' href='user_login.php'>login</a>
                        </li>";
                      }else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='user_logout.php'>logout</a>
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
<!-- four -->
<div class="row">
  <div class="col-md-2 p-0">
    <div class="navbar-nav bg-secondary text-center">
      <li class="nav-item bg-info">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
      </li>
      <?php
      $username=$_SESSION['username'];
      $user_image="Select * from user_table where username='$username'";
      $result=mysqli_query($con,$user_image);
      $row_image=mysqli_fetch_assoc($result);
      $user_image=$row_image['user_image'];
      echo "<li class='nav-item'>
          <img src='./user_images/$user_image' class='profile_img''>
      </li>";

       ?>
          <li class="nav-item">
            <a class="nav-link text-light" href="profile.php">Pending Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="user_logout.php">Logout</a>
        </li>
        </div>
    </div>
    <div class="col-md-10 text-center">
      <?php
      get_user_order_details();

       ?>
      <?php
      get_user_order_details();
      if (isset($_GET['my_orders'])) {
        include('user_orders.php');
      }
       ?>
       <?php
       if (isset($_GET['delete_account'])) {
         include('delete_account.php');
       }
        ?>
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
