<?php require '../config/database.php'; ?>
<!DOCTYPE html>
<html>

<head>

<title>Quiz List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

Available Quizzes

</h1>


<a href="dashboard.php"
class="btn btn-info">

← Back

</a>


<br><br>



<?php

$data=
$conn->query(
"SELECT * FROM quizzes"
);


while(
$row=
$data->fetch_assoc()
){

?>


<div class="card bg-secondary p-3 mb-3">


<h3>

<?= $row['title'] ?>

</h3>


<p>

Time:

<?= $row['time_limit'] ?>

Minutes

</p>


<a
href="quiz_play.php"
class="btn btn-success">

Start Quiz

</a>


</div>


<?php } ?>


</div>


</body>
</html>