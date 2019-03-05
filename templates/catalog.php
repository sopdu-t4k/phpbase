<h1>Каталог</h1>
<? if($current_page==1 && !empty($sort)): ?>
<div class="small">
    Сортировать:
    <ul class="nav d-inline-flex sort">
        <? foreach ($sort as $key => $value): ?>
        <li class="nav-item">
            <a class="nav-link <?=$value==$current_sort?'disabled':'';?>" href="/catalog/?sort=<?=$value;?>"><?=$key;?></a>
        </li>
        <? endforeach; ?>
    </ul>
</div>
<? endif; ?>
<div class="d-flex flex-wrap row">
    <? foreach ($goods as $good): ?>
    <div class="col-4 mt-3 mb-3">
        <div class="card pt-2 h-100 shadow-sm position-relative">
            <? if($good['sale']): ?>
            <div class="badge badge-danger sale shadow-sm">Скидка <?=$good['discount'];?>%</div>
            <? endif; ?>
            <a href="/tovar/<?=$good['id'];?>" title="Подробнее">
                <img src="/catalog-img/<?=imageProduct($good['image']);?>" class="card-img-top" alt="<?=$good['name'];?>">
            </a>
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"><?=$good['name'];?></h5>
                <? if($good['sale']): ?>
                    <p class="text-right mb-0 text-secondary"><s><?=round($good['price']);?> р.</s></p>
                <? endif; ?>
                <p class="h5 text-danger text-right mb-4">
                    <?=$good['sale']?round($good['discount_price']):round($good['price']);?> р.
                </p>
                <button data-action="buy" data-id="<?=$good['id'];?>" class="btn btn-success btn-sm w-50 d-block mx-auto">Купить</button>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>
<? if($count_page > 1): ?>
<ul class="pagination justify-content-center my-4">
    <? for ($idx = 1; $idx <= $count_page; $idx++): ?>
    <li class="page-item <?=$idx==$current_page?'active':'';?>">
        <a class="page-link" href="/catalog/?page=<?=$idx;?>"><?=$idx;?></a>
    </li>
    <? endfor; ?>
</ul>
<? endif; ?>
