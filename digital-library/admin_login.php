<?php
include 'Config.php';
$msg = "";
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $email;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $msg = "Invalid admin login";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library & E Book system</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="LogIn.php">Login</a>
            <a class="nav-link" href="Register.php">Register</a>
        </nav>
    </div>
</header>
<div class="login-shell">
    <div class="form-box reveal">
        <h2>Admin Login</h2>
        <p class="form-subtext">Manage books, users, and uploads.</p>
        <form method="POST">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="btn" name="login">Login</button>
        </form>
        <p class="msg"><?php echo $msg; ?></p>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
