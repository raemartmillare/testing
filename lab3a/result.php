<?php

require "helpers.php";

// Check if the request method is POST, if not, redirect to index.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Retrieve form data
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];
$answers = isset($_POST['answers']) ? $_POST['answers'] : [];

// Load trivia quiz questions and answers from the JSON file
$json_file = file_get_contents('triviaquiz.json');
$data = json_decode($json_file, true);

// Extract correct answers and questions from JSON
$correct_answers = $data['answers'];
$questions = $data['questions'];

// Function to format birthdate from YYYY-MM-DD to "Month dd, YYYY"
function format_birthdate($birthdate) {
    return date("F d, Y", strtotime($birthdate));
}

// Compute the score
$score = 0;
foreach ($correct_answers as $index => $correct_answer) {
    if (isset($answers[$index]) && $answers[$index] === $correct_answer) {
        $score++;
    }
}

// Determine the hero class based on the score
$hero_class = $score > 2 ? 'is-success' : 'is-danger';

// Format the birthdate
$formatted_birthdate = format_birthdate($birthdate);

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A - Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body>

<!-- Hero section based on the score -->
<section class="hero <?php echo $hero_class; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo $score; ?>/5</p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>

<!-- User Details Table -->
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
                    <td><?php echo htmlspecialchars($complete_name); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo htmlspecialchars($contact_number); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Confetti Canvas, shown only if the user got a perfect score -->
<?php if ($score === 5): ?>
    <canvas id="confetti-canvas"></canvas>
    <script>
        var confettiSettings = { target: 'confetti-canvas' };
        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();
    </script>
<?php endif; ?>

</body>
</html>
