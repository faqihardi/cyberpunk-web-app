<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
    
</head>
<body class="gallery-body">

<header class="navbar">
    <div class="nav-inner">

        <div class="nav-left">
            <ul class="nav-menu">
                <li><a href="<?= BASE_URL; ?>">HOME</a></li>
                <li><a href="<?= BASE_URL; ?>/news">NEWS</a></li>
                <li><a href="<?= BASE_URL; ?>/gallery" class="active">GALLERY</a></li>
                <li><a href="<?= BASE_URL; ?>/characters">CHARACTERS</a></li>
                <li><a href="<?= BASE_URL; ?>/districts">DISTRICTS</a></li>
            </ul>
        </div>

        <div class="profile-box" title="Admin Login" onclick="location.href='<?= BASE_URL; ?>/auth/showLogin'" style="cursor: pointer;">
            <svg viewBox="0 0 24 24">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" fill="#222"/>
            </svg>
        </div>

    </div>
</header>

<div class="gallery-container">

    <!-- SLIDER WRAPPER -->
    <div class="slider" id="slider">

        <!-- ITEM 1 -->
        <div class="slide active">
            <img src="<?= BASE_URL; ?>/img/1.png" class="slide-img" alt="Character 1">

            <div class="gallery-title">GALLERY<br><span>ART 01</span></div>

            <button class="nav-btn right">➜</button>
        </div>

        <!-- ITEM 2 -->
        <div class="slide">
            <img src="<?= BASE_URL; ?>/img/2.png" class="slide-img" alt="Character 2">

            <div class="gallery-title">GALLERY<br><span>ART 02</span></div>

            <button class="nav-btn left">⬅</button>
            <button class="nav-btn right">➜</button>
        </div>

        <!-- ITEM 3 -->
        <div class="slide">
            <img src="<?= BASE_URL ?>/img/3.png" class="slide-img" alt="Character 3">

            <div class="gallery-title">GALLERY<br><span>ART 03</span></div>

            <button class="nav-btn left">⬅</button>
        </div>

    </div>
</div>

<script src="<?= BASE_URL; ?>/js/main.js"></script>
</body>
</html>
