<?php
if (isset($_GET['edit_products'])) {
  $edit_id=$_GET['edit_products'];
  $get_data="select * from products where product_id=$edit_id";
  $result=mysqli_query($con,$get_data);
  $row=mysqli_fetch_assoc($result);
  $product_title=$row['product_title'];
  $product_description=$row['product_description'];
  $product_keywords=$row['product_keywords'];
  $catergory_id=$row['catergory_id'];
  $brand_id=$row['brand_id'];
  $product_image1=$row['product_image1'];
  $product_image2=$row['product_image2'];
  $product_image3=$row['product_image3'];
  $product_price=$row['product_price'];

}
 ?>
<div class="container mt-5">
  <h1 class="text-center">Edit Product</h1>
  <form class="" action="" method="post" enctype="multipart/form-data">
    <div class="form-outline w-50 m-auto">
      <label for="product_title" class="form-label">Product Title</label>
      <input type="text" name="product_title" id="product_title" value="<?php echo "$product_title"; ?>" class="form-control" required="required">
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_description" class="form-label">Product Description</label>
      <input type="text" name="product_description" id="product_title" value="<?php echo "$product_description"; ?>" class="form-control" required="required">
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_keywords" class="form-label">Product Keywords</label>
      <input type="text" name="product_keywords" id="product_title" value="<?php echo "$product_keywords"; ?>" class="form-control" required="required">
    </div>

    <?php
    $select_category = "select * from Catergories where catergory_id=$catergory_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);

    $catergory_title = null; // Initialize to null in case no category is found
    if ($row_category) {
        $catergory_title = $row_category['catergory_title'];
    }
    // echo "$catergory_title";

    // brands
    $select_brand = "select * from brands where brand_id=$brand_id";
    $result_brand = mysqli_query($con, $select_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);

    $brand_title = null; // Initialize to null in case no brand is found
    if ($row_brand) {
        $brand_title = $row_brand['brand_title'];
    }
    // echo "$brand_title";
?>
    <div class="form-outline w-50 m-auto mt-3">
      <label for="product_category" class="form-label">Product Brands</label>
      <select class="form-select" name="product_category">
        <option value="<?php echo "$brand_title"; ?>"><?php echo "$brand_title"; ?></option>
        <?php
        $select_brand_all="select * from brands";
        $result_brand_all=mysqli_query($con,$select_brand_all);
        while ($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
          $brand_title=$row_brand_all['brand_title'];
          $brand_id=$row_brand_all['brand_id'];
          echo "<option value='$brand_id'>$brand_title</option>";
        }
        ?>

      </select>
    </div>
    <div class="form-outline w-50 m-auto mt-3">
      <label for="product_brand" class="form-label">Product Catergories</label>
      <select class="form-select" name="product_brand">
        <option value="<?php echo "$catergory_title"; ?>"><?php echo "$catergory_title"; ?></option>
        <?php
        $select_category_all="select * from Catergories";
        $result_category_all=mysqli_query($con,$select_category_all);
        while ($row_category_all=mysqli_fetch_assoc($result_category_all)){
          $catergory_title=$row_category_all['catergory_title'];
          $catergory_id=$row_category_all['catergory_id'];
          echo "<option value='$catergory_id'>$catergory_title</option>";
        }
        ?>

      </select>
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_image1" class="form-label">Product Image 1</label>
      <div class="d-flex">
        <input type="file" name="product_image1" id="product_title" value="<?php echo "$product_image1"; ?>" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo "$product_image1"; ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_image2" class="form-label">Product Image 2</label>
      <div class="d-flex">
        <input type="file" name="product_image2" id="product_title" value="<?php echo "$product_image2"; ?>" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo "$product_image2"; ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_image3" class="form-label">Product Image 3</label>
      <div class="d-flex">
        <input type="file" name="product_image3" id="product_title" value="<?php echo "$product_image3"; ?>" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo "$product_image3"; ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto">
      <label for="product_price" class="form-label">Product Price</label>
      <input type="text" name="product_price" id="product_title" value="<?php echo "$product_price"; ?>" class="form-control" required="required">
    </div>
    <div class="w-50 m-auto">
      <input type="submit" name="edit_product" value="update_product" class="btn btn-info px-3 mt-3">
    </div>
  </form>
</div>

<?php

if (isset($_POST['edit_product'])) {
  $product_title=$_POST['product_title'];
  $product_description=$_POST['product_description'];
  $product_keywords=$_POST['product_keywords'];
  $product_category=$_POST['product_category'];
  $product_category=$_POST['product_category'];
  $product_price=$_POST['product_price'];

  $product_image1=$_FILES['product_image1']['name'];
  $product_image2=$_FILES['product_image2']['name'];
  $product_image3=$_FILES['product_image3']['name'];

    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    // checking for empty fields

    if ($product_title=='' or $product_description=='' or $product_keywords=='' or $product_category=='' or
    $product_category=='' or $product_image1=='' or $product_image2=='' or $product_image3=='' or $product_price=='') {
      echo "<script>alert('Please Fill all the Fields!')</script>";
    }else {
      move_uploaded_file($temp_image1,"./product_images/$product_image1");
      move_uploaded_file($temp_image2,"./product_images/$product_image2");
      move_uploaded_file($temp_image3,"./product_images/$product_image3");
    }

    // query to update products
    $update_product="update products set product_title='$product_title', product_description='$product_description',
    product_keywords='$product_keywords',catergory_id='$product_category',brand_id='$product_category',
    product_image1='$product_image1',product_image2='$product_image2',product_image3='$product_image3',
     product_price='$product_price',date=NOW() WHERE product_id='$edit_id'";
     $result_update=mysqli_query($con,$update_product);

     if ($result_update){
       echo "<script>alert('Product updated Successfully.')</script>";
       echo "<script>window.open('index.php','_self')</script>";
     }
}

 ?>
