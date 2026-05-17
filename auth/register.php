<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(isset($_POST['register'])){


$name=
$conn->real_escape_string(
$_POST['name']
);


$email=
$conn->real_escape_string(
$_POST['email']
);


$password=
password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);


$role=
$_POST['role'];



$check=
$conn->query(

"SELECT id FROM users

WHERE email='$email'"

);



if(
$check->num_rows>0
){

echo
"<script>

alert('Email already exists');

</script>";

}
else{


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
'$role'

)"

);


echo
"<script>

alert('Registration Success');

location='login.php';

</script>";

}

}

?>

<style>

body{

background:url('../assets/images/register-bg.png');

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

rgba(30,41,59,.45),

rgba(99,102,241,.30),

rgba(168,85,247,.30)

);

}


.box{

position:relative;

z-index:5;

max-width:520px;

margin:auto;

margin-top:40px;

padding:40px;

background:rgba(255,255,255,.10);

backdrop-filter:blur(14px);

border-radius:25px;

color:white;

}

</style>

<div class="overlay"></div>

<div class="container">

<div class="box">


<a href="../index.php" class="btn btn-info">🏠 Home</a>

<a href="javascript:history.back()" class="btn btn-warning">← Back</a>


<br><br>


<h1 class="text-center">

📝 Register

</h1>


<br>


<form method="POST">


<input name="name" class="form-control" placeholder="Full Name">

<br>


<input name="email" class="form-control" placeholder="Email">

<br>


<input type="password" name="password" class="form-control" placeholder="Password">

<br>


<select name="role" class="form-control">

<option value="student">Student</option>

<option value="admin">Admin</option>

</select>


<br>


<button name="register" class="btn btn-success w-100">

Create Account

</button>


</form>


</div>

</div>

<?php include '../includes/footer.php'; ?>
