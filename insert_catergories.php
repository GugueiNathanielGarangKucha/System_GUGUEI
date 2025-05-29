<?php

include('../includes/connect.php');

if (isset($_POST['insert_cat'])) {
    $catergory_title = $_POST['cat_title']; // Corrected variable name

    // Select data from the database
    $select_query = "SELECT * FROM catergories WHERE catergory_title = '$catergory_title'"; // Corrected table name and syntax
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This category is already present in the Database!')</script>";
    } else {
        $insert_query = "INSERT INTO catergories (catergory_title) VALUES ('$catergory_title')"; // Corrected table name and syntax
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Category has been added successfully')</script>";
        } else {
            echo "<script>alert('Error adding category!')</script>"; // Added an error message for debugging
        }
    }
}

?>

<h2 class="text-center"> Insert Categories</h2>
 <form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="username"
               aria-describedby="basic-addon1"> </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Category"> </div>
</form>
