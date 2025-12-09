<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = isset($_SESSION['auth_errors']) ? $_SESSION['auth_errors'] : [];
$success = isset($_SESSION['auth_success']) ? $_SESSION['auth_success'] : '';
$old = isset($_SESSION['old']) ? $_SESSION['old'] : ['username' => ''];

unset($_SESSION['auth_errors'], $_SESSION['auth_success'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .errors { color: #b00020; }
        .success { color: #006400; }
    </style>
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/auth/login" method="post" novalidate>
        <table>
            <tr>
                <td>Username or Email: </td>
                <td><input type="text" name="username" id="username" required value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" id="password" required minlength="6"></td>
            </tr>
        </table>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="<?= BASE_URL ?>/auth/showregister">Register here</a></p>
    </form>
</body>
</html>