<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php


$user_id=
$_SESSION['user_id'];



$user=
$conn->query(

"SELECT * FROM users

WHERE id='$user_id'"

)

->fetch_assoc();



$user['phone']=
$user['phone']
?? '';



$user['university']=
$user['university']
?? '';



$user['photo']=
$user['photo']
?? '';



if(isset($_POST['save'])){


$phone=
$_POST['phone'];


$university=
$_POST['university'];


$photo=
$user['photo'];



if(

isset($_FILES['photo'])

&&

$_FILES['photo']['error']==0

){


$uploadDir=

dirname(__DIR__)

."/uploads/";



$fileName=

time()

."_"

.basename(

$_FILES['photo']['name']

);



$targetFile=

$uploadDir

.$fileName;



if(

move_uploaded_file(

$_FILES['photo']['tmp_name'],

$targetFile

)

){

$photo=
$fileName;

}

}



$conn->query(

"UPDATE users

SET

phone='$phone',

university='$university',

photo='$photo'

WHERE id='$user_id'"

);



header(
"Location: profile.php"
);

exit();

}



$image=


!empty(
$user['photo']
)

?

"../uploads/"

.$user['photo']

:

"../assets/images/avatar.png";

?>

<style>
body {
    background: #0f172a;
    min-height: 100vh;
}
</style>

<div class="container mt-5 text-white">


<h1>

👤 My Profile

</h1>


<a
href="dashboard.php"
class="btn btn-warning btn-lg me-2">

← Back

</a>


<a
href="../index.php"
class="btn btn-info btn-lg">

🏠 Home

</a>


<br><br>



<img
src="<?= $image ?>"
width="160"
height="160"

style="

border-radius:50%;

object-fit:cover;

border:4px solid white;

">


<br><br>



<form
method="POST"
enctype="multipart/form-data">


<input
type="file"
name="photo"
class="form-control">


<br>


<input
name="phone"
value="<?= htmlspecialchars($user['phone']) ?>"
class="form-control"
placeholder="Phone">


<br>


<input
name="university"
value="<?= htmlspecialchars($user['university']) ?>"
class="form-control"
placeholder="University">


<br>


<button
name="save"
class="btn btn-success">

Save Profile

</button>


</form>


<hr>


<h4>

Name:

<?= htmlspecialchars($user['name']) ?>

</h4>


<h4>

Email:

<?= htmlspecialchars($user['email']) ?>

</h4>


<h4>

Phone:

<?= htmlspecialchars($user['phone']) ?>

</h4>


<h4>

University:

<?= htmlspecialchars($user['university']) ?>

</h4>


</div>

<?php include '../includes/footer.php'; ?>
