<?php
// include('../includes/connect.php');
include('../includes/connect.php');  // Include your database connection file FIRST.
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
<style media="screen">
  body{
    overflow: hidden;
  }
</style>
<body>

<div class="container-fluid m-3">
  <div class="container-fluid m-4">
    <h2 class="text-center">Login Form</h2>
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form class="" action="" method="post">
          <!-- username -->
          <div class="form-outline mb-4 mt-5">
            <label for="user_username" class="form-label">User name</label>
            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off"
            required="required" name="user_username">
          </div>
          <!-- password -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">User Password</label>
            <input type="password" id="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off"
            required="required" name="user_password">
          </div>


          <div class="mt-2 pt-2">
            <input type="submit" name="Admin_login" value="Login" class="bg-info py-2  px-3 border-0">
          </div>
          <p class="mt-2 pt-2"> <strong>Don't have an account ? </strong> <a class="text-danger" href="Admin_registration.php">Register</a> </p>
        </form>
      </div>
    </div>
  </div>
</div>
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['Admin_login'])) {
  $user_username=$_POST['user_username'];
  $user_password=$_POST['user_password'];

  $select_query="select * from admin_table where admin_name='$user_username'";
  $result=mysqli_query($con,$select_query);
  $row_count=mysqli_num_rows($result);
  $row_data=mysqli_fetch_assoc($result);

  if ($row_count > 0) {
    $_SESSION['admin_name']=$user_username;
    if (password_verify($user_password, $row_data['admin_password'])) {
        $_SESSION['admin_name'] = $user_username;
          // echo "<script>alert('Login successful !!!')</script>";
          if ($row_count==1) {
            $_SESSION['admin_name']=$user_username;
            echo "<script>alert('Login successful !!!')</script>";
            echo "<script>window.open('index.php','_self')</script>";
          }
    }else {
      echo "<script>alert('Invalid Credentials')</script>";
    }
  }

}
 ?>
