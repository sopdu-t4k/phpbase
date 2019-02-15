<h1>Галерея</h1>
<ul class="nav nav-tabs mt-4">
    <li class="nav-item">
        <a class="nav-link btn-sm" href="/gallery/">По добавлению</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-sm" href="/gallery/?sort=imagename">По названию</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-sm" href="/gallery/?sort=popularity">По популярности</a>
    </li>
</ul>
<div class="clearfix mt-4 mb-4">
<? foreach ($images as $image): ?>
    <div class="image-block">
        <a href="/gallery/?delete=<?=$image['title'];?>" class="btn btn-danger" title="Удалить">&times;</a>
        <a href="/image/?id=<?=$image['id'];?>" title="Посмотреть">
            <figure class="figure float-left m-1 img-thumbnail shadow-sm">
                <img src="/gallery-img/small/<?=$image['title'];?>" />
                <figcaption class="figure-caption">
                    <?=$image['title'];?>
                    <span class="float-right">&#9734; <?=$image['count'];?></span>
                </figcaption>
            </figure>
        </a>
    </div>
<? endforeach; ?>
</div>
<h4>Загрузить изображение</h4>
<? if(!empty($message)): ?>
<div class="alert <?=$success?'alert-success':'alert-danger';?>" role="alert">
    <?=$message;?>
</div>
<? endif; ?>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" />
    </div>
    <input type="submit" name="load" value="Загрузить" class="btn btn-primary"/>
</form>
