<?php
include 'Config.php';
if (!isset($_SESSION['user'])) {
    header("Location: LogIn.php");
    exit();
}
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"));
$latest = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library & E Book system</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="Dashboard.php">Dashboard</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="Uploads_book.php">Upload Book</a>
            <a class="nav-link" href="LogOut.php">Logout</a>
        </nav>
    </div>
</header>
<div class="container dashboard-container">
    <h1 class="dashboard-title reveal">Welcome <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
    <p class="dashboard-subtitle reveal">Quick access to your digital library tools and latest books.</p>
    <div class="card-container">
        <div class="dashboard-card"><h3>Total Books</h3><p><?php echo (int)$total_books['total']; ?></p></div>
        <div class="dashboard-card"><h3>Explore Library</h3><a href="View_books.php" class="btn">Browse Books</a></div>
        <div class="dashboard-card"><h3>Upload Book</h3><a href="Uploads_book.php" class="btn">Add New Book</a></div>
    </div>
    <section class="page-section">
        <h2 class="section-title" style="font-size:38px;">Latest Books</h2>
        <div class="library-grid">
            <?php while ($row = mysqli_fetch_assoc($latest)) { ?>
                <div class="library-card show">
                    <div class="cover-box">
                        <?php if (!empty($row['cover']) && file_exists('covers/' . $row['cover'])) { ?>
                            <img src="covers/<?php echo rawurlencode($row['cover']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?> cover">
                        <?php } else { ?>
                            <div class="dummy-cover">No Cover</div>
                        <?php } ?>
                    </div>
                    <div class="book-info">
                        <div class="book-badge"><?php echo htmlspecialchars($row['category']); ?></div>
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <div class="book-meta">
                            <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                            <p><strong>Rating:</strong> ⭐ <?php echo htmlspecialchars($row['rating']); ?>/5</p>
                        </div>
                        <div class="book-actions">
                            <a class="btn small-btn" href="preview.php?id=<?php echo (int)$row['id']; ?>">Read Online</a>
                            <a class="btn-secondary small-btn" href="downloads.php?file=<?php echo rawurlencode($row['pdf']); ?>">Download PDF</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
<script src="script.js"></script>
</body>
</html>
