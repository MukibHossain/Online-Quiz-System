<?php require '../config/database.php'; ?>

<?php

$quiz_id=
$_GET['id'];


$data=
$conn->query(

"SELECT * FROM questions

WHERE quiz_id='$quiz_id'"

);

?>


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

padding:30px;

border-radius:20px;

}

</style>

</head>


<body>


<div class="container mt-5">


<div class="quiz">


<h1>

📝 Quiz

</h1>


<a href="../index.php"
class="btn btn-info">

🏠 Home

</a>


<br><br>


<form method="POST">


<?php

$i=1;

while(
$row=
$data->fetch_assoc()
){

?>


<h4>

<?= $i ?>.

<?= $row['question'] ?>

</h4>


<input
type="radio"
name="q<?= $row['id'] ?>"
value="<?= $row['option1'] ?>">

<?= $row['option1'] ?>


<br>


<input
type="radio"
name="q<?= $row['id'] ?>"
value="<?= $row['option2'] ?>">

<?= $row['option2'] ?>


<br>


<input
type="radio"
name="q<?= $row['id'] ?>"
value="<?= $row['option3'] ?>">

<?= $row['option3'] ?>


<br>


<input
type="radio"
name="q<?= $row['id'] ?>"
value="<?= $row['option4'] ?>">

<?= $row['option4'] ?>


<br><br>


<?php

$i++;

}

?>


<button
name="submit"
class="btn btn-success">

Submit Quiz

</button>


</form>



<?php

if(isset($_POST['submit'])){


$user_id=
$_SESSION['user_id'];


$questions=
$conn->query(

"SELECT * FROM questions

WHERE quiz_id='$quiz_id'"

);


$total=0;

$score=0;


while(
$q=
$questions->fetch_assoc()
){

$total++;


$answer=

$_POST[
'q'.$q['id']
]

?? '';


if(
$answer==
$q['correct_answer']
){

$score++;

}

}



$conn->query(

"INSERT INTO results(

user_id,
quiz_id,
score,
total

)

VALUES(

'$user_id',
'$quiz_id',
'$score',
'$total'

)"

);



$conn->query(

"INSERT INTO leaderboard(

name,
score

)

VALUES(

'".$_SESSION['user_name']."',
'$score'

)"

);



header(
"Location: result.php"
);

}

?>


</div>


</div>


</body>
</html>