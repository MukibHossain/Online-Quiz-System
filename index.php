<!DOCTYPE html>
<html>

<head>

<title>Online Quiz System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(
45deg,
#0f2027,
#203a43,
#2c5364
);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:Arial;

}


.box{

background:white;

padding:50px;

border-radius:20px;

text-align:center;

width:500px;

}


#loader{

display:none;

margin-top:20px;

font-weight:bold;

}

</style>

</head>


<body>


<div class="box">


<h1>

🎯 Online Quiz System

</h1>


<p>

Test Your Knowledge

</p>


<br>



<a
onclick="loading()"
href="auth/login.php"
class="btn btn-primary">

Login

</a>



<a
href="auth/register.php"
class="btn btn-success">

Register

</a>



<div id="loader">

Loading...

</div>


</div>




<script>

function loading(){

document
.getElementById(
'loader'
)

.style.display=
'block';

}

</script>



</body>
</html>