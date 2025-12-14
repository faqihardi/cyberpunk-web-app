<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Control Panel</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>

<body class="news-control-page">

<!-- <div class="admin-bg"></div>  --> 

<div class="news-control-container">
    
    <!-- Header -->
    <div class="submission-header">
        <h1 class="panel-title">News Control Panel</h1>
        <a href="<?= BASE_URL; ?>/admindashboard">
            <span class="admin-label"><?= htmlspecialchars($adminName) ?></span>
        </a>
    </div>

    <form method="POST" 
      action="<?= BASE_URL; ?>/adminnews/update"
      class="news-form">
        
        <!-- Game Update Version -->
        <div class="news-section">
            <h3 class="section-label">Game Update Ver</h3>
            <div class="news-box">
                <input type="text"
                       name="version"
                       value="<?= htmlspecialchars($news['version']) ?>"
                       placeholder="update 2.3 Patch Notes">
            </div>
        </div>
        
        <!-- Game Update Header -->
        <div class="news-section">
            <h3 class="section-label">Game Update Header</h3>
            <div class="news-box">
                <input type="text"
                       name="header"
                       value="<?= htmlspecialchars($news['header']) ?>"
                       placeholder="Added 2 new vehicles">
            </div>
        </div>
        
        <!-- Game Update Content -->
        <div class="news-section">
            <h3 class="section-label">Game Update Content</h3>
            <div class="news-box content-box">
                <textarea name="content"
                          rows="5"
                          placeholder="Update content..."><?= htmlspecialchars($news['content']) ?></textarea>
            </div>
        </div>
        
        <button type="submit" class="update-btn">Update</button>
        
    </form>
    
    <!-- Corner Decorations -->
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>
    
</div>

</body>
</html>
