<?php
function handleOrderAction($action, $id, &$params) {
    if ($action == 'status' && isset($_POST['value'])) {
        changeOrderStatus($id);
        $params['is_ajax'] = true;
    }
}

function getAllOrders() {
    $sql = "SELECT `order`.id, date, order_status.status as status, user_name, phone FROM `order`
            INNER JOIN order_status ON `order`.status = order_status.id
            ORDER BY id DESC";
    return getAssocResult($sql);
}

function getAmountEachOrder() {
    $sql = "SELECT `order`.id as order_id, sum(quantity * (price-price/100*order_goods.discount)) as total_price FROM `order`
            INNER JOIN order_goods ON `order`.session = order_goods.session
            INNER JOIN goods ON order_goods.good_id = goods.id
            GROUP BY `order`.id;";
    return getAssocResult($sql);
}

function getOrderData($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM `order` WHERE `id`={$id}";
    return takeFirstItem(getAssocResult($sql));
}

function getOrderBasket($id) {
    $session = getOrderData($id)['session'];
    return getBasket($session);
}

function getOrderTotalAmount($id) {
    $session = getOrderData($id)['session'];
    return getTotalAmount($session);
}

function getListOrderStatus() {
    $sql = "SELECT * FROM order_status";
    return getAssocResult($sql);
}

function changeOrderStatus($id) {
    $id = (int)$id;
    $status = (int)$_POST['value'];
    $sql = "UPDATE `order` SET `status` = '{$status}' WHERE `id`={$id}";
    executeQuery($sql);
}
