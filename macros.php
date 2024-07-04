<?php
include("public/header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Daily Macronutrient Needs</h2>
            <form method="post" action="calculate_macros.php">
                <div class="form-group">
                    <label for="age">Age:</label>
                    <select class="form-control" id="age" name="age" required>
                        <option value="">Select Age</option>
                        <?php for ($i = 16; $i <= 80; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <p><em>(If you define yourself as non-binary choose which body composition fits you best)</em></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" class="form-control" id="height" name="height" required>
                    <div class="invalid-feedback">Height is required.</div>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                    <div class="invalid-feedback">Weight is required.</div>
                </div>
                <div class="form-group">
                    <label for="activity">Activity Level:</label>
                    <select class="form-control" id="activity" name="activity" required>
                        <option value="">Select Activity Level</option>
                        <option value="1.2">Sedentary (little or no exercise)</option>
                        <option value="1.375">Lightly active (light exercise/sports 1-3 days/week)</option>
                        <option value="1.55">Moderately active (moderate exercise/sports 3-5 days/week)</option>
                        <option value="1.725">Very active (hard exercise/sports 6-7 days a week)</option>
                        <option value="1.9">Super active (very hard exercise/sports & a physical job)</option>
                    </select>
                    <div class="invalid-feedback">Please select your activity level.</div>
                </div>
                <div class="form-group">
                    <label for="goal">Fitness Goal:</label>
                    <select class="form-control" id="goal" name="goal" required>
                        <option value="">Select Fitness Goal</option>
                        <option value="maintain">Maintain Weight</option>
                        <option value="lose">Lose Weight</option>
                        <option value="gain">Gain Weight</option>
                    </select>
                    <div class="invalid-feedback">Please select your fitness goal.</div>
                </div>
                <button type="submit" class="btn btn-success btn-calculate">Calculate</button>
            </form>
        </div>
    </div>
</main>


<?php
include("public/footer.php")
?>