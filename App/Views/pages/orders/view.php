<?php
/**
 * @var array $data
 * @var OrderFullViewEntity $OrderFullViewEntity
 */

use App\Entities\Mixed\OrderFullViewEntity;
$OrderFullViewEntity = $data['OrderFullViewEntity'];
?>

<h2>Info</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Loyalty card</th>
        <th>To pay</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$OrderFullViewEntity->id?></td>
        <td>
            <a href="/customers/id/<?=$OrderFullViewEntity->customer_id?>"><?=$OrderFullViewEntity->customer_name . ' ' . $OrderFullViewEntity->customer_surname?></a>
        </td>
        <td>
            <a href="/loyaltyCards/edit/<?=$OrderFullViewEntity->loyalty_card_id?>"><?=$OrderFullViewEntity->card_number?></a>
        </td>
        <td><?=$OrderFullViewEntity->total?></td>
        <td><?=$OrderFullViewEntity->date?></td>
    </tr>
    </tbody>
</table>

<br>
<br>
<h2>Goods</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price on buy moment</th>
        <th>Current price</th>
        <th>Count</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($OrderFullViewEntity->goods_list as $GoodEntity): ?>
        <tr>
            <td><?=$GoodEntity->id?></td>
            <td><?=$GoodEntity->title?></td>
            <td><?=$GoodEntity->price_on_moment?></td>
            <td><?=$GoodEntity->price?></td>
            <td><?=$GoodEntity->count?></td>
            <td><?=$GoodEntity->price_on_moment * $GoodEntity->count?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
