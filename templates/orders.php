<h1>Заказы</h1>
<? if(!empty($orders)): ?>
<table class="table table-hover my-5">
    <thead class="thead-light table-sm">
        <tr>
            <th class="px-3">Дата/время заказа</th>
            <th>Посмотреть заказ</th>
            <th>Сумма заказа</th>
            <th>Клиент</th>
            <th>Телефон</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($orders as $order): ?>
        <tr>
            <td><?=$order['date'];?></td>
            <td>
                <a href="/order/<?=$order['id'];?>" class="h5">Заказ <?=$order['id'];?></a>
            </td>
            <td>
                <span class="h5 text-danger">
                <? foreach($amount as $summ): ?>
                    <?=$summ['order_id']==$order['id']?$summ['total_price']:'';?>
                <? endforeach; ?>
                </span>
            </td>
            <td><?=$order['user_name'];?></td>
            <td><?=$order['phone'];?></td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? else: ?>
<p class="text-center h5">Оформленных заказов нет</p>
<? endif; ?>
