<?php require '../config/database.php'; ?>
<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#0f2027;

color:white;

}


.quiz{

background:#1f2937;

padding:25px;

border-radius:20px;

margin-bottom:20px;

box-shadow:0 0 20px black;

}

</style>

</head>


<body>


<div class="container mt-5">


<h1>

🚀 Available Quizzes

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


<div class="quiz">


<h2>

<?= $row['title'] ?>

</h2>


<p>

⏰

<?= $row['time_limit'] ?>

minutes

</p>


<a

href="quiz_play.php?id=<?= $row['id'] ?>"

class="btn btn-success">

Start Quiz

</a>


</div>


<?php } ?>


</div>


</body>
</html>