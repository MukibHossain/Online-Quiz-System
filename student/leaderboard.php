<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

$data=
$conn->query(

"SELECT

users.name,
users.photo,

MAX(results.score) best_score,

COUNT(results.id) total_attempts

FROM results

JOIN users
ON users.id=results.user_id

GROUP BY results.user_id

ORDER BY best_score DESC"

);

?>

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


.leader-title{

color:white!important;

font-weight:bold;

margin-bottom:25px;

}


.rank-badge{

background:#2563eb;

padding:8px 14px;

border-radius:12px;

font-weight:bold;

display:inline-block;

min-width:50px;

text-align:center;

color:white;

}


.user-box{

display:flex;

align-items:center;

gap:12px;

}


.user-img{

width:50px;

height:50px;

border-radius:50%;

object-fit:cover;

border:2px solid white;

}


.table{

border-radius:20px;

overflow:hidden;

background:rgba(
255,
255,
255,
0.06
)!important;

color:white!important;

}


.table th{

background:#2563eb!important;

color:white!important;

border:none;

padding:18px;

font-size:17px;

}


.table td{

padding:16px;

vertical-align:middle;

border-color:rgba(
255,
255,
255,
0.08
)!important;

color:white!important;

}


.table tr:hover{

background:rgba(
37,
99,
235,
0.15
);

transition:.3s;

}


.score-box{

background:#2563eb;

padding:8px 16px;

border-radius:12px;

display:inline-block;

font-weight:bold;

color:white;

}


.attempt-box{

background:rgba(
255,
255,
255,
0.12
);

padding:8px 16px;

border-radius:12px;

display:inline-block;

color:white;

}


.top-rank{

font-size:24px;

}


/* STUDENT NAME */
.student-name{

color:#60a5fa!important;

font-weight:bold;

}

</style>



<div class="overlay"></div>



<div class="container">



<div class="box">



<h1 class="leader-title">

🏆 Leaderboard

</h1>



<a
href="dashboard.php"
class="btn btn-primary">

← Back

</a>



<a
href="../index.php"
class="btn btn-primary">

🏠 Home

</a>



<br><br>



<div class="table-responsive">



<table class="table align-middle">



<tr>

<th>

Rank

</th>

<th>

Student

</th>

<th>

Best Score

</th>

<th>

Attempts

</th>

</tr>



<?php

$i=1;


while(
$row=
$data->fetch_assoc()
){

$image=

!empty(
$row['photo']
)

?

"../uploads/".
$row['photo']

:

"../assets/images/avatar.png";

?>



<tr>



<td>

<?php

if($i==1){

echo
"<span class='rank-badge top-rank'>🥇</span>";

}
elseif($i==2){

echo
"<span class='rank-badge top-rank'>🥈</span>";

}
elseif($i==3){

echo
"<span class='rank-badge top-rank'>🥉</span>";

}
else{

echo
"<span class='rank-badge'>#$i</span>";

}

?>

</td>



<td>

<div class="user-box">


<img
src="<?= $image ?>"
class="user-img">


<div>

<strong class="student-name">

<?= $row['name'] ?>

</strong>

</div>


</div>

</td>



<td>

<span class="score-box">

<?= $row['best_score'] ?>

</span>

</td>



<td>

<span class="attempt-box">

<?= $row['total_attempts'] ?>

</span>

</td>



</tr>



<?php

$i++;

}

?>



</table>



</div>



</div>



</div>



<?php include '../includes/footer.php'; ?>