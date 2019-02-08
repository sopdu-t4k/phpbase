<?php
echo '<h4>Задание 1</h4>';
$i = 0;
while ($i <= 100) {
    echo "{$i} ";
    $i+=3;
}
unset($i);

echo '<h4>Задание 2</h4>';
$i = 0;
do {
    if ($i == 0) { echo "{$i} – это ноль."; }
    $i++;
    $type = ($i & 1) ? 'нечетное' : 'четное'; //определение четности на битовых операциях, быстродейственнее чем ($i % 2)
    echo "{$i} – {$type} число.";
} while ($i < 10);

echo '<h4>Задание 3</h4>';
$city = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Касимов', 'Рязань', 'Сасово', 'Скопин'],
    'Нижегородская область' => ['Нижний Новгород', 'Дзержинск', 'Кстово', 'Саров', 'Арзамас'],
    'Саратовская область' => ['Саратов', 'Балаково', 'Приволжский', 'Красноармейск', 'Ершов', 'Калининск'],
    'Волгоградская область' => ['Волгоград', 'Камышин', 'Волжский', 'Урюпинск', 'Котово', 'Городище'],
];
foreach ($city as $key => $value) {
    $list = "<p>{$key}:<br>";
    foreach ($value as $item) {
        $list .= ($item == end($value)) ? $item : "{$item}, "; //end() возвращает значение последнего элемента в массиве
    }
    $list .= "</p>";
    echo $list;
}

echo '<h4>Задание 4</h4>';
$text = 'Привет! Я расскажу Вам про массивы в Php';
function transliteration(string $str) {
    $alphabet = [
        'а' => 'a', 
        'б' => 'b', 
        'в' => 'v', 
        'г' => 'g', 
        'д' => 'd', 
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'i',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'kh',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e', 
        'ю' => 'yu', 
        'я' => 'ya',
    ];
    $response = '';
    for ($i = 0; $i < mb_strlen($str); $i++) { //mb_strlen() получает длину строки
        $sign = mb_substr($str, $i, 1); //mb_substr() возвращает нужное количество символов (1), начиная с позиции $i от начала
        if (array_key_exists($sign, $alphabet)) { //array_key_exists() проверяет, присутствует ли в массиве указанный ключ или индекс
            $response .= $alphabet[$sign];
        } else if ($alphabet[mb_strtolower($sign)]) { //mb_strtolower() приведение строки к нижнему регистру
            $response .= mb_strtoupper($alphabet[mb_strtolower($sign)]); //mb_strtoupper() приведение строки к верхнему регистру
        } else {
            $response .= $sign;
        }
    }
    return $response;
}
echo transliteration($text);

echo '<h4>Задание 5</h4>';
function spaceRemove(string $str) {
    return str_replace(' ', '_', $str); //str_replace() возвращает строку с замененными указанными символами на нужные
}
echo spaceRemove($text);

echo '<h4>Задание 6</h4>';
/*Простой способ*/
$menuItem = [
    'Home' => '/index',
    'About' => '/about',
    'Catalog' => '/catalog',
    'News' => '/news',
    'Contact' => '/contact',
];
$menu = "<ul>";
foreach ($menuItem as $key => $value) {    
    $menu .= "<li><a href='{$value}'>{$key}</a></li>";
}
$menu .= "</ul>";
echo $menu;

/*Вложенное меню*/
$subenuItem = [
    [
        'name' => 'Home',
        'href' => '/index',
    ],
    [
        'name' => 'About',
        'href' => '/about',
    ],
    [
        'name' => 'Catalog',
        'href' => '/catalog',
        'items' => [
            [
                'name' => 'Women',
                'href' => '/women',
                'items' => [
                    [
                        'name' => 'Dress',
                        'href' => '/dress',
                    ],
                    [
                        'name' => 'Shoes',
                        'href' => '/shoes',
                    ],
                ],
            ],
            [
                'name' => 'Men',
                'href' => '/men',
                'items' => [],
            ],
        ],
    ],
    [
        'name' => 'News',
        'href' => '/news',
    ],
    [
        'name' => 'Contact',
        'href' => '/contact',
    ],
];
function renderMenu($listItem, $parent = '') {
    $content = "<ul>";
    foreach ($listItem as $value) {
        $href = $parent . $value['href'];
        if (is_array($value['items']) && !is_null($value['items'])) {//is_array() проверяет что это массив, !is_null() что массив не пустой
            $content .= "<li class='dropdown'><a href='{$href}'>{$value['name']}</a>" . renderMenu($value['items'], $href) . "</li>";
        } else {
            $content .= "<li><a href='{$href}'>{$value['name']}</a></li>";
        }
    }
    $content .= "</ul>";
    return $content;
}
echo renderMenu($subenuItem);

echo '<h4>Задание 7</h4>';
for ($i = 0; $i < 10; print$i++){} //print выводит строку и возвращает 1

echo '<h4>Задание 8</h4>';
foreach ($city as $key => $value) {
    $list = "<p>{$key}:<br>";
    $select = preg_grep('/^К/', $value); //preg_grep() возвращает массив элементов, которые соответствуют шаблону
    foreach ($select as $item) {
        $list .= ($item == end($select)) ? $item : "{$item}, ";
    }
    $list .= "</p>";
    echo $list;
}

echo '<h4>Задание 9</h4>';
function getURL(string $str) {
    return spaceRemove(transliteration($str));
}
echo getURL($text);
