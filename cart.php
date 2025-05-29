<?php
include('./includes/connect.php');
include('./functions/common_function.php');
session_start();

// Function to update cart quantity and redirect (RETAINED for non-AJAX fallback)
function update_cart_and_redirect()
{
    global $con;
    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $qty) {
            $product_id = intval($product_id);
            $qty = intval($qty);

            if ($qty > 0) {
                $update_qty_query = "UPDATE cart_details SET quantity = ? WHERE ip_address = ? AND product_id = ?";
                $stmt_update = mysqli_prepare($con, $update_qty_query);

                if ($stmt_update) {
                    mysqli_stmt_bind_param($stmt_update, "isi", $qty, getIPAddress(), $product_id);
                    mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
                } else {
                    error_log("Error preparing update query: " . mysqli_error($con));
                    echo "<script>alert('Failed to update cart. Please try again.');</script>";
                    echo "<script>window.open('cart.php?error=1', '_self')</script>";
                    exit;
                }
            }
        }
        echo "<script>window.open('cart.php', '_self')</script>"; //redirect
    } else {
        echo "<script>alert('Invalid request. Quantity data is missing.');</script>";
        echo "<script>window.open('cart.php?error=2', '_self')</script>";
        exit;
    }
}

// Function to calculate the total price of the cart
function get_cart_total_price()
{
    global $con;
    $total_price = 0;
    $ip_address = getIPAddress();

    // Join cart_details with products to get the price
    $cart_query = "SELECT cart_details.quantity, products.product_price
                   FROM cart_details
                   INNER JOIN products ON cart_details.product_id = products.product_id
                   WHERE cart_details.ip_address = ?";
    $stmt_cart = mysqli_prepare($con, $cart_query);

    if ($stmt_cart) {
        mysqli_stmt_bind_param($stmt_cart, "s", $ip_address);
        mysqli_stmt_execute($stmt_cart);
        $result_cart = mysqli_stmt_get_result($stmt_cart);

        while ($row_cart = mysqli_fetch_assoc($result_cart)) {
            $product_price = $row_cart['product_price'];
            $quantity = $row_cart['quantity'];
            $subtotal = $product_price * $quantity;
            $total_price += $subtotal;
        }
        mysqli_stmt_close($stmt_cart);
    } else {
        error_log("Error preparing cart query: " . mysqli_error($con));
        echo "<script>alert('Failed to retrieve cart data.');</script>";
        return 0;
    }
    return $total_price;
}

// Check if the update cart form has been submitted (RETAINED for non-AJAX)
if (isset($_POST['update_cart'])) {
    update_cart_and_redirect();
}

