```php id="wq8s2v"
<?php

require '../config/database.php';

header(
"Content-type: application/vnd-ms-excel"
);

header(
"Content-Disposition: attachment; filename=quiz_report.xls"
);

$data =
$conn->query(

"SELECT

users.name,
users.email,
quizzes.title,
results.score,
results.total,
results.created_at

FROM results

JOIN users
ON users.id = results.user_id

JOIN quizzes
ON quizzes.id = results.quiz_id

ORDER BY results.id DESC"

);

echo "

<table border='1'>

<tr>

<th>Serial</th>

<th>Student Name</th>

<th>Email</th>

<th>Quiz</th>

<th>Score</th>

<th>Total</th>

<th>Percentage</th>

<th>Date</th>

</tr>

";

$serial = 1;

while($row = $data->fetch_assoc()){

$percentage = 0;

if($row['total'] > 0){

$percentage =
round(

($row['score'] / $row['total']) * 100

);

}

echo "

<tr>

<td>$serial</td>

<td>{$row['name']}</td>

<td>{$row['email']}</td>

<td>{$row['title']}</td>

<td>{$row['score']}</td>

<td>{$row['total']}</td>

<td>{$percentage}%</td>

<td>{$row['created_at']}</td>

</tr>

";

$serial++;

}

echo "</table>";

?>
```
