<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

// Quiz wise attempts

$quizData=
$conn->query(

"SELECT

quizzes.title,

COUNT(results.id) total_attempts,

AVG(results.score) avg_score

FROM quizzes

LEFT JOIN results
ON quizzes.id=results.quiz_id

GROUP BY quizzes.id"

);



$labels=[];
$attempts=[];
$averages=[];



while(
$row=
$quizData->fetch_assoc()
){

$labels[]=
$row['title'];

$attempts[]=
$row['total_attempts'];

$averages[]=
round(
$row['avg_score']
);

}

?>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<style>

body{

background:url(
'../assets/images/admin-bg.png'
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


h1{

color:white!important;

font-weight:bold;

margin-bottom:25px;

}


.chart-box{

background:white;

padding:20px;

border-radius:20px;

}


.stats-card{

background:rgba(
255,
255,
255,
0.12
);

padding:25px;

border-radius:20px;

text-align:center;

margin-bottom:20px;

}


.stats-card h2{

color:white!important;

font-size:38px;

}


.stats-card p{

color:#cbd5e1!important;

font-size:17px;

margin-top:5px;

}

</style>



<div class="overlay"></div>



<div class="container">



<div class="box">



<h1>

📊 Reports & Analytics

</h1>



<a
href="dashboard.php"
class="btn btn-primary">

← Back

</a>



<a
href="../exports/excel_export.php"
class="btn btn-primary">

📥 Download Excel

</a>



<br><br>



<div class="row">



<div class="col-md-4">

<div class="stats-card">

<h2>

<?= array_sum($attempts) ?>

</h2>

<p>

Total Attempts

</p>

</div>

</div>



<div class="col-md-4">

<div class="stats-card">

<h2>

<?= count($labels) ?>

</h2>

<p>

Total Quizzes

</p>

</div>

</div>



<div class="col-md-4">

<div class="stats-card">

<h2>

<?= count($averages)>0 ? round(array_sum($averages)/count($averages)) : 0 ?>

%</h2>

<p>

Average Performance

</p>

</div>

</div>



</div>



<div class="chart-box">

<canvas id="reportChart"></canvas>

</div>



</div>



</div>



<script>

new Chart(

document.getElementById(
'reportChart'
),

{

type:'bar',

data:{

labels:

<?= json_encode($labels) ?>,

datasets:[

{

label:'Attempts',

data:

<?= json_encode($attempts) ?>,

backgroundColor:'#2563eb'

},

{

label:'Average Score',

data:

<?= json_encode($averages) ?>,

backgroundColor:'#60a5fa'

}

]

},

options:{

responsive:true,

plugins:{

legend:{

labels:{

color:'#0f172a'

}

}

},

scales:{

y:{

beginAtZero:true,

ticks:{

color:'#0f172a'

}

},

x:{

ticks:{

color:'#0f172a'

}

}

}

}

}

);

</script>



<?php include '../includes/footer.php'; ?>