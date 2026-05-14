<?php require '../config/database.php'; ?>
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


<a href="dashboard.php"
class="btn btn-info">

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

$data=
$conn->query(

"SELECT * FROM leaderboard
ORDER BY score DESC"

);


$rank=1;


while(
$row=
$data->fetch_assoc()
){

?>


<tr>

<td>

<?= $rank++ ?>

</td>


<td>

<?= $row['name'] ?>

</td>


<td>

<?= $row['score'] ?>

</td>

</tr>


<?php } ?>


</table>


</div>


</body>
</html>