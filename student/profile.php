<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

My Profile

</h1>


<img
id="preview"
width="150">


<br><br>


<input
type="file"
class="form-control"
onchange="showImage(event)">


<br>


<input
value="Student"
class="form-control">


<br>


<button
class="btn btn-success">

Update

</button>


</div>



<script>

function showImage(event){

document
.getElementById(
'preview'
)

.src=

URL.createObjectURL(
event.target.files[0]
);

}

</script>



</body>
</html>