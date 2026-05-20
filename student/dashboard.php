<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

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
0.72
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

backdrop-filter:blur(16px);

padding:35px;

border-radius:30px;

margin-top:40px;

color:white;

box-shadow:0 0 30px rgba(37,99,235,.35);

}


.stat-card{

background:rgba(
255,
255,
255,
0.12
);

padding:25px;

border-radius:22px;

text-align:center;

color:white;

backdrop-filter:blur(12px);

transition:.3s;

height:100%;

border:1px solid rgba(255,255,255,.15);

}


.stat-card:hover{

transform:translateY(-5px);

box-shadow:0 0 25px rgba(37,99,235,.45);

}


.stat-card h2,
.stat-card h4{

color:white!important;

}


.dashboard-title{

color:white!important;

font-weight:bold;

}


.chart-box{

background:rgba(
255,
255,
255,
0.08
);

padding:20px;

border-radius:20px;

}


.user-name{

color:white;

font-weight:bold;

margin-top:15px;

}

</style>


<div class="overlay"></div>


<div class="container">


<div class="box">


<h1 class="dashboard-title">

🎓 Student Dashboard

</h1>


<a
href="../index.php"
class="btn btn-primary">

🏠 Home

</a>


<a
href="../auth/logout.php"
class="btn btn-primary">

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


<h2 class="user-name">

<?= $user['name'] ?>

</h2>


<hr style="color:white;">



<div class="row g-4">


<div class="col-md-4">

<div class="stat-card">

<h4>

Total Quizzes

</h4>


<h2>

<?= $total ?>

</h2>

</div>

</div>



<div class="col-md-4">

<div class="stat-card">

<h4>

Average Score

</h4>


<h2>

<?= $average ?>

</h2>

</div>

</div>



<div class="col-md-4">

<div class="stat-card">

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



<div class="chart-box">

<canvas id="chart"></canvas>

</div>



<br><br>



<a
href="quiz_list.php"
class="btn btn-primary">

Start Quiz

</a>


<a
href="leaderboard.php"
class="btn btn-primary">

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

label:'Performance',

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

<?php include '../includes/footer.php'; ?>