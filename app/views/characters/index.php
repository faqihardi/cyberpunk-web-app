<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="character-page">

<header class="navbar">
    <div class="nav-inner">

        <div class="nav-left">
            <ul class="nav-menu">
                <li><a href="<?= BASE_URL; ?>">HOME</a></li>
                <li><a href="<?= BASE_URL; ?>/news">NEWS</a></li>
                <li><a href="<?= BASE_URL; ?>/gallery">GALLERY</a></li>
                <li><a href="<?= BASE_URL; ?>/characters" class="active">CHARACTERS</a></li>
                <li><a href="<?= BASE_URL; ?>/districts">DISTRICTS</a></li>
            </ul>
        </div>

        <div class="profile-box"
             title="Admin Login"
             onclick="location.href='<?= BASE_URL; ?>/auth/showLogin'"
             style="cursor: pointer;">
            <svg viewBox="0 0 24 24">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" fill="#222"/>
            </svg>
        </div>

    </div>
</header>

<section class="character-section">

    <h1 class="char-title">Characters</h1>

    <div class="char-slider" id="charSlider">

        <?php foreach ($slides as $index => $slide): ?>
            <div class="char-slide <?= $index === 0 ? 'active' : '' ?>">
                <button class="char-nav left" onclick="charPrev()">⬅</button>

                <?php foreach ($slide as $char): ?>
                    <div class="char-box">
                        <img src="<?= BASE_URL . $char['image']; ?>"
                             class="char-img"
                             alt="<?= htmlspecialchars($char['name']) ?>">

                        <button class="char-btn"
                            onclick="location.href='<?= BASE_URL; ?>/characters/detail/<?= $char['id']; ?>'">
                            LEARN MORE
                        </button>
                    </div>
                <?php endforeach; ?>

                <button class="char-nav right" onclick="charNext()">➡</button>
            </div>
        <?php endforeach; ?>

    </div>

</section>

<script src="<?= BASE_URL; ?>/js/main.js"></script>

</body>
</html>
