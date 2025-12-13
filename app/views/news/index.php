<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberpunk — News</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="news-bg" style="background-image: url('<?= BASE_URL ?>/img/bgnews.jpg');">

<header class="navbar">
    <div class="nav-inner">

        <div class="nav-left">
            <ul class="nav-menu">
                <li><a href="<?= BASE_URL; ?>">HOME</a></li>
                <li><a href="<?= BASE_URL; ?>/news" class="active">NEWS</a></li>
                <li><a href="<?= BASE_URL; ?>/gallery">GALLERY</a></li>
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

<section class="news-area">

    <div class="news-card" style="background: 
        linear-gradient(180deg, rgba(0,0,0,0.75), rgba(0,0,0,0.8)),
        url('<?= BASE_URL; ?>/img/bgnews2.png');">
        <!-- Konten Teks Kiri -->
        <div class="news-left">
            <h2 class="news-title">News</h2>
            <p>
                Update 2.3 lands tomorrow on PC, PlayStation 5, and Xbox Series X|S! The update will also be hitting Cyberpunk 2077: Ultimate Edition on Nintendo Switch 2 at a later date — stay tuned for more detes!
            </p><br>
            <p>
                Experience Night City in a whole new way — this patch introduces 4 new vehicles,  the AutoDrive feature, self-driving Delamain cabs and more! It also  contains updates for CrystalCoat™ and Photo Mode, as well as support for AMD FSR 3.1 Frame Generation, Intel XeSS 2.0 and HDR10+ Gaming on PC,  among others. Find out more at https://www.cyberpunk.net/en/news/51674/update-2-3-patch-notes
            </p>
        </div>

        <!-- Kotak Karakter dengan Border Dashed -->
        <div class="character-container">
            <div class="character-box" style="background: url('<?= BASE_URL; ?>/img/gambarcyber1.jpg'); background-size: cover; background-position: center;">
                <!-- GAMBAR KARAKTER: Ganti src dengan path gambar karakter Anda -->
                <img src="<?= BASE_URL; ?>/img/karakter1.png" alt="Character" class="news-character">
            </div>
        </div>

    </div>

</section>

</body>
</html>