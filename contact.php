<?php
include('includes/connect.php');  // Include your database connection file
include('functions/common_function.php'); // Include common functions
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gugues Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css.css"> <style>
        /* Custom styles for the contact page */
        .contact-info {
            background-color: #f8f9fa; /* Light background */
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .contact-info h2 {
            color: #007bff; /* Primary color */
            margin-bottom: 20px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .contact-info ul li {
            margin-bottom: 10px;
            display: flex; /* Use flexbox for icon alignment */
            align-items: center; /* Vertically center icon and text */
        }
        .contact-info ul li i {
            margin-right: 10px; /* Space between icon and text */
            color: #007bff; /* Icon color */
            font-size: 1.2em; /* Adjust icon size as needed */
        }
        .contact-form {
            background-color: #ffffff; /* White background for form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .contact-form h2 {
            color: #007bff; /* Primary color */
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #343a40; /* Darker label color */
        }
        .form-control:focus {
            border-color: #007bff; /* Highlight border on focus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Add focus shadow */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            border-color: #0056b3;
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
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php cart(); ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a></li>";
                    }
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='./user_area/user_login.php'>Login</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./user_area/user_logout.php'>Logout</a></li>";
                    }
                    ?>
                </li>
            </ul>
        </nav>

        <div class="bg-light">
            <h3 class="text-center">Gugues Store</h3>
            <p class="text-center">Communication is at the heart of E-commerce and community</p>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info">
                        <h2>Contact Information</h2>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> 123 Main Street, Anytown, USA</li>
                            <li><i class="fas fa-phone"></i> (123) 456-7890</li>
                            <li><i class="fas fa-envelope"></i> info@guguesstore.com</li>
                            <li><i class="fas fa-globe"></i> www.guguesstore.com</li>
                        </ul>
                        <hr>
                        <h2>Follow Us</h2>
                        <ul>
                            <li><i class="fab fa-facebook"></i> <a href="#" target="_blank">Facebook</a></li>
                            <li><i class="fab fa-twitter"></i> <a href="#" target="_blank">Twitter</a></li>
                            <li><i class="fab fa-instagram"></i> <a href="#" target="_blank">Instagram</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="contact-form">
                        <h2>Send us a Message</h2>
                        <form action="send_contact_form.php" method="post">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-info p-3 text-center">
            <p>All Rights Reserved - Gugues Store Designed in 2025</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
