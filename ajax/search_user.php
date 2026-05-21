<?php

require '../config/database.php';

$search = $_GET['search'];

$data = $conn->query(
"SELECT * FROM users
WHERE name LIKE '%$search%'
OR email LIKE '%$search%'"
);