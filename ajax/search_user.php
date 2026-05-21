<?php

require '../config/database.php';

$search = $_GET['search'];

$data = $conn->query(
"SELECT * FROM users
WHERE name LIKE '%$search%'
OR email LIKE '%$search%'"
);

while($row = $data->fetch_assoc()){

echo "

<tr>

<td>{$row['name']}</td>

<td>{$row['email']}</td>

<td>{$row['role']}</td>

</tr>

";

}
?>