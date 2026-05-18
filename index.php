<!DOCTYPE html>
<html>

<head>

<title>Online Quiz System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">


<style>

body{

margin:0;

background:url(
'assets/images/hero-bg.png'
);

background-size:cover;

background-position:center;

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:Arial;

}


.overlay{

background:rgba(
0,
0,
0,
0.6
);

position:absolute;

width:100%;

height:100%;

}


.box{

position:relative;

z-index:5;

background:rgba(
255,
255,
255,
0.08
);

backdrop-filter:blur(15px);

padding:60px;

border-radius:30px;

text-align:center;

color:white;

box-shadow:0 0 50px black;

animation:up 1.2s;

}


@keyframes up{

from{

opacity:0;

transform:translateY(50px);

}

to{

opacity:1;

transform:translateY(0);

}

}


.btn{

margin:8px;

padding:14px 35px;

font-size:18px;

}

</style>

</head>


<body>


<div class="overlay"></div>


<div class="box">


<h1>

<i class="fa fa-graduation-cap"></i>

Online Quiz System

</h1>


<br>


<h4>

Smart Learning Platform

</h4>


<br><br>


<a
href="auth/login.php"
class="btn btn-primary">

Login

</a>


<a
href="auth/register.php"
class="btn btn-primary">

Register

</a>


</div>


</body>
</html>