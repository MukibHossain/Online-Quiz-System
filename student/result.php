<?php



require '../config/database.php';


if(!isset($_SESSION['user_id'])){

header("Location: ../auth/login.php");

exit();

}


$user_id=
$_SESSION['user_id'];


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
(int)(
$result['score']
?? 0
);


$total=
(int)(
$result['total']
?? 0
);



$percentage=

$total>0

?

($score/$total)*100

:

0;

?>


<!DOCTYPE html>
<html>

<head>

<title>Result</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

📊 My Result

</h1>


<a
href="dashboard.php"
class="btn btn-warning">

← Back

</a>


<a
href="../index.php"
class="btn btn-info">

🏠 Home

</a>


<br><br>



<?php if($total==0){ ?>


<div class="alert alert-warning">

No Quiz Attempt Yet

</div>


<?php } ?>


<h2>

Score:

<?= $score ?>

/

<?= $total ?>

</h2>


<h2>

<?= round($percentage) ?>%

</h2>


<br>


<a
href="certificate.php"
class="btn btn-success">

Certificate

</a>


<br><br>


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

<?= max(0,$total-$score) ?>

]

}]

}

}

);

</script>


</body>
</html>