<?php

# Check if the HTTP method is POST; otherwise, redirect to the index.php page
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

# Retrieve form data from POST request
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? '';

# Load the JSON file and convert it into a PHP array
$json_file = file_get_contents('triviaquiz.json');
$data = json_decode($json_file, true);

# Extract questions and correct answers from JSON
$questions = $data['questions'];
$correct_answers = $data['answers'];

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">
    <h1 class="title">Trivia Quiz</h1>
    <h2 class="subtitle">Answer all the questions below:</h2>

    <!-- Start the form -->
    <form method="POST" action="result.php">
        <input type="hidden" name="complete_name" value="<?php echo $complete_name; ?>" />
        <input type="hidden" name="email" value="<?php echo $email; ?>" />
        <input type="hidden" name="birthdate" value="<?php echo $birthdate; ?>" />
        <input type="hidden" name="contact_number" value="<?php echo $contact_number; ?>" />
        <input type="hidden" name="agree" value="<?php echo $agree; ?>" />

        <!-- Loop through the questions array and display them -->
        <?php foreach ($questions as $index => $question): ?>
            <div class="box">
                <h3 class="title is-4">Question <?php echo $index + 1; ?></h3>
                <p><?php echo $question['question']; ?></p>

                <!-- Loop through the options for this question -->
                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo $option['key']; ?>" required />
                                <?php echo $option['value']; ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <!-- Submit button -->
        <button type="submit" class="button is-primary">Submit</button>
    </form>
</section>
</body>
</html>
