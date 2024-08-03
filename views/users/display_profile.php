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
    <a href="\FitForm/views/users/user_home.php">User Dashboard</a>
    <a href="\FitForm/views/users/add_progress.php">Add Progress</a>
    <a href="\FitForm/views/users/edit_objective_form.php">Edit Objective</a>
    <a href="\FitForm/views/users/edit_profile_form.php">Edit Profile</a>
    <a href="\FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="\FitForm/controllers/logout.php">Logout</a>
</div>

<main>
    <div class="container mt-5">
        
        <div class="profile-container mt-4">
            <h2 class="text-center"><?php echo $first_name; ?>'s Profile</h2>
            
            <div >

                <p>Age: <b><?php echo $age; ?></b></p>
            </div>
            <div>

                <p>Gender: <b><?php echo $gender; ?></b></p>
            </div>
            <div class="form-group">

                <p>Height (cm): <b><?php echo $height; ?></b></p>
            </div>
            <div class="form-group">

                <p>Weight (kg): <b><?php echo $weight; ?></b></p>
            </div>
            <div >

                <p>Activity Level: <b><?php echo $activity_level; ?></b></p>
            </div>
            <div>

                <p>Desired Objective: <b><?php echo $desired_objective; ?></b></p>
            </div>

            <div class="text-center mt-4">
                <a href="edit_profile_form.php" class="btn btn-secondary">Edit Profile</a>
            </div>
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
include("../partials/footer.php");
?>
