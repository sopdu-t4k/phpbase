<?php
function prepareVariables($page, $action, $id) {
    $params = [
        'menu' => getMenuItems(),
        'is_ajax' => false,
    ];
    switch ($page) {
        case 'index':
            break;
        case 'gallery':
            if ($action == 'add' && isset($_POST['load'])) {
                addImage($_FILES['image']);
            }
            if ($action == 'delete') {
                deleteImage($id);
            }
            $params['images'] = getImages();
            $params['message'] = getMessage();
            $params['success'] = (int)$_GET['success'] == 1;
            break;
        case 'image':
            $content = getImageContent($id);
            $params['image'] = $content['title'];
            $params['count'] = $content['count'];
            break;
        case 'calc':
            $params = array_merge($params, handleMathAction($action));
            break;
        case 'catalog':
            $params['goods'] = getProducts();
            break;
        case 'tovar':
            if ($action == 'comment' && isset($_POST['send'])) {
                addComment($id);
                header ("Location: /tovar/{$id}");
            }
            $params['good'] = getProductContent($id);
            $params['comments'] = getCommentsProduct($id);
            break;
        case 'reviews':
            if ($action == 'delete') {
                deleteComment($id);
            }
            if ($action == 'edit') {
                $params['id_edit'] = (int)$id;
                updateComment($id);
            }
            $params['comments'] = getAllComments();
            $params['message'] = getMessage();
            $params['success'] = (int)$_GET['success'] == 1;
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
            'href' => '/gallery/',
        ],
        [
            'name' => 'Каталог',
            'href' => '/catalog/',
        ],
        [
            'name' => 'Отзывы',
            'href' => '/reviews/',
        ],
        [
            'name' => 'Калькулятор',
            'href' => '/calc/',
        ],
    ];
}

function render($page, $params = [], $is_ajax = false) {
    if (!$is_ajax) {
        return renderTemplate(LAYOUTS_DIR . 'main', [
            'content' => renderTemplate($page, $params),
            'menu' => renderTemplate('menu', $params),
            'title' => 'Название сайта', 
            'year' => '2019',
        ]);
    } else {
        return json_encode($params);
    }
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
