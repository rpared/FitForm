<?php
class CalorieCalculator {
    private $age;
    private $gender;
    private $height;
    private $weight;
    private $activity;

    public function __construct($age, $gender, $height, $weight, $activity) {
        $this->age = $age;
        $this->gender = $gender;
        $this->height = $height;
        $this->weight = $weight;
        $this->activity = $activity;
    }

    public function calculateBMR() {
        // Harris-Benedict Equation for calculating BMR (Basal Metabolic Rate)
        if ($this->gender == 'male') {
            $bmr = 88.362 + (13.397 * $this->weight) + (4.799 * $this->height) - (5.677 * $this->age);
        } else {
            $bmr = 447.593 + (9.247 * $this->weight) + (3.098 * $this->height) - (4.330 * $this->age);
        }
        return round($bmr);
    }

    public function calculateCalories() {
        $bmr = $this->calculateBMR();
        $cals = $bmr * $this->activity;
        return round($cals);
    }

    public function caloriesForWeightLoss() {
        $cals = $this->calculateCalories();
        return max(1200, $cals - 500); // Ensure the calorie intake doesn't drop below 1200 kcal
    }

    public function caloriesForMuscleGain() {
        $cals = $this->calculateCalories();
        return $cals + 250; // Add 250 kcal for muscle gain
    }

    public function caloriesForMaintenance() {
        return $this->calculateCalories();
    }
    
    public function getDisclaimer() {
<<<<<<< HEAD
        return "
        <div class='container'>
            <h4>Disclaimer</h4>
            <p>Please consult a healthcare professional or a registered dietitian for personalized advice. The use of this tool is at your own risk, and the developers are not liable for any consequences arising from the use of these calculations.</p>
            
            
            <button class='btn-link' type='button' data-toggle='collapse' data-target='#sourcesCollapse' aria-expanded='false' aria-controls='sourcesCollapse'>
                Sources
            </button>
            <div class='collapse mt-3' id='sourcesCollapse'>
            <h4>Sources</h4>
                <div class='card card-body'>
                    <p>The calculations provided by this tool are based on the Harris-Benedict equation, which estimates Basal Metabolic Rate (BMR) and Total Daily Energy Expenditure (TDEE). The results are approximations and should not be considered as medical or nutritional advice.</p>
                    <p>The formulas used are as follows:</p>
                    <ul>
                        <li><strong>BMR for Men:</strong> BMR = 88.362 + (13.397 x weight in kg) + (4.799 x height in cm) - (5.677 x age in years)</li>
                        <li><strong>BMR for Women:</strong> BMR = 447.593 + (9.247 x weight in kg) + (3.098 x height in cm) - (4.330 x age in years)</li>
                        <li><strong>TDEE:</strong> TDEE = BMR x Activity Level</li>
                    </ul>
                    <p>Activity levels are estimated as follows:</p>
                    <ul>
                        <li>Sedentary (little or no exercise): 1.2</li>
                        <li>Lightly active (light exercise/sports 1-3 days/week): 1.375</li>
                        <li>Moderately active (moderate exercise/sports 3-5 days/week): 1.55</li>
                        <li>Very active (hard exercise/sports 6-7 days a week): 1.725</li>
                        <li>Super active (very hard exercise/sports & a physical job): 1.9</li>
                    </ul>
                </div>
            </div>
        </div>";
    }
    
}
?>
=======
        return "<h3>Disclaimer</h3>
                <p>The calculations provided by this tool are based on the Harris-Benedict equation, which estimates Basal Metabolic Rate (BMR) and Total Daily Energy Expenditure (TDEE). The results are approximations and should not be considered as medical or nutritional advice.</p>
                <p>The formulas used are as follows:</p>
                <ul>
                    <li><strong>BMR for Men:</strong> BMR = 88.362 + (13.397 x weight in kg) + (4.799 x height in cm) - (5.677 x age in years)</li>
                    <li><strong>BMR for Women:</strong> BMR = 447.593 + (9.247 x weight in kg) + (3.098 x height in cm) - (4.330 x age in years)</li>
                    <li><strong>TDEE:</strong> TDEE = BMR x Activity Level</li>
                </ul>
                <p>Activity levels are estimated as follows:</p>
                <ul>
                    <li>Sedentary (little or no exercise): 1.2</li>
                    <li>Lightly active (light exercise/sports 1-3 days/week): 1.375</li>
                    <li>Moderately active (moderate exercise/sports 3-5 days/week): 1.55</li>
                    <li>Very active (hard exercise/sports 6-7 days a week): 1.725</li>
                    <li>Super active (very hard exercise/sports & a physical job): 1.9</li>
                </ul>
                <p>Please consult a healthcare professional or a registered dietitian for personalized advice. The use of this tool is at your own risk, and the developers are not liable for any consequences arising from the use of these calculations.</p>";
    }
}
?>
>>>>>>> d1318bdf472437e1fe520b8d0222f5e8d885d874
