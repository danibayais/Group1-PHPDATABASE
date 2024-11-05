<?php
// register.php: User registration logic

session_start();
include('includes/db.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Username or email already exists
        $error_message = "Username or email already exists!";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to login page after successful registration
            $_SESSION['message'] = "Registration successful! Please log in.";
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/login-register.css"> <!-- Include your CSS file -->
    <style>
        body {
    background-image: url('img/bg.avif'); /* Path to your image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    }
  </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Account</h2>

        <!-- Display error message if any -->
        <?php if (isset($error_message)) { echo "<p class='message'>$error_message</p>"; } ?>
        <?php if (isset($_SESSION['message'])) { echo "<p class='message'>" . $_SESSION['message'] . "</p>"; unset($_SESSION['message']); } ?>

        <!-- Registration Form -->
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>

        <p style="text-align:center;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
