<?php
require_once '../../models/Repository_class.php';
require_once '../../models/Calorie_calculator_class.php';
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
$desired_objective = $profile['desired_objective'];
// var_dump($desired_objective); must translate this ugh

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
// $disclaimer = $calculator->getDisclaimer(); A customized disclaimer is needed


// Extract profile data objective

$desired_objective = $profile['desired_objective'];

if ($desired_objective == 'Muscle Gain'){
    $user_cals = $caloriesForMuscleGain;
}elseif ($desired_objective == 'Weight Loss'){
$user_cals = $caloriesForWeightLoss;
}elseif ($desired_objective == 'Maintain Weight'){
    $user_cals = $caloriesForMaintenance;
    };

    // if($desired_objective == "Muscle Gain") { $goal= 'gain';} 
    // elseif ($desired_objective == "Maintain weight") { $goal = 'maintain';} 
    // elseif ($desired_objective == "Lose fat") { $goal= 'lose';}


    
    // Macro Calculator Object
    $calculator_macros = new MacroCalculator($age, $gender, $height, $weight, $activity, $desired_objective);
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
                <h1 class="cal-result"><?= $macros['protein'] ?> g</h1>
                <p class="h4 text-center"><strong>Total Protein</strong></p>
                <div class="additional-info">
                    <p><strong>Protein:</strong> <?= $macros['protein'] ?> g</br>
                    <strong>Fats:</strong> <?= $macros['fat'] ?> g</br>
                    <strong>Carbohydrates:</strong> <?= $macros['carbs'] ?> g</p>
                    <p><strong>For your goal:</strong> <?= $desired_objective ?></br>
                    <small>Your macros add up to get your calories: <strong> <?= $macros['calories'] ?> g </strong></small>
                </p>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Canvas for Chart.js -->
 <div class="container w-40 mt-5">
                <h3 class="text-center">Macro Distribution</h3>
                <canvas id="macrosGraph"></canvas>
                <br>
            
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Extract data from PHP
        const fats = <?php echo json_encode($macros['fat']); ?>;
        const protein = <?php echo json_encode($macros['protein']); ?>;
        const carbs = <?php echo json_encode($macros['carbs']); ?>;

        // Prepare data for Chart.js
        const ctx = document.getElementById('macrosGraph').getContext('2d');
        const weightChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Protein', 'Carbs', 'Fats'],
                datasets: [{
                    label: 'Daily Grams: ',
                    data: [protein, carbs, fats],
                    backgroundColor: [
                        '#5ea23a',
                        'rgb(54, 162, 235)',
                        'rgb(255, 180, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => {
                            let total = 0;
                            context.chart.data.datasets[0].data.forEach(data => {
                                total += data;
                            });
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${percentage}%`;
                        },
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Include the plugin in the chart
        });
    });
    </script>
