<?php
function renderTemplate($page) {
    ob_start();
    $content = file_get_contents($page . '.php');
    include 'layout.php';
    return ob_get_clean();
}
echo renderTemplate('welcome');
