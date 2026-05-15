<?php require '../config/database.php'; ?>

<!DOCTYPE html>
<html>

<head>

<title>Question Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-dark text-white">


<div class="container mt-5">


<h1>

📝 Add Question

</h1>


<a
href="dashboard.php"
class="btn btn-info">

🏠 Home

</a>


<br><br>


<form method="POST">


<input
name="quiz_id"
class="form-control"
placeholder="Quiz ID">


<br>


<textarea
name="question"
class="form-control"
placeholder="Question"></textarea>


<br>


<input
name="o1"
class="form-control"
placeholder="Option 1">


<br>


<input
name="o2"
class="form-control"
placeholder="Option 2">


<br>


<input
name="o3"
class="form-control"
placeholder="Option 3">


<br>


<input
name="o4"
class="form-control"
placeholder="Option 4">


<br>


<input
name="correct"
class="form-control"
placeholder="Correct Answer">


<br>


<button
name="save"
class="btn btn-success">

Save Question

</button>


</form>



<?php

if(isset($_POST['save'])){


$conn->query(

"INSERT INTO questions(

quiz_id,
question,
option1,
option2,
option3,
option4,
correct_answer

)

VALUES(

'".$_POST['quiz_id']."',

'".$_POST['question']."',

'".$_POST['o1']."',

'".$_POST['o2']."',

'".$_POST['o3']."',

'".$_POST['o4']."',

'".$_POST['correct']."'

)"

);


echo
"<div class='alert alert-success mt-3'>
Question Saved
</div>";

}

?>


</div>


</body>
</html>