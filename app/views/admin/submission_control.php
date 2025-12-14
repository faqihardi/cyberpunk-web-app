<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Control Panel</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="submission-control-page">

<div class="admin-bg"></div>

<div class="submission-container">
    
    <div class="submission-header">
        <h1 class="panel-title">Submission Control Panel</h1>
        <a href="<?= BASE_URL; ?>/admindashboard">
            <span class="admin-label"><?= htmlspecialchars($adminName) ?></span>
        </a>
    </div>
    
    <div class="submission-content">
        
        <!-- LEFT -->
        <div class="submission-list">
            <?php foreach ($submissions as $sub): ?>
                <button
                    class="submission-item <?= $sub['id'] == $selectedId ? 'active' : '' ?>"
                    onclick="location.href='<?= BASE_URL; ?>/adminsubmission/index/<?= $sub['id'] ?>'">
                    <?= htmlspecialchars($sub['title']) ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <!-- CENTER -->
        <div class="submission-preview">
            <?php if ($selected): ?>
                <img src="<?= BASE_URL . htmlspecialchars($selected['image']) ?>" alt="Preview">
                <div class="preview-info">
                    <p>
                        <?= htmlspecialchars($selected['resolution']) ?> |
                        <?= htmlspecialchars($selected['theme']) ?> |
                        Author: <?= htmlspecialchars($selected['author']) ?> |
                        Uploader: <?= htmlspecialchars($selected['user']) ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- RIGHT -->
        <div class="submission-actions">
            <button class="action-btn"
                onclick="location.href='<?= BASE_URL; ?>/adminsubmission/edit/<?= $selectedId ?>'">
                Edit Submission
            </button>

            <button class="action-btn"
                onclick="deleteSubmission(<?= $selectedId ?>)">
                Delete Submission
            </button>

            <button class="action-btn"
                onclick="location.href='<?= BASE_URL; ?>/adminsubmission/create'">
                Create Submission
            </button>

            <button class="action-btn fullview-btn" onclick="openFullview()">
                Fullview
            </button>
        </div>
        
    </div>
    
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
    
</div>

<script>
function deleteSubmission(id) {
    if (confirm('Are you sure you want to delete this submission?')) {
        window.location.href =
            '<?= BASE_URL; ?>/adminsubmission/delete/' + id;
    }
}

function openFullview() {
    <?php if ($selected): ?>
        window.open('<?= BASE_URL . htmlspecialchars($selected['image']) ?>', '_blank');
    <?php endif; ?>
}
</script>

</body>
</html>