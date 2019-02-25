<?php
function getMenuItems() {
    return [
        [
            'name' => 'Главная',
            'href' => '/',
        ],
        [
            'name' => 'Каталог',
            'href' => '/catalog/',
        ],
        [
            'name' => 'Галерея',
            'href' => '/gallery/',
        ],
        [
            'name' => 'Калькулятор',
            'href' => '/calc/',
        ],
    ];
}

function getMessage() {
    $message = '';
    if (isset($_GET['message'])) {
        switch ((int)$_GET['message']) {
            case 1: $message = 'Файл загружен'; break;
            case 2: $message = 'Произошла ошибка'; break;
            case 3: $message = 'Выберите файл с расширением .jpeg или .png'; break;
            case 4: $message = 'Файл удален'; break;
            case 5: $message = 'Ошибка удаления'; break;
            case 6: $message = 'Отзыв удален'; break;
            case 7: $message = 'Отзыв изменен'; break;
            case 8: $message = 'Заказ отправлен! Мы свяжемся с Вами по указанному телефону'; break;
            case 9: $message = 'Публикация отзыва изменена'; break;
            default: $message = '';
        }
    }
    return $message;
}

function dataPrepar($data) {
    if (isset($_POST[$data])) {
        $db = getDb();
        return mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST[$data])));
    }
}

function takeFirstItem($arr) {
    $result = [];
    if(isset($arr[0])) {
        $result = $arr[0];
    }
    return $result;
}

function getProducts() {
    $sql = "SELECT `id`,`name`,`price`,`image` FROM goods";
    return getAssocResult($sql);
}

function getProductContent($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM goods WHERE id = {$id}";
    return takeFirstItem(getAssocResult($sql));
}

function getProductComments($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM comments WHERE `good_id` = {$id} ORDER BY `id` DESC";
    return getAssocResult($sql);
}

function getCountAllGoods() {
    $sql = "SELECT count(*) as `count`, max(price) FROM goods";
    return takeFirstItem(getAssocResult($sql));
}

function getNewCommentsGood() {
    $sql = "SELECT user, message, name, price, image, goods.id FROM comments 
            INNER JOIN goods ON comments.good_id = goods.id
            WHERE `public`=1 ORDER BY comments.id DESC LIMIT 1";
    return takeFirstItem(getAssocResult($sql));
}

function getLastAddingGood() {
    $sql = "SELECT * FROM goods ORDER BY `id` DESC LIMIT 1";
    return takeFirstItem(getAssocResult($sql));
}
