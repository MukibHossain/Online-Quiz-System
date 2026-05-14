<!DOCTYPE html>
<html>

<head>

<title>Quiz List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

Available Quizzes

</h1>


<a href="dashboard.php"
class="btn btn-info">

← Back

</a>


<br><br>


<input
id="search"
class="form-control"
placeholder="Search quiz...">


<br>


<div
class="card bg-secondary p-3 mb-3"
id="quiz1">

<h3>

Python Quiz

</h3>


<div class="progress">

<div
class="progress-bar"
style="width:70%">

70%

</div>

</div>


</div>



<div
class="card bg-secondary p-3"
id="quiz2">

<h3>

Automata Quiz

</h3>


<div class="progress">

<div
class="progress-bar"
style="width:50%">

50%

</div>

</div>


</div>


</div>



<script>

document
.getElementById(
'search'
)

.addEventListener(
'keyup',

function(){

let value=
this.value
.toLowerCase();


document
.querySelectorAll(
'.card'
)

.forEach(
card=>{

card.style.display=

card.innerText
.toLowerCase()
.includes(value)

? ''

:'none';

});

});

</script>



</body>
</html>