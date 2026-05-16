<?php



require '../config/database.php';


$data=
$conn->query(

"SELECT * FROM quizzes

ORDER BY id DESC"

);

?>


<!DOCTYPE html>
<html>

<head>

<title>Available Quiz</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

📝 Available Quizzes

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



<div class="row">


<?php

while(
$quiz=
$data->fetch_assoc()
){

?>


<div class="col-md-4 mb-4">


<div class="card bg-secondary text-white p-3">


<h3>

<?= $quiz['title'] ?>

</h3>


<p>

Time:

<?= $quiz['time_limit'] ?>

minutes

</p>


<a
href="quiz_play.php?id=<?= $quiz['id'] ?>"
class="btn btn-success">

Start Quiz

</a>


</div>


</div>


<?php } ?>


</div>


</div>


</body>
</html>