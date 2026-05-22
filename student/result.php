<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$data = $conn->query(
"SELECT results.*, quizzes.title AS quiz_title
FROM results
JOIN quizzes ON quizzes.id = results.quiz_id
WHERE results.user_id='$user_id'
ORDER BY results.id DESC
LIMIT 1"
);

$result = $data->fetch_assoc();

if(!$result){
?>
<div class="container mt-5">
    <div class="alert alert-warning text-center">
        No Quiz Attempt Yet
        <br><br>
        <a href="quiz_list.php" class="btn btn-primary">Start Quiz</a>
    </div>
</div>
<?php
include '../includes/footer.php';
exit();
}

$score      = (int)$result['score'];
$total      = (int)$result['total'];
$quiz_id    = (int)$result['quiz_id'];
$percentage = $total > 0 ? round(($score / $total) * 100) : 0;
$wrong      = $total - $score;

if($percentage >= 90){      $grade = "A+"; $status = "Outstanding"; }
elseif($percentage >= 80){  $grade = "A";  $status = "Excellent";   }
elseif($percentage >= 70){  $grade = "B";  $status = "Very Good";   }
elseif($percentage >= 60){  $grade = "C";  $status = "Good";        }
elseif($percentage >= 50){  $grade = "D";  $status = "Average";     }
else{                        $grade = "F";  $status = "Failed";      }

// Questions WITH user answers fetch
$questions = $conn->query(
"SELECT q.*, ua.selected_answer
FROM questions q
LEFT JOIN user_answers ua
    ON ua.question_id = q.id
    AND ua.user_id = '$user_id'
    AND ua.quiz_id = '$quiz_id'
WHERE q.quiz_id = '$quiz_id'"
);

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    min-height: 100vh;
}

.result-box{
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 0 25px rgba(0,0,0,.4);
}

.page-title{
    color: white !important;
    font-weight: bold;
}

.result-title{
    color: #60a5fa !important;
    font-weight: bold;
}

/* ---- SCORE CARD ---- */
.score-card{
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    border-radius: 25px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 0 20px rgba(37,99,235,.4);
}

.score-card h1{
    font-size: 60px;
    font-weight: bold;
    color: white;
}

.score-card h3{
    color: #bfdbfe;
}

.score-card p{
    color: #dbeafe;
    font-size: 18px;
}

/* ---- STAT CARDS ---- */
.stat-card{
    background: linear-gradient(135deg, #1d4ed8, #3b82f6);
    border-radius: 25px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 0 20px rgba(37,99,235,.3);
}

.stat-card h3{
    color: #bfdbfe;
    font-size: 18px;
}

.stat-card h1{
    font-size: 55px;
    font-weight: bold;
    color: white;
}

/* ---- CHART BOX ---- */
.chart-box{
    background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
    border-radius: 25px;
    padding: 25px;
    box-shadow: 0 0 20px rgba(0,0,0,.3);
}

/* ---- REVIEW ---- */
.review-box{
    background: white;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 0 15px rgba(0,0,0,.15);
}

.review-question{
    color: #0f172a;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 12px;
}

.option{
    padding: 12px;
    border-radius: 12px;
    margin-top: 10px;
    font-size: 17px;
}

.correct{
    background: #dcfce7;
    color: #166534;
    border: 2px solid #22c55e;
}

.wrong{
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #ef4444;
}

.normal{
    background: #f1f5f9;
    color: #0f172a;
}

</style>

<div class="container mt-5 mb-5">

    <div class="result-box">

        <h1 class="page-title">📊 Quiz Result</h1>

        <br>

        <div class="d-flex gap-2 flex-wrap">
            <a href="dashboard.php"   class="btn btn-primary">🏠 Dashboard</a>
            <a href="quiz_list.php"   class="btn btn-primary">📝 Quiz List</a>
            <a href="certificate.php" class="btn btn-primary">🏆 Certificate</a>
        </div>

        <br><br>

        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="score-card">
                    <h3><?= htmlspecialchars($result['quiz_title']) ?></h3>
                    <br>
                    <h1><?= $percentage ?>%</h1>
                    <h3><?= $score ?> / <?= $total ?></h3>
                    <p>Grade: <b><?= $grade ?></b></p>
                    <p><?= $status ?></p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="chart-box">
                    <canvas id="chart"></canvas>
                </div>
            </div>

        </div>

        <div class="row text-center mb-5">

            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <h3>Total Questions</h3>
                    <h1><?= $total ?></h1>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <h3>Correct Answers</h3>
                    <h1><?= $score ?></h1>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <h3>Wrong Answers</h3>
                    <h1><?= $wrong ?></h1>
                </div>
            </div>

        </div>

        <h2 class="result-title mb-4">📝 Answer Review</h2>

        <?php
        $i = 1;
        while($q = $questions->fetch_assoc()){

            $selected = trim($q['selected_answer'] ?? '');
            $correct  = trim($q['correct_answer']);
            $is_right = strtolower($selected) == strtolower($correct);

        ?>

        <div class="review-box">

            <div class="review-question">
                <?= $i ?>. <?= htmlspecialchars($q['question']) ?>
            </div>

            <?php if($is_right){ ?>

                <div class="option correct">
                    ✅ Your Answer: <?= htmlspecialchars($selected) ?>
                </div>

            <?php } else { ?>

                <div class="option wrong">
                    ❌ Your Answer: <?= $selected ? htmlspecialchars($selected) : 'No Answer' ?>
                </div>

                <div class="option correct">
                    ✅ Correct Answer: <?= htmlspecialchars($correct) ?>
                </div>

            <?php } ?>

        </div>

        <?php $i++; } ?>

    </div>

</div>

<script>

new Chart(document.getElementById('chart'), {
    type: 'doughnut',
    data: {
        labels: ['Correct', 'Wrong'],
        datasets:[{
            data: [<?= $score ?>, <?= $wrong ?>],
            backgroundColor: ['#22c55e', '#ef4444'],
            borderWidth: 0
        }]
    },
    options: {
        plugins: {
            legend: {
                labels: {
                    color: 'white',
                    font: { size: 16 }
                }
            }
        }
    }
});

</script>

<?php include '../includes/footer.php'; ?>