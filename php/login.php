<?php
require_once __DIR__.'/vendor/autoload.php';
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
        <style>
            .inline-flex {
                display: inline-flex;
            }
            .flex-column {
                flex-direction: column;
            }
            .fit-content {
                width: fit-content;
            }
            .align-items-center {
                align-items: center;
            }
            .gap-10 {
                gap: 10px;
            }
        </style>
    </head>
    <body>
        <?php if ($message) : ?>
        <h1><?= $message ?></h1>
        <?php endif; ?>


        <h1>Login</h1>
        <form class="inline-flex gap-10 flex-column align-items-center" action="/login.php" method="post">
            <label for="username">
                Username :
                <input type="text" name="username">
            </label>
            <label for="password">
                Password :
                <input type="text" name="password">
            </label>
            <input class="fit-content" type="submit" value="Login">
        </form>
    </body>
</html>