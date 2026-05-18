<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(
!isset($_SESSION['user_name'])
){

$_SESSION['user_name']="Student";

}

?>

<style>

body{

background:#111;

color:white;

text-align:center;

padding:80px;

}


.box{

border:4px solid gold;

padding:50px;

border-radius:20px;

max-width:1000px;

margin:auto;

box-shadow:0 0 30px gold;

}

</style>


<div class="box">


<h1>

🏆 Certificate

</h1>


<h2>

This certifies

</h2>


<h1>

<?= $_SESSION['user_name'] ?>

</h1>


<h3>

For Successful Participation

</h3>


<br>


<button
onclick="window.print()"
class="btn btn-primary">

Download

</button>


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


</div>

<?php include '../includes/footer.php'; ?>
