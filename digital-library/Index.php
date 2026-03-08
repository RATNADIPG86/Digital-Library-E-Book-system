<?php include 'Config.php';
$totalBooks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM books"));
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="Index.php">
            <img src="images/logo.png" alt="Digital Library Logo">
            <span class="brand-text">Digital Library & E Book system</span>
        </a>
        <nav class="nav-right">
            <a class="nav-link" href="Index.php">Home</a>
            <a class="nav-link" href="View_books.php">Library</a>
            <a class="nav-link" href="Register.php">Register</a>
            <a class="nav-link" href="LogIn.php">Login</a>
            <a class="nav-link" href="admin_login.php">Admin</a>
        </nav>
    </div>
</header>

<section class="kindle-hero">
    <div class="hero-content container">
        <div class="hero-badge">Digital Library &amp; E-Book Management System</div>
        <h1>Read, preview, and manage books in one modern library website.</h1>
        <p>Search books, preview PDFs directly in the browser, download them anytime, and manage your collection from a clean professional dashboard.</p>
        <div class="hero-buttons">
            <a href="View_books.php" class="btn">Explore Library</a>
            <a href="Register.php" class="btn-outline">Create Account</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="section-title">Why choose our library?</h2>
        <p class="section-subtitle">Built for a smoother reading and management experience.</p>
        <div class="features-grid">
            <div class="feature-card"><div class="feature-icon">📖</div><h3>Online PDF Preview</h3><p>Books can now be opened directly in the browser, not just downloaded.</p></div>
            <div class="feature-card"><div class="feature-icon">🔎</div><h3>Smart Search</h3><p>Search by title or author and filter books instantly by category.</p></div>
            <div class="feature-card"><div class="feature-icon">📂</div><h3>Organized Collection</h3><p>Clean cards, covers, categories, and ratings keep everything easy to browse.</p></div>
            <div class="feature-card"><div class="feature-icon">⚡</div><h3>Animated UI</h3><p>Professional sections, hover effects, and smooth reveal animations.</p></div>
        </div>
        <div class="stats-strip">
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-label">Total Books</div><div class="stat-number"><?php echo (int)$totalBooks['total']; ?></div></div>
                <div class="stat-card"><div class="stat-label">Registered Users</div><div class="stat-number"><?php echo (int)$totalUsers['total']; ?></div></div>
                <div class="stat-card"><div class="stat-label">Reading Mode</div><div class="stat-number">Preview + Download</div></div>
            </div>
        </div>
    </div>
</section>

<div class="footer">This Is Digital Library And E Book Managment system Project.</div>
<script src="script.js"></script>
</body>
</html>
