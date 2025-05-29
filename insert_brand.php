<?php

include('../includes/connect.php');

if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title']; // Corrected variable name

    // Select data from the database
    $select_query = "SELECT * FROM brands WHERE brand_title = '$brand_title'"; // Corrected table name and syntax
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This Brand is already present in the Database!')</script>";
    } else {
        $insert_query = "INSERT INTO brands (brand_title) VALUES ('$brand_title')"; // Corrected table name and syntax
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Brand has been added successfully')</script>";
        } else {
            echo "<script>alert('Error adding Brand!')</script>"; // Added an error message for debugging
        }
    }
}

?>
 <h2 class="text-centre"> Insert Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
        <i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="insert_brand" aria-label="Brands"
            aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input type="Submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brands">
    </div>
</form>
