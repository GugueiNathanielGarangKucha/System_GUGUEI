
<?php

if (isset($_GET['edit_categories'])) {
  $edit_categories=$_GET['edit_categories'];
  $get_catergories="select * from catergories where catergory_id=$edit_categories";
  $result=mysqli_query($con,$get_catergories);
  $row=mysqli_fetch_assoc($result);
  $catergory_title=$row['catergory_title'];
  // echo "$catergory_title";
}
if (isset($_POST['edit_cat'])) {
  $cat_title=$_POST['catergory_title'];
  $update_query="update catergories set catergory_title='$cat_title' where catergory_id=$edit_categories";
  $result_cat=mysqli_query($con,$update_query);
if ($result_cat) {
  echo "<script>alert(Catergory Updated Successfully)</script>";
  echo "<script>window.open('./index.php?view_categories.php', '_self')</script>";
  }
}
 ?>

<div class="container">
  <h1 class="text-center text-success">Edit Catergory</h1>
  <form class="text-center" action="" method="post">
    <div class="form-outline mb-4 w-50 m-auto ">
      <label for="catergory_title" class="form-label">Catergory Title</label>
      <input type="text" name="catergory_title" id="catergory_title" value="<?php echo "$catergory_title"; ?>" required=required class="form-control">
    </div>
    <input type="submit" name="edit_cat" value="Update Catergory" class="btn btn-info px-3 mb-4">
  </form>
</div>
