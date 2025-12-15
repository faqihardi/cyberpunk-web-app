<?php 
$user = $data['user'] ?? null; 
$userName = $data['userName'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>
<body class="account-control-page">
<div class="admin-bg"></div>
<div class="account-control-container">
    <div class="submission-header">
        <h1 class="panel-title">Your Account</h1>
        <a href="<?= BASE_URL; ?>/user/dashboard">
            <span class="admin-label"><?= htmlspecialchars($userName) ?></span>
        </a>
    </div>
    
    <!-- Display success/error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <div class="account-content">
        <div class="user-details">
            <?php if ($user): ?>
            <form method="POST" id="updateUserForm" action="<?= BASE_URL; ?>/useraccount/update">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                <div class="detail-row">
                    <label>Name :</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="detail-row">
                    <label>Username :</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>
                <div class="detail-row">
                    <label>E-mail :</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="detail-row">
                    <label>Password :</label>
                    <input type="password" name="password" placeholder="Leave empty to keep current password">
                </div>
            </form>
            <?php endif; ?>
        </div>
        <div class="account-actions">
            <button class="action-btn" onclick="document.getElementById('updateUserForm').submit();">
                Update Account
            </button>
            <form method="POST" action="<?= BASE_URL; ?>/useraccount/delete" style="display:inline;" onsubmit="return confirmDelete()">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                <button class="action-btn" type="submit">Delete Account</button>
            </form>
        </div>
    </div>
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
</div>

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete your account? This action cannot be undone and will delete all your submissions.');
}
</script>

</body>
</html>