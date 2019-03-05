<a href="/orders/" class="btn btn-link">&larr; Назад</a>
<h2 class="my-3">Заказ <?=$order['id'];?></h2>
<dl class="row">
    <dt class="col-2">Оформлен:</dt>
    <dd class="col-10"><?=$order['date'];?></dd>
    <dt class="col-2">Клиент:</dt>
    <dd class="col-10"><?=$order['user_name'];?></dd>
    <dt class="col-2">Телефон:</dt>
    <dd class="col-10"><?=$order['phone'];?></dd>
    <dt class="col-2">Статус:</dt>
    <dd class="col-2">
        <select id="status" data-id="<?=$order['id'];?>" class="form-control form-control-sm">
            <? foreach($statuses as $item): ?>
            <option <?=$item['id']==$order['status']?'selected':'';?> value="<?=$item['id'];?>">
                <?=$item['status'];?>
            </option>
            <? endforeach; ?>
        </select>
    </dd>
</dl>
<table class="table my-5">
    <thead class="thead-light table-sm">
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($basket as $good): ?>
        <tr>
            <td>
                <a href="/tovar/<?=$good['good_id'];?>" class="h5"><?=$good['name'];?></a>
            </td>
            <td>
                <span class="h5"><?=round($good['current_price']);?> р.</span>
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
                <span id="total"><?=round($total['summ']);?></span> р. 
            </span>
        </p>
    </div>
</div>
