<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    include("../views/partials/user_header.php");
    include("../views/partials/user_sidebar.html");
} else {
include("../views/partials/header.php");
}


// Branch 1: Form to Get
// If there was no post request display the form:
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        include("../views/calories_form.html");
        include("../views/partials/footer.php");
        return;
    }

// Branch 2: Post request
// VALIDATORS 
$age = $_POST['age'];
$gender = $_POST['gender'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$activity = $_POST['activity'];

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
$activity_levels = ["1.2", "1.375", "1.55", "1.725", "1.9"];
if (!in_array($activity, $activity_levels)) {
    die("Invalid activity level provided.");
}

// If all inputs are valid, instantiate the CalorieCalculator class
require_once '../models/Calorie_calculator_class.php';

$calculator = new CalorieCalculator($age, $gender, $height, $weight, $activity);
$calories = $calculator->calculateCalories();

$bmr = $calculator->calculateBMR();
$caloriesForMaintenance = $calculator->caloriesForMaintenance();
$caloriesForWeightLoss = $calculator->caloriesForWeightLoss();
$caloriesForMuscleGain = $calculator->caloriesForMuscleGain();
$disclaimer = $calculator->getDisclaimer();



include("../views/calories_result.html");


include("../views/partials/footer.php");
?>
