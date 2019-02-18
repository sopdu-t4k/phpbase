<a href="/catalog/" class="btn btn-link">&larr; Назад</a>
<h2 class="mt-3 mb-3"><?=$good['name']?></h2>
<div class="row mb-5">
    <div class="col-4">
        <img src="/catalog-img/<?=!empty($good['image'])?$good['image']:'no-thumb.png';?>" class="d-block mx-auto" alt="<?=$good['name'];?>">
    </div>
    <div class="col-8 d-flex flex-column justify-content-center">
        <p class="h3 text-danger mb-3"><?=$good['price'];?> руб.</p>
        <? if (!empty($good['description'])): ?>
        <p><?=$good['description'];?></p>
        <? endif; ?>
        <a href="#" class="btn btn-success btn-lg w-25 d-block">Купить</a>
    </div>
</div>
<div class="card my-4">
<h5 class="card-header">Оставьте отзыв:</h5>
    <div class="card-body">
        <form action="/tovar/comment/<?=$good['id'];?>" method="post">
            <div class="form-group">
                <input name="user" class="form-control" placeholder="Ваше Имя" required>
            </div>
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Ваше сообщение" required></textarea>
            </div>
            <button type="submit" name="send" class="btn btn-secondary">Отправить</button>
        </form>
    </div>
</div>
<? if (isset($comments)): ?>
<? foreach ($comments as $comment): ?>
<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
    <div class="media-body">
        <h5 class="mt-0"><?=$comment['user'];?></h5>
        <?=$comment['message'];?>
    </div>
</div>
<? endforeach; ?>
<? endif; ?>
