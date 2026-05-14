<!DOCTYPE html>
<html>

<head>

<title>Quiz Exam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#111;
color:white;
font-family:Arial;
padding:20px;
}

button{
padding:10px;
margin:5px;
}

</style>

</head>


<body>


<h1>

Quiz Exam

</h1>


<a href="quiz_list.php">

← Back

</a>


<br><br>


<h3 id="timer">

10:00

</h3>



<hr>



<p>

1. Python কে develop করেছে?

</p>


<input type="radio"> Guido<br>

<input type="radio"> Elon<br>

<input type="radio"> Bill<br><br>



<button>

Previous

</button>



<button>

Next

</button>



<button
onclick="submitQuiz()">

Submit

</button>



<audio id="sound">

<source
src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg">

</audio>




<script>

let time = 600;


let countdown = setInterval(
function(){

let min =
Math.floor(time/60);

let sec =
time%60;


if(sec<10){

sec="0"+sec;

}


document
.getElementById(
'timer'
)

.innerHTML=

"Time Left: "
+min+":"+sec;


if(time<=0){

clearInterval(
countdown
);

submitQuiz();

}


time--;

},1000);




function submitQuiz(){

document
.getElementById(
'sound'
)
.play();


alert(
"Quiz Submitted 🎉"
);

window.location=
'result.php';

}

</script>



</body>
</html>