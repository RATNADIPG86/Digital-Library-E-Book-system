<?php
include 'Config.php';
$result = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
$categories = mysqli_query($conn, "SELECT DISTINCT category FROM books ORDER BY category ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
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
                <a class="nav-link" href="Uploads_book.php">Upload Book</a>
            <?php } elseif (isset($_SESSION['user'])) { ?>
                <a class="nav-link" href="Dashboard.php">Dashboard</a>
                <a class="nav-link" href="Uploads_book.php">Upload Book</a>
            <?php } else { ?>
                <a class="nav-link" href="Register.php">Register</a>
                <a class="nav-link" href="LogIn.php">Login</a>
            <?php } ?>
            <a class="nav-link" href="View_books.php">Library</a>
            <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) { ?>
                <a class="nav-link" href="LogOut.php">Logout</a>
            <?php } else { ?>
                <a class="nav-link" href="admin_login.php">Admin</a>
            <?php } ?>
        </nav>
    </div>
</header>
<div class="container">
    <section class="library-header reveal">
        <h1>Our Library</h1>
        <p>Browse books, search by title or author, filter by category, preview online, or download the PDF.</p>
        <div class="filter-bar">
            <input type="text" id="searchInput" onkeyup="filterBooks()" placeholder="Search by title or author...">
            <select id="categoryFilter" onchange="filterBooks()">
                <option value="">All Categories</option>
                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo strtolower(htmlspecialchars($cat['category'])); ?>"><?php echo htmlspecialchars($cat['category']); ?></option>
                <?php } ?>
            </select>
        </div>
    </section>

    <div class="library-grid">
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="library-card book-card-item" data-title="<?php echo htmlspecialchars(strtolower($row['title'])); ?>" data-author="<?php echo htmlspecialchars(strtolower($row['author'])); ?>" data-category="<?php echo htmlspecialchars(strtolower($row['category'])); ?>">
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
        <?php } else { ?>
            <div class="empty-state">No books found yet. Upload the first book from the upload page.</div>
        <?php } ?>
    </div>
</div>
<div class="footer">Preview + Download feature added for your digital library.</div>
<script src="script.js"></script>
</body>
</html>
