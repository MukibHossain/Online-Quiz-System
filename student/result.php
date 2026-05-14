<?php require '../config/database.php'; ?>
<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

📊 My Result

</h1>


<a href="dashboard.php"
class="btn btn-info">

← Back

</a>


<br><br>



<?php

$user_id=2;


$data=
$conn->query(

"SELECT * FROM results
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 1"

);


$result=
$data->fetch_assoc();


$score=
$result['score'] ?? 0;

$total=
$result['total'] ?? 1;


$percentage=
($score/$total)*100;

?>


<h2>

Score:

<?= $score ?>

/

<?= $total ?>

</h2>


<h2>

<?= round($percentage) ?>%

</h2>


<canvas id="chart"></canvas>


</div>



<script>

new Chart(

document.getElementById(
'chart'
),

{

type:'doughnut',

data:{

labels:[
'Correct',
'Wrong'
],

datasets:[{

data:[

<?= $score ?>,

<?= $total-$score ?>

]

}]

}

}

);

</script>



</body>
</html>