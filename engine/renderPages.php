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
            $params['operations'] = getActionList();
            if (isset($_GET['submit'])) {
                $operand1 = (int)$_GET['operand1'];
                $operand2 = (int)$_GET['operand2'];
                $operation = $_GET['operation'];
                $params['operand1'] = $operand1;
                $params['operand2'] = $operand2;
                $params['rezult'] = mathOperation($operand1, $operand2, $operation);
            }
            break;
        case 'calculated':
            $operand1 = (int)$_POST['ajx-operand1'];
            $operand2 = (int)$_POST['ajx-operand2'];
            $operation = $_POST['ajx-operation'];
            $params['ajx_rezult'] = mathOperation($operand1, $operand2, $operation);
            $params['is_ajax'] = true;
            break;
        case 'catalog':
            $params['goods'] = getProducts();
            break;
        case 'tovar':
            if ($action == 'comment') {
                addComment($id);
                header ("Location: /tovar/{$id}");
            }
            $params['good'] = getProductContent($id);
            $params['comments'] = getCommentsProduct($id);
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
