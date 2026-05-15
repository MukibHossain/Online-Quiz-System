<?php require '../config/database.php'; ?>

<!DOCTYPE html>
<html>

<head>

    <title>Question Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background: url('../assets/images/admin-bg.png');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: Arial;
        }

        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }

        .box {
            position: relative;
            z-index: 5;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 25px;
            margin-top: 40px;
            color: white;
            box-shadow: 0 0 30px black;
        }

    </style>

</head>

<body>

    <div class="overlay"></div>

    <div class="container">

        <div class="box">

            <h1>📝 Question Management</h1>

            <a href="dashboard.php" class="btn btn-warning">← Back</a>

            <a href="../index.php" class="btn btn-info">🏠 Home</a>

            <br><br>

            <form method="POST">

                <input name="quiz_id" class="form-control" placeholder="Quiz ID">

                <br>

                <textarea name="question" class="form-control" placeholder="Question"></textarea>

                <br>

                <input name="o1" class="form-control" placeholder="Option 1">

                <br>

                <input name="o2" class="form-control" placeholder="Option 2">

                <br>

                <input name="o3" class="form-control" placeholder="Option 3">

                <br>

                <input name="o4" class="form-control" placeholder="Option 4">

                <br>

                <input name="correct" class="form-control" placeholder="Correct Answer">

                <br>

                <button name="save" class="btn btn-success">Save Question</button>

            </form>

            <?php
            if (isset($_POST['save'])) {

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
                        '" . $_POST['quiz_id'] . "',
                        '" . $_POST['question'] . "',
                        '" . $_POST['o1'] . "',
                        '" . $_POST['o2'] . "',
                        '" . $_POST['o3'] . "',
                        '" . $_POST['o4'] . "',
                        '" . $_POST['correct'] . "'
                    )"
                );

                echo "<div class='alert alert-success mt-3'>Question Saved Successfully 🎉</div>";
            }
            ?>

            <hr>

            <h3>Saved Questions</h3>

            <table class="table table-dark">

                <tr>
                    <th>ID</th>
                    <th>Quiz ID</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Correct Answer</th>
                </tr>

                <?php
                $list = $conn->query("SELECT * FROM questions");

                while ($q = $list->fetch_assoc()) {
                ?>

                    <tr>
                        <td><?= $q['id'] ?></td>
                        <td><?= $q['quiz_id'] ?></td>
                        <td><?= $q['question'] ?></td>
                        <td><?= $q['option1'] ?></td>
                        <td><?= $q['option2'] ?></td>
                        <td><?= $q['option3'] ?></td>
                        <td><?= $q['option4'] ?></td>
                        <td><?= $q['correct_answer'] ?></td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</body>
</html>