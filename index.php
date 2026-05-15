<!DOCTYPE html>
<html>

<head>

<title>Online Quiz System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(
135deg,
#0f2027,
#203a43,
#2c5364
);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:Arial;

overflow:hidden;

}


.box{

background:rgba(
255,
255,
255,
0.1
);

backdrop-filter:blur(15px);

padding:60px;

border-radius:30px;

text-align:center;

color:white;

box-shadow:0 0 40px black;

width:700px;

animation:fade 1.5s;

}


@keyframes fade{

from{

transform:translateY(50px);

opacity:0;

}

to{

transform:translateY(0);

opacity:1;

}

}

</style>

</head>


<body>


<div class="box">


<h1>

🎯 Online Quiz System

</h1>


<h4>

Smart Learning Platform

</h4>


<br>


<a
href="auth/login.php"
class="btn btn-primary btn-lg">

Login

</a>


<a
href="auth/register.php"
class="btn btn-success btn-lg">

Register

</a>


</div>


</body>
</html>