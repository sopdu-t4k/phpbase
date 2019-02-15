<?php
$menu = [
    [
        'name' => 'Главная',
        'href' => '/',
    ],
    [
        'name' => 'Галерея',
        'href' => '?page=gallery',
    ],
];
echo renderMenu($menu);
