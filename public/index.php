<?php
include '../config/main.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

echo render($page, $params);
