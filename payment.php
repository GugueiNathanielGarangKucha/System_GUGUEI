<?php
include('../includes/connect.php');  // Include your database connection file FIRST.
include('../functions/common_function.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
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
  <!-- php code for user_ip -->
<?php
$user_ip=getIPAddress();
$get_user="select * from user_table where user_ip='$user_ip'";
$result_query=mysqli_query ($con, $get_user);
$run_query=mysqli_fetch_array($result_query);
$user_id=$run_query['user_id'];

 ?>

    <div class="container mb-5">
      <h2 class="text-center text-info">Payment Methods</h2>
    </div>
    <div class="row d-flex px-6 mt-6 text-center justify-content-center mb-5">
      <div>
        <a href="oreder.php?user_id=<?php echo "$user_id"; ?>"><h3 class="">Payment Link</h3></a>
      </div>
    </div>
</body>
</html>
