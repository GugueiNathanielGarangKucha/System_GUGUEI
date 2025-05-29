<?php
include('../includes/connect.php');  // Include your database connection file FIRST.
include('../functions/common_function.php');

    if (isset($_GET['user_id'])) {
        $user_id=$_GET['user_id'];
    }

    // getting the total_price and total number of items
    $get_ip_address=getIPAddress();
    $total_price=0;
    $cart_query="select * from cart_details where ip_address='$get_ip_address'";
    $result_cart=mysqli_query($con,$cart_query);
    $invoice_number=mt_rand();
    $status='pending';
    $count_products=mysqli_num_rows($result_cart);

    // Calculate total price and get individual product IDs and quantities
    $product_details = array();
    while ($row_cart=mysqli_fetch_array($result_cart)) {
        $product_id = $row_cart['product_id'];
        $quantity = $row_cart['quantity'];
        $select_products="select * from products where product_id=$product_id";
        $run_price=mysqli_query($con,$select_products);
        while ($row_product_price=mysqli_fetch_array($run_price)) {
            $product_price=$row_product_price['product_price'];
            $subtotal_single=$product_price*$quantity;
            $total_price+=$subtotal_single;
            $product_details[] = array('product_id' => $product_id, 'quantity' => $quantity);
        }
    }

    // Insert into user_orders table
    $insert_orders="INSERT INTO user_orders (user_id,amount_due,invoice_number,total_products,order_date,order_status)
    VALUES ($user_id,$total_price,$invoice_number,$count_products,NOW(),'$status')";
    $result_query=mysqli_query($con,$insert_orders);

    if ($result_query) {
        echo "<script>alert('Orders Submitted successfully')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>"; // Redirect to my_orders for user to see
    } else {
        echo "<script>alert('Error submitting order')</script>"; // Handle potential errors
    }

    // Insert into orders_pending table
    foreach ($product_details as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $insert_pending_orders="INSERT INTO order_pending (user_id,invoice_number,product_id,quantity,order_status)
        VALUES ($user_id,$invoice_number,$product_id,$quantity,'$status')";
        $result_pending_orders=mysqli_query($con,$insert_pending_orders);
        if (!$result_pending_orders) {
            echo "<script>alert('Error inserting into pending orders')</script>"; // Handle potential errors
        }
    }

    // delete items from cart
    $empty_cart="DELETE FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_delete=mysqli_query($con,$empty_cart);
    if (!$result_delete) {
        echo "<script>alert('Error emptying the cart')</script>"; // Handle potential errors
    }

?>
