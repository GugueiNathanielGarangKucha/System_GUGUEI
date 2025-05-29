<?php

// include('./includes/connect.php');

//getting products
function getproducts(){
  global $con;

  //checking for isset
  if(!isset($_GET['catergories'])){
    if(!isset($_GET['brands'])){
  $select_query="select * from products order by rand() LIMIT 0,9";
  $result_query=mysqli_query($con,$select_query);
  while ($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_image1=$row['product_image1'];
    $product_price=$row['product_price'];
    $catergory_id=$row['catergory_id'];
    $brand_id=$row['brand_id'];
    echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price:$product_price/=</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";
  }
}
}
}
//getting all products
function get_all_products(){
  global $con;
  //checking for isset
  if(!isset($_GET['catergories'])){
    if(!isset($_GET['brands'])){
  $select_query="select * from products order by rand()";
  $result_query=mysqli_query($con,$select_query);
  while ($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_image1=$row['product_image1'];
    $product_price=$row['product_price'];
    $catergory_id=$row['catergory_id'];
    $brand_id=$row['brand_id'];
    echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price:$product_price/=</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";
  }
}
}
}



//getting unique catergories
function get_unique_catergories(){
  global $con;
  //checking for isset
  if(isset($_GET['catergories'])){
    $catergory_id = $_GET['catergories']; // Corrected: Use catergory_id from GET
    $select_query = "SELECT * FROM products WHERE catergory_id = ?"; // Use prepared statement
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, "i", $catergory_id); // Bind the integer parameter
    mysqli_stmt_execute($stmt);
    $result_query = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result_query);
    if ($num_rows > 0) {
      while ($row = mysqli_fetch_assoc($result_query)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $catergory_id = $row['catergory_id'];
        $brand_id = $row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
            <div class='card'>
                <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price:$product_price/=</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                </div>
            </div>
        </div>";
      }
    }else {
        echo "<h2 class='text-center text-danger'>No products available for this Catergory.</h2>";
}
    mysqli_stmt_close($stmt); // Close the prepared statement
  }
}



//getting unique brands
function get_unique_brands(){
    global $con;
    //checking for isset
    if(isset($_GET['brands'])){
        $brand_id = $_GET['brands'];
        // Corrected SQL query to join products and brands tables
        $select_query = "SELECT p.* FROM products p JOIN brands b ON p.brand_id = b.brand_id WHERE b.brand_id = ?";
        $stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($stmt, "i", $brand_id);
        mysqli_stmt_execute($stmt);
        $result_query = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result_query);
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result_query)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $catergory_id = $row['catergory_id'];
                $brand_id = $row['brand_id']; // This will be the same $brand_id from the GET request
                echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price:$product_price/=</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                </div>
                            </div>
                        </div>";
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available for this brand.</h2>";
        }
        mysqli_stmt_close($stmt);
    }
}
//getting catergories

function getcatergories(){
  global $con;
  $select_catergories="select * from catergories";
  $result_catergories=mysqli_query($con,$select_catergories);
  while ($row_data=mysqli_fetch_assoc($result_catergories)){
  $catergory_title=$row_data['catergory_title'];
  $catergory_id=$row_data['catergory_id'];
  echo "<li class='nav-item'>
      <a href='index.php?catergories=$catergory_id' class='nav-link text-light'>$catergory_title</a>
  </li>";
 }
}

//getting Brands
function getbrands(){
  global $con;
  $select_brands="select * from brands";
  $result_brands=mysqli_query($con,$select_brands);
  while ($row_data=mysqli_fetch_assoc($result_brands)){
  $brand_title=$row_data['brand_title'];
  $brand_id=$row_data['brand_id'];
  echo "<li class='nav-item'>
      <a href='index.php?brands=$brand_id' class='nav-link text-light'>$brand_title</a>
  </li>";
 }
}


