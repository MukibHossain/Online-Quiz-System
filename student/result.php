<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>


<body class="bg-dark text-white">


<div class="alert alert-success text-center">

Quiz Submitted Successfully 🎉

</div>



<div class="container mt-5">


<h1>

Quiz Result

</h1>


<a href="dashboard.php"
class="btn btn-info">

Back

</a>


<br><br>


<h2>

Score: 85%

</h2>


<canvas id="resultChart">

</canvas>


</div>



<script>

new Chart(

document.getElementById(
'resultChart'
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
85,
15
]

}]

}

}

);

</script>



</body>
</html>