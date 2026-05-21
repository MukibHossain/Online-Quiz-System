<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(isset($_POST['saveQuiz'])){

$title =
$conn->real_escape_string($_POST['title']);

$time =
(int)$_POST['time'];

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

}

if(isset($_GET['delete'])){

$id =
(int)$_GET['delete'];

$conn->query(

"DELETE FROM quizzes
WHERE id='$id'"

);

$conn->query(

"DELETE FROM questions
WHERE quiz_id='$id'"

);

header(
"Location: quiz_management.php"
);

exit();

}

?>

<style>

h1{
color:#2563eb!important;
font-weight:bold;
}

.quiz-card{
background:white;
padding:20px;
border-radius:20px;
box-shadow:0 10px 25px rgba(37,99,235,.15);
}

.table td{
color:#0f172a!important;
font-weight:600;
}

.table th{
color:white!important;
}

</style>

<div class="container mt-5">

<h1>

🎯 Quiz Management

</h1>

<a
href="dashboard.php"
class="btn btn-primary">

← Back

</a>

<br><br>

<div class="quiz-card">

<form method="POST">

<input
name="title"
class="form-control"
placeholder="Quiz Title"
required>

<br>

<input
type="number"
name="time"
class="form-control"
placeholder="Time In Minutes"
required>

<br>

<button
name="saveQuiz"
class="btn btn-primary">

Save Quiz

</button>

</form>

</div>

<br><br>

<div class="card p-4">

<h3 style="color:#2563eb;">

📚 Saved Quizzes

</h3>

<br>

<table class="table">

<tr>

<th>ID</th>

<th>Quiz</th>

<th>Total Questions</th>

<th>Time</th>

<th>Action</th>

</tr>

<?php

$data =
$conn->query(
"SELECT * FROM quizzes
ORDER BY id DESC"
);

while($row = $data->fetch_assoc()){

$count =
$conn->query(

"SELECT COUNT(*) total
FROM questions
WHERE quiz_id='".$row['id']."'"

)->fetch_assoc();

?>

<tr>

<td>

<?= $row['id'] ?>

</td>

<td style="color:#2563eb!important;">

<?= $row['title'] ?>

</td>

<td>

<?= $count['total'] ?>

Questions

</td>

<td>

<?= $row['time_limit'] ?>

Min

</td>

<td>

<a
href="question_management.php?quiz=<?= $row['id'] ?>"
class="btn btn-primary btn-sm">

Manage Questions

</a>

<a
href="?delete=<?= $row['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this quiz?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php include '../includes/footer.php'; ?>