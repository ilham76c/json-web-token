<?php
session_start();
require_once __DIR__.'/src/session.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (SessionManager::login($_POST['username'], $_POST['password'])) {
        header('Location: /index.php');
        exit(0);
    } else {
        $message = "Gagal login";
    }
}
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php if ($message) : ?>
        <h1><?= $message ?></h1>
        <?php endif; ?>


        <h1>Login</h1>
        <form action="/login.php" method="post">
            <label for="username">
                Username :
                <input type="text" name="username">
            </label>
            <label for="password">
                Password :
                <input type="text" name="password">
            </label>
            <input type="submit" value="Login">
        </form>
    </body>
</html>