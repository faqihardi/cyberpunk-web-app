<?php
$admin_name  = $data['admin_name'] ?? 'Admin';
$admin_email = $data['admin_email'] ?? '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cyberpunk 2077</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="admin-dashboard-page">

<div class="admin-bg"></div>

<div class="admin-dashboard-container">
    
    <!-- Admin Profile Card -->
    <div class="admin-profile-card">
        <div class="admin-avatar">
            <svg viewBox="0 0 24 24" fill="#666">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
            </svg>
        </div>
        <div class="admin-info">
            <h2><?= htmlspecialchars($admin_name) ?></h2>
            <p><?= htmlspecialchars($admin_email) ?></p>
            <p class="admin-password">••••••••••••</p>
        </div>
    </div>
    
    <!-- Control Panel Buttons -->
    <div class="control-panel-buttons">
        <div class="corner-deco top-left"></div>
        <div class="corner-deco top-right"></div>
        <div class="corner-deco bottom-left"></div>
        <div class="corner-deco bottom-right"></div>
        
        <button onclick="location.href='<?= BASE_URL; ?>/adminsubmission'" class="panel-btn">
            Submission Control Panel
        </button>
        
        <button onclick="location.href='<?= BASE_URL; ?>/adminnews'" class="panel-btn">
            News Control Panel
        </button>
        
        <button onclick="location.href='/?page=account_control'" class="panel-btn">
            Account Edit
        </button>
    </div>

</div>

</body>
</html>