// Handle remove functionality
if (isset($_POST['remove'])) {
    global $con;
    foreach ($_POST['remove'] as $remove_id) {
        $delete_query = "DELETE FROM cart_details WHERE product_id = ? AND ip_address = ?";
        $stmt_delete = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt_delete, "is", $remove_id, getIPAddress());
        mysqli_stmt_execute($stmt_delete);
        mysqli_stmt_close($stmt_delete);
    }
    echo "<script>window.open('cart.php', '_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css.css">
    <style>
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .quantity-field {
            width: 50px;
            text-align: center;
        }

        .total-price {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/Logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all_products.php">Products</a>
                        </li>
                        <?php
                          if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                            </li>";
                          }
                          else {
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                            </li>";
                          }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
                                        <?php cart_item(); ?>
                                    </sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        cart();
        ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">

                    <?php
                    //displaying user name
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                                    <a class='nav-link' href='#'>Welcome Guest</a>
                                </li>";
                    } else {
                        echo "<li class='nav-item'>
                                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                                </li>";
                    }
                    //login and logout
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='./user_area/user_login.php'>login</a>
                                    </li>";
                    } else {
                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='./user_area/user_logout.php'>logout</a>
                                    </li>";
                    }

                    ?>
                </li>
            </ul>
        </nav>
        <div class="bg-light">
            <h3 class="text-center">Gugues Store</h3>
            <p class="text-center">Communication is at the heart of E-commerce and community </p>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan="1">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $con;
                            $ip_address = getIPAddress();
                            $total_cart_price = 0;
                            $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip_address'";
                            $result = mysqli_query($con, $cart_query);

                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM Products WHERE product_id='$product_id'";
                                $result_products = mysqli_query($con, $select_products);

                                while ($row_product = mysqli_fetch_array($result_products)) {
                                    $product_price = $row_product['product_price'];
                                    $product_title = $row_product['product_title'];
                                    $product_image1 = $row_product['product_image1'];
                                    $current_quantity = $row['quantity'];
                                    $individual_product_price = $product_price * $current_quantity;
                                    $total_cart_price += $individual_product_price;
                                    ?>
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img src="./Admin/product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_title; ?>" class="cart-img"></td>
                                        <td>
                                            <input type="number" name="quantity[<?php echo $product_id; ?>]" class="form-input quantity-field w-50 text-center" min="1" value="<?php echo max(1, $current_quantity); ?>" data-product-id="<?php echo $product_id; ?>" data-product-price="<?php echo $product_price; ?>">
                                        </td>
                                        <td class="product-price"><?php echo $product_price; ?></td>
                                        <td class="total-price"><?php echo $individual_product_price; ?></td>
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></td>
                                        <td>
                                            <button type="submit" class="bg-info text-center py-2 px-3 border-0 update-btn" name="update_cart">Update</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-flex mb-5">
                        <h4 class="px-4">Subtotal: <strong class="text-info total-cart-price"><?php echo $total_cart_price ?></strong> /=</h4>
                        <a href="index.php"><button class="btn-info p-3 py-2 mx-3">Continue Shopping</button></a>
                        <button class="btn-secondary p-3 py-2 mx-3"><a href="./user_area/check_out.php" class="text-light text-decoration-none">Check Out </button></a>
                    </div>
                </form>
                <form action="" method="post">
                    <div>
                        <?php
                        // Display the "Remove" button only if there are items to remove
                        if (!empty($_POST['remove'])) {
                            echo '<input type="submit" value="Remove Selected" class="bg-danger text-center py-2 px-3 border-0 mt-2" name="remove">';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-info p-3 text-center">
            <p>All Rights Resereved - Nathan Desgined in 2025 </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // Get all quantity input fields
        const quantityFields = document.querySelectorAll('.quantity-field');

        // Add an event listener to each quantity field
        quantityFields.forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.dataset.productId;
                const productPrice = parseFloat(this.dataset.productPrice);
                const quantity = parseInt(this.value);

                // Find the corresponding total price cell
                const totalPriceCell = this.closest('tr').querySelector('.total-price');

                // Calculate the new total price for the item
                const newTotalPrice = productPrice * quantity;

                // Update the total price cell
                totalPriceCell.textContent = newTotalPrice;

                // Update the cart without a full page reload (AJAX call)
                updateCartItem(productId, quantity);

                // Recalculate and update the overall cart subtotal
                updateCartSubtotal();
            });
        });

        function updateCartItem(productId, quantity) {
            // Use AJAX to send the updated quantity to a server-side script
            fetch('update_cart_ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${productId}&quantity=${quantity}`
            })
            .then(response => response.text())
            .then(data => {
                // Optionally handle the server response (e.g., display a message)
                console.log(data);
            })
            .catch(error => {
                console.error('Error updating cart:', error);
            });
        }

        function updateCartSubtotal() {
            let subtotal = 0;
            const totalPriceCells = document.querySelectorAll('.total-price');
            totalPriceCells.forEach(cell => {
                subtotal += parseFloat(cell.textContent);
            });

            const totalCartPriceElement = document.querySelector('.total-cart-price');
            totalCartPriceElement.textContent = subtotal;
        }
    </script>
</body>

</html>
