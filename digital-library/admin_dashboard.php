<?php
include 'Config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM books"));
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"));
$result = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php"><img src="images/logo.png" alt="Digital Library Logo"><span class="brand-text">Digital Library & E Book system</span></a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="Uploads_book.php">Upload Book</a>
            <a class="nav-link" href="LogOut.php">Logout</a>
        </nav>
    </div>
</header>
<div class="container dashboard-container">
    <h1 class="dashboard-title reveal">Admin Analytics Dashboard</h1>
    <p class="dashboard-subtitle reveal">Manage books, monitor users, and keep the library updated.</p>
    <div class="card-container">
        <div class="dashboard-card"><h3>Total Books</h3><p><?php echo (int)$total_books['total']; ?></p></div>
        <div class="dashboard-card"><h3>Total Users</h3><p><?php echo (int)$total_users['total']; ?></p></div>
        <div class="dashboard-card"><h3>Manage Library</h3><a href="Uploads_book.php" class="btn">Add New Book</a></div>
    </div>
    <section class="page-section">
        <h2 class="section-title" style="font-size:38px;">Manage Books</h2>
        <div class="library-grid">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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
                            <a class="btn-danger small-btn" onclick="return confirm('Delete this book?');" href="delete_book.php?id=<?php echo (int)$row['id']; ?>">Delete</a>
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
