<?php
session_start();
require_once __DIR__.'/src/session.php';

try {
    $session = SessionManager::getCurrentSession();
} catch (Exception $e) {
    header('Location: /login.php');
    exit(0);
}
?>

<html>
    <head>

    </head>
    <body>
        <h1>Hello <?= $session->username; ?></h1>
    </body>
</html>