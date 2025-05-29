<?php

$username=$_SESSION['username'];
$GET_user="select * from user_table where username='$username'"; // Use the session variable
$result=mysqli_query($con,$GET_user);
$row_fetch=mysqli_fetch_assoc($result);
// Add a check to ensure a user was found before accessing array elements
if ($row_fetch) {
    $user_id=$row_fetch['user_id'];
} else {
    // Handle the case where the user is not found in the database.
    // You might want to display an error message or redirect the user.
    echo "<div class='alert alert-danger'>Error: User not found. Please log in again.</div>";
    exit(); // Stop further execution
}

?>

<div class="container">
  <h3 class="text-success">All My Orders</h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-info">
    <tr>
      <th>Serial No.</th>
      <th>Amount Due</th>
      <th>Total Products</th>
      <th>Invoice Number</th>
      <th>Date</th>
      <th>Complete / Incomplete</th>
      <th>Status</th>
    </tr>
     </thead>
     <tbody class="bg-secondary text-light">
       <?php

       $get_order_details="select * from user_orders where user_id='$user_id'";
       $result_orders=mysqli_query($con,$get_order_details);
       $number=1;
       while ($row_orders=mysqli_fetch_assoc($result_orders)) {
         $order_id=$row_orders['order_id'];
         $amount_due=$row_orders['amount_due'];
         $invoice_number=$row_orders['invoice_number'];
         $total_products=$row_orders['total_products'];
         $order_date=$row_orders['order_date'];
         $order_status=$row_orders['order_status'];
         echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
        ?>
        <?php
        if ($order_status=='Complete') {
          echo "<td>Paid</td>";
        }
        else {
          echo "  <td><a href='confirm_payment.php?order_id=$order_id' class='text-center text-light'>Confirm</a></td>";
        }

         if ($order_status=='pending') {
           $order_status_display='Incomplete';
         }else {
           $order_status_display='Complete';
         }
         $number++;
       }
        ?>
     </tbody>
  </table>
</div>
