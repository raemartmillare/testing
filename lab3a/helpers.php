<?php

define('MAX_QUESTION_NUMBER', 5);

function retrieve_questions() {
    $json_string = file_get_contents("./questions/triviaquiz.json");
    $json_data = json_decode($json_string, true);
    return $json_data['questions'];
}

function get_answers() {
    $json_string = file_get_contents("./questions/triviaquiz.json");
    $json_data = json_decode($json_string, true);
    return $json_data['answers'];
}

function get_current_question($answers = '') {
    $number_of_answers = strlen($answers);
    return [$number_of_answers];
}

function get_current_question_number($answers = '') {
    return strlen($answers) + 1;
}

function get_options_for_question_number($number = 0) {
    $questions = retrieve_questions();
    return $questions[$number - 1]['options'];
}

function compute_score($answers = []) {
    $correct_answers = get_answers();

    $score = 0;
    for ($i = 0; $i < MAX_QUESTION_NUMBER; $i++) {
        if (isset($correct_answers[$i]) && isset($answers[$i]) && $correct_answers[$i] == $answers[$i]) {
            $score += 100;
        }
    }
    return $score;
}
