<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors  = $_SESSION['auth_errors']  ?? [];
$success = $_SESSION['auth_success'] ?? '';
$old     = $_SESSION['old']          ?? [
    'name'     => '',
    'username' => '',
    'email'    => ''
];

unset($_SESSION['auth_errors'], $_SESSION['auth_success'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cyberpunk 2077</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="login-page">

<!-- Background -->
<div class="login-bg">
    <div class="watermark">ADMIN DASHBOARD</div>
</div>

<!-- Register Container -->
<div class="login-container">
    <div class="login-box">

        <!-- Corner decorations -->
        <div class="corner-deco top-left"></div>
        <div class="corner-deco top-right"></div>
        <div class="corner-deco bottom-left"></div>
        <div class="corner-deco bottom-right"></div>

        <h1 class="login-title">Register</h1>

        <!-- SUCCESS MESSAGE -->
        <?php if (!empty($success)): ?>
            <div class="success-message">
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- ERROR MESSAGE -->
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="<?= BASE_URL; ?>/auth/register" method="post" novalidate>

            <div class="input-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    required
                    value="<?= htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="input-group">
                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    required
                    value="<?= htmlspecialchars($old['username'], ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="input-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    value="<?= htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    minlength="6"
                >
            </div>

            <div class="input-group">
                <input
                    type="password"
                    name="password_confirm"
                    placeholder="Confirm Password"
                    required
                    minlength="6"
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
            Already have an account?
            <a href="<?= BASE_URL; ?>/auth/showlogin">Login here</a>
        </p>

    </div>
</div>

</body>
</html>
