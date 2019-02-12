<h1>Галерея</h1>
<div class="clearfix mb-4">
<? foreach ($images as $image): ?>
    <a href="/gallery/big/<?=$image;?>" target="_blank">
        <img src="/gallery/small/<?=$image;?>" class="img-thumbnail float-left shadow-sm m-1" />
    </a>
<? endforeach; ?>
</div>
<h4>Загрузить изображение</h4>
<? if(!empty($message)): ?>
<div class="alert alert-danger" role="alert">
    <?=$message;?>
</div>
<? endif; ?>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" />
    </div>
    <input type="submit" name="load" value="Загрузить" class="btn btn-primary"/>
</form>
