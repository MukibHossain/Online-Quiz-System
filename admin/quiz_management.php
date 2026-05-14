<?php require '../config/database.php'; ?>
<!DOCTYPE html>
<html>

<head>

<title>Quiz Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

Quiz Management

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
placeholder="Quiz Name">


<br>


<input
name="time"
class="form-control"
placeholder="Time in Minutes">


<br>


<button
name="save"
class="btn btn-success">

Save Quiz

</button>


</form>



<?php

if(isset($_POST['save'])){

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
Quiz Added 🎉
</div>";

}

?>



<br><br>


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

min

</td>

</tr>


<?php } ?>


</table>


</div>


</body>
</html>