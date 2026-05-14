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

box-shadow:0 0 30px black;

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


$q=
$conn->query(

"SELECT * FROM users

WHERE email='$email'

AND password='$password'"

);


$user=
$q->fetch_assoc();


if($user){

$_SESSION['user_id']=$user['id'];

$_SESSION['user_name']=$user['name'];

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

}

}

?>


<br>


<a href="../index.php">

🏠 Home

</a>


</div>


</body>
</html>