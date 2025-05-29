<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-info">
    <tr>
      <th>Sl no.</th>
      <th>category Title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody class="bg-secondary">
    <?php

    $select_cat="select * from Catergories";
    $result_cat=mysqli_query($con,$select_cat);
    $number=0;
    while ($row=mysqli_fetch_assoc($result_cat)) {
      $catergory_id=$row['catergory_id'];
      $catergory_title=$row['catergory_title'];
      $number++;
     ?>
    <tr>
      <td><?php echo "$number"; ?></td>
      <td><?php echo "$catergory_title"; ?></td>
      <td><a href='index.php?edit_categories=<?php echo "$catergory_id"; ?>' class='text-light'>Edit</a></td>
      <td><a href='index.php?delete_categories=<?php echo "$catergory_id"; ?>' class='text-light'>Delete</a></td>
    </tr>
  <?php
}
  ?>
  </tbody>
</table>
