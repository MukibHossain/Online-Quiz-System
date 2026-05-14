<?php require '../config/database.php'; ?>

<!DOCTYPE html>
<html>

<head>

<title>Register</title>

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

Register

</h2>


<form method="POST">


<input
name="name"
class="form-control"
placeholder="Full Name">

<br>


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
name="register"
class="btn btn-success w-100">

Register

</button>


</form>



<?php

if(isset($_POST['register'])){

$name=$_POST['name'];

$email=$_POST['email'];

$password=$_POST['password'];


$conn->query(

"INSERT INTO users(
name,
email,
password,
role
)

VALUES(

'$name',
'$email',
'$password',
'student'

)"

);


echo
"<div class='alert alert-success mt-3'>
Registration Success 🎉
</div>";

}

?>


<br>


<a href="login.php">

← Back

</a>


</div>


</body>
</html>