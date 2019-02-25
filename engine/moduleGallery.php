<?php
function handleGalleryAction($action, $id, $params) {
    if ($action == 'add' && isset($_POST['load'])) {
        addImage($_FILES['image']);
    }
    if ($action == 'delete') {
        deleteImage($id);
    }
    return $params;
}

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
    return takeFirstItem(getAssocResult($sql));
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
    return takeFirstItem(getAssocResult($sql))['title'];
}
