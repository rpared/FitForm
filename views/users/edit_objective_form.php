<?php
require_once '../../models/Repository_class.php';
include("../partials/user_header.php");
include("../../controllers/backgroundImage.php");
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

    $desired_objective = htmlspecialchars($profile['desired_objective']);
} else {
    // Handle case where profile data is not found

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
        <h3><?php echo $first_name; ?>, let's edit your <b>objective</b>!</h3>
        
        <div class="form-container mt-4">
            <h2 class="text-center">Edit Objective</h2>
            <!-- <?php  var_dump($desired_objective);?> -->
            <form method="post" action="../../controllers/edit_objective.php">
               
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

                <button type="submit" class="btn btn-success btn-calculate">Update Objective</button>
            </form>
        </div>
    </div>
</main>

<?php
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;

include("../partials/footer.php");
?>
