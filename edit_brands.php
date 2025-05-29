
<?php

if (isset($_GET['edit_brands'])) {
  $edit_brands=$_GET['edit_brands'];
  $get_brands="select * from brands where brand_id=$edit_brands";
  $result=mysqli_query($con,$get_brands);
  $row=mysqli_fetch_assoc($result);
  $brand_title=$row['brand_title'];
  // echo "$catergory_title";
}
if (isset($_POST['edit_brand'])) {
  $brand_title=$_POST['brand_title'];
  $update_query="update brands set brand_title='$brand_title' where brand_id=$edit_brands";
  $result_brand=mysqli_query($con,$update_query);
if ($result_brand) {
  echo "<script>alert(Brand Updated Successfully)</script>";
  echo "<script>window.open('./index.php?view_brands.php', '_self')</script>";
  }
}
 ?>

<div class="container">
  <h1 class="text-center text-success">Edit Brand</h1>
  <form class="text-center" action="" method="post">
    <div class="form-outline mb-4 w-50 m-auto ">
      <label for="catergory_title" class="form-label">Brand Title</label>
      <input type="text" name="brand_title" id="brand_title" value="<?php echo "$brand_title"; ?>" required=required class="form-control">
    </div>
    <input type="submit" name="edit_brand" value="Update Brand" class="btn btn-info px-3 mb-4">
  </form>
</div>
