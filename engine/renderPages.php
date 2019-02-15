<?php
function prepareVariables($page) {
    $params = [
        'menu' => getMenuItems(),
    ];
    switch ($page) {
        case 'index':
            break;
        case 'gallery':
            changeImage();
            $params['images'] = getImages();
            $params['message'] = getMessage();
            $params['success'] = (int)$_GET['success'] == 1;
            break;
        case 'image':
            $content = getImageContent($_GET['id']);
            $params['image'] = $content['title'];
            $params['count'] = $content['count'];
    }
    return $params;
}

function getMenuItems() {
    return [
        [
            'name' => 'Главная',
            'href' => '/',
        ],
        [
            'name' => 'Галерея',
            'href' => '/gallery',
        ],
    ];
}

function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'content' => renderTemplate($page, $params),
        'menu' => renderTemplate('menu', $params),
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
