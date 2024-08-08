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
        include("../views/macros_form.html");
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
$desired_objective = $_POST['desired_objective'];

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

// Validate fitness desired_objective!
if (!in_array($desired_objective, ["Maintain Weight", "Weight Loss", "Muscle Gain"])) {
    die("Invalid fitness goal provided.");
}
// $goalDescriptions = [
//     'maintain' => 'Maintain weight',
//     'lose' => 'Lose fat',
//     'gain' => 'Gain muscle'
// ];
// $goalDescription = isset($goalDescriptions[$desired_objective]) ? $goalDescriptions[$desired_objective] : 'Unknown desired objective';

// If all inputs are valid, instantiate the MacroCalculator class
require_once '../models/Macro_calculator_class.php';
// Calculator Object
$calculator = new MacroCalculator($age, $gender, $height, $weight, $activity, $desired_objective);
// Calculate macros based on the user input
$macros = $calculator->calculateMacros();
$disclaimer = $calculator->getDisclaimer();

// NOt needed anymore
// Output results or pass them to a view
// echo "<h2>Your Macros:</h2>";
// echo "<p>Calories: " . $macros['calories'] . " kcal</p>";
// echo "<p>Protein: " . $macros['protein'] . " g</p>";
// echo "<p>Fats: " . $macros['fat'] . " g</p>";
// echo "<p>Carbohydrates: " . $macros['carbs'] . " g</p>";
// echo "<p>For your goal: ". $goalDescription. "</p>";

// echo $disclaimer;

include("../views/macros_result.html");


include("../views/partials/footer.php");
?>




?>