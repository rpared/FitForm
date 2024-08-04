<?php
require_once '../../models/Repository_class.php';
include("../partials/user_header.php");

// This check is needed because the user_header.php starts session too
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];

// Initialize the repository
$repository = new Repository();

// Load user info
$profile = $repository->getUserProfile($user_id);

// Ensure $profile is not empty
if (!empty($profile)) {

    // Safely assign Profile data
    $age = htmlspecialchars($profile['age']);
    $gender = htmlspecialchars($profile['gender']);
    $height = htmlspecialchars($profile['height']);
    $weight = htmlspecialchars($profile['weight']);
    $activity_level = htmlspecialchars($profile['activity_level']);
    $desired_objective = htmlspecialchars($profile['desired_objective']);
} else {
    // Handle case where profile data is not found
    $age = '';
    $gender = '';
    $height = '';
    $weight = '';
    $activity_level = '';
    $desired_objective = '';
}
?>

<div class="sidebar">
    <a href="/FitForm/views/users/user_home.php">User Dashboard</a>
    <a href="/FitForm/views/users/add_progress.php">Add Progress</a>
    <a href="/FitForm/views/users/edit_objective_form.php">Edit Objective</a>
    <a href="/FitForm/views/users/edit_profile_form.php">Edit Profile</a>
    <a href="/FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="/FitForm/controllers/logout.php">Logout</a>
</div>

<main>

    <div class="container mt-5">
    <?php if (isset($_GET["failed"])): ?>
                <div class="alert alert-danger" role="alert">
                Failed Updating your info, please try again.
                </div>
            <?php endif; ?>
        <h3><?php echo $first_name; ?>, let's edit your profile!</h3>
        
        <div class="form-container mt-4">
            <h2 class="text-center">Edit Profile</h2>
            <!-- <?php  var_dump($gender);?> -->
            <form method="post" action="../../controllers/edit_profile.php">
                <div class="form-group">
                    <label for="age">Age:</label>
                    <select class="form-control" id="age" name="age" required>
                        <option value="">Select Age</option>
                        <?php for ($i = 16; $i <= 80; $i++): ?>
                            <option value="<?= $i ?>" <?= $i == $age ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="invalid-feedback">Age is required.</div>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?= $profile['gender'] == 'Male' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?= $gender == 'Female' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <p><em>(If you define yourself as non-binary or other choose which body composition fits you best)</em></p>
                    </div>
                    <div class="invalid-feedback">Please select your gender.</div>
                </div>
                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" class="form-control" id="height" name="height" value="<?= $height ?>" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" value="<?= $weight ?>" required>
                </div>

                <div class="form-group">
                    <label for="activity_level">Activity Level:</label>
                    <select class="form-control" id="activity_level" name="activity_level" required>
                        <option value="">Select Activity Level</option>
                        <option value="Sedentary" <?= $activity_level == 'Sedentary' ? 'selected' : '' ?>>Sedentary</option>
                        <option value="Lightly Active" <?= $activity_level == 'Lightly Active' ? 'selected' : '' ?>>Lightly Active</option>
                        <option value="Moderately Active" <?= $activity_level == 'Moderately Active' ? 'selected' : '' ?>>Moderately Active</option>
                        <option value="Very Active" <?= $activity_level == 'Very Active' ? 'selected' : '' ?>>Very Active</option>
                        <option value="Extremely Active" <?= $activity_level == 'Extremely Active' ? 'selected' : '' ?>>Extremely Active</option>
                    </select>
                    <div class="invalid-feedback">Please select your activity level.</div>
                </div>
                <div class="form-group">
                    <label for="desired_objective">Desired Objective:</label>
                    <select class="form-control" id="desired_objective" name="desired_objective" required>
                        <option value="">Select Desired Objective</option>
                        <option value="Weight Loss" <?= $desired_objective == 'Weight Loss' ? 'selected' : '' ?>>Weight Loss</option>
                        <option value="Muscle Gain" <?= $desired_objective == 'Muscle Gain' ? 'selected' : '' ?>>Muscle Gain</option>
                        <option value="Maintain Weight" <?= $desired_objective == 'Maintain Weight' ? 'selected' : '' ?>>Maintain Weight</option>
                    </select>
                    <div class="invalid-feedback">Please select your desired objective.</div>
                </div>

                <button type="submit" class="btn btn-success btn-calculate">Update Profile</button>
            </form>
        </div>
    </div>
</main>

<?php
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;

include("../partials/footer.php");
?>
