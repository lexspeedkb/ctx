<?php
/**
 * @var array $data
 * @var LoyaltyCardEntity $LoyaltyCardEntity
 * @var CustomerEntity $CustomerEntity
 */

use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;

?>

<form action="/loyaltyCards" method="post">
    <table border="1">
        <thead>
        <tr>
            <th>Card number</th>
            <th>Is virtual</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input type="text" name="card_number" placeholder="Name"">
            </td>
            <td>
                <input type="radio" name="is_virtual" value="1" checked/> true <br>
                <input type="radio" name="is_virtual" value="0" /> false
            </td>
            <td>
                <button>Submit</button>
            </td>
        </tr>
        </tbody>
    </table>


</form>
