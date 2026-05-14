<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>


<body class="bg-dark text-white">


<div class="container mt-4">


<h1>

<i class="fa fa-user-shield"></i>

Admin Dashboard

</h1>


<a href="../auth/login.php"
class="btn btn-info mb-4">

← Back

</a>



<div class="row">


<div class="col-md-3">

<div class="card bg-primary text-white">

<div class="card-body">

<h4>Total Users</h4>

<h2>245</h2>

</div>

</div>

</div>



<div class="col-md-3">

<div class="card bg-success text-white">

<div class="card-body">

<h4>Quizzes</h4>

<h2>35</h2>

</div>

</div>

</div>



<div class="col-md-3">

<div class="card bg-warning text-dark">

<div class="card-body">

<h4>Attempts</h4>

<h2>1280</h2>

</div>

</div>

</div>



<div class="col-md-3">

<div class="card bg-danger text-white">

<div class="card-body">

<h4>Reports</h4>

<h2>Ready</h2>

</div>

</div>

</div>


</div>



<br><br>



<a href="quiz_management.php"
class="btn btn-success">

Quiz Management

</a>



<a href="user_management.php"
class="btn btn-warning">

User Management

</a>



<a href="reports.php"
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
'Jan',
'Feb',
'Mar',
'Apr'
],

datasets:[{

label:'Quiz Activity',

data:[
20,
45,
70,
90
]

}]

}

}

);

</script>



</body>
</html>