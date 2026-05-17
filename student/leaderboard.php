<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

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

<style>
body {
    background: #0f172a;
    min-height: 100vh;
}
</style>

<div class="container mt-5 text-white">


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

<?php include '../includes/footer.php'; ?>
