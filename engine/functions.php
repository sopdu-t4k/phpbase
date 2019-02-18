<?php
function getImages() {
    $sort = mysqli_real_escape_string(getDb(), $_GET['sort']);
    switch ($sort) {
        case 'popularity':
            $sql = "SELECT * FROM gallery ORDER BY count DESC";
            break;
        case 'imagename':
            $sql = "SELECT * FROM gallery ORDER BY title";
            break;
        default:
            $sql = "SELECT * FROM gallery";
    }
    $images = getAssocResult($sql);
    return $images;
}

function getImageContent($id) {
    $id = (int)$id;
    $up = "UPDATE gallery SET `count`=`count`+1 WHERE `id`={$id};";
    executeQuery($up);
    $sql = "SELECT * FROM gallery WHERE id = {$id}";
    $images = getAssocResult($sql);
    $result = [];
    if(isset($images[0])) {
        $result = $images[0];
    }
    return $result;
}

function addImage($file) {
    $filetype = $file['type'];
    if ($filetype == 'image/png' || $filetype == 'image/jpeg') {
        $path = GALLERY_DIR . "big/{$file['name']}";
        if (move_uploaded_file($file['tmp_name'], $path)) {
            resizeImage($file['name']);
            $sql = "INSERT INTO gallery (`title`) VALUES ('{$file['name']}')";
            executeQuery($sql);
            $success = 1;
            $message = 1;
        } else {
            $success = 0;
            $message = 2;
        }
    } else {
        $success = 0;
        $message = 3;
    }
    header("Location: /gallery/?success={$success}&message={$message}");
}

function resizeImage($img) {
    $image = new SimpleImage();
    $image->load(GALLERY_DIR ."big/{$img}");
    $image->resize(150, 100);
    $image->save(GALLERY_DIR ."small/{$img}");
}

function deleteImage($id) {
    $id = (int)$id;
    $name = getImageName($id);
    if (@unlink(GALLERY_DIR . "big/{$name}") && @unlink(GALLERY_DIR . "small/{$name}")) {
        $sql = "DELETE FROM gallery WHERE id = {$id}";
        executeQuery($sql);
        $success = 1;
        $message = 4;
    } else {
        $success = 0;
        $message = 5;
    }
    header("Location: /gallery/?success={$success}&message={$message}");
}

function getImageName($id) {
    $sql = "SELECT `title` FROM gallery WHERE id = {$id}";
    $result = getAssocResult($sql);
    $name = '';
    if(isset($result[0])) {
        $name = $result[0]['title'];
    }
    return $name;
}

function getMessage() {
    $message = '';
    if (isset($_GET['message'])) {
        switch ((int)$_GET['message']) {
            case 1: $message = 'Файл загружен'; break;
            case 2: $message = 'Ошибка загрузки'; break;
            case 3: $message = 'Выберите файл с расширением .jpeg или .png'; break;
            case 4: $message = 'Файл удален'; break;
            case 5: $message = 'Ошибка удаления'; break;
            default: $message = '';
        }
    }
    return $message;
}

function getActionList() {
    $operations = [
        [
            'option' => '+',
            'value' => 'plus',
        ],
        [
            'option' => '-',
            'value' => 'minus',
        ],
        [
            'option' => '*',
            'value' => 'mult',
        ],
        [
            'option' => '/',
            'value' => 'div',
        ],
    ];
    if (isset($_GET['operation'])) {
        array_walk($operations, function(&$operation) {
            $operation['selected'] = $operation['value'] == $_GET['operation'];
        });
    }
    return $operations;
}

function mathOperation($arg1, $arg2, $oper){
    $rez = 0;
    switch ($oper) {
        case 'plus':
            $rez = $arg1 + $arg2; break;
        case 'minus':
            $rez = $arg1 - $arg2; break;
        case 'mult':
            $rez = $arg1 * $arg2; break;
        case 'div':
            $rez = $arg2 != 0 ? $arg1 / $arg2 : 0;
    }
    return $rez;
}

function getProducts() {
    $sql = "SELECT `id`,`name`,`price`,`image` FROM goods";
    $products = getAssocResult($sql);
    return $products;
}

function getProductContent($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM goods WHERE id = {$id}";
    $product = getAssocResult($sql);
    $result = [];
    if(isset($product[0])) {
        $result = $product[0];
    }
    return $result;
}

function getCommentsProduct($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM comments WHERE `good_id` = {$id} ORDER BY `id` DESC";
    $comments = getAssocResult($sql);
    return $comments;
}

function addComment($id) {
    $id = (int)$id;
    $db = getDb();
    $user = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['user'])));
    $message = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['message'])));
    $sql = "INSERT INTO comments (`user`, `message`, `good_id`) VALUES ('{$user}', '{$message}', {$id});";
    executeQuery($sql);
}
