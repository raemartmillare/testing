<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
}

// Supply the missing code
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];
$answer = $_POST['answer'] ?? null;
$answers = $_POST['answers'] ?? null;

if (!is_null($answer)) {
    $answers .= $answer;
}

if (is_array($answers)) {
    $answers = implode('', $answers);
}

// Use the compute_score() function from helpers.php
$score = compute_score($answers);

// Convert birthdate format
$birthdateFormatted = date('F j, Y', strtotime($birthdate));

// Retrieve questions and correct answers
$questions = retrieve_questions();
$correct_answers = get_answers();
$user_answers = str_split($answers);

// Determine hero section class and confetti visibility
$heroClass = $score <= 100 ? 'is-danger' : 'is-success';
$showConfetti = $score === 500;
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body>
<section class="hero <?php echo $heroClass; ?>">
    <div class="hero-body">
        <p class="title">Your Score <?php echo $score; ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>

<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td><?php echo $complete_name; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo $birthdate; ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $contact_number; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Questions and answers table -->
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $index => $question): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($question['question']); ?></td>
                        <td><?php echo htmlspecialchars($correct_answers[$index] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($user_answers[$index] ?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <canvas id="confetti-canvas"></canvas>

</section>

<script>
<?php if ($showConfetti): ?>
    var confettiSettings = {
        target: 'confetti-canvas'
    };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
    <?php endif; ?>
</script>
</body>
</html>