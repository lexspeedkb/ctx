<?php
/**
 * @var array $data
 * @var CustomerEntity $CustomerEntity
 */

use App\Entities\CustomerEntity;

?>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Address</th>
        <th>E-mail</th>
        <th>Phone</th>
        <th>Registration date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$data['CustomerEntity']->id?></td>
        <td><?=$data['CustomerEntity']->name?></td>
        <td><?=$data['CustomerEntity']->surname?></td>
        <td><?=$data['CustomerEntity']->address?></td>
        <td><?=$data['CustomerEntity']->email?></td>
        <td><?=$data['CustomerEntity']->phone?></td>
        <td><?=$data['CustomerEntity']->registration_date?></td>
    </tr>
    </tbody>
</table>