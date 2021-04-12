<table class="table table-striped">
    <thead>
    <th>Ім`я</th>
    <th>Прізвище</th>
    <th>Телефон</th>
    <th>Email</th>
    <th>Місто</th>
    <th>Admin</th>
    <th></th>
</thead>

<?php
$customers = $this->registry['customers'];

foreach ($customers as $customer) :
    ?>
    <tr>
        <td><?php echo $customer['first_name'] ?></td>
        <td><?php echo $customer['last_name'] ?></td>
        <td><?php echo $customer['phone'] ?></td>
        <td><?php echo $customer['email'] ?></td>
        <td><?php echo $customer['city'] ?></td>
        <td> <span class="<?php echo Helper::isAdmin($customer['customer_id']) == 1 ? "glyphicon glyphicon-ok" : "glyphicon glyphicon-remove"; ?>"></span></td>
        <td>
            <a href=" <?php echo Helper::link('/customer/edit', array('id' => $customer['customer_id'])); ?>"> Редагувати </a>
        </td>


    </tr>
<?php endforeach; ?>

</table>