<?php require '../config/database.php'; ?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#111;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}


.box{

background:white;

padding:40px;

border-radius:20px;

width:400px;

}

</style>

</head>


<body>


<div class="box">


<h2 class="text-center">

Login

</h2>


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
class="btn btn-primary w-100">

Login

</button>


<br><br>


<a href="forgot_password.php">

Forgot Password?

</a>


</form>



<?php

if(isset($_POST['login'])){

$email=$_POST['email'];

$password=$_POST['password'];


$sql=
"SELECT * FROM users
WHERE email='$email'
AND password='$password'";


$q=
$conn->query($sql);


$user=
$q->fetch_assoc();


if($user){

$_SESSION['role']=$user['role'];


if(
$user['role']=='admin'
){

header(
"Location: ../admin/dashboard.php"
);

}else{

header(
"Location: ../student/dashboard.php"
);

}

exit();

}else{

echo
"<p class='text-danger mt-3'>
Wrong Login
</p>";

}

}

?>


<br>


<a href="../index.php">

← Back

</a>


</div>


</body>
</html>