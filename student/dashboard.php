<?php require '../config/database.php'; ?>


<?php

$user_id=
$_SESSION['user_id'];


$user=
$conn->query(

"SELECT * FROM users

WHERE id='$user_id'"

)

->fetch_assoc();



$stats=
$conn->query(

"SELECT

COUNT(*) total,

AVG(score) average_score,

MAX(score) highest

FROM results

WHERE user_id='$user_id'"

)

->fetch_assoc();



$total=
$stats['total'] ?? 0;


$average=
round(
$stats['average_score'] ?? 0
);


$highest=
$stats['highest'] ?? 0;



$image=

!empty(
$user['photo']
)

?

"../uploads/".
$user['photo']

:

"../assets/images/avatar.png";

?>



<!DOCTYPE html>
<html>

<head>

<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>

body{

background:url(
'../assets/images/student-bg.png'
);

background-size:cover;

background-position:center;

min-height:100vh;

}


.overlay{

position:fixed;

width:100%;

height:100%;

background:rgba(
0,
0,
0,
0.75
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

padding:30px;

border-radius:25px;

margin-top:40px;

color:white;

}

</style>

</head>


<body>


<div class="overlay"></div>


<div class="container">


<div class="box">


<h1>

🎓 Student Dashboard

</h1>


<a
href="../index.php"
class="btn btn-info">

🏠 Home

</a>


<a
href="../auth/login.php"
class="btn btn-danger">

Logout

</a>


<br><br>



<img
src="<?= $image ?>"
width="140"
height="140"

style="

border-radius:50%;

object-fit:cover;

border:4px solid white;

">


<h2>

<?= $user['name'] ?>

</h2>


<hr>



<div class="row">


<div class="col-md-4">

<div class="card bg-primary text-white p-3">

<h4>

Total Quizzes

</h4>


<h2>

<?= $total ?>

</h2>

</div>

</div>



<div class="col-md-4">

<div class="card bg-success text-white p-3">

<h4>

Average Score

</h4>


<h2>

<?= $average ?>

</h2>

</div>

</div>



<div class="col-md-4">

<div class="card bg-warning text-dark p-3">

<h4>

Highest Score

</h4>


<h2>

<?= $highest ?>

</h2>

</div>

</div>


</div>



<br><br>



<canvas id="chart"></canvas>



<br><br>



<a
href="quiz_list.php"
class="btn btn-success">

Start Quiz

</a>


<a
href="leaderboard.php"
class="btn btn-warning">

Leaderboard

</a>


<a
href="profile.php"
class="btn btn-primary">

Profile

</a>



</div>


</div>



<script>

new Chart(

document.getElementById(
'chart'
),

{

type:'bar',

data:{

labels:[

'Attempts',
'Average',
'Highest'

],

datasets:[{

data:[

<?= $total ?>,

<?= $average ?>,

<?= $highest ?>

]

}]

}

}

);

</script>



</body>
</html>