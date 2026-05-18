<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>


<?php

$total_users=
$conn->query(
"SELECT COUNT(*) total
FROM users
WHERE role='student'"
)->fetch_assoc()['total'];


$total_quizzes=
$conn->query(
"SELECT COUNT(*) total
FROM quizzes"
)->fetch_assoc()['total'];


$total_attempts=
$conn->query(
"SELECT COUNT(*) total
FROM results"
)->fetch_assoc()['total'];


$report_status=
$total_attempts > 0
?
"Ready"
:
"Empty";

?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container mt-4">


<h1 class="mb-4">

<i class="fa fa-user-shield"></i>

Admin Dashboard

</h1>



<a
href="../index.php"
class="btn btn-primary mb-4">

🏠 Home

</a>





<div class="row">




<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h4>

Total Users

</h4>

<h2>

<?= $total_users ?>

</h2>

</div>

</div>

</div>





<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h4>

Quizzes

</h4>

<h2>

<?= $total_quizzes ?>

</h2>

</div>

</div>

</div>





<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h4>

Attempts

</h4>

<h2>

<?= $total_attempts ?>

</h2>

</div>

</div>

</div>





<div class="col-md-3 mb-4">

<div class="card">

<div class="card-body text-center">

<h4>

Reports

</h4>

<h2>

<?= $report_status ?>

</h2>

</div>

</div>

</div>



</div>





<div class="mb-4">


<a
href="quiz_management.php"
class="btn btn-primary">

Quiz Management

</a>



<a
href="question_management.php"
class="btn btn-primary">

Question Management

</a>



<a
href="user_management.php"
class="btn btn-primary">

User Management

</a>



<a
href="reports.php"
class="btn btn-primary">

Reports

</a>


</div>





<div class="card p-4">

<canvas id="myChart"></canvas>

</div>



</div>





<script>

new Chart(

document.getElementById(
'myChart'
),

{

type:'bar',

data:{

labels:[

'Users',
'Quizzes',
'Attempts'

],

datasets:[{

label:'System Analytics',

data:[

<?= $total_users ?>,

<?= $total_quizzes ?>,

<?= $total_attempts ?>

]

}]

}

}

);

</script>



<?php include '../includes/footer.php'; ?>