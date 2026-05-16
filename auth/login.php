<?php require '../config/database.php'; ?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:url('../assets/images/auth-bg.png');

background-size:cover;
background-position:center;
min-height:100vh;

}


.overlay{

position:fixed;

width:100%;
height:100%;

background:

linear-gradient(

45deg,

rgba(15,23,42,0.45),

rgba(37,99,235,0.30),

rgba(147,51,234,0.30)

);

}


.box{

position:relative;

z-index:5;

max-width:460px;

margin:auto;

margin-top:70px;

padding:40px;

background:rgba(
255,
255,
255,
0.10
);

backdrop-filter:blur(14px);

border-radius:25px;

color:white;

box-shadow:0 0 30px rgba(0,0,0,.5);

}

a{

text-decoration:none;

color:white;

}

</style>

</head>


<body>


<div class="overlay"></div>


<div class="container">


<div class="box">


<div class="mb-3">


<a
href="../index.php"
class="btn btn-info">

🏠 Home

</a>


<a
href="javascript:history.back()"
class="btn btn-warning">

← Back

</a>


</div>


<h1 class="text-center">

🔐 Login

</h1>


<br>


<form method="POST">


<input
name="email"
class="form-control"
placeholder="Email">


<br>


<input
type="password"
name="password"
class="form-control"
placeholder="Password">


<br>


<button
name="login"
class="btn btn-success w-100">

Login

</button>


<br><br>


<div class="text-center">


<a href="register.php">

Create Account

</a>


<br>


<a href="forgot_password.php">

Forgot Password?

</a>


</div>


</form>


</div>


</div>


</body>
</html>