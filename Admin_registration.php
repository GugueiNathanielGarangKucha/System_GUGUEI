<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
  <h2 class="text-center mb-5">Admin Registration</h2>
  <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
          <form class="" action="" method="post">
              <div class="form-outline mb-4">
                  <label for="user_username" class="form-label">User name</label>
                  <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off"
                         required="required" name="user_username">
              </div>
              <div class="form-outline mb-4">
                  <label for="user_email" class="form-label">User Email</label>
                  <input type="email" id="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off"
                         required="required" name="user_email">
              </div>

              <div class="form-outline mb-4">
                  <label for="user_password" class="form-label">User Password</label>
                  <input type="password" id="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off"
                         required="required" name="user_password">
              </div>
              <div class="form-outline mb-4">
                  <label for="confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off"
                         required="required" name="confirm_password">
              </div>

              <div class="mt-2 pt-2">
                  <input type="submit" name="Admin_register" value="Register" class="bg-info py-2  px-3 border-0">
                  <p class="mt-2 pt-2"> <strong>Already have an account ? </strong> <a class="text-danger" href="Admin_login.php">Login</a> </p>
              </div>
          </form>
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
    if (isset($_POST['Admin_register'])) {
        $user_username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($user_password != $confirm_password) {
            echo "<script>alert('Passwords do not match!')</script>";
            exit(); // Stop the script if passwords don't match
        }

// .. select query
        $select_query="select * from admin_table where admin_name='$user_username' or admin_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if ($rows_count>0) {
            $_SESSION['admin_name']=$user_username;
            echo "<script>alert('User name or Email  already exists')</script>";
        }else{
        // insert query
        $insert_query = "insert into admin_table (admin_name, admin_email, admin_password)
        values ('$user_username','$user_email','$hash_password')"; //corrected query
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}

?>
