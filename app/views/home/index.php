<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cyberpunk — Home</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
    <style>
        .hero {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 60px;
            perspective: 1000px;
        }

        .cp-logo {
            max-width: 90%;
            height: auto;
            transition: transform 0.1s ease-out;
            will-change: transform;
            filter: drop-shadow(0 0 20px rgba(255, 0, 255, 0.5));
        }
    </style>
</head>

<body class="home-bg" style="background-image: url('<?= BASE_URL; ?>/img/bghome.png'); background-size: cover; background-position: center; background-attachment: fixed; margin: 0; overflow-x: hidden;">

<header class="navbar">
    <div class="nav-inner">

        <!-- NAV LEFT (menu + box) -->
        <div class="nav-left">
            <ul class="nav-menu">
                <li><a class="active" href="<?= BASE_URL; ?>">HOME</a></li>
                <li><a href="<?= BASE_URL; ?>/news">NEWS</a></li>
                <li><a href="<?= BASE_URL; ?>/gallery">GALLERY</a></li>
                <li><a href="<?= BASE_URL; ?>/characters">CHARACTERS</a></li>
                <li><a href="<?= BASE_URL; ?>/districts">DISTRICTS</a></li>
            </ul>
        </div>

        <!-- PROFILE ICON (inline SVG, bukan gambar) -->
        <div class="profile-box" title="Profile" onclick="location.href='<?= BASE_URL; ?>/auth/showLogin'">
            <!-- Inline SVG icon (user circle). Kamu bisa ganti ukurannya via CSS .profile-box svg { width:... } -->
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" fill="#222"/>
            </svg>
        </div>

    </div>
</header>

<section class="hero">

    <!-- Logo Cyberpunk dengan Parallax 3D Effect -->
    <img src="<?= BASE_URL; ?>/img/fontcyberpunk2077.png" class="cp-logo" alt="Cyberpunk 2077 logo" id="cpLogo">

</section>

<script>
    const logo = document.getElementById('cpLogo');
    
    document.addEventListener('mousemove', (e) => {
        // Hitung posisi mouse relatif terhadap center layar
        const mouseX = (e.clientX / window.innerWidth) - 0.5;
        const mouseY = (e.clientY / window.innerHeight) - 0.5;
        
        // Skala efek (bisa di-adjust untuk intensity yang berbeda)
        const moveX = mouseX * 30; // Max 30px movement horizontal
        const moveY = mouseY * 20; // Max 20px movement vertical
        
        // Hitung rotasi 3D (tilt effect)
        const rotateX = -mouseY * 10; // Rotasi X axis
        const rotateY = mouseX * 10;  // Rotasi Y axis
        
        // Apply transform dengan 3D perspective
        logo.style.transform = `
            translate(${moveX}px, ${moveY}px) 
            rotateX(${rotateX}deg) 
            rotateY(${rotateY}deg) 
            scale(1.02)
        `;
    });
    
    // Reset position ketika mouse meninggalkan window
    document.addEventListener('mouseleave', () => {
        logo.style.transform = 'translate(0, 0) rotateX(0deg) rotateY(0deg) scale(1)';
    });
</script>

</body>
</html>

