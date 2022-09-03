<?php
/**
 * @var array $data
 * @var OrdersListEntity $OrdersListEntity
 */

use App\Entities\Mixed\OrdersListEntity;

?>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Loyalty card</th>
        <th>To pay</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['OrdersList'] as $OrdersListEntity): ?>
        <tr>
            <td><?=$OrdersListEntity->id?></td>
            <td>
                <a href="/customers/id/<?=$OrdersListEntity->customer_id?>"><?=$OrdersListEntity->customer_name . ' ' . $OrdersListEntity->customer_surname?></a>
            </td>
            <td>
                <a href="/loyaltyCards/edit/<?=$OrdersListEntity->loyalty_card_id?>"><?=$OrdersListEntity->card_number?></a>
            </td>
            <td><?=$OrdersListEntity->total?></td>
            <td><?=$OrdersListEntity->date?></td>
            <td>
                <a href="/orders/id/<?=$OrdersListEntity->id?>">View</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>