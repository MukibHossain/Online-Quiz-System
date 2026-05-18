<?php require '../config/database.php'; ?>
<?php include '../includes/header.php'; ?>

<?php

// Login check
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Latest result with quiz name
$data = $conn->query(
    "SELECT r.*, q.title AS quiz_title, u.name AS student_name
     FROM results r
     JOIN quizzes q ON r.quiz_id = q.id
     JOIN users u ON u.id = r.user_id
     WHERE r.user_id = '$user_id'
     ORDER BY r.id DESC
     LIMIT 1"
);

$result = $data->fetch_assoc();

if(!$result){
    echo "<div class='container mt-5'>
            <div class='alert alert-warning text-center fs-5'>
                ⚠️ You haven't attempted any quizzes yet.
                <br><br>
                <a href='quiz_list.php' class='btn btn-primary'>Take a Quiz</a>
            </div>
          </div>";
    include '../includes/footer.php';
    exit();
}

$student_name  = htmlspecialchars($result['student_name']);
$quiz_title    = htmlspecialchars($result['quiz_title']);
$score         = (int)$result['score'];
$total         = (int)$result['total'];
$percentage    = $total > 0 ? round(($score / $total) * 100) : 0;
$date          = date('d F Y', strtotime($result['created_at']));

// Auto certificate number: CERT-USERID-RESULTID
$cert_no = 'CERT-' . str_pad($user_id, 4, '0', STR_PAD_LEFT)
         . '-' . str_pad($result['id'], 6, '0', STR_PAD_LEFT);

// Grade logic
if($percentage >= 90)      { $grade = 'A+'; $grade_label = 'Outstanding'; }
elseif($percentage >= 80)  { $grade = 'A';  $grade_label = 'Excellent'; }
elseif($percentage >= 70)  { $grade = 'B';  $grade_label = 'Very Good'; }
elseif($percentage >= 60)  { $grade = 'C';  $grade_label = 'Good'; }
elseif($percentage >= 50)  { $grade = 'D';  $grade_label = 'Satisfactory'; }
else                       { $grade = 'F';  $grade_label = 'Needs Improvement'; }

?>

<div class="no-print text-center py-4" style="background:#1a1a2e;">
    <button onclick="window.print()" class="btn btn-lg me-3"
        style="background:linear-gradient(135deg,#d4af37,#f5e07a);color:#1a1a2e;font-weight:bold;border-radius:12px;padding:12px 32px;">
        🖨️ Print / Download
    </button>
    <a href="result.php" class="btn btn-lg me-3"
        style="background:#374151;color:white;border-radius:12px;padding:12px 32px;">
        ← Back to Result
    </a>
    <a href="dashboard.php" class="btn btn-lg"
        style="background:#374151;color:white;border-radius:12px;padding:12px 32px;">
        🏠 Dashboard
    </a>
</div>

<div class="cert-page">

    <div class="cert-outer">
    <div class="cert-inner">

        <div class="corner tl">❧</div>
        <div class="corner tr">❧</div>
        <div class="corner bl">❧</div>
        <div class="corner br">❧</div>

        <div class="cert-seal-row">
            <div class="seal-line"></div>
            <div class="seal-emblem">🎯</div>
            <div class="seal-line"></div>
        </div>

        <p class="cert-issuer">Online Quiz System</p>
        <div class="cert-divider">✦ ✦ ✦</div>

        <h1 class="cert-title">Certificate of Achievement</h1>

        <p class="cert-presented">This is to certify that</p>

        <h2 class="cert-name"><?= $student_name ?></h2>

        <p class="cert-body">
            has successfully completed the
        </p>

        <h3 class="cert-quiz">"<?= $quiz_title ?>"</h3>

        <div class="cert-score-row">
            <div class="score-box">
                <div class="score-label">Score</div>
                <div class="score-value"><?= $score ?> / <?= $total ?></div>
            </div>
            <div class="score-box highlight">
                <div class="score-label">Percentage</div>
                <div class="score-value"><?= $percentage ?>%</div>
            </div>
            <div class="score-box">
                <div class="score-label">Grade</div>
                <div class="score-value"><?= $grade ?></div>
            </div>
        </div>
        <p class="cert-grade-label"><?= $grade_label ?></p>

        <div class="cert-divider">── ✦ ──</div>

        <div class="cert-footer-row">

            <div class="cert-sign-block">
                <div class="sign-line"></div>
                <p class="sign-title">Authorized Signatory</p>
                <p class="sign-sub">Quiz System Authority</p>
            </div>

            <div class="cert-stamp">
                <div class="stamp-circle">
                    <div class="stamp-inner">
                        <p>✦</p>
                        <p>VERIFIED</p>
                        <p>✦</p>
                    </div>
                </div>
            </div>

            <div class="cert-sign-block">
                <div class="sign-line"></div>
                <p class="sign-title">Date of Issue</p>
                <p class="sign-sub"><?= $date ?></p>
            </div>

        </div>

        <p class="cert-number">Certificate No: <strong><?= $cert_no ?></strong></p>

    </div></div></div><style>

