<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<style>
body {
    background: #0f172a;
    min-height: 100vh;
}
</style>

<div class="container mt-5 text-white">


<h1>

User Management

</h1>


<a href="dashboard.php"
class="btn btn-info">

Back

</a>


<br><br>


<input
id="search"
class="form-control"
placeholder="Search user...">


<br>


<table
class="table table-dark"
id="myTable">


<tr>

<th>Name</th>

<th>Email</th>

<th>Role</th>

</tr>


<tr>

<td>Admin</td>

<td>admin@gmail.com</td>

<td>Admin</td>

</tr>


<tr>

<td>Student</td>

<td>student@gmail.com</td>

<td>Student</td>

</tr>


</table>


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
row=>{

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
