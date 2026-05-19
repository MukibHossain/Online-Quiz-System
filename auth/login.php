<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>


<?php

if(isset($_POST['login'])){


$email=
trim(
$conn->real_escape_string(
$_POST['email']
));

$password=
trim($_POST['password']);



$data=
$conn->query(

"SELECT * FROM users
WHERE email='$email'"

);



if($data->num_rows>0){


$user=
$data->fetch_assoc();

$db_password=
$user['password'];



/* HASHED PASSWORD CHECK */
$valid=
password_verify(
$password,
$db_password
);



/* PLAIN TEXT CHECK */
if(!$valid){

$valid=
(
$password==
$db_password
);

}



/* LOGIN SUCCESS */
if($valid){


/* AUTO HASH OLD PASSWORD */
if(
$password==
$db_password
){

$new_hash=
password_hash(
$password,
PASSWORD_DEFAULT
);


$conn->query(

"UPDATE users

SET password='$new_hash'

WHERE id='".$user['id']."'"

);

}



$_SESSION['user_id']=
$user['id'];

$_SESSION['role']=
$user['role'];

$_SESSION['name']=
$user['name'];



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

alert('Wrong Password');

</script>";

}

}
else{

echo
"<script>

alert('User Not Found');

</script>";

}

}

?>


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

background:rgba(
255,
255,
255,
.10
);

backdrop-filter:blur(14px);

border-radius:25px;

color:white;

box-shadow:0 0 30px black;

}

</style>


<div class="overlay"></div>


<div class="container">


<div class="box">


<a
href="../index.php"
class="btn btn-primary">

🏠 Home

</a>


<a
href="javascript:history.back()"
class="btn btn-primary">

← Back

</a>


<br><br>


<h1 class="text-center">

🔐 Login

</h1>


<br>


<form method="POST">


<input
type="email"
name="email"
class="form-control"
placeholder="Email"
required>


<br>


<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>


<br>


<button
name="login"
class="btn btn-primary w-100">

Login

</button>


</form>


</div>


</div>

<?php include '../includes/footer.php'; ?>