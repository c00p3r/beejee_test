<?php
if (file_exists('../.env')) {
    require dirname(__DIR__) . '/bootstrap.php';
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo 'Configure project first';
    exit;
}

(new \App\Core\Application(require ROOT . '/config/main.php'))->run();