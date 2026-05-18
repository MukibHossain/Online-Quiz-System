<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>


<?php


$total_users=

$conn
->query(

"SELECT COUNT(*) total

FROM users

WHERE role='student'"

)

->fetch_assoc()['total'];




$total_quizzes=

$conn
->query(

"SELECT COUNT(*) total

FROM quizzes"

)

->fetch_assoc()['total'];




$total_attempts=

$conn
->query(

"SELECT COUNT(*) total

FROM results"

)

->fetch_assoc()['total'];




$report_status=

$total_attempts > 0

?

"Ready"

:

"Empty";

?>


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
0.65
);

}


.box{

position:relative;

z-index:5;

color:white;

}


.card{

border:none;

border-radius:20px;

box-shadow:0 0 20px black;

}

</style>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div class="overlay"></div>



<div class="container mt-4 box">


<h1>

<i class="fa fa-user-shield"></i>

Admin Dashboard

</h1>



<a
href="../index.php"
class="btn btn-info mb-4">

🏠 Home

</a>





<div class="row">




<div class="col-md-3 mb-3">


<div class="card">


<div class="card-body">


<h4>

Total Users

</h4>


<h2>

<?= $total_users ?>

</h2>


</div>


</div>


</div>





<div class="col-md-3 mb-3">


<div class="card">


<div class="card-body">


<h4>

Quizzes

</h4>


<h2>

<?= $total_quizzes ?>

</h2>


</div>


</div>


</div>





<div class="col-md-3 mb-3">


<div class="card">


<div class="card-body">


<h4>

Attempts

</h4>


<h2>

<?= $total_attempts ?>

</h2>


</div>


</div>


</div>





<div class="col-md-3 mb-3">


<div class="card">


<div class="card-body">


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
class="btn btn-warning">

User Management

</a>



<a
href="reports.php"
class="btn btn-danger">

Reports

</a>





<br><br><br>




<canvas id="myChart"></canvas>



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