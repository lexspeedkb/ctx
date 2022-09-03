<?php
/**
 * @var array $data
 * @var CustomerEntity $CustomerEntity
 */

use App\Entities\CustomerEntity;

?>

<form action="/customers/id/<?=$data['CustomerEntity']->id?>" method="post">
    <table border="1">
        <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Address</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Registration date</th>
            <th>Loyalty card</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input type="text" name="name" placeholder="Name" value="<?=$data['CustomerEntity']->name?>">
            </td>
            <td>
                <input type="text" name="surname" placeholder="Surname" value="<?=$data['CustomerEntity']->surname?>">
            </td>
            <td>
                <input type="text" name="address" placeholder="Address" value="<?=$data['CustomerEntity']->address?>">
            </td>
            <td>
                <input type="text" name="email" placeholder="E-mail" value="<?=$data['CustomerEntity']->email?>">
            </td>
            <td>
                <input type="text" name="phone" placeholder="Phone" value="<?=$data['CustomerEntity']->phone?>">
            </td>
            <td>
                <input type="date" name="registration_date" placeholder="Registration date" value="<?=$data['CustomerEntity']->registration_date?>">
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
