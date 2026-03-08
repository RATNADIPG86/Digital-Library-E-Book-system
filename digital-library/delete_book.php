<?php
include 'Config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM books WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit();
?>