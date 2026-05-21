<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(isset($_GET['delete'])){

$id = $_GET['delete'];

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

<style>

h1{
color:#2563eb!important;
font-weight:bold;
}

.table th{
color:white!important;
}

.table td{
color:#0f172a!important;
font-weight:600;
}

</style>

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

<table class="table">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Action</th>

</tr>

<tbody id="result"></tbody>

</table>

</div>

</div>

<script>

function loadUsers(value=''){

fetch(
'../ajax/search_user.php?search='+value
)

.then(res=>res.text())

.then(data=>{

document
.getElementById('result')
.innerHTML = data;

});

}

document
.getElementById('search')

.addEventListener(
'keyup',

function(){

loadUsers(this.value);

});

loadUsers();

</script>

<?php include '../includes/footer.php'; ?>