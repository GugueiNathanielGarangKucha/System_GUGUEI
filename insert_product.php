<?php

include('../includes/connect.php');
if(isset($_POST['insert_product'])){

    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_catergories=$_POST['product_catergories'];
    $product_brands=$_POST['product_brands'];
    $product_Price=$_POST['product_Price'];
    $product_status='true';

    //accessing images//
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    // accessing image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    //checking empty conditions
    if($product_title=='' or $description=='' or $product_catergories=='' or $product_brands=='' or $product_Price=='' or
    $product_image1=='' or $product_image2=='' or $product_image3=='' ) {
        echo "<script>alert('Please fill all the  Fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        //insert query
        $insert_products="insert into products (product_title,product_description,product_keywords,catergory_id,brand_id,
        product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$description','$product_keywords',
        '$product_catergories','$product_brands','$product_image1','$product_image2','$product_image3','$product_Price',NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('Product successfully added.')</script>";
        }
    }

}
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
<body class= bg-light>
    <div class="container mt-3">
      <h1 class="text-center">Insert Products</h1>

      <form action="" method="post" enctype="multipart/form-data">
        <!--title-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_title" class="form-label">Product Title</label>
          <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required="required">
        </div>
        <!--description-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="description" class="form-label">Product Description</label>
          <input type="text" name="description" id="description" class="form-control" placeholder="Enter Product Description" autocomplete="off" required="required">
        </div>
        <!--keywords-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_keywords" class="form-label">Product keywords</label>
          <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter Product keywords" autocomplete="off" required="required">
        </div>
        <!--Catergories-->
        <<div class="form-outline mb-4 w-50 m-auto">
    <select name="product_catergories" id="" class="form-select">
        <option value="">Select a Category</option>
        <?php
            $select_query="select * from catergories";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query)){
            $catergory_title=$row['catergory_title'];
            $catergory_id=$row['catergory_id'];
            echo "<option value='$catergory_id'>$catergory_title</option>";}
        ?>
    </select>
</div>
        <!--Brands-->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brands" id="" class="form-select">
                <option value="">Select a Brand</option>
                <?php
                    $select_query="select * from brands";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                    $brand_title=$row['brand_title'];
                    $brand_id=$row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";}
                ?>
            </select>
        </div>


        <!--image 1-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_image1" class="form-label">Product image1</label>
          <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
        </div>

        <!--image 2-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_image2" class="form-label">Product image2</label>
          <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
        </div>

        <!--image 3-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_image3" class="form-label">Product image3</label>
          <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
        </div>

        <!--Price-->
        <div class="form-outline mb-4 w-50 m-auto">
          <label for="product_Price" class="form-label">Product Price</label>
          <input type="text" name="product_Price" id="product_Price" class="form-control" placeholder="Enter Product Price" autocomplete="off" required="required">
        </div>

        <!--button-->
        <div class="form-outline mb-4 w-50 m-auto">
          <input type="submit" name="insert_product" value="insert Products" class="btn btn-info mb-3 px-3">
        </div>
      </form>
    </div>

</body>
</html>
