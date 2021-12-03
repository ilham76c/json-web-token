<?php
require_once __DIR__.'/vendor/autoload.php';

setcookie("X-76c-Session", "LOGOUT");
header('Location: /login.php');
?>