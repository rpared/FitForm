<?php
include("../partials/user_header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Add progress info</h2>
            <form method="post" action="progress_entry_confirmation.php">

                <div class="form-group">
                    <label for="date">*Date:</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="mandatory" required>
                </div>

                <div class="form-group">
                    <label for="activity">*Activity Level:</label>
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
                    <label for="weight">*Curent weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" placeholder="mandatory" required >
                </div>

                <div class="form-group">
                    <label for="calories">Number of calories consumed:</label>
                    <input type="number" class="form-control" id="calories" name="calories" placeholder="optional">
                </div>

                <div class="form-group">
                    <label for="carbohydrates">Carbohydrates (g):</label>
                    <input type="number" class="form-control" id="carbohydrates" name="carbohydrates" placeholder="optional">
                </div>

                <div class="form-group">
                    <label for="proteins">Proteins (g):</label>
                    <input type="number" class="form-control" id="proteins" name="proteins" placeholder="optional">
                </div>

                <div class="form-group">
                    <label for="fats">Fats (g):</label>
                    <input type="number" class="form-control" id="fats" name="fats" placeholder="optional">
                </div>


                <button type="submit" class="btn btn-success btn-calculate">Add info</button>
            </form>
        </div>
    </div>
</main>




<?php
include("../partials/footer.php")
?>