<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character Not Found</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body class="character-detail-page">
    <div style="text-align:center; padding:100px; color:#fcee09;">
        <h1>Character not found</h1>
        <p>ID: <?= htmlspecialchars($charId) ?></p>
        <a href="<?= BASE_URL ?>/characters" style="color:cyan;">Back</a>
    </div>
</body>
</html>
