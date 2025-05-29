 <?php

 if (isset($_GET['delete_categories'])) {
   $delete_categories=$_GET['delete_categories'];
   // echo "$delete_categories";
   $delete_query="Delete from catergories where catergory_id=$delete_categories";
   $result=mysqli_query($con,$delete_query);
   if ($result) {
     echo "<script>alert('Category Deleted Successfully')</script>";
     echo "<script>window.open('index.php','_self')</script>";
   }
 }

  ?>
