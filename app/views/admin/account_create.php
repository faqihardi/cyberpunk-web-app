<?php
$adminName = $data['adminName'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>
<body class="account-control-page">
<div class="admin-bg"></div>
<div class="account-control-container">
    <!-- Header -->
    <div class="submission-header">
        <h1 class="panel-title">Create New Account</h1>
        <a href="<?= BASE_URL; ?>/admindashboard">
            <span class="admin-label"><?= htmlspecialchars($adminName) ?></span>
        </a>
    </div>
    <div class="account-content">
        <div class="user-details">
            <form method="POST" id="createUserForm" action="<?= BASE_URL; ?>/adminaccount/store">
                <div class="detail-row">
                    <label>Name :</label>
                    <input type="text" name="name" required>
                </div>
                <div class="detail-row">
                    <label>Username :</label>
                    <input type="text" name="username" required>
                </div>
                <div class="detail-row">
                    <label>E-mail :</label>
                    <input type="email" name="email" required>
                </div>
                <div class="detail-row">
                    <label>Password :</label>
                    <input type="password" name="password" required>
                </div>
                <div class="detail-row">
                    <label>Privilege :</label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_admin">
                        Administrator
                    </label>
                </div>
            </form>
        </div>
        <div class="account-actions">
            <button class="action-btn" onclick="createAccount()">Create Account</button>
            <button class="action-btn" onclick="location.href='<?= BASE_URL; ?>/adminaccount'">Cancel</button>
        </div>
    </div>
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
</div>
<script>
function createAccount() {
    document.getElementById('createUserForm').submit();
}
</script>
</body>
</html>
