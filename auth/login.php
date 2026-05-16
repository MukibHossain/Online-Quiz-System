<?php require '../config/database.php'; ?>


<?php

if(isset($_POST['login'])){


$email=
$conn->real_escape_string(
$_POST['email']
);


$password=
$_POST['password'];



$data=
$conn->query(

"SELECT * FROM users

WHERE email='$email'"

);



if(
$data->num_rows==0
){

echo
"<script>

alert('User not found');

</script>";

}
else{


$user=
$data->fetch_assoc();



if(

password_verify(

$password,

$user['password']

)

){


$_SESSION['user_id']=
$user['id'];


$_SESSION['role']=
$user['role'];



if(
$user['role']=='admin'
){

header(
"Location: ../admin/dashboard.php"
);

}
else{

header(
"Location: ../student/dashboard.php"
);

}

exit();

}
else{

echo
"<script>

alert('Wrong password');

</script>";

}

}

}

?>

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

rgba(15,23,42,.45),

rgba(37,99,235,.30),

rgba(147,51,234,.30)

);

}


.box{

position:relative;

z-index:5;

max-width:460px;

margin:auto;

margin-top:70px;

padding:40px;

background:rgba(255,255,255,.10);

backdrop-filter:blur(14px);

border-radius:25px;

color:white;

}

</style>

</head>


<body>

<div class="overlay"></div>

<div class="container">

<div class="box">


<a href="../index.php" class="btn btn-info">🏠 Home</a>

<a href="javascript:history.back()" class="btn btn-warning">← Back</a>


<br><br>


<h1 class="text-center">

🔐 Login

</h1>


<br>


<form method="POST">


<input name="email" class="form-control" placeholder="Email">

<br>


<input type="password" name="password" class="form-control" placeholder="Password">

<br>


<button name="login" class="btn btn-success w-100">

Login

</button>


</form>


</div>

</div>

</body>
</html>