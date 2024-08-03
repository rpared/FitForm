<?php
include("../partials/user_header.php");



$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];

?>

<div class="sidebar">
    <a href="user_home.php">User Dashboard</a>
    <a href="progress_tracker.php">Progress Tracker</a>
    <a href="edit_profile.php">Edit Objective</a>
    <a href="edit_profile.php">Edit Profile</a>
    <a href="\FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="../../controllers/logout.php">Logout</a>
</div>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Add progress info</h2>
            <form method="post" action="../../controllers/progress_confirmation.php">

                <div class="form-group">
                    <label for="date">*Date:</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="mandatory" required>
                </div>

                <!-- <div class="form-group">
                    <label for="activity">*Activity Level:</label>
                    <select class="form-control" id="activity" name="activity" required>
                        <option value="">Select Activity Level</option>
                        <option value="1.2">Sedentary (little or no exercise)</option>
                        <option value="1.375">Lightly active (light exercise/sports 1-3 days/week)</option>
                        <option value="1.55">Moderately active (moderate exercise/sports 3-5 days/week)</option>
                        <option value="1.725">Very active (hard exercise/sports 6-7 days a week)</option>
                        <option value="1.9">Super active (very hard exercise/sports & a physical job)</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label for="weight">*Your weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" placeholder="mandatory" required >
                </div>

                <div class="form-group">
                    <label for="calories">Number of calories consumed:</label>
                    <input type="number" class="form-control" id="calorie_intake" name="calorie_intake" placeholder="optional">
                </div>

                <div class="form-group">
                    <label for="proteins">Proteins (g):</label>
                    <input type="number" class="form-control" id="protein" name="protein" placeholder="optional">
                </div>

                <div class="form-group">
                    <label for="carbohydrates">Carbohydrates (g):</label>
                    <input type="number" class="form-control" id="carbs" name="carbs" placeholder="optional">
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
<script>
    document.querySelector('#delete-account-link').addEventListener('click', function(event) {
        
        event.preventDefault(); // Prevent the default action
        console.log("clicked");
        if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
            window.location.href = '../../controllers/delete_user.php';
        }
    });
    </script>



<?php
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;
include("../partials/footer.php")
?>