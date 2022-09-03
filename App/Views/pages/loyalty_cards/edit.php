<?php
/**
 * @var array $data
 * @var LoyaltyCardEntity $LoyaltyCardEntity
 * @var CustomerEntity $CustomerEntity
 */

use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;

?>

<form action="/loyaltyCards/id/<?=$data['LoyaltyCardEntity']->id?>" method="post">
    <table border="1">
        <thead>
        <tr>
            <th>Card number</th>
            <th>Is virtual</th>
            <th>Owner</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input type="text" name="card_number" placeholder="Name" value="<?=$data['LoyaltyCardEntity']->card_number?>">
            </td>
            <td>
                <input type="radio" name="is_virtual" value="1" <?php if ($data['LoyaltyCardEntity']->is_virtual) {echo 'checked'; }?>/> true <br>
                <input type="radio" name="is_virtual" value="0" <?php if (!$data['LoyaltyCardEntity']->is_virtual) {echo 'checked'; }?>/> false
            </td>
            <td>
                <select name="customer_id">
                    <option value="null" <?php if ($data['LoyaltyCardEntity']->customer_id == null) {echo 'selected'; }?>>Unset</option>
                    <?php foreach($data['customers_list'] as $CustomerEntity): ?>
                        <option value="<?=$CustomerEntity->id?>" <?php if ($data['LoyaltyCardEntity']->customer_id == $CustomerEntity->id) {echo 'selected'; }?>><?=$CustomerEntity->name . ' ' . $CustomerEntity->surname?></option>
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
