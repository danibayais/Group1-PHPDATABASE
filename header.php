<!-- header.php -->
<?php
session_start(); // Start the session to track user login state
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shoe Store</title>
    <link rel="stylesheet" href="css/index-store.css"> <!-- Link to your CSS file for the page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
     
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <!-- Check if the user is logged in -->
                <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="profile.php">Welcome, <?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
                
                <li><a href="cart.php">Cart</a></li> <!-- Shopping Cart link -->
            </ul>
        </nav>
    </header>

    <!-- Page Content Start -->
    <div class="container">
