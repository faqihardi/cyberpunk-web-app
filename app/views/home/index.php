<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Hello, <?= $data['name'] ?></h1>
    <h2>Welcome to The Home Page</h2>
    <p><a href="<?= BASE_URL ?>auth/showregister">Register</a></p>
    <p><a href="<?= BASE_URL ?>auth/showlogin">Login</a></p>
</body>
</html>