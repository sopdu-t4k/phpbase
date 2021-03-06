<?php
function handleBasketAction($action, $id, &$params) {
    if ($action == 'buy' && isset($_POST['quantity'])) {
        addGoodInCart($id);
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
}

function addGoodInCart($id) {
    $id = (int)$id;
    $quantity = (int)$_POST['quantity'];
    $session = session_id();
    $discount = !empty(nowSaleDiscount($id))? nowSaleDiscount($id)['discount'] : 0;
    $already = "SELECT quantity FROM order_goods WHERE (`session` = '{$session}') AND (`good_id` = {$id})";
    if (empty(getAssocResult($already))) {
        $sql = "INSERT INTO order_goods (`session`,`good_id`,`quantity`,`discount`) VALUES ('{$session}', '{$id}', '{$quantity}', '{$discount}')";
    } else {
        $sql = "UPDATE order_goods SET `quantity`=`quantity`+{$quantity} WHERE (`session` = '{$session}') AND (`good_id` = {$id});";
    }
    return executeQuery($sql);
}
function getBasket($id_session = '') {
    $session = empty($id_session) ? session_id() : $id_session;
    $sql = "SELECT order_goods.id, name, price-price/100*order_goods.discount as current_price, quantity, goods.id as good_id FROM order_goods
            INNER JOIN goods ON order_goods.good_id = goods.id 
            WHERE `session` = '{$session}'";
    return getAssocResult($sql);
}

function getTotalAmount($id_session = '') {
    $session = empty($id_session) ? session_id() : $id_session;
    $sql = "SELECT SUM(quantity * (price-price/100*order_goods.discount)) as summ FROM order_goods
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
    $session = session_id();
    $sql = "DELETE FROM order_goods WHERE (`session` = '{$session}') AND (id = {$id})";
    executeQuery($sql);
}

function setQuantityGood() {
    $id = (int)$_POST['id'];
    $quantity = (int)$_POST['quantity'];
    $sql = "UPDATE order_goods SET `quantity`={$quantity} WHERE `id`={$id}";
    executeQuery($sql);
    return getTotalAmount();
}

function setOrderBasket() {
    $session = session_id();
    $user_name = dataPrepar('name');
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

function nowSaleDiscount($id) {
    $sql = "SELECT discount FROM goods WHERE (`id`={$id}) AND (`sale`=1)";
    return takeFirstItem(getAssocResult($sql));
}
