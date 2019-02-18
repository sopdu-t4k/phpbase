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
    return getAssocResult($sql);
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
            case 2: $message = 'Произошла ошибка'; break;
            case 3: $message = 'Выберите файл с расширением .jpeg или .png'; break;
            case 4: $message = 'Файл удален'; break;
            case 5: $message = 'Ошибка удаления'; break;
            case 6: $message = 'Отзыв удален'; break;
            case 7: $message = 'Отзыв изменен'; break;
            default: $message = '';
        }
    }
    return $message;
}

function getProducts() {
    $sql = "SELECT `id`,`name`,`price`,`image` FROM goods";
    return getAssocResult($sql);
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
    return getAssocResult($sql);
}

function getAllComments() {
    $sql = "SELECT * FROM comments ORDER BY `id` DESC";
    return getAssocResult($sql);
}

function addComment($id) {
    $id = (int)$id;
    $user = dataPrepar()['user'];
    $message = dataPrepar()['message'];
    $sql = "INSERT INTO comments (`user`, `message`, `good_id`) VALUES ('{$user}', '{$message}', {$id});";
    executeQuery($sql);
}

function deleteComment($id) {
    $id = (int)$id;
    $sql = "DELETE FROM comments WHERE id = {$id}";
    if (@executeQuery($sql)) {
        $success = 1;
        $message = 6;
    } else {
        $success = 0;
        $message = 5;
    }
    header ("Location: /reviews/?success={$success}&message={$message}");
}

function updateComment($id) {
    if (isset($_POST['save'])) {
        $id = (int)$id;
        $user = dataPrepar()['user'];
        $message = dataPrepar()['message'];
        $sql = "UPDATE comments SET `user`='{$user}', `message`='{$message}' WHERE id = {$id}";
        if (executeQuery($sql)) {
            $success = 1;
            $message = 7;
        } else {
            $success = 0;
            $message = 2;
        }
        header ("Location: /reviews/?success={$success}&message={$message}");
    }
}

function dataPrepar() {
    $db = getDb();
    $user = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['user'])));
    $message = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['message'])));
    return [
        'user' => $user,
        'message' => $message,
    ];
}
