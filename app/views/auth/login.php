<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors  = $_SESSION['auth_errors']  ?? [];
$success = $_SESSION['auth_success'] ?? '';
$old     = $_SESSION['old']          ?? ['username' => ''];

unset($_SESSION['auth_errors'], $_SESSION['auth_success'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Cyberpunk 2077</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="login-page">

<!-- Background -->
<div class="login-bg">
    <div class="watermark">ADMIN DASHBOARD</div>
</div>

<!-- Login Container -->
<div class="login-container">
    <div class="login-box">

        <div class="corner-deco top-left"></div>
        <div class="corner-deco top-right"></div>
        <div class="corner-deco bottom-left"></div>
        <div class="corner-deco bottom-right"></div>

        <h1 class="login-title">Login</h1>

        <!-- SUCCESS -->
        <?php if (!empty($success)): ?>
            <div class="success-message">
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- ERRORS -->
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL; ?>/auth/login" novalidate>

            <div class="input-group">
                <input
                    type="text"
                    name="username"
                    placeholder="Username or Email"
                    required
                    value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14m-7-7l7 7-7 7"
                          stroke="#000"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </button>

        </form>

        <br>
        <p class="register-link">
            Don't have an account?
            <a href="<?= BASE_URL; ?>/auth/showregister">Register here</a>
        </p>

    </div>
</div>

</body>
</html>
