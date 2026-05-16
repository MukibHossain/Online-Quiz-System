<?php

session_start();

require '../config/database.php';


$data=
$conn->query(

"SELECT

users.name,

MAX(results.score) best_score

FROM results

JOIN users

ON users.id=results.user_id

GROUP BY results.user_id

ORDER BY best_score DESC"

);

?>


<!DOCTYPE html>
<html>

<head>

<title>Leaderboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

🏆 Leaderboard

</h1>


<a
href="dashboard.php"
class="btn btn-warning">

← Back

</a>


<br><br>


<table class="table table-dark">


<tr>

<th>Rank</th>

<th>Name</th>

<th>Score</th>

</tr>



<?php

$i=1;


while(
$row=
$data->fetch_assoc()
){

?>


<tr>


<td>

<?= $i++ ?>

</td>


<td>

<?= $row['name'] ?>

</td>


<td>

<?= $row['best_score'] ?>

</td>


</tr>


<?php } ?>


</table>


</div>


</body>
</html>