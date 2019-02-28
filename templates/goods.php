<h1>Товары</h1>
<? if(!empty($message)): ?>
    <div class="alert mt-4 <?=$success?'alert-success':'alert-danger';?>" role="alert">
        <?=$message;?>
    </div>
<? endif; ?>
<p class="my-4">
    <a href="/product/" class="btn btn-success w-25">Добавить товар</a>
</p>
<table class="table table-hover my-5">
    <thead class="thead-light table-sm">
        <tr>
            <th style="width: 90px"><a href="/goods/?sort=id" title="Сортировать по добавлению" class="dropdown-toggle text-info">Товар</a></th>
            <th><a href="/goods/?sort=name" title="Сортировать по наименованию" class="dropdown-toggle text-info">Наименование</a></th>
            <th><a href="/goods/?sort=price" title="Сортировать по цене" class="dropdown-toggle text-info">Цена</a></th>
            <th></th>
            <th><a href="/goods/?sort=sale" title="Сортировать по акции" class="dropdown-toggle text-info">Акция</a></th>
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
