<?php
/**
 * @var array $data
 */
?>

<h1>Customers count: <?=$data['CustomersCount']?></h1>
<h1>Used loyalty cards: <?=$data['UsedCards']?></h1>

<h2>Top buyers by last 30 days:</h2>
<table border="1">
    <thead>
    <tr>
        <th>Rank</th>
        <th>Customer</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['TopBuyers'] as $key => $TopBuyer): ?>
        <tr>
            <td>
                <?=$key+1?>
            </td>
            <td>
                <a href="/customers/id/<?=$TopBuyer['customer_id']?>"><?=$TopBuyer['name'] . ' ' . $TopBuyer['surname']?></a>
            </td>
            <td>
                <?=$TopBuyer['total_for_30_days']?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
