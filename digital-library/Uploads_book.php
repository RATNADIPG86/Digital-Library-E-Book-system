<?php
include 'Config.php';
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: LogIn.php");
    exit();
}
$msg = "";
$success = false;
if (isset($_POST['upload'])) {
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $author = mysqli_real_escape_string($conn, trim($_POST['author']));
    $category = mysqli_real_escape_string($conn, trim($_POST['category']));
    $rating = mysqli_real_escape_string($conn, trim($_POST['rating']));
    $pdf = $_FILES['pdf']['name'] ?? '';
    $tmp_pdf = $_FILES['pdf']['tmp_name'] ?? '';
    $cover = $_FILES['cover']['name'] ?? '';
    $tmp_cover = $_FILES['cover']['tmp_name'] ?? '';

    if (!is_dir('uploads')) mkdir('uploads', 0777, true);
    if (!is_dir('covers')) mkdir('covers', 0777, true);

    $safePdf = time() . '-' . preg_replace('/[^A-Za-z0-9._-]/', '-', $pdf);
    $safeCover = time() . '-' . preg_replace('/[^A-Za-z0-9._-]/', '-', $cover);

    if ($pdf && $cover && move_uploaded_file($tmp_pdf, 'uploads/' . $safePdf) && move_uploaded_file($tmp_cover, 'covers/' . $safeCover)) {
        $sql = "INSERT INTO books(title, author, category, pdf, cover, rating) VALUES('$title', '$author', '$category', '$safePdf', '$safeCover', '$rating')";
        if (mysqli_query($conn, $sql)) {
            $msg = 'Book uploaded successfully';
            $success = true;
        } else {
            $msg = 'Database insert failed';
        }
    } else {
        $msg = 'File upload failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library & E Book system</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <?php if (isset($_SESSION['admin'])) { ?>
                <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
            <?php } else { ?>
                <a class="nav-link" href="Dashboard.php">Dashboard</a>
            <?php } ?>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="LogOut.php">Logout</a>
        </nav>
    </div>
</header>
<div class="form-box reveal">
    <h2>Upload New Book</h2>
    <p class="form-subtext">Add a book cover, category, rating, and PDF file to your library.</p>
    <div class="notice">Books can now be opened online from the library using the new preview feature.</div>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author Name" required>
        <input type="text" name="category" placeholder="Category (e.g. Finance, Novel, Science)" required>
        <label>Book Rating</label>
        <select name="rating" required>
            <option value="5.0">5.0</option>
            <option value="4.5">4.5</option>
            <option value="4.0">4.0</option>
            <option value="3.5">3.5</option>
            <option value="3.0">3.0</option>
        </select>
        <label>Upload PDF</label>
        <input type="file" name="pdf" accept="application/pdf" required>
        <label>Upload Book Cover</label>
        <input type="file" name="cover" accept="image/*" required>
        <button class="btn" name="upload">Upload Book</button>
    </form>
    <p class="msg <?php echo $success ? 'success' : ''; ?>"><?php echo $msg; ?></p>
</div>
<script src="script.js"></script>
</body>
</html>
