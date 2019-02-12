<?php
include '../config/main.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

switch ($page) {
    case 'index':
        break;
    case 'gallery':
        $params = [
            'images'=> array_slice(scandir('./gallery/big'), 2),
        ];
        break;
}

echo render($page, $params);
