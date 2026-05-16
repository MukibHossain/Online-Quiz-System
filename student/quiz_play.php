<?php require '../config/database.php'; ?>


<?php

$quiz_id=
$_GET['id'];


if(isset($_POST['submit'])){


$user_id=
$_SESSION['user_id'];


$check=
$conn->query(

"SELECT id FROM results

WHERE

user_id='$user_id'

AND

quiz_id='$quiz_id'"

);


if(
$check->num_rows>0
){

echo
"<script>

alert('Already attempted');

location='dashboard.php';

</script>";

exit();

}



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


header(
"Location: result.php"
);

exit();

}


$quiz=
$conn->query(

"SELECT * FROM quizzes

WHERE id='$quiz_id'"

)

->fetch_assoc();


$minutes=
$quiz['time_limit'];


$data=
$conn->query(

"SELECT * FROM questions

WHERE quiz_id='$quiz_id'"

);

?>


<!DOCTYPE html>
<html>

<head>

<title>Quiz Exam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

body{

background:url(
'../assets/images/quiz-bg.png'
);

background-size:cover;

background-position:center;

min-height:100vh;

font-family:Arial;

}


.overlay{

position:fixed;

width:100%;

height:100%;

background:rgba(
0,
0,
0,
0.7
);

}


.box{

position:relative;

z-index:5;

background:rgba(
255,
255,
255,
0.08
);

backdrop-filter:blur(15px);

padding:40px;

border-radius:25px;

margin-top:40px;

color:white;

box-shadow:0 0 30px black;

}


.timer{

font-size:30px;

font-weight:bold;

color:yellow;

}

</style>

</head>


<body>


<div class="overlay"></div>


<div class="container">


<div class="box">


<h1>

📝 Quiz Exam

</h1>



href="quiz_list.php"
class="btn btn-warning">

← Back

</a>



href="../index.php"
class="btn btn-info">

🏠 Home

</a>


<br><br>


<div
id="timer"
class="timer">

</div>


<br>


<form
method="POST"
id="quizForm">


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


</div>


</div>



<script>

let time=

<?= $minutes ?>*60;



setInterval(

function(){

let min=
Math.floor(
time/60
);

let sec=
time%60;


document
.getElementById(
'timer'
)

.innerHTML=

"⏰ "
+min+
":"
+String(sec)
.padStart(
2,
'0'
);


if(
time<=0
){

document
.getElementById(
'quizForm'
)
.submit();

}


time--;

},

1000

);

</script>



</body>
</html>