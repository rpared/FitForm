<?php
include("public/header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Add daily info</h2>
            <form method="post" action="register_confirmation.php">

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
                </div>

                <div class="form-group">
                    <label for="weight">Number of calories consumed:</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>

                <div class="form-group">
                    <label for="carbohydrates">Carbohydrates (g):</label>
                    <input type="number" class="form-control" id="carbohydrates" name="carbohydrates">
                </div>

                <div class="form-group">
                    <label for="proteins">Proteins (g):</label>
                    <input type="number" class="form-control" id="proteins" name="proteins">
                </div>

                <div class="form-group">
                    <label for="fats">Fats (g):</label>
                    <input type="number" class="form-control" id="fats" name="fats">
                </div

                <div class="form-group">
                    <label for="weight">Curent weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>


                <button type="submit" class="btn btn-success btn-calculate">Add daily info</button>
            </form>
        </div>
    </div>
</main>




<?php
include("public/footer.php")
?>