<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid m-4">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form class="" action="" method="post" enctype="multipart/form-data">
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
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" placeholder="Enter your user image" autocomplete="off"
                               required="required" name="user_image">
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

                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">User Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your Address" autocomplete="off"
                               required="required" name="user_address">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">User Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your Contact" autocomplete="off"
                               required="required" name="user_contact">
                    </div>

                    <div class="mt-2 pt-2">
                        <input type="submit" name="user_register" value="Register" class="bg-info py-2  px-3 border-0">
                        <p class="mt-2 pt-2"> <strong>Already have an account ? </strong> <a class="text-danger" href="user_login.php">Login</a> </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if (isset($_POST['user_register'])) {
        $user_username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_password = $_POST['user_password'];
        $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
        $confirm_password = $_POST['confirm_password'];
        $user_address = $_POST['user_address'];
        $user_contact = $_POST['user_contact'];


        // Check if passwords match
        if ($user_password != $confirm_password) {
            echo "<script>alert('Passwords do not match!')</script>";
            exit(); // Stop the script if passwords don't match
        }

// .. select query
        $select_query="select * from user_table where username='$user_username' or user_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if ($rows_count>0) {
            $_SESSION['username']=$user_username;
            echo "<script>alert('User name or Email  already exists')</script>";
        }else{
        // insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "insert into user_table (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)
        values ('$user_username','$user_email','$hash_password','$user_image','$user_address','$user_contact')"; //corrected query
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die(mysqli_error($con));

        }
    }
}

?>
