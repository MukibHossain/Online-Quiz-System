<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(isset($_POST['saveQuiz'])){


$conn->query(

"INSERT INTO quizzes(

title,
time_limit

)

VALUES(

'".$_POST['title']."',

'".$_POST['time']."'

)"

);

}


if(isset($_GET['delete'])){


$id=
(int)
$_GET['delete'];


$conn->query(

"DELETE FROM quizzes

WHERE id='$id'"

);


header(
"Location: quiz_management.php"
);

exit();

}

?>

<style>
body {
    background: #0f172a;
    min-height: 100vh;
}

h1,h2,h3,h4,h5,h6{
    color:white!important;
}

.table td{
    color:white!important;
}
</style>

<div class="container mt-5 text-white">


<h1>

🎯 Quiz Management

</h1>


<a
href="dashboard.php"
class="btn btn-warning">

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


<hr>


<table class="table table-dark">


<tr>

<th>ID</th>

<th>Quiz</th>

<th>Questions</th>

<th>Action</th>

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


$count=
$conn->query(

"SELECT COUNT(*) total

FROM questions

WHERE quiz_id='".$row['id']."'"

)

->fetch_assoc();

?>


<tr>


<td>

<?= $row['id'] ?>

</td>


<td style="color:#60a5fa!important;">

<?= $row['title'] ?>

</td>


<td style="color:#60a5fa!important;">

<?= $count['total'] ?>

Questions

</td>


<td>


<a
href="question_management.php?quiz=<?= $row['id'] ?>"
class="btn btn-primary btn-sm">

Questions

</a>


<a
href="?delete=<?= $row['id'] ?>"
class="btn btn-danger btn-sm">

Delete

</a>


</td>


</tr>


<?php } ?>


</table>


</div>

<?php include '../includes/footer.php'; ?>