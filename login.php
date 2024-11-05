<?php
// login.php: User login logic
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
            $error_message = "Invalid credentials!";
        }
    } else {
        $error_message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login-register.css">
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
        <h2>Login</h2>
        
        <?php if(isset($error_message)) { echo "<p class='message'>$error_message</p>"; } ?>
        
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        <p style="text-align:center;">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