/* ---- Screen wrapper ---- */
.cert-page {
    background: #1a1a2e;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

/* ---- Outer border (thick gold) ---- */
.cert-outer {
    background: linear-gradient(145deg, #1c1200, #2e1e00);
    border: 6px solid #d4af37;
    border-radius: 6px;
    padding: 10px;
    box-shadow:
        0 0 0 2px #f5e07a,
        0 0 0 5px #d4af37,
        0 0 60px rgba(212,175,55,0.4);
    max-width: 900px;
    width: 100%;
}

/* ---- Inner border (thin gold) ---- */
.cert-inner {
    border: 2px solid #d4af37;
    border-radius: 4px;
    padding: 48px 56px 36px;
    position: relative;
    background:
        radial-gradient(ellipse at center, #1e1500 0%, #0d0900 100%);
    text-align: center;
}

/* ---- Corners ---- */
.corner {
    position: absolute;
    font-size: 28px;
    color: #d4af37;
    line-height: 1;
}
.corner.tl { top: 10px;  left: 14px; }
.corner.tr { top: 10px;  right: 14px; transform: scaleX(-1); }
.corner.bl { bottom: 10px; left: 14px; transform: scaleY(-1); }
.corner.br { bottom: 10px; right: 14px; transform: scale(-1,-1); }

/* ---- Seal row ---- */
.cert-seal-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 10px;
}
.seal-line {
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, transparent, #d4af37, transparent);
}
.seal-emblem {
    font-size: 48px;
    filter: drop-shadow(0 0 10px #d4af37);
}

/* ---- Issuer ---- */
.cert-issuer {
    font-size: 13px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: #c9a227;
    margin: 0 0 6px;
}

/* ---- Dividers ---- */
.cert-divider {
    color: #d4af37;
    letter-spacing: 8px;
    font-size: 14px;
    margin: 8px 0;
}

/* ---- Main title ---- */
.cert-title {
    font-family: 'Georgia', serif;
    font-size: 38px;
    font-weight: bold;
    color: #f5e07a !important;
    text-shadow: 0 0 20px rgba(212,175,55,0.6);
    margin: 12px 0 6px;
    letter-spacing: 2px;
}

/* ---- Presented to ---- */
.cert-presented {
    font-size: 15px;
    color: #b8976a !important;
    letter-spacing: 2px;
    margin: 10px 0 4px;
    font-style: italic;
}

/* ---- Student name ---- */
.cert-name {
    font-family: 'Georgia', serif;
    font-size: 44px;
    color: #fff8dc !important;
    text-shadow: 0 0 20px rgba(212,175,55,0.5);
    border-bottom: 2px solid #d4af37;
    display: inline-block;
    padding-bottom: 6px;
    margin: 8px auto 10px;
    letter-spacing: 1px;
}

/* ---- Body text ---- */
.cert-body {
    font-size: 15px;
    color: #b8976a !important;
    letter-spacing: 1px;
    margin: 0 0 4px;
}

/* ---- Quiz name ---- */
.cert-quiz {
    font-family: 'Georgia', serif;
    font-size: 22px;
    color: #f5e07a !important;
    font-style: italic;
    margin: 4px 0 20px;
}

/* ---- Score boxes ---- */
.cert-score-row {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 10px 0 6px;
}
.score-box {
    border: 1px solid #d4af37;
    border-radius: 8px;
    padding: 12px 28px;
    background: rgba(212,175,55,0.08);
    min-width: 110px;
}
.score-box.highlight {
    background: rgba(212,175,55,0.2);
    border-width: 2px;
}
.score-label {
    font-size: 11px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c9a227 !important;
    margin-bottom: 4px;
}
.score-value {
    font-size: 24px;
    font-weight: bold;
    color: #f5e07a !important;
    font-family: 'Georgia', serif;
}
.cert-grade-label {
    font-size: 13px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: #c9a227 !important;
    margin: 4px 0 10px;
}

/* ---- Footer row ---- */
.cert-footer-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 24px;
    gap: 20px;
}
.cert-sign-block {
    flex: 1;
    text-align: center;
}
.sign-line {
    height: 1px;
    background: #d4af37;
    margin-bottom: 8px;
}
.sign-title {
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #c9a227 !important;
    margin: 0;
}
.sign-sub {
    font-size: 13px;
    color: #f5e07a !important;
    margin: 2px 0 0;
    font-weight: bold;
}

/* ---- Stamp ---- */
.cert-stamp {
    flex: 0 0 auto;
}
.stamp-circle {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    border: 3px solid #d4af37;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(212,175,55,0.1);
    box-shadow: 0 0 15px rgba(212,175,55,0.3);
}
.stamp-inner {
    text-align: center;
    color: #f5e07a !important;
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 2px;
    line-height: 1.5;
}
.stamp-inner p {
    margin: 0;
    color: #f5e07a !important;
}

/* ---- Cert number ---- */
.cert-number {
    font-size: 11px;
    letter-spacing: 2px;
    color: #7a6030 !important;
    margin-top: 20px;
    text-transform: uppercase;
}
.cert-number strong {
    color: #c9a227 !important;
}

/* ===================== PRINT STYLES ===================== */
@media print {

    /* Hide everything except the certificate */
    .no-print,
    nav,
    footer {
        display: none !important;
    }

    body {
        background: white !important;
        margin: 0;
        padding: 0;
    }

    .cert-page {
        background: white !important;
        padding: 0 !important;
        min-height: unset;
    }

    /* Light version for print (gold colors preserved as-is) */
    .cert-outer {
        box-shadow: none !important;
        border: 6px solid #d4af37 !important;
        max-width: 100%;
        page-break-inside: avoid;
    }

    .cert-inner {
        background: white !important;
    }

    /* Override dark colors → print-safe dark colors */
    .cert-title        { color: #8B6914 !important; text-shadow: none !important; }
    .cert-name         { color: #4a3000 !important; text-shadow: none !important; }
    .cert-quiz         { color: #7a5c00 !important; }
    .cert-issuer,
    .cert-divider,
    .cert-grade-label,
    .sign-title,
    .score-label       { color: #a07800 !important; }
    .score-value,
    .sign-sub,
    .stamp-inner,
    .stamp-inner p     { color: #5c3d00 !important; }
    .cert-body,
    .cert-presented    { color: #6b4f1a !important; }
    .cert-number       { color: #aaa !important; }
    .cert-number strong{ color: #8B6914 !important; }

    .corner            { color: #d4af37 !important; }
    .sign-line         { background: #d4af37 !important; }
    .stamp-circle      { border-color: #d4af37 !important; background: #fff8e7 !important; }
    .score-box         { background: #fff8e7 !important; }
    .score-box.highlight { background: #fff0c0 !important; }
}

</style>

<?php include '../includes/footer.php'; ?>