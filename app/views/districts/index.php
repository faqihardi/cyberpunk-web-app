<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Districts - Cyberpunk 2077</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="districts-page">

<!-- NAVBAR -->
<header class="navbar">
    <div class="nav-inner">
        <div class="nav-left">
            <ul class="nav-menu">
                <li><a href="<?= BASE_URL; ?>">HOME</a></li>
                <li><a href="<?= BASE_URL; ?>/news">NEWS</a></li>
                <li><a href="<?= BASE_URL; ?>/gallery">GALLERY</a></li>
                <li><a href="<?= BASE_URL; ?>/characters">CHARACTERS</a></li>
                <li><a href="<?= BASE_URL; ?>/districts" class="active">DISTRICTS</a></li>
            </ul>
        </div>

        <div class="profile-box" title="Admin Login" onclick="location.href='<?= BASE_URL; ?>/auth/showLogin'" style="cursor: pointer;">
            <svg viewBox="0 0 24 24">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" fill="#222"/>
            </svg>
        </div>
    </div>
</header>

<!-- DISTRICTS SLIDER SECTION -->
<section class="districts-section">
    
    <div class="districts-slider" id="districtsSlider">

        <?php foreach ($districts as $i => $district): ?>
            <div class="district-slide <?= $i === 0 ? 'active' : '' ?>">
                <button class="district-nav left" onclick="districtPrev()">
                    <svg width="30" height="50" viewBox="0 0 30 50">
                        <polyline points="25,5 5,25 25,45" fill="none" stroke="#fcee09" stroke-width="3"/>
                    </svg>
                </button>

                <div class="district-bg" style="background-image: url('<?= BASE_URL . $district['bg'] ?>');"></div>
                
                <div class="district-content">
                    <div class="district-header">
                        <h1 class="district-title"><?= htmlspecialchars($district['title']) ?></h1>
                    </div>
                    
                    <div class="district-description">
                        <?php if (!empty($district['icon'])): ?>
                            <img src="<?= BASE_URL . $district['icon'] ?>" alt="<?= htmlspecialchars($district['title']) ?> Icon" class="district-icon">
                        <?php endif; ?>
                        <p><?= htmlspecialchars($district['desc']) ?></p>
                    </div>
                </div>

                <button class="district-nav right" onclick="districtNext()">
                    <svg width="30" height="50" viewBox="0 0 30 50">
                        <polyline points="5,5 25,25 5,45" fill="none" stroke="#fcee09" stroke-width="3"/>
                    </svg>
                </button>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Slide Indicator Dots -->
    <div class="district-indicators">
        <?php foreach ($districts as $i => $_): ?>
            <span class="indicator <?= $i === 0 ? 'active' : '' ?>" onclick="goToSlide(<?= $i ?>)"></span>
        <?php endforeach; ?>
    </div>

</section>

<script src="<?= BASE_URL; ?>/js/main.js"></script>

</body>
</html>