<!DOCTYPE html>
<html>

<head>

<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

body{

margin:0;

font-family:Arial;

background:#111;

color:white;

transition:.5s;

}


.light{

background:white;

color:black;

}


.sidebar{

width:250px;

height:100vh;

background:#222;

position:fixed;

left:0;

top:0;

padding:20px;

overflow:auto;

}


.sidebar a{

display:block;

color:white;

text-decoration:none;

padding:15px;

margin:10px 0;

border-radius:10px;

}


.sidebar a:hover{

background:#0d6efd;

}


.content{

margin-left:270px;

padding:30px;

}

</style>

</head>


<body id="body">


<div class="sidebar">


<h3>

🎯 Quiz System

</h3>


<a href="dashboard.php">

Dashboard

</a>


<a href="quiz_list.php">

Quiz

</a>


<a href="leaderboard.php">

Leaderboard

</a>


<a href="result.php">

Result

</a>


<a href="certificate.php">

Certificate

</a>


<a href="profile.php">

Profile

</a>


<br>


<button
onclick="changeMode()"
class="btn btn-warning w-100">

🌙 Dark / Light

</button>


</div>




<div class="content">


<h1>

Welcome Student

</h1>

<h3 id="clock"></h3>

<div class="alert alert-success">

System Running Perfectly 🎉

</div>


</div>




<script>

function changeMode(){

document
.getElementById(
'body'
)

.classList
.toggle(
'light'
);

}



setTimeout(

function(){

alert(
"Session Expired"
);

window.location=
'../auth/login.php';

},

300000

);


setInterval(

function(){

document
.getElementById(
'clock'
)

.innerHTML=

new Date()
.toLocaleTimeString();

},

1000

);

</script>



</body>
</html>