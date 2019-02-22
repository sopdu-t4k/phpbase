<?php
function handleCommentAction($action, $id) {
    $params = [];
    if ($action == 'delete') {
        deleteComment($id);
    }
    if ($action == 'edit') {
        $params['id_edit'] = (int)$id;
        if (isset($_POST['save'])) { updateComment($id); }
    }
    if ($action == 'add' && isset($_POST['send'])) {
        $params['adding'] = addComment($id);
        $params['is_ajax'] = true;
    }
    if ($action == 'public') {
        reversePublicComment($id);
    }
    return $params;
}

function getAllComments() {
    $sql = "SELECT * FROM comments ORDER BY `id` DESC";
    return getAssocResult($sql);
}

function addComment($id) {
    $id = (int)$id;
    $user = dataPrepar('user');
    $message = dataPrepar('message');
    $sql = "INSERT INTO comments (`user`, `message`, `good_id`) VALUES ('{$user}', '{$message}', {$id});";
    return executeQuery($sql);
}

function deleteComment($id) {
    $id = (int)$id;
    $sql = "DELETE FROM comments WHERE id = {$id}";
    if (executeQuery($sql)) {
        $success = 1;
        $message = 6;
    } else {
        $success = 0;
        $message = 5;
    }
    header ("Location: /comments/?success={$success}&message={$message}");
}

function updateComment($id) {
    $id = (int)$id;
    $user = dataPrepar('user');
    $message = dataPrepar('message');
    $sql = "UPDATE comments SET `user`='{$user}', `message`='{$message}' WHERE id = {$id}";
    if (executeQuery($sql)) {
        $success = 1;
        $message = 7;
    } else {
        $success = 0;
        $message = 2;
    }
    header ("Location: /comments/?success={$success}&message={$message}");
}

function reversePublicComment($id) {
    $id = (int)$id;
    $sql = "UPDATE comments SET `public`= NOT `public` WHERE id = {$id}";
    if (executeQuery($sql)) {
        $success = 1;
        $message = 9;
    } else {
        $success = 0;
        $message = 2;
    }
    header ("Location: /comments/?success={$success}&message={$message}");
}
