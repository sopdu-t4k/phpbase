<?php
include '../config/main.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

switch ($page) {
    case 'index':
        break;
    case 'gallery':
        $message = '';
        if (isset($_POST['load'])) {
            $filetype = $_FILES['image']['type'];
            if ($filetype == 'image/png' || $filetype == 'image/jpeg') {
                $path = './gallery/big/' . $_FILES['image']['name'];
                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                    $img = new SimpleImage();
                    $img->load($path);
                    $img->resize(150, 100);
                    $img->save('./gallery/small/' . $_FILES['image']['name']);
                    header('Location: ?page=gallery');
                } else {
                    $message = 'Ошибка загрузки';
                }
            } else {
                $message = 'Выберите файл с расширением .jpeg или .png';
            }
        }
        $params = [
            'images' => array_slice(scandir('./gallery/big'), 2),
            'message' => $message,
        ];
        break;
}

echo render($page, $params);
