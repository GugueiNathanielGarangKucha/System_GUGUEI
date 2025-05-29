<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-info">
    <tr>
      <th>Sl no</th>
      <th>User Name </th>
      <th>User Email</th>
      <th>User Address</th>
      <th>User Mobile</th>
    </tr>
  </thead>
<tbody class='bg-secondary text-light'>
  <?php
$get_user="select * from user_table";
$result_user=mysqli_query($con,$get_user);
$row_count=mysqli_num_rows($result_user);

if ($row_count==0) {
  echo "<h2 class='text-danger text-center'>No User Found</h2>";
}
else {
  $number=0;
  while ($row_data=mysqli_fetch_assoc($result_user)) {
    $user_id=$row_data['user_id'];
    $username=$row_data['username'];
    $user_email=$row_data['user_email'];
    $user_address=$row_data['user_address'];
    $user_mobile=$row_data['user_mobile'];
    $number++;

  echo "<tr>
  <td>$number</td>
  <td>$username</td>
  <td>$user_email</td>
  <td>$user_address</td>
  <td>$user_mobile</td>";
}
}

?>


  </tbody>
</table>
