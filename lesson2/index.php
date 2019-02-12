<?php
function renderTemplate($page, array $params = []) {
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $fileName = $page . '.php';
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die('404 Страницы не существует!');
    }
    return ob_get_clean();
}
echo renderTemplate('layout', [
    'content' => renderTemplate('welcome', [
        'header' => 'Приветствуем вас на нашем сайте!',
    ]), 
    'title' => 'Заголовок страницы', 
    'year' => '2019',
    ]);
