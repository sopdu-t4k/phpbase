<?php
function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'content' => renderTemplate($page, $params),
        'title' => 'Название сайта', 
        'year' => '2019',
    ]);
}

function renderTemplate($page, $params = []) {
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $fileName = TEMPLATES_DIR . "{$page}.php";
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die('404 Страницы не существует!');
    }
    return ob_get_clean();
}
