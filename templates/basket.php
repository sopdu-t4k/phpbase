<h1>Корзина</h1>
<? if(!empty($basket)): ?>
<table class="table my-5">
    <thead class="thead-light table-sm">
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? foreach($basket as $good): ?>
        <tr>
            <td class="align-middle">
                <a href="/tovar/<?=$good['good_id'];?>" class="h5"><?=$good['name'];?></a>
            </td>
            <td class="align-middle">
                <span class="h5"><?=round($good['current_price']);?> р.</span>
            </td>
            <td style="width: 60px">
                <input type="number" name="quantity" data-id="<?=$good['id'];?>" class="form-control form-control-sm" value="<?=$good['quantity'];?>" autocomplete="off">
            </td>
            <td class="text-right">
                <a href="/basket/delete/<?=$good['id'];?>" class="btn btn-danger btn-sm" title="Удалить товар">&times;</a>
            </td>
        </tr>
        <? endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="button" id="recount" class="btn btn-light btn-block btn-sm">Пересчитать</button>
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>
<div class="row justify-content-end">
    <div class="col-4">
        <p class="h5">
            Общая стоимость: 
            <span class="h4 text-danger ml-2">
                <span id="total"><?=round($total['summ']);?></span> р. 
            </span>
        </p>
    </div>
</div>
<div class="alert alert-warning mt-5" role="alert">Для оформления заказа укажите Ваше имя и телефон</div>
<div class="row">
    <div class="col-4 mb-3">
        <form name="order" action="/basket/order/" method="post">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Имя">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="8(000)0000000">
            </div>
            <button type="submit" name="send" class="btn btn-success btn-block">Оформить заказ</button>
        </form>
    </div>
</div>
<? elseif(!empty($message)): ?>
<div class="my-5 alert <?=$success?'alert-success':'alert-danger';?>" role="alert">
    <?=$message;?>
</div>
<? else: ?>
<p class="text-center h5">Ваша корзина пуста</p>
<? endif; ?>
