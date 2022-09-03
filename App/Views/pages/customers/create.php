<?php
/**
 * @var array $data
 * @var CustomerEntity $CustomerEntity
 * @var LoyaltyCardEntity $LoyaltyCardEntity
 */

use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;

?>

<form action="/customers" method="post">
    <table border="1">
        <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Address</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Loyalty card</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input type="text" name="name" placeholder="Name">
            </td>
            <td>
                <input type="text" name="surname" placeholder="Surname">
            </td>
            <td>
                <input type="text" name="address" placeholder="Address">
            </td>
            <td>
                <input type="text" name="email" placeholder="E-mail">
            </td>
            <td>
                <input type="text" name="phone" placeholder="Phone">
            </td>
            <td>
                <select name="loyalty_card_id">
                    <option value="null" selected>Unset</option>
                    <?php foreach ($data['loyalty_cards_list'] as $LoyaltyCardEntity): ?>
                        <option value="<?=$LoyaltyCardEntity->id?>"><?=$LoyaltyCardEntity->card_number?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <button>Submit</button>
            </td>
        </tr>
        </tbody>
    </table>


</form>
