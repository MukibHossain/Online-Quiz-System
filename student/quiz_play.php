<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$quiz_id = (int)($_GET['id'] ?? 0);

if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    // Purer data delete
    $conn->query("DELETE FROM results WHERE user_id='$user_id' AND quiz_id='$quiz_id'");
    $conn->query("DELETE FROM user_answers WHERE user_id='$user_id' AND quiz_id='$quiz_id'");

    // FIXED: prepared statement
    $stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id=?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $questions = $stmt->get_result();

    $total = 0;
    $score = 0;

    // FIXED: answer + score calculation alag loop e
    $rows = [];
    while($q = $questions->fetch_assoc()){
        $rows[] = $q;
    }

    foreach($rows as $q){

        $total++;

        $answer  = trim($_POST['q'.$q['id']] ?? '');
        $correct = trim($q['correct_answer']);

        // User answer save
        $ins = $conn->prepare(
            "INSERT INTO user_answers(user_id, quiz_id, question_id, selected_answer)
             VALUES(?,?,?,?)"
        );
        $ins->bind_param("iiis", $user_id, $quiz_id, $q['id'], $answer);
        $ins->execute();

        // Score check
        if(strtolower($answer) == strtolower($correct)){
            $score++;
        }

    }

    // FIXED: ekbar e insert, prepared statement
    $res = $conn->prepare(
        "INSERT INTO results(user_id, quiz_id, score, total)
         VALUES(?,?,?,?)"
    );
    $res->bind_param("iiii", $user_id, $quiz_id, $score, $total);
    $res->execute();

    header("Location: result.php");
    exit();

}

$quiz = $conn->query(
    "SELECT * FROM quizzes WHERE id='$quiz_id'"
)->fetch_assoc();

$minutes = (int)($quiz['time_limit'] ?? 10);

$data = $conn->query(
    "SELECT * FROM questions WHERE quiz_id='$quiz_id'"
);

?>

<style>

body{
    background: url('../assets/images/quiz-bg.png');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    font-family: Arial;
}

.overlay{
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
}

.box{
    position: relative;
    z-index: 5;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    padding: 40px;
    border-radius: 25px;
    margin-top: 40px;
    color: white;
    box-shadow: 0 0 30px black;
}

.timer{
    font-size: 30px;
    font-weight: bold;
    color: yellow;
}

</style>

<div class="overlay"></div>

<div class="container">

    <div class="box">

        <h1>
            📝 <?= htmlspecialchars($quiz['title'] ?? 'Quiz Exam') ?>
        </h1>

        <div class="mb-4">
            <a href="quiz_list.php" class="btn btn-warning btn-lg me-2">← Back</a>
            <a href="../index.php"  class="btn btn-info btn-lg">🏠 Home</a>
        </div>

        <div id="timer" class="timer"></div>

        <br>

        <form method="POST" id="quizForm">

            <?php
            $i = 1;
            while($row = $data->fetch_assoc()){
            ?>

            <div class="mb-4">

                <h4>
                    <?= $i ?>. <?= htmlspecialchars($row['question']) ?>
                </h4>

                <input type="radio" name="q<?= $row['id'] ?>" value="<?= htmlspecialchars($row['option1']) ?>">
                <?= htmlspecialchars($row['option1']) ?>
                <br>

                <input type="radio" name="q<?= $row['id'] ?>" value="<?= htmlspecialchars($row['option2']) ?>">
                <?= htmlspecialchars($row['option2']) ?>
                <br>

                <input type="radio" name="q<?= $row['id'] ?>" value="<?= htmlspecialchars($row['option3']) ?>">
                <?= htmlspecialchars($row['option3']) ?>
                <br>

                <input type="radio" name="q<?= $row['id'] ?>" value="<?= htmlspecialchars($row['option4']) ?>">
                <?= htmlspecialchars($row['option4']) ?>

            </div>

            <?php
            $i++;
            }
            ?>

            <button name="submit" class="btn btn-primary btn-lg">
                Submit Quiz
            </button>

        </form>

    </div>

</div>

<script>

let time = <?= $minutes ?> * 60;

setInterval(function(){

    let min = Math.floor(time / 60);
    let sec = time % 60;

    document.getElementById('timer').innerHTML =
        "⏰ " + min + ":" + String(sec).padStart(2, '0');

    if(time <= 0){
        document.getElementById('quizForm').submit();
    }

    time--;

}, 1000);

</script>

<?php include '../includes/footer.php'; ?>