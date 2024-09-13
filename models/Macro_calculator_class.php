<?php
class MacroCalculator {
    private $age;
    private $gender;
    private $height;
    private $weight;
    private $activity;
    private $desired_objective;

    public function __construct($age, $gender, $height, $weight, $activity, $desired_objective) {
        $this->age = $age;
        $this->gender = $gender;
        $this->height = $height;
        $this->weight = $weight;
        $this->activity = $activity;
        $this->desired_objective = $desired_objective;
    }

    // Function to calculate BMR
    private function calculateBMR() {
        if ($this->gender == "male") {
            return 88.362 + (13.397 * $this->weight) + (4.799 * $this->height) - (5.677 * $this->age);
        } else {
            return 447.593 + (9.247 * $this->weight) + (3.098 * $this->height) - (4.330 * $this->age);
        }
    }

    // Function to calculate Total Daily Energy Expenditure (TDEE)
    private function calculateCalories() {
        $bmr = $this->calculateBMR();
        return $bmr * $this->activity;
    }

    // Function to calculate macronutrients based on the desired_objective
    public function calculateMacros() {
        $tdee = $this->calculateCalories();
        $macros = [];

        switch ($this->desired_objective) {
            case 'Maintain Weight':
                $macros = $this->macrosForMaintenance($tdee);
                break;
            case 'Weight Loss':
                $macros = $this->macrosForWeightLoss($tdee);
                break;
            case 'Muscle Gain':
                $macros = $this->macrosForMuscleGain($tdee);
                break;
            default:
                throw new Exception("Invalid desired objective");
        }

        return $macros;
    }

    // Function to calculate macros for maintenance
    private function macrosForMaintenance($tdee) {
        return $this->calculateMacroMaintennance($tdee, 0);
    }

    // Function to calculate macros for weight loss (20% calorie reduction)
    private function macrosForWeightLoss($tdee) {
        return $this->calculateMacroDistribution($tdee, -0.20);
    }

    // Function to calculate macros for muscle gain (20% calorie increase)
    private function macrosForMuscleGain($tdee) {
        return $this->calculateMacroDistribution($tdee, 0.20);
    }

    // Function to calculate macro distribution For Both Gain Muscle and Loose Weight
    private function calculateMacroDistribution($tdee, $calorieAdjustment) {
        $adjustedCalories = $tdee * (1 + $calorieAdjustment);
        
        // Macro ratios: Protein: 1g per lb of body weight, Carbs: 45-65%, Fats: 20-35%
        $protein = $this->weight * 1.6; // grams
        $fat = $adjustedCalories * 0.25 / 9; // grams
        $carbs = ($adjustedCalories - ($protein * 4) - ($fat * 9)) / 4; // grams

        return [
            'calories' => round($adjustedCalories),
            'protein' => round($protein),
            'fat' => round($fat),
            'carbs' => round($carbs)
        ];
    }

    // Function to calculate macro distribution for Maintennace
    private function calculateMacroMaintennance($tdee, $calorieAdjustment) {
        $adjustedCalories = $tdee * (1 + $calorieAdjustment);
        
        // Macro ratios: Protein: 1g per lb of body weight, Carbs: 45-65%, Fats: 20-35%
        $protein = $this->weight * 0.75; // grams
        $fat = $adjustedCalories * 0.25 / 9; // grams
        $carbs = ($adjustedCalories - ($protein * 4) - ($fat * 9)) / 4; // grams

        return [
            'calories' => round($adjustedCalories),
            'protein' => round($protein),
            'fat' => round($fat),
            'carbs' => round($carbs)
        ];
    }

    // Function to get the disclaimer
    public function getDisclaimer() {
        return "<h4>Disclaimer</h4>
                <p>Please consult a healthcare professional or a registered dietitian for personalized advice. The use of this tool is at your own risk, and the developers are not liable for any consequences arising from the use of these calculations.</p>
                
                <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#sourcesCollapse' aria-expanded='false' aria-controls='sourcesCollapse'>
                Sources</button>
                <div class='collapse mt-3' id='sourcesCollapse'>
                    <h4>Sources</h4>
                    <p>The macronutrient calculations provided by this tool are based on standard dietary guidelines and may not be suitable for everyone. The results are approximations and should not be considered as medical or nutritional advice.</p>
                    <p>Formulas and guidelines used include:</p>
                    <ul>
                        <li><strong>Protein:</strong> 
                        <ul>
                        <li>Muscle Gain and Weight Loss: 1.6 grams per kilogram of body weight</li>
                        <li>Maintennance: 0.75 gram per kilogram of body weight</li>
                        </ul>
                        </li>
                        <li><strong>Fats:</strong> 25% of total caloric intake (approximately 0.25 of total calories), converted to grams (1 gram of fat = 9 kcal)</li>
                        <li><strong>Carbs:</strong> Remaining calories after accounting for protein and fat, converted to grams (1 gram of carbs = 4 kcal)</li>
                    </ul>
                    <p>Activity levels are estimated as follows:</p>
                    <ul>
                        <li>Sedentary (little or no exercise): 1.2</li>
                        <li>Lightly active (light exercise/sports 1-3 days/week): 1.375</li>
                        <li>Moderately active (moderate exercise/sports 3-5 days/week): 1.55</li>
                        <li>Very active (hard exercise/sports 6-7 days a week): 1.725</li>
                        <li>Super active (very hard exercise/sports & a physical job): 1.9</li>
                    </ul>
                    <a href='https://www.medicalnewstoday.com/articles/how-much-protein-do-you-need-to-build-muscle' target='_blank'>References</a>
                </div>";
    }
}
?>
