<h1>Галерея</h1>
<div class="clearfix mb-4">
    <? foreach ($images as $image):?>
    <a href="/gallery/big/<?=$image;?>" target="_blank">
        <img src="/gallery/big/<?=$image;?>" class="img-thumbnail float-left shadow-sm m-1" width="200" />
    </a>
    <?endforeach;?>
</div>
<h4>Загрузить изображение</h4>
<?php
function showAlert($str) {
    return '<div class="alert alert-danger" role="alert">' . $str . '</div>';
}
if (isset($_POST['load'])) {
    $filetype = $_FILES['image']['type'];
    if ($filetype == 'image/png' || $filetype == 'image/jpeg') {
        $path = './gallery/big/' . $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            header('Location: ?page=gallery');
        } else {
            echo showAlert('Ошибка загрузки');
        }
    } else {
        echo showAlert('Выберите файл с расширением .jpeg или .png');
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" />
    </div>
    <input type="submit" name="load" value="Загрузить" class="btn btn-primary"/>
</form>
