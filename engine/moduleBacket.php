<?php
function handleBasketAction($action, $id) {
    $params = [];
    if ($action == 'buy' && isset($_POST['good'])) {
        $params['adding'] = addGoodInCart();
        $params['is_ajax'] = true;
    }
    if ($action == 'count') {
        $params['cart'] = getTotalQuantity();
        $params['is_ajax'] = true;
    }
    if ($action == 'recount' && isset($_POST['id'])) {
        $params['total'] = setQuantityGood();
        $params['cart'] = getTotalQuantity();
        $params['is_ajax'] = true;
    }
    if ($action == 'delete') {
        deleteGoodBasket($id);
        header("Location: /basket/");
    }
    if ($action == 'order' && isset($_POST['send'])) {
        setOrderBasket();
    }
    return $params;
}

function addGoodInCart() {
    $good = (int)$_POST['good'];
    $quantity = (int)$_POST['quantity'];
    $session = session_id();
    $already = "SELECT quantity FROM order_goods WHERE (`session` = '{$session}') AND (`good_id` = {$good})";
    if (empty(getAssocResult($already))) {
        $sql = "INSERT INTO order_goods (`session`,`good_id`,`quantity`) VALUES ('{$session}', '{$good}', '{$quantity}')";
    } else {
        $sql = "UPDATE order_goods SET `quantity`=`quantity`+{$quantity} WHERE (`session` = '{$session}') AND (`good_id` = {$good});";
    }
    return executeQuery($sql);
}
function getBasket($id_session = '') {
    $session = empty($id_session) ? session_id() : $id_session;
    $sql = "SELECT order_goods.id, name, price, quantity, goods.id as good_id FROM order_goods
            INNER JOIN goods ON order_goods.good_id = goods.id 
            WHERE `session` = '{$session}'";
    return getAssocResult($sql);
}

function getTotalAmount($id_session = '') {
    $session = empty($id_session) ? session_id() : $id_session;
    $sql = "SELECT SUM(quantity * price) as summ FROM order_goods
            INNER JOIN goods ON order_goods.good_id = goods.id 
            WHERE `session` = '{$session}'";
    return takeFirstItem(getAssocResult($sql));
}

function getTotalQuantity() {
    $session = session_id();
    $sql = "SELECT SUM(quantity) as `count` FROM order_goods WHERE `session` = '{$session}'";
    return takeFirstItem(getAssocResult($sql));
}

function deleteGoodBasket($id) {
    $id = (int)$id;
    $sql = "DELETE FROM order_goods WHERE id = {$id}";
    executeQuery($sql);
}

function setQuantityGood() {
    $id = (int)$_POST['id'];
    $quantity = (int)$_POST['quantity'];
    $sql = "UPDATE order_goods SET `quantity`={$quantity} WHERE `id`={$id};";
    executeQuery($sql);
    return getTotalAmount();
}

function setOrderBasket() {
    $session = session_id();
    $user_name = dataPrepar('client');
    $phone = dataPrepar('phone');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `order` (`session`, `user_name`, `phone`, `date`) VALUES ('{$session}', '{$user_name}', '{$phone}', '{$date}')";
    if (executeQuery($sql)) {
        session_regenerate_id();
        $success = 1;
        $message = 8;
    } else {
        $success = 0;
        $message = 2;
    }
    header ("Location: /basket/?success={$success}&message={$message}");
}

function getAllOrders() {
    $sql = "SELECT id, date, user_name, phone FROM `order` ORDER BY id DESC";
    return getAssocResult($sql);
}

function getAmountEachOrder() {
    $sql = "SELECT `order`.id as order_id, sum(price * quantity) as total_price FROM `order`
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
