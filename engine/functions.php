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

function changeImage() {
    if (isset($_GET['delete'])) {
        $name = mysqli_real_escape_string(getDb(), $_GET['delete']);
        deleteImage($name);
    }
    if (isset($_POST['load'])) {
        addImage($_FILES['image']);
    }
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

function deleteImage($name) {
    if (@unlink(GALLERY_DIR . "big/{$name}") && @unlink(GALLERY_DIR . "small/{$name}")) {
        $sql = "DELETE FROM gallery WHERE `title`='{$name}'";
        executeQuery($sql);
        $success = 1;
        $message = 4;
    } else {
        $success = 0;
        $message = 5;
    }
    header("Location: /gallery/?success={$success}&message={$message}");
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
