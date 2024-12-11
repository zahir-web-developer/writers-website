<?php
session_start();
include './service/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Writers Website</title>
</head>

<body class="bg-secondary">
    <nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="./index.php">WW</a>
        <div class="nav-center">
            <ul>
                <?php if (!isset($_SESSION['id'])) { ?>
                    <li><a href="./auth/login.php">Login</a></li>
                    <li><a href="./auth/register.php">Register</a></li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownToggle">Advice</a>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><a href="./akun/self.php">My Advice</a></li>
                            <li><a href="./article/create.php">Make Suggestions</a></li>
                        </ul>
                    </li>

                    <li><a href="./auth/logout.php">Logout</a></li>
                    <?php if ($_SESSION['is_admin'] == 1) { ?>
                        <li><a href="./admin/index.php">Author</a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="main-container">
    <div class="content">
        <div class="welcome-message">
            <h1>Welcome</h1>
            <h2><?= $_SESSION['username'] ?? '' ?></h2>
            <h3>in Writers Website</h3>
        </div>
        <div class="image-section">
            <div class="bg-image"></div>
        </div>
    </div>

    <div class="action-button">
        <a class="btn" href="./article/create.php">Make Suggestions</a>
    </div>
</div>

<script>
    // Seleksi elemen
    const dropdownToggle = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Tambahkan event listener untuk klik
    dropdownToggle.addEventListener('click', function (event) {
        event.preventDefault(); // Mencegah redirect
        // Toggle tampilan dropdown
        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
        } else {
            dropdownMenu.style.display = 'block';
        }
    });

    // Sembunyikan dropdown jika klik di luar menu
    document.addEventListener('click', function (event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>


</body>

</html>
