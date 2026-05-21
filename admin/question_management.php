<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

$selected =
$_GET['quiz']
?? '';

if(isset($_GET['delete'])){

$id =
(int)$_GET['delete'];

$conn->query(

"DELETE FROM questions
WHERE id='$id'"

);

header(
"Location: question_management.php?quiz=".$selected
);

exit();

}

if(isset($_POST['save'])){

$conn->query(

"INSERT INTO questions(

quiz_id,
question,
option1,
option2,
option3,
option4,
correct_answer

)

VALUES(

'".$_POST['quiz_id']."',
'".$_POST['question']."',
'".$_POST['o1']."',
'".$_POST['o2']."',
'".$_POST['o3']."',
'".$_POST['o4']."',
'".$_POST['correct']."'

)"

);

echo "

<div class='alert alert-success mt-3'>

Question Saved Successfully 🎉

</div>

";

}

?>

<style>

h1,h3{
color:#2563eb!important;
font-weight:bold;
}

.manage-box{
background:white;
padding:25px;
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

📝 Question Management

</h1>

<a
href="quiz_management.php"
class="btn btn-primary">

← Back

</a>

<br><br>

<div class="manage-box">

<form method="POST">

<select
name="quiz_id"
class="form-control"
required>

<option value="">

Select Quiz

</option>

<?php

$quizzes =
$conn->query(
"SELECT * FROM quizzes"
);

while($q = $quizzes->fetch_assoc()){

?>

<option
value="<?= $q['id'] ?>"
<?= $selected == $q['id'] ? 'selected' : '' ?>>

<?= $q['title'] ?>

</option>

<?php } ?>

</select>

<br>

<textarea
name="question"
class="form-control"
placeholder="Enter Question"
required></textarea>

<br>

<input
name="o1"
class="form-control"
placeholder="Option 1"
required>

<br>

<input
name="o2"
class="form-control"
placeholder="Option 2"
required>

<br>

<input
name="o3"
class="form-control"
placeholder="Option 3"
required>

<br>

<input
name="o4"
class="form-control"
placeholder="Option 4"
required>

<br>

<input
name="correct"
class="form-control"
placeholder="Correct Answer"
required>

<br>

<button
name="save"
class="btn btn-primary">

Save Question

</button>

</form>

</div>

<br><br>

<div class="card p-4">

<h3>

📚 Quiz Questions

</h3>

<br>

<table class="table">

<tr>

<th>ID</th>

<th>Question</th>

<th>Correct Answer</th>

<th>Action</th>

</tr>

<?php

if($selected != ''){

$list =
$conn->query(

"SELECT * FROM questions
WHERE quiz_id='$selected'
ORDER BY id DESC"

);

if($list->num_rows > 0){

while($q = $list->fetch_assoc()){

?>

<tr>

<td>

<?= $q['id'] ?>

</td>

<td>

<?= $q['question'] ?>

</td>

<td style="color:#2563eb!important;">

<?= $q['correct_answer'] ?>

</td>

<td>

<a
href="?quiz=<?= $selected ?>&delete=<?= $q['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this question?')">

Delete

</a>

</td>

</tr>

<?php }

}else{

?>

<tr>

<td colspan="4" class="text-center">

No Questions Found

</td>

</tr>

<?php }

}else{

?>

<tr>

<td colspan="4" class="text-center">

Select a quiz first

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php include '../includes/footer.php'; ?>