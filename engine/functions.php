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
            'name' => 'Акции',
            'href' => '/sale/',
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
            case 3: $message = 'Выберите файл с расширением .jpg или .png'; break;
            case 4: $message = 'Файл удален'; break;
            case 5: $message = 'Ошибка удаления'; break;
            case 6: $message = 'Отзыв удален'; break;
            case 7: $message = 'Отзыв изменен'; break;
            case 8: $message = 'Заказ отправлен! Мы свяжемся с Вами по указанному телефону'; break;
            case 9: $message = 'Публикация отзыва изменена'; break;
            case 10: $message = 'Товар успешно сохранен'; break;
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

function imageProduct($img) {
    if (empty($img)) {
        $img = 'no-thumb.png';
    }
    return $img;
}

function getSortParameter() {
    $sort = mysqli_real_escape_string(getDb(), $_GET['sort']);
    if(isset($_GET['sort'])) {
        $_SESSION['sort'] = $sort;
    }
    if(isset($_SESSION['sort'])) {
        $sort = $_SESSION['sort'];
    }
    return $sort;
}
