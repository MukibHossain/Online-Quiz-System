<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

// Total attempts
$total_attempts =
$conn->query(
"SELECT COUNT(*) total FROM results"
)->fetch_assoc()['total'];


// Average score
$average_score =
$conn->query(
"SELECT AVG(score) avg_score FROM results"
)->fetch_assoc()['avg_score'];

$average_score = round($average_score ?? 0);


// Highest scorer
$topper =
$conn->query(

"SELECT users.name, MAX(results.score) highest
FROM results
JOIN users
ON users.id = results.user_id"

)->fetch_assoc();


// Quiz wise performance
$quiz_data =
$conn->query(

"SELECT quizzes.title,
AVG(results.score) avg_score

FROM results

JOIN quizzes
ON quizzes.id = results.quiz_id

GROUP BY results.quiz_id"

);


$labels = [];
$scores = [];

while($row = $quiz_data->fetch_assoc()){

    $labels[] = $row['title'];
    $scores[] = round($row['avg_score']);

}

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{

background:#0f172a;

min-height:100vh;

}

.report-title{

color:white!important;

font-weight:bold;

}

.report-card{

background:white;

border-radius:20px;

padding:25px;

text-align:center;

box-shadow:0 0 20px rgba(0,0,0,.2);

height:100%;

}

.report-card h3{

color:#2563eb!important;

font-weight:bold;

}

.report-card h2{

font-weight:bold;

color:#2563eb!important;

}

.chart-box{

background:white;

padding:30px;

border-radius:20px;

box-shadow:0 0 20px rgba(0,0,0,.2);

}

</style>

<div class="container mt-5">

<h1 class="report-title">

📊 Reports & Analytics

</h1>

<br>

<a href="dashboard.php"
class="btn btn-primary">

← Back

</a>

<a href="../exports/excel_export.php"
class="btn btn-success ms-2">

📥 Download Excel

</a>

<br><br>

<div class="row">

<div class="col-md-4 mb-4">

<div class="report-card">

<h3>Total Attempts</h3>

<h2>

<?= $total_attempts ?>

</h2>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="report-card">

<h3>Average Performance</h3>

<h2>

<?= $average_score ?>

%

</h2>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="report-card">

<h3>Top Scorer</h3>

<h2>

<?= $topper['name'] ?? 'N/A' ?>

</h2>

</div>

</div>

</div>


<div class="chart-box">

<canvas id="reportChart"></canvas>

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

datasets:[{

label:'Average Quiz Score',

data:

<?= json_encode($scores) ?>,

backgroundColor:'#2563eb',

borderWidth:2

}]

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

x:{

ticks:{
color:'#0f172a'
}

},

y:{

beginAtZero:true,

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