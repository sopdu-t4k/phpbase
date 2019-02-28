<h2>Добро пожаловать!</h2>
<p class="lead my-3"><b>В нашем магазине Вы найдете <b class="text-danger"><?=$goods['count'];?></b> товаров по самой выгодной цене!</b></p>
<hr/>
<h3 class="my-4">Распродажа</h3>
<div class="row">
    <? foreach ($sale as $good): ?>
    <div class="col-2">
        <div class="position-relative">
            <div class="badge badge-danger sale shadow-sm">Скидка <?=$good['discount'];?>%</div>
            <a href="/tovar/<?=$good['id'];?>" title="Подробнее">
                <img src="/catalog-img/<?=imageProduct($good['image']);?>" class="d-block mx-auto img-fluid" alt="Кофемашина DeLonghi Magnifica S ECAM 22.110.SB">
            </a>
        </div>
    </div>
    <div class="col-4">
        <a href="/tovar/<?=$good['id'];?>" class="text-body">
            <p class="h4"><?=$good['name'];?></p>
        </a>
        <p class="mb-0 text-secondary"><s><?=round($good['price']);?> р.</s></p>
            <p class="h4 text-danger mb-4">
                <?=round($good['discount_price']);?> р.
            </p>
        <button data-action="buy" data-id="<?=$good['id'];?>" class="btn btn-success btn-sm w-50">Купить</button>
    </div>
    <? endforeach; ?>
</div>
<hr/>
<h3 class="my-4">Новые поступления</h3>
<div class="row">
    <div class="col-4">
        <a href="/tovar/<?=$last_good['id'];?>" title="Подробнее">
             <img src="/catalog-img/<?=!empty($last_good['image'])?$last_good['image']:'no-thumb.png';?>" class="d-block mx-auto img-fluid" alt="<?=$last_good['name'];?>">
        </a>
    </div>
    <div class="col-8">
        <a href="/tovar/<?=$last_good['id'];?>" class="text-body">
            <p class="h4"><?=$last_good['name'];?></p>
        </a>
        <p><?=$last_good['description'];?></p>
        <span class="h4 text-danger"><?=round($last_good['price']);?> руб.</span>
        <button data-action="buy" data-id="<?=$last_good['id'];?>" class="btn btn-success btn-sm w-25 mx-5">Купить</button>
    </div>
</div>
<div class="my-4 alert" role="alert" id="message" style="display: none"></div>
<hr/>
<h3 class="my-4">Отзывы о наших товарах</h3>
<div class="row my-3">
    <div class="col-8">
        <div class="alert alert-secondary mt-3">
            <p class="h6 mb-3"><strong><?=$comment_good['user'];?></strong> о товаре <a class="alert-link" href="/tovar/<?=$comment_good['id'];?>"><?=$comment_good['name'];?></a></p>
            <p class="mb-0"><?=$comment_good['message'];?></p>
        </div> 
    </div>
    <div class="col-2 mx-auto">
        <a href="/tovar/<?=$comment_good['id'];?>" title="<?=$comment_good['name'];?>">
            <img src="/catalog-img/<?=!empty($comment_good['image'])?$comment_good['image']:'no-thumb.png';?>" class="d-block img-fluid" alt="<?=$comment_good['name'];?>">
        </a>
    </div>
</div>
