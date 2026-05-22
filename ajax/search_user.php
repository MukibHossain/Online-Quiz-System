<?php

require '../config/database.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$data = $conn->query(

"SELECT * FROM users

WHERE

name LIKE '%$search%'

OR

email LIKE '%$search%'

ORDER BY id ASC"

);

$serial = 1;

while($row = $data->fetch_assoc()){

echo "

<tr>

<td>$serial</td>

<td>{$row['name']}</td>

<td>{$row['email']}</td>

<td>{$row['role']}</td>

<td>

<a
href='user_management.php?delete={$row['id']}'
class='btn btn-primary btn-sm'>

Delete

</a>

</td>

</tr>

";

$serial++;

}

?>