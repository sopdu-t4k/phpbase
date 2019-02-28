<a href="/catalog/" class="btn btn-link">&larr; Назад</a>
<h2 class="my-3"><?=$good['name']?></h2>
<div class="row my-5">
    <div class="col-4">
        <div class="position-relative">
            <? if($good['sale']): ?>
                <div class="badge badge-danger sale shadow-sm">Скидка <?=$good['discount'];?>%</div>
            <? endif; ?>
            <img src="/catalog-img/<?=imageProduct($good['image']);?>" class="d-block mx-auto img-fluid" alt="<?=$good['name'];?>">
        </div>
    </div>
    <div class="col-8 d-flex flex-column justify-content-center">
        <? if($good['sale']): ?>
            <p class="mb-0 text-secondary"><s><?=round($good['price']);?> руб.</s></p>
        <? endif; ?>
        <p class="h3 text-danger mb-3">
            <?=$good['sale']?round($good['discount_price']):round($good['price']);?> руб.
        </p>
        <? if (!empty($good['description'])): ?>
            <p><?=$good['description'];?></p>
        <? endif; ?>
        <div class="form-group row">
            <label class="col-2 col-form-label text-right text-muted">Количество:</label>
            <div class="col-2">
                <input type="number" name="quantity" class="form-control" value="1" autocomplete="off">
            </div>
        </div>
        <button data-action="buy" data-id="<?=$good['id'];?>" class="btn btn-success btn-lg w-25 d-block">Купить</button>
    </div>
</div>
<div class="card my-4">
<h5 class="card-header">Оставьте отзыв:</h5>
    <div class="card-body">
        <form action="/comments/add/<?=$good['id'];?>" method="post" id="comment">
            <div class="form-group">
                <input name="user" class="form-control" placeholder="Ваше Имя" required>
            </div>
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Ваше сообщение" required></textarea>
            </div>
            <input type="submit" name="send" value="Отправить" class="btn btn-info">
        </form>
    </div>
</div>
<? if (isset($comments)): ?>
    <? foreach ($comments as $comment): ?>
        <? if($comment['public'] == 1): ?>
        <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0"><?=$comment['user'];?></h5>
                <?=$comment['message'];?>
            </div>
        </div>
        <? endif; ?>
    <? endforeach; ?>
<? endif; ?>
