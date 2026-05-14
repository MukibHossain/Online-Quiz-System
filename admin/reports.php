<!DOCTYPE html>
<html>

<head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

Reports

</h1>


<a href="dashboard.php"
class="btn btn-info">

Back

</a>

<a href="../exports/excel_export.php"
class="btn btn-success">

Download Excel

</a>
<br><br>


<canvas id="reportChart">

</canvas>


</div>


<script>

new Chart(

document.getElementById(
'reportChart'
),

{

type:'line',

data:{

labels:[
'Quiz1',
'Quiz2',
'Quiz3'
],

datasets:[{

label:'Performance',

data:[
70,
90,
85
]

}]

}

}

);

</script>


</body>
</html>