//searching Products
function search_product(){
  global $con;
  if(isset($_GET['search_data_product'])){
    $search_data_value=$_GET['search_data'];
    $search_query="select * from products where product_keywords like '%$search_data_value%'";
    $result_query=mysqli_query($con,$search_query);
    $num_rows = mysqli_num_rows($result_query);
    if($num_rows > 0){
      while ($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $catergory_id=$row['catergory_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
            <div class='card'>
                <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price:$product_price/=</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                </div>
            </div>
        </div>";
      }
    } else {
      echo "<h2 class='text-center text-danger'>No results found!</h2>";
    }
  }
}



//view details
function view_detail(){
  global $con;

  //checking for isset
    if(isset($_GET['product_id'])){
    if(!isset($_GET['catergories'])){
    if(!isset($_GET['brands'])){
      $product_id=$_GET['product_id'];
  $select_query="select * from products where product_id=$product_id";
  $result_query=mysqli_query($con,$select_query);
  while ($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_image1=$row['product_image1'];
    $product_image2=$row['product_image2'];
    $product_image3=$row['product_image3'];
    $product_price=$row['product_price'];
    $catergory_id=$row['catergory_id'];
    $brand_id=$row['brand_id'];
    echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./Admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price:$product_price/=</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                <a href='index.php' class='btn btn-secondary'>Go Back</a>
            </div>
        </div>
    </div>

    <div class='col-md-8'>
      <!--related images-->
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='text-center text-info mb-5'>Related Products</h4>
        </div>
        <div class='col-md-6'>
          <img src='./Admin/product_images/$product_image2' class='card-img-top' alt='$product_title'>
        </div>
        <div class='col-md-6'>
          <img src='./Admin/product_images/$product_image3' class='card-img-top' alt='$product_title'>
        </div>
      </div>
    </div>";
  }
}
}
}
}

//get ip address function
function getIPAddress() {
   //whether ip is from the share internet
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
               $ip = $_SERVER['HTTP_CLIENT_IP'];
       }
   //whether ip is from the proxy
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
               $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
//whether ip is from the remote address
   else{
            $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();
// echo 'User Real IP Address - '.$ip;

// cart function
function cart(){
if(isset($_GET['add_to_cart'])){
global $con;
$ip = getIPAddress();
$get_product_id=$_GET['add_to_cart'];
$select_query="select * from cart_details where ip_address='$ip' and product_id=$get_product_id";
$result_query=mysqli_query($con,$select_query);
$sum_of_rows=mysqli_num_rows($result_query);
if ($sum_of_rows>0) {
  echo "<script>alert('This item is already present inside Cart')</script>";
  echo "<script>window.open('index.php','_self')</script>";
}else {
  $insert_query="insert into cart_details (product_id,ip_address,quantity) values($get_product_id,'$ip',0 )";
  $result_query=mysqli_query($con,$insert_query);
  echo "<script>alert('Item is added to cart')</script>";
  echo "<script>window.open('index.php','_self')</script>";
}
}
}

//function to get cart item number
function cart_item(){
    global $con;
    $ip = getIPAddress();
    $select_query="select * from cart_details where ip_address='$ip'";
    $result_query=mysqli_query($con,$select_query);
    if (!$result_query) {
        echo "Error: " . mysqli_error($con); // Display any database errors
        return;
    }
    $sum_of_rows=mysqli_num_rows($result_query);
    echo "$sum_of_rows";
}

//total cart price
function total_price(){
    global $con;
    $ip = getIPAddress();
    $total = 0;
    $cart_query = "select * from cart_details where ip_address='$ip'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id']; // Corrected variable access
        $select_products = "select * from Products where product_id='$product_id'"; // Corrected WHERE clause
        $result_products = mysqli_query($con, $select_products);
        while ($row_product = mysqli_fetch_array($result_products)) {
            $product_price = $row_product['product_price']; // Get the price directly
            $total += $product_price; // Add directly to the total
        }
    }
    echo $total;
}

// Get user order cart_details
    function get_user_order_details(){
      global $con;
      $username=$_SESSION['username'];
      $get_details="select * from user_table where username='$username'";
      $result_query=mysqli_query($con,$get_details);
      while ($row_query=mysqli_fetch_array($result_query)) {
        $user_id=$row_query['user_id'];
        if (!isset($_GET['my_orders'])) {
          if (!isset($_GET['delete_account'])) {
            $get_orders="select * from user_orders where user_id='$user_id' and order_status='pending'";
            $result_orders_query=mysqli_query($con,$get_orders);
            $row_count=mysqli_num_rows($result_orders_query);
            if ($row_count>0) {
              echo "<h3 class='text-center text-success'>You have <span class='text-danger'>$row_count </span> Pending Orders.</h3>
                <p class='text-center'><a class='nav-link text-light' href='profile.php?my_orders'>Order Details</a></p>";
            }else {
              echo "<h3 class='text-center text-success'>You have Zero Pending Orders.</h3>
                <p class='text-center'><a class='nav-link text-light' href='../index.php'>Get Items</a></p>";
            }
          }
        }
      }
}


 ?>
