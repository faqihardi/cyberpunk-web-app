<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = isset($_SESSION['auth_errors']) ? $_SESSION['auth_errors'] : [];
$success = isset($_SESSION['auth_success']) ? $_SESSION['auth_success'] : '';
$old = isset($_SESSION['old']) ? $_SESSION['old'] : ['name' => '', 'username' => '', 'email' => ''];

// Clear flash data
unset($_SESSION['auth_errors'], $_SESSION['auth_success'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .errors { color: #b00020; }
        .success { color: #006400; }
    </style>
</head>
<body>
    <h2>Register</h2>

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

    <form action="<?= BASE_URL ?>/auth/register" method="post" novalidate>
        <table>
            <tbody>
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" id="name" required value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" id="username" required value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="email" name="email" id="email" required value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" id="password" required minlength="6"></td>
                </tr>
                <tr>
                    <td>Password Confirmation: </td>
                    <td><input type="password" name="password_confirm" id="password_confirm" required minlength="6"></td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Register">
        <p>Already have an account? <a href="<?= BASE_URL ?>/auth/showlogin">Login here</a></p>
    </form>
</body>
</html>