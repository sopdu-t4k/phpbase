<h1>Акции</h1>
<div class="row">
    <div class="d-flex flex-wrap">       
    <? foreach ($goods as $good): ?>
    <div class="col-4 mt-3 mb-3">
        <div class="card pt-2 h-100 shadow-sm position-relative">
            <div class="badge badge-danger sale shadow-sm">Скидка <?=$good['discount'];?>%</div>
            <a href="/tovar/<?=$good['id'];?>" title="Подробнее">
                <img src="/catalog-img/<?=imageProduct($good['image']);?>" class="card-img-top" alt="<?=$good['name'];?>">
            </a>
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"><?=$good['name'];?></h5>
                <p class="text-right mb-0 text-secondary"><s><?=round($good['price']);?> р.</s></p>
                <p class="h5 text-danger text-right mb-4">
                    <?=round($good['discount_price']);?> р.
                </p>
                <button data-action="buy" data-id="<?=$good['id'];?>" class="btn btn-success btn-sm w-50 d-block mx-auto">Купить</button>
            </div>
        </div>
    </div>
    <? endforeach; ?>
    </div>
</div>
