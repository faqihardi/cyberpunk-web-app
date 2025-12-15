<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($data['name']) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>

<body class="character-detail-page">

<header class="navbar">
    <div class="nav-inner">
        <a href="<?= BASE_URL ?>/characters" class="back-btn">← Characters</a>
    </div>
</header>

<section class="character-detail">
    <div class="detail-left">
           <img src="<?= BASE_URL . ($data['image'] ?? '') ?>"
               class="detail-img"
               id="characterImg"
               alt="<?= htmlspecialchars($data['name'] ?? '') ?>">

           <h2 class="char-name"><?= htmlspecialchars($data['name'] ?? '') ?></h2>
    </div>

    <div class="detail-right">
        <h2 class="section-title">Description</h2>
        <p class="description-text"><?= htmlspecialchars($data['description'] ?? '') ?></p>

        <h2 class="section-title">Fun Facts</h2>
        <ul class="facts-box">
            <?php if (!empty($facts) && is_array($facts)): ?>
                <?php foreach ($facts as $i => $fact): ?>
                    <li>
                        <span class="fact-number"><?= $i + 1 ?>.</span>
                        <?= htmlspecialchars($fact['fact']) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No facts available.</li>
            <?php endif; ?>
        </ul>
    </div>
</section>

<script>
// ============================
// 3D HOVER EFFECT (TIDAK DIHAPUS)
// ============================
const img = document.getElementById('characterImg');
const container = document.querySelector('.detail-left');

container.addEventListener('mousemove', (e) => {
    const rect = container.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    const rotateX = (y - centerY) / 15;
    const rotateY = (centerX - x) / 15;

    img.style.transform = `
        perspective(1000px)
        rotateX(${rotateX}deg)
        rotateY(${rotateY}deg)
        scale3d(1.05, 1.05, 1.05)
    `;
});

container.addEventListener('mouseleave', () => {
    img.style.transform =
        'perspective(1000px) rotateX(0) rotateY(0) scale3d(1,1,1)';
});

// ============================
// PARALLAX SCROLL EFFECT
// ============================
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    img.style.transform = `translateY(${scrolled * 0.3}px)`;
});
</script>

</body>
</html>
