<?php
/**
 * @var array $data
 * @var CustomerEntity $CustomerEntity
 */

use App\Entities\CustomerEntity;

?>

<form action="/customers/list" method="post">
    <input type="text" name="s" placeholder="search"> <button>Search</button>
</form>

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
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['customers_list'] as $CustomerEntity): ?>
        <tr>
            <td><?=$CustomerEntity->id?></td>
            <td><?=$CustomerEntity->name?></td>
            <td><?=$CustomerEntity->surname?></td>
            <td><?=$CustomerEntity->address?></td>
            <td><?=$CustomerEntity->email?></td>
            <td><?=$CustomerEntity->phone?></td>
            <td><?=$CustomerEntity->registration_date?></td>
            <td>
                <span class="delete" data-id="<?=$CustomerEntity->id?>" style="color: red">Delete</span>
                <a href="/customers/edit/<?=$CustomerEntity->id?>">Edit</a>
                <a href="/customers/id/<?=$CustomerEntity->id?>">View</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="/customers/create">Create customer</a>

<script>
    $(document).ready(function () {
        $('body').on('click', '.delete', function () {
            let conf = confirm('Are you sure?')

            if (!conf) {
                return false
            }

            let id = $(this).attr("data-id")

            axios.delete('/customers/id/' + id).then(() => {
                location.reload()
            })
        })
    })
</script>
