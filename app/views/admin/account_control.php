<?php
$adminName = $data['adminName'] ?? 'Admin';
$users = $data['users'] ?? [];
$selected = $data['selected'] ?? null;
$selectedId = $data['selectedId'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Control</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="account-control-page">

<div class="admin-bg"></div>

<div class="account-control-container">
    
    <!-- Header -->
    <div class="submission-header">
        <h1 class="panel-title">User Account Control</h1>
        <a href="<?= BASE_URL; ?>/admindashboard">
            <span class="admin-label"><?= htmlspecialchars($adminName) ?></span>
        </a>
    </div>
    
    <div class="account-content">
        
        <!-- Left: User List -->
        <div class="user-list">
            <?php foreach ($users as $user): ?>
                <button 
                    class="user-item <?= $user['id'] == $selectedId ? 'active' : '' ?>"
                    onclick="location.href='<?= BASE_URL; ?>/adminaccount/index/<?= $user['id'] ?>'">
                    <?= htmlspecialchars($user['username']) ?>
                    <?php if ($user['is_admin'] == 1): ?>
                        <span class="badge-admin">Admin</span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <!-- Center: User Details Form -->
        <div class="user-details">
            <?php if ($selected): ?>
                <form method="POST" id="userForm" action="<?= BASE_URL; ?>/adminaccount/update">
                    <input type="hidden" name="user_id" value="<?= $selected['id'] ?>">
                    
                    <div class="detail-row">
                        <label>Username :</label>
                        <input type="text" 
                               name="username" 
                               value="<?= htmlspecialchars($selected['username']) ?>"
                               required>
                    </div>
                    
                    <div class="detail-row">
                        <label>E-mail :</label>
                        <input type="email" 
                               name="email" 
                               value="<?= htmlspecialchars($selected['email']) ?>"
                               required>
                    </div>
                    
                    <div class="detail-row">
                        <label>Password :</label>
                        <input type="password" 
                               name="password" 
                               placeholder="Leave empty to keep current password">
                        <small>Leave empty to keep current password</small>
                    </div>
                    
                    <div class="detail-row">
                        <label>Privilege :</label>
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   name="is_admin" 
                                   <?= $selected['is_admin'] == 1 ? 'checked' : '' ?>>
                            Administrator
                        </label>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        
        <!-- Right: Action Buttons -->
        <div class="account-actions">
            <button class="action-btn" onclick="updateAccount()">
                Update Account
            </button>
            <button class="action-btn" onclick="deleteAccount()">
                Delete Account
            </button>
            <button class="action-btn" onclick="location.href='<?= BASE_URL; ?>/adminaccount/create'">
                Create New
            </button>
        </div>
        
    </div>
    
    <!-- Corner Decorations -->
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
    
</div>

<script>
function updateAccount() {
    document.getElementById('userForm').submit();
}

function deleteAccount() {
    if (confirm('Are you sure you want to delete this account?')) {
        const form = document.getElementById('userForm');
        form.action = '<?= BASE_URL; ?>/adminaccount/delete';
        form.submit();
    }
}
</script>

</body>
</html>