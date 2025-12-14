<?php
$adminName = $data['adminName'] ?? 'Admin';
$editMode = $data['editMode'] ?? false;
$submission = $data['submission'] ?? [
    'title' => '',
    'resolution' => '',
    'theme' => '',
    'author' => '',
    'user' => '',
    'image' => ''
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editMode ? 'Edit' : 'Create' ?> Submission</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="create-submission-page">

<div class="admin-bg"></div>

<div class="create-submission-container">
    
    <!-- Header -->
    <div class="submission-header">
        <h1 class="panel-title"><?= $editMode ? 'Edit' : 'Create' ?> Submission</h1>
        <a href="<?= BASE_URL; ?>/admindashboard">
            <span class="admin-label"><?= htmlspecialchars($adminName) ?></span>
        </a>
    </div>
    
    <div class="create-submission-content">
        
        <!-- Left: Image Preview -->
        <div class="image-preview-section">
              <img id="previewImage" 
                  src="<?= !empty($submission['image'] ?? '') ? BASE_URL . htmlspecialchars($submission['image']) : BASE_URL . '/images/placeholder.jpg' ?>" 
                  alt="Preview">
        </div>
        
        <!-- Right: Form -->
        <div class="submission-form-section">
            <form method="POST" 
                  action="<?= BASE_URL; ?>/adminsubmission/<?= $editMode ? 'update' : 'store' ?>" 
                  enctype="multipart/form-data">
                
                <?php if ($editMode && isset($submission['id'])): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($submission['id']) ?>">
                <?php endif; ?>
                
                <div class="form-group">
                          <label>Title</label>
                          <input type="text" 
                              name="title" 
                              value="<?= htmlspecialchars($submission['title'] ?? '') ?>" 
                              placeholder="Submission Title"
                              required>
                </div>
                
                <div class="form-group">
                          <label>Resolution</label>
                          <input type="text" 
                              name="resolution" 
                              value="<?= htmlspecialchars($submission['resolution'] ?? '') ?>" 
                              placeholder="3840 x 2160"
                              required>
                </div>
                
                <div class="form-group">
                          <label>Theme</label>
                          <input type="text" 
                              name="theme" 
                              value="<?= htmlspecialchars($submission['theme'] ?? '') ?>" 
                              placeholder="City 77 Streets"
                              required>
                </div>
                
                <div class="form-group">
                          <label>Author</label>
                          <input type="text" 
                              name="author" 
                              value="<?= htmlspecialchars($submission['author'] ?? '') ?>" 
                              placeholder="argel"
                              required>
                </div>
                
                <div class="form-group">
                          <label>User</label>
                          <input type="text" 
                              name="user" 
                              value="<?= htmlspecialchars($submission['user'] ?? '') ?>" 
                              placeholder="Admin 1"
                              required>
                </div>
                
                <div class="form-group">
                    <label>Upload Image <?= $editMode ? '(Leave empty to keep current image)' : '' ?></label>
                    <input type="file" 
                           name="image" 
                           accept="image/*" 
                           onchange="previewFile(this)"
                           <?= !$editMode ? 'required' : '' ?>>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        <?= $editMode ? 'Update Submission' : 'Create Submission' ?>
                    </button>
                    
                    <button type="button" 
                            class="submit-btn" 
                            onclick="location.href='<?= BASE_URL; ?>/adminsubmission'">
                        Cancel
                    </button>
                </div>
                
            </form>
        </div>
        
    </div>
    
    <!-- Corner Decorations -->
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
    
</div>

<script>
function previewFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>