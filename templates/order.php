<a href="/orders/" class="btn btn-link">&larr; Назад</a>
<h2 class="my-3">Заказ <?=$order['id'];?></h2>
<dl class="row">
    <dt class="col-2">Оформлен:</dt>
    <dd class="col-10"><?=$order['date'];?></dd>
    <dt class="col-2">Клиент:</dt>
    <dd class="col-10"><?=$order['user_name'];?></dd>
    <dt class="col-2">Телефон:</dt>
    <dd class="col-10"><?=$order['phone'];?></dd>
</dl>
<table class="table my-5">
    <thead class="thead-light table-sm">
        <tr>
            <th class="px-3">Наименование</th>
            <th class="px-3">Цена</th>
            <th class="pr-3">Количество</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($basket as $good): ?>
        <tr>
            <td>
                <a href="/tovar/<?=$good['good_id'];?>" class="h5"><?=$good['name'];?></a>
            </td>
            <td>
                <span class="h5"><?=$good['price'];?> р.</span>
            </td>
            <td style="width: 60px">
                <?=$good['quantity'];?> шт.
            </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
<div class="row justify-content-end">
    <div class="col-4">
        <p class="h5">
            Общая стоимость: 
            <span class="h4 text-danger ml-2">
                <span id="total"><?=$total['summ'];?></span> р. 
            </span>
        </p>
    </div>
</div>
