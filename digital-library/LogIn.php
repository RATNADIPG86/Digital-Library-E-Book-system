<?php
include 'Config.php';
$msg = "";
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['name'];
        $_SESSION['user_id'] = $row['id'];
        header("Location: Dashboard.php");
        exit();
    } else {
        $msg = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="Register.php">Register</a>
            <a class="nav-link" href="admin_login.php">Admin</a>
        </nav>
    </div>
</header>
<div class="login-shell">
    <div class="form-box reveal">
        <h2>Welcome Back</h2>
        <p class="form-subtext">Login to access your digital library dashboard.</p>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button class="btn" name="login">Login</button>
        </form>
        <p class="msg"><?php echo $msg; ?></p>
        <p class="bottom-text">New here? <a href="Register.php">Create account</a></p>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
