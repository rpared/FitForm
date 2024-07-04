<?php

// VALIDATORS 
$age = $_POST['age'];
$gender = $_POST['gender'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$activity = $_POST['activity'];
$goal = $_POST['goal'];

// Validate age
if (!is_numeric($age) || $age < 16 || $age > 80) {
    die("Invalid age provided.");
}

// Validate gender
if ($gender !== "male" && $gender !== "female") {
    die("Invalid gender provided.");
}

// Validate height (must be a float)
if (!is_numeric($height) || $height <= 0) {
    die("Invalid height provided.");
}

// Validate weight (must be a float)
if (!is_numeric($weight) || $weight <= 0) {
    die("Invalid weight provided.");
}

// Validate activity level
if (!in_array($activity, ["1.2", "1.375", "1.55", "1.725", "1.9"])) {
    die("Invalid activity level provided.");
}

// Validate fitness goal
if (!in_array($goal, ["maintain", "lose", "gain"])) {
    die("Invalid fitness goal provided.");
}


?>