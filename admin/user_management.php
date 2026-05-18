<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>


<?php

if(isset($_GET['delete'])){

$id=$_GET['delete'];

$conn->query(

"DELETE FROM users
WHERE id='$id'"

);

header(
"Location:user_management.php"
);

exit();

}

?>


<div class="container mt-5">


<h1>

👥 User Management

</h1>



<a
href="dashboard.php"
class="btn btn-primary">

← Back

</a>



<br><br>



<input
id="search"
class="form-control"
placeholder="Search user...">


<br>



<div class="card p-4">


<table
class="table"
id="myTable">


<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Action</th>

</tr>



<?php

$users=
$conn->query(

"SELECT * FROM users
ORDER BY id"

);


while(
$user=
$users->fetch_assoc()
){

?>


<tr>

<td>

<?= $user['id'] ?>

</td>


<td>

<?= $user['name'] ?>

</td>


<td>

<?= $user['email'] ?>

</td>


<td>

<?= $user['role'] ?>

</td>


<td>

<a
href="?delete=<?= $user['id'] ?>"
class="btn btn-primary">

Delete

</a>

</td>


</tr>


<?php } ?>


</table>


</div>


</div>





<script>

document
.getElementById(
'search'
)

.addEventListener(
'keyup',

function(){

let value=
this.value
.toLowerCase();


let rows=
document
.querySelectorAll(
'#myTable tr'
);


rows.forEach(
(row,index)=>{

if(index==0)return;


row.style.display=

row.innerText
.toLowerCase()
.includes(value)

? ''

:'none';

});

});

</script>



<?php include '../includes/footer.php'; ?>