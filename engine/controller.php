<?php
function prepareVariables($page, $action, $id, $allow = false) {
    $params = [
        'menu' => getMenuItems(),
        'is_ajax' => false,
        'allow' => $allow,
        'current' => $page,
    ];
    switch ($page) {
        case 'index':
            $params['current'] = '';
            $params['goods'] = getCountAllGoods();
            $params['comment_good'] = getNewCommentsGood();
            $params['last_good'] = getLastAddingGood();
            break;
        case 'gallery':
            $params['images'] = getImages();
            $params['message'] = getMessage();
            $params['success'] = (int)$_GET['success'] == 1;
            if ($allow) {
                $params = array_merge($params, handleGalleryAction($action, $id));
            }
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
            $params['current'] = 'catalog';
            $params['good'] = getProductContent($id);
            $params['comments'] = getProductComments($id);
            break;
        case 'comments':
            if ($allow || $action == 'add') { 
                $params['comments'] = getAllComments();
                $params['message'] = getMessage();
                $params['success'] = (int)$_GET['success'] == 1;
                $params = array_merge($params, handleCommentAction($action, $id));
            } else {
                header("Location: /admin/");
            }
            break;
        case 'basket':
            $params['basket'] = getBasket();
            $params['total'] = getTotalAmount();
            $params['message'] = getMessage();
            $params['success'] = (int)$_GET['success'] == 1;
            $params = array_merge($params, handleBasketAction($action, $id));
            break;
        case 'orders':
            if (!$allow) { header("Location: /admin/"); }
            $params['orders'] = getAllOrders();
            $params['amount'] = getAmountEachOrder();
            break;
        case 'order':
            if (!$allow) { header("Location: /admin/"); }
            $params['order'] = getOrderData($id);
            $params['basket'] = getOrderBasket($id);
            $params['total'] = getOrderTotalAmount($id);
    }
    return $params;
}

function render($page, $params = [], $is_ajax = false) {
    if (!$is_ajax) {
        return renderTemplate(LAYOUTS_DIR . 'main', [
            'allow' => isAuth(),
            'user' => getUser(),
            'content' => renderTemplate($page, $params),
            'menu' => renderTemplate('menu', $params),
            'cart' => getTotalQuantity(),
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
