<?php
function prepareVariables($page, $action, $id) {
    $params = [
        'menu' => getMenuItems(),
        'is_ajax' => false,
        'allow' => isAuth(),
        'current' => $page,
        'message' => getMessage(),
        'success' => (int)$_GET['success'] == 1,
    ];
    switch ($page) {
        case 'index':
            $params['current'] = '';
            $params['goods'] = getCountAllGoods();
            $params['comment_good'] = getNewCommentsGood();
            $params['last_good'] = getLastAddingGood();
            $params['sale'] = array_slice(getGoodsForSale(), 0, 2);
            break;
        case 'admin':
            login();
            handleAdminAction($action);
            break;
        case 'gallery':
            $params['images'] = getImages();
            if ($params['allow']) {
                handleGalleryAction($action, $id, $params);
            }
            break;
        case 'image':
            $content = getImageContent($id);
            $params['image'] = $content['title'];
            $params['count'] = $content['count'];
            break;
        case 'calc':
            handleMathAction($action, $params);
            break;
        case 'catalog':
            $params['goods'] = getProducts();
            break;
        case 'sale':
            $params['goods'] = getGoodsForSale();
            break;
        case 'tovar':
            $params['current'] = 'catalog';
            $params['good'] = getProductContent($id);
            $params['comments'] = getProductComments($id);
            break;
        case 'goods':
            if (!$params['allow']) { header("Location: /admin/"); }
            $params['goods'] = getProducts();
            handleGoodsAction($action, $id, $params);
            break;
        case 'product':
            if (isset($id)) {
                $params['good'] = getProductContent($id);
            }
        case 'comments':
            if ($params['allow'] || $action == 'add') { 
                $params['comments'] = getAllComments();
                handleCommentAction($action, $id, $params);
            } else {
                header("Location: /admin/");
            }
            break;
        case 'basket':
            $params['basket'] = getBasket();
            $params['total'] = getTotalAmount();
            handleBasketAction($action, $id, $params);
            break;
        case 'orders':
            if (!$params['allow']) { header("Location: /admin/"); }
            $params['orders'] = getAllOrders();
            $params['amount'] = getAmountEachOrder();
            break;
        case 'order':
            if (!$params['allow']) { header("Location: /admin/"); }
            $params['order'] = getOrderData($id);
            $params['basket'] = getOrderBasket($id);
            $params['total'] = getOrderTotalAmount($id);
            $params['statuses'] = getListOrderStatus();
            handleOrderAction($action, $id, $params);
    }
    return $params;
}

function render($page, $params = []) {
    if (!$params['is_ajax']) {
        return renderTemplate(LAYOUTS_DIR . 'main', [
            'allow' => isAuth(),
            'user' => getUser(),
            'content' => renderTemplate($page, $params),
            'menu' => renderTemplate('menu', $params),
            'cart' => getTotalQuantity(),
            'title' => 'Лучший магазин', 
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
