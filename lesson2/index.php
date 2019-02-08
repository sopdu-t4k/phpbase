<?php
function renderTemplate($page, $content = '') {
    ob_start();
    include $page . '.php';
    return ob_get_clean();
}
echo renderTemplate('layout', renderTemplate('welcome'));
