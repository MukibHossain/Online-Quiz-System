<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: #0f172a;
    min-height: 100vh;
}
</style>

<div class="container mt-5 text-white">


<h1>

Reports

</h1>


<a href="dashboard.php"
class="btn btn-info">

Back

</a>

<a href="../exports/excel_export.php"
class="btn btn-primary">

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

<?php include '../includes/footer.php'; ?>
