<?php
ob_start(); // Start output buffering
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    include("../views/partials/user_header.php");
    include("../views/partials/user_sidebar.html");
} else {
include("../views/partials/header.php");
}

if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
    echo '<div class="alert alert-danger">';
    foreach ($_SESSION['form_errors'] as $error) {
        echo '<p>' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
    unset($_SESSION['form_errors']); // Clear errors after displaying them
}

$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']); // Clear form data after retrieving it




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

$errors = [];

// Validate age
if (!is_numeric($age) || $age < 16 || $age > 80) {
    $errors[] = "Invalid age provided. Age must be between 16 and 80.";
}

// Validate gender
if ($gender !== "male" && $gender !== "female") {
    $errors[] = "Invalid gender provided.";
}

// Validate height (must be a float)
if (!is_numeric($height) || $height <= 40 || $height >= 300) {
    $errors[] = "Invalid height provided. it must be between 40 and 300 cm";
}

// Validate weight (must be a float)
if (!is_numeric($weight) || $weight <= 20 || $weight >= 700) {
    $errors[] = "Invalid weight provided, it must be between 20 and 700 kg.";
}

// Validate activity level
$activity_levels = ["1.2", "1.375", "1.55", "1.725", "1.9"];
if (!in_array($activity, $activity_levels)) {
    $errors[] = "Invalid activity level provided.";
}

// If there are errors, redirect back to the form with errors
if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $_POST; // Preserve form data
    header("Location: calculate_calories.php");
    exit;
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
ob_end_flush(); // Send the buffered output
?>