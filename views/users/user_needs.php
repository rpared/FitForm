<?php
require_once '../../models/Repository_class.php';
require_once '../..\models\Calorie_calculator_class.php';
require_once '../../models/Macro_calculator_class.php';

// Initialize the repository
$repository = new Repository();

// Extract profile data
$profile = $repository->getUserProfile($user_id);

$age = $profile['age'];
$gender = $profile['gender'];
$height = $profile['height'];
$weight = $profile['weight'];
$activity = $profile['activity_level'];
$goal = $profile['desired_objective'];
// var_dump($goal); must translate this ugh

switch ($activity) {
    case "Sedentary":
        $activity = 1.2;
        break;
    case "Lightly Active":
        $activity = 1.375;
        break;
    case "Moderately Active":
        $activity = 1.55;
        break;
    case "Very Active":
        $activity = 1.725;
        break;
    case "Super Active":
        $activity = 1.9;
        break;
    }
//Calorie Calcualtor
$calculator = new CalorieCalculator($age, $gender, $height, $weight, $activity);
$calories = $calculator->calculateCalories();
$bmr = $calculator->calculateBMR();
$caloriesForMaintenance = $calculator->caloriesForMaintenance();
$caloriesForWeightLoss = $calculator->caloriesForWeightLoss();
$caloriesForMuscleGain = $calculator->caloriesForMuscleGain();
$disclaimer = $calculator->getDisclaimer();


// Extract profile data objective

$desired_objective = $profile['desired_objective'];

if ($desired_objective == 'Muscle Gain'){
    $user_cals = $caloriesForMuscleGain;
}elseif ($desired_objective == 'Weight Loss'){
$user_cals = $caloriesForWeightLoss;
}elseif ($desired_objective == 'Maintain Weight'){
    $user_cals = $caloriesForMaintenance;
    };

    if($goal == "Muscle Gain") { $goal = 'gain';} 
    elseif ($goal == "Maintain weight") { $goal = 'maintain';} 
    elseif ($goal == "Lose fat") { $goal = 'lose';}


    
    // Macro Calculator Object
    $calculator_macros = new MacroCalculator($age, $gender, $height, $weight, $activity, $goal);
    // Calculate macros based on the user input
    $macros = $calculator_macros->calculateMacros();


?>
<div class="user-needs">
    <div class="container w-40 mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Your Daily Calories</h2>
            <div class="results mt-4">
                <h1 class="cal-result"><?= $user_cals ?> kcal</h1>
                <p class="h4 text-center"><strong>Calories for <?= $desired_objective ?></strong></p>
                <div class="additional-info">
                    <p><strong>Calories for Weight Loss:</strong> <?= $caloriesForWeightLoss ?> kcal</br>
                    <strong>Calories for Maintenance:</strong> <?= $caloriesForMaintenance ?> kcal</br>
                    <strong>Calories for Muscle Gain:</strong> <?= $caloriesForMuscleGain ?> kcal</p>
                    <p><strong>BMR:</strong> <?= $bmr ?> kcal <small>(Basal Metabolic Rate)</small><br>
                        <small>(Minimum to survive with no activity).</small>
                    </p>
                </div>
            </div>
            
        </div>
    </div>
    <div class="container w-40 mt-5">
    <div class="form-container mt-4">
        <h2 class="text-center">Your Daily Macros</h2>
        <div class="results mt-4">
            <h1 class="cal-result"><?= $macros['calories'] ?> kcal</h1>
            <p class="h4 text-center"><strong>Total Daily Calories</strong></p>
            <div class="additional-info">
                <p><strong>Protein:</strong> <?= $macros['protein'] ?> g</p>
                <p><strong>Fats:</strong> <?= $macros['fat'] ?> g</p>
                <p><strong>Carbohydrates:</strong> <?= $macros['carbs'] ?> g</p>
                <p><strong>For your goal:</strong> <?= $desired_objective ?></p>
            </div>
        </div>
    </div>
</div>
</div>

