<h1>Товары</h1>
<? if(!empty($message)): ?>
    <div class="alert mt-4 <?=$success?'alert-success':'alert-danger';?>" role="alert">
        <?=$message;?>
    </div>
<? endif; ?>
<p class="my-4">
    <a href="/product/" class="btn btn-success w-25">Добавить товар</a>
</p>
<? if($current_page==1 && !empty($sort)): ?>
<div class="small">
    Сортировать:
    <ul class="nav d-inline-flex sort">
        <? foreach ($sort as $key => $value): ?>
        <li class="nav-item">
            <a class="nav-link <?=$value==$current_sort?'disabled':'';?>" href="/goods/?sort=<?=$value;?>"><?=$key;?></a>
        </li>
        <? endforeach; ?>
    </ul>
</div>
<? endif; ?>
<table class="table table-hover my-3">
    <thead class="thead-light table-sm">
        <tr>
            <th style="width: 90px">Товар</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th></th>
            <th>Акция</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($goods as $good): ?>
        <tr>
            <td>
                <img src="/catalog-img/<?=imageProduct($good['image']);?>" class="d-block mx-auto img-fluid" alt="<?=$good['name'];?>">
            </td>
            <td class="align-middle">
                <a href="/tovar/<?=$good['id'];?>" class="h5"><?=$good['name'];?></a>
            </td>
            <td class="align-middle">
                <span class="h5"><?=round($good['price']);?> р.</span>
            </td>
            <td class="align-middle">
                <a href="/product/<?=$good['id'];?>" class="btn btn-warning btn-sm">Изменить</a>
            </td>
            <td class="align-middle">
                <label class="form-check-label">
                    <input type="checkbox" name="sale" data-action="sale" data-id="<?=$good['id'];?>" class="form-check-input" <?=$good['sale']==1?'checked':'';?>> включить
                </label>
            </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? if($count_page > 1): ?>
<ul class="pagination justify-content-center my-4">
    <? for ($idx = 1; $idx <= $count_page; $idx++): ?>
    <li class="page-item <?=$idx==$current_page?'active':'';?>">
        <a class="page-link" href="/goods/?page=<?=$idx;?>"><?=$idx;?></a>
    </li>
    <? endfor; ?>
</ul>
<? endif; ?>
