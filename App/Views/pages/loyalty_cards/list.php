<?php
/**
 * @var array $data
 * @var LoyaltyCardWithOwnerEntity $LoyaltyCardEntity
 */

use App\Entities\Mixed\LoyaltyCardWithOwnerEntity;

?>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Card number</th>
        <th>Type</th>
        <th>Owner</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['loyalty_cards_list'] as $LoyaltyCardEntity): ?>
        <tr>
            <td><?=$LoyaltyCardEntity->id?></td>
            <td><?=$LoyaltyCardEntity->card_number?></td>
            <td><?php if ($LoyaltyCardEntity->is_virtual) {echo 'Virtual'; } else {echo 'Plastic';}?></td>
            <td>
                <a href="/customers/id/<?=$LoyaltyCardEntity->customer_id?>">
                    <?=$LoyaltyCardEntity->customer_name . ' ' . $LoyaltyCardEntity->customer_surname?>
                </a>
            </td>
            <td>
                <span class="delete" data-id="<?=$LoyaltyCardEntity->id?>" style="color: red">Delete</span>
                <a href="/loyaltyCards/edit/<?=$LoyaltyCardEntity->id?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="/loyaltyCards/create">Create loyalty card</a>

<script>
    $(document).ready(function () {
        $('body').on('click', '.delete', function () {
            let conf = confirm('Are you sure?')

            if (!conf) {
                return false
            }

            let id = $(this).attr("data-id")

            axios.delete('/loyaltyCards/id/' + id).then(() => {
                location.reload()
            })
        })
    })
</script>
