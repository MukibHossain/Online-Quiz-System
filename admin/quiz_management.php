<?php require '../config/database.php'; ?>
<!DOCTYPE html>
<html>

<head>

<title>Quiz Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(
45deg,
#0f2027,
#203a43,
#2c5364
);

min-height:100vh;

color:white;

}

.box{

background:rgba(
255,
255,
255,
0.08
);

padding:30px;

border-radius:20px;

backdrop-filter:blur(10px);

}

</style>

</head>


<body>


<div class="container mt-5">


<div class="box">


<h1>

🎯 Quiz Management

</h1>


<a href="dashboard.php"
class="btn btn-info">

← Back

</a>


<br><br>


<form method="POST">


<input
name="title"
class="form-control"
placeholder="Quiz Title">


<br>


<input
name="time"
class="form-control"
placeholder="Time">


<br>


<button
name="saveQuiz"
class="btn btn-success">

Save Quiz

</button>


</form>



<?php

if(isset($_POST['saveQuiz'])){

$title=$_POST['title'];

$time=$_POST['time'];


$conn->query(

"INSERT INTO quizzes(
title,
time_limit
)

VALUES(
'$title',
'$time'
)"

);

echo
"<div class='alert alert-success mt-3'>
Quiz Added
</div>";

}

?>


<hr>


<h3>

Saved Quizzes

</h3>


<table class="table table-dark">


<tr>

<th>ID</th>

<th>Quiz</th>

<th>Time</th>

</tr>



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


<tr>

<td>

<?= $row['id'] ?>

</td>


<td>

<?= $row['title'] ?>

</td>


<td>

<?= $row['time_limit'] ?>

</td>

</tr>


<?php } ?>


</table>


</div>


</div>


</body>
</html>