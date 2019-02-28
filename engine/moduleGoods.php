<?php
function handleGoodsAction($action, $id, &$params) {
    if ($action == 'update' && isset($_POST['send'])) {
        sendPostData($id);
    }
    if ($action == 'sale') {
        forSaleProduct($id);
        $params['is_ajax'] = true;
    }
}

function getProducts() {
    $sql = "SELECT id, name, image, price, discount, sale, price-price/100*discount as discount_price FROM goods";
    $sort = mysqli_real_escape_string(getDb(), $_GET['sort']);
    switch ($sort) {
        case 'id':
            $sql .= " ORDER BY id DESC";
            break;
        case 'name':
            $sql .= " ORDER BY name";
            break;
        case 'price':
            $sql .= " ORDER BY price";
            break;
        case 'sale':
            $sql .= " ORDER BY sale DESC";
    }
    return getAssocResult($sql);
}

function getProductContent($id) {
    $id = (int)$id;
    $sql = "SELECT *, price-price/100*discount as discount_price FROM goods WHERE id = {$id}";
    return takeFirstItem(getAssocResult($sql));
}

function getProductComments($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM comments WHERE good_id = {$id} ORDER BY id DESC";
    return getAssocResult($sql);
}

function sendPostData($id = '') {
    if (validationImage($_FILES['image'])) {
        if (moveImageToFolder($_FILES['image'])) {
            startQuerySend($id);
            $success = 1;
            $message = 10;
        } else {
            $success = 0;
            $message = 2;
        }
    } else {
        $success = 0;
        $message = 3;
    }
    header("Location: /goods/?success={$success}&message={$message}");
}

function validationImage($file) {
    if (!empty($file['type'])) {
        $filetype = $file['type'];
        return $filetype == 'image/png' || $filetype == 'image/jpeg';
    }
    return true;
}

function moveImageToFolder($file) {
    if (!empty($file['name'])) {
        $path = "./catalog-img/{$file['name']}";
        return move_uploaded_file($file['tmp_name'], $path);
    }
    return true;
}

function startQuerySend($id = '') {
    $name = dataPrepar('name');
    $description = dataPrepar('description');
    $image = $_FILES['image']['name'];
    $price = (float)$_POST['price'];
    $discount = (int)$_POST['discount'];
    $sale = $_POST['sale']=='on';
    if (!empty($id)) {
        $id = (int)$id;
        updateProduct($id, $name, $description, $image, $price, $discount, $sale);
    } else {
        addProduct($name, $description, $image, $price, $discount, $sale);
    }
}

function updateProduct($id, $name, $description, $image, $price, $discount, $sale) {
    $sql = "UPDATE goods SET
           `name`= '{$name}', `description` = '{$description}', `image` = '{$image}', `price` = '{$price}', `discount` = '{$discount}', `sale` = '{$sale}'
           WHERE `id`={$id}";
    if (!isset($_POST['remove']) && empty($_FILES['image']['name'])) {
        $sql = "UPDATE goods SET
               `name`= '{$name}', `description` = '{$description}', `price` = '{$price}', `discount` = '{$discount}', `sale` = '{$sale}'
               WHERE `id`={$id}";    
    }
    unlinkImageProduct($id);
    return executeQuery($sql);
}

function addProduct($name, $description, $image, $price, $discount, $sale) {
    $sql = "INSERT INTO goods (`name`, `description`, `image`, `price`, `discount`, `sale`)
            VALUES ('{$name}', '{$description}', '{$image}', '{$price}', '{$discount}', '{$sale}')";
    return executeQuery($sql);
}

function unlinkImageProduct($id) {
    if (isset($_POST['remove']) || !isset($_POST['remove']) && !empty($_FILES['image']['name'])) {
        $image_name = getImageProduct($id);
        if (!empty($image_name)) {
            unlink("./catalog-img/{$image_name}");
        }
    }
}

function getImageProduct($id) {
    $sql = "SELECT image FROM goods WHERE id = {$id}";
    return takeFirstItem(getAssocResult($sql))['image'];
}

function forSaleProduct($id) {
    $id = (int)$id;
    $sql = "UPDATE goods SET `sale`= NOT `sale` WHERE `id`={$id};";
    return executeQuery($sql);
}

function getCountAllGoods() {
    $sql = "SELECT count(*) as `count` FROM goods";
    return takeFirstItem(getAssocResult($sql));
}

function getNewCommentsGood() {
    $sql = "SELECT user, message, name, image, goods.id FROM comments 
            INNER JOIN goods ON comments.good_id = goods.id
            WHERE `public`=1 ORDER BY comments.id DESC LIMIT 1";
    return takeFirstItem(getAssocResult($sql));
}

function getLastAddingGood() {
    $sql = "SELECT * FROM goods ORDER BY `id` DESC LIMIT 1";
    return takeFirstItem(getAssocResult($sql));
}

function getGoodsForSale() {
    $sql = "SELECT id, name, image, discount, price, price-price/100*discount as discount_price
            FROM goods WHERE `sale`= 1 ORDER BY `discount` DESC";
    return getAssocResult($sql);
}
