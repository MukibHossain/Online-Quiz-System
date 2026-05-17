<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

.navbar{

backdrop-filter:blur(15px);

box-shadow:0 5px 20px rgba(0,0,0,.4);

}


.brand{

font-size:28px;

font-weight:bold;

font-weight:bold;

color:#00e5ff !important;

}

</style>

</head>


<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">


<div class="container-fluid">


<a
class="navbar-brand brand"
href="../index.php">

🎯 Quiz System

</a>



<div>


<?php if(isset($_SESSION['user_id'])){ ?>


    <?php if($_SESSION['role']=="admin"){ ?>


        <a
        href="../admin/dashboard.php"
        class="btn btn-primary me-2">

        <i class="fa fa-chart-line"></i>

        Dashboard

        </a>


    <?php } else { ?>


        <a
        href="../student/dashboard.php"
        class="btn btn-primary me-2">

        <i class="fa fa-chart-line"></i>

        Dashboard

        </a>


        <a
        href="../student/profile.php"
        class="btn btn-warning me-2">

        <i class="fa fa-user"></i>

        Profile

        </a>


    <?php } ?>


    <a
    href="../auth/logout.php"
    class="btn btn-danger">

    <i class="fa fa-right-from-bracket"></i>

    Logout

    </a>


<?php } else { ?>


    <a
    href="../auth/login.php"
    class="btn btn-success me-2">

    <i class="fa fa-lock"></i>

    Login

    </a>


    <a
    href="../auth/register.php"
    class="btn btn-info">

    <i class="fa fa-user-plus"></i>

    Register

    </a>


<?php } ?>


</div>


</div>


</nav>