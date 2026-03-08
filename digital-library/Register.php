<?php
include 'Config.php';
$msg = "";
$success = false;
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if ($check && mysqli_num_rows($check) > 0) {
        $msg = "Email already registered";
    } else {
        mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
        $msg = "Registration successful. You can login now.";
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="LogIn.php">Login</a>
            <a class="nav-link" href="admin_login.php">Admin</a>
        </nav>
    </div>
</header>
<div class="login-shell">
    <div class="form-box reveal">
        <h2>Create Account</h2>
        <p class="form-subtext">Join your digital reading world.</p>
        <form method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button class="btn" name="register">Register</button>
        </form>
        <p class="msg <?php echo $success ? 'success' : ''; ?>"><?php echo $msg; ?></p>
        <p class="bottom-text">Already have an account? <a href="LogIn.php">Login</a></p>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
