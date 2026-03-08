<?php
include 'Config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$book = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE id=$id LIMIT 1"));
if (!$book) {
    die('Book not found');
}
$pdfPath = 'uploads/' . $book['pdf'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Online - <?php echo htmlspecialchars($book['title']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <?php if (isset($_SESSION['admin'])) { ?><a class="nav-link" href="admin_dashboard.php">Dashboard</a><?php } elseif (isset($_SESSION['user'])) { ?><a class="nav-link" href="Dashboard.php">Dashboard</a><?php } ?>
            <a class="nav-link" href="LogOut.php">Logout</a>
        </nav>
    </div>
</header>
<div class="container preview-shell">
    <div class="preview-card reveal">
        <div class="preview-top">
            <div>
                <div class="book-badge"><?php echo htmlspecialchars($book['category']); ?></div>
                <h1 style="font-size:34px;margin-bottom:6px;"><?php echo htmlspecialchars($book['title']); ?></h1>
                <p style="color:#64748b;"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?> &nbsp; | &nbsp; <strong>Rating:</strong> ⭐ <?php echo htmlspecialchars($book['rating']); ?>/5</p>
            </div>
            <div class="book-actions">
                <a class="btn-secondary small-btn" href="View_books.php">Back to Library</a>
                <a class="btn small-btn" href="downloads.php?file=<?php echo rawurlencode($book['pdf']); ?>">Download PDF</a>
            </div>
        </div>
        <?php if (file_exists($pdfPath)) { ?>
            <iframe class="preview-frame" src="<?php echo htmlspecialchars($pdfPath); ?>"></iframe>
        <?php } else { ?>
            <div class="empty-state">PDF file not found.</div>
        <?php } ?>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
