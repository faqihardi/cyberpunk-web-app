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
    <div class="slider" id="slider">
        <?php if (!empty($submissions)): ?>
            <?php foreach ($submissions as $i => $sub): ?>
                <div class="slide<?= $i === 0 ? ' active' : '' ?>">
                    <img src="<?= BASE_URL . htmlspecialchars($sub['image']) ?>" class="slide-img" alt="<?= htmlspecialchars($sub['title']) ?>">
                    <div class="gallery-title">
                        <?= htmlspecialchars($sub['title']) ?><br>
                        <span><?= htmlspecialchars($sub['theme']) ?></span>
                    </div>
                    <div class="gallery-meta">
                        <span>Resolution: <?= htmlspecialchars($sub['resolution']) ?></span> |
                        <span>Author: <?= htmlspecialchars($sub['author']) ?></span> |
                        <span>Uploader: <?= htmlspecialchars($sub['uploader'] ?? $sub['user'] ?? '-') ?></span>
                    </div>
                    <?php if ($i > 0): ?>
                        <button class="nav-btn left" onclick="showSlide(<?= $i-1 ?>)">⬅</button>
                    <?php endif; ?>
                    <?php if ($i < count($submissions)-1): ?>
                        <button class="nav-btn right" onclick="showSlide(<?= $i+1 ?>)">➜</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="slide active">
                <div class="gallery-title">No submissions yet.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function showSlide(idx) {
    var slides = document.querySelectorAll('.slide');
    slides.forEach(function(slide, i) {
        slide.classList.toggle('active', i === idx);
    });
}
</script>
<script src="<?= BASE_URL; ?>/js/main.js"></script>
</body>
</html>
