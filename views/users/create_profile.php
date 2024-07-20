<?php
include("../partials/user_header.php");

//This check is needed beacuse the user_header.php starts session too
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];


// Getting the users first name from the query parameter with the GET superglobal

// if (isset($_GET['first_name'])) {
//     $received_firstName = $_GET['first_name']; // Get the parameter from the URL
//     $first_name = urldecode($received_firstName); // Decode for display
// }
?>

<main>
    <div class="container mt-5">
    <h3> Welcome <?php echo $first_name ?>🤗, let's create your profile now! </h3>
        <div class="form-container mt-4">
            <h2 class="text-center">Create Profile</h2>
            
            <form method="post" action="../../controllers/profile_confirmation.php">
                <div class="form-group">
                    <label for="age">Age:</label>
                    <select class="form-control" id="age" name="age" required>
                        <option value="">Select Age</option>
                        <?php for ($i = 16; $i <= 80; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="invalid-feedback">Age is required.</div>
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
                        <p><em>(If you define yourself as non-binary or other choose which body composition fits you best)</em></p>
                    </div>
                    <div class="invalid-feedback">Please select your gender.</div>
                </div>
                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" class="form-control" id="height" name="height" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>

                <div class="form-group">
                    <label for="activity_level">Activity Level:</label>
                    <select class="form-control" id="activity_level" name="activity_level" required>
                        <option value="">Select Activity Level</option>
                        <option value="Sedentary">Sedentary</option>
                        <option value="Lightly Active">Lightly Active</option>
                        <option value="Moderately Active">Moderately Active</option>
                        <option value="Very Active">Very Active</option>
                        <option value="Extremely Active">Extremely Active</option>
                    </select>
                    <div class="invalid-feedback">Please select your activity level.</div>
                </div>
                <div class="form-group">
                    <label for="desired_objective">Desired Objective:</label>
                    <select class="form-control" id="desired_objective" name="desired_objective" required>
                        <option value="">Select Desired Objective</option>
                        <option value="Weight Loss">Weight Loss</option>
                        <option value="Muscle Gain">Muscle Gain</option>
                        <option value="Maintain Weight">Maintain Weight</option>
                    </select>
                    <div class="invalid-feedback">Please select your desired objective.</div>
                </div>

                <button type="submit" class="btn btn-success btn-calculate">Submit Profile</button>
            </form>
        </div>
    </div>
</main>



<?php
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;

include("../partials/footer.php")
?>