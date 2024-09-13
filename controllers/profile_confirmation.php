<?php
ob_start(); // Start output buffering
require_once '../models/Repository_class.php';
require_once '../models/Profile_class.php';
include("../views/partials/header.php");

// This check is needed beacuse the user_header.php starts session too
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}
$user_id = $_SESSION['user_id']; //Retrieve from the _Session superglobal
$first_name = $_SESSION['first_name'];


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST['age'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $height = $_POST['height'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $activity_level = $_POST['activity_level'] ?? null;
    $desired_objective = $_POST['desired_objective'] ?? null;

    // Validate inputs (example validation)
    $errors = [];

    if (empty($age)) {
        $errors[] = "Age is required.";
    }
    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }

    // Validate height (must be a float)
    if (!is_numeric($height) || $height <= 40 || $height >= 300) {
        $errors[] = "Invalid height provided. it must be between 40 and 300 cm";
    }

    // Validate weight (must be a float)
    if (!is_numeric($weight) || $weight <= 20 || $weight >= 700) {
        $errors[] = "Invalid weight provided, it must be between 20 and 700 kg.";
    }



    if (empty($activity_level)) {
        $errors[] = "Activity level is required.";
    }
    if (empty($desired_objective)) {
        $errors[] = "Desired objective is required.";
    }

     // If no errors, proceed to create the profile
     if (empty($errors)) {
        $profileData = [
            'age' => $age,
            'gender' => $gender,
            'height' => $height,
            'weight' => $weight,
            'activity_level' => $activity_level,
            'desired_objective' => $desired_objective,
        ];

        // Initialize the repository and the profile
        $repository = new Repository();
        $new_profile = new Profile($age, $gender, $height, $weight, $activity_level, $desired_objective);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['first_name'] = $first_name;

        try {
            if ($repository->createProfile($user_id, $new_profile)) {
                // Profile created successfully
                $successMessage = "Profile created successfully!";
                header('Location: ../views/users/user_home.php');
                exit;
            } else {
                // Profile creation failed for an unknown reason
                $errors[] = "Failed to create profile.";
            }
        } catch (Exception $e) {
            // Handle the exception and store the error message
            $errors[] = "Failed to create profile: " . $e->getMessage();
        }
    }
}
?>

<main>
    <div class="container mt-5">
        <h3>Profile Confirmation</h3>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success"><?= $successMessage ?></div>
            <div class="buttons">
                <a href="edit_user.php" class="btn btn-primary">Edit User</a>
                <a href="edit_profile.php" class="btn btn-secondary">Edit Profile</a>
                <p>Now you may add some statistics to track your progress.</p>
                <a href="add_statistics.php" class="btn btn-info">Add Statistics</a>
            </div>
        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <a href="../views/users/create_profile.php" class="btn btn-warning">Go Back</a>
        <?php endif; ?>
    </div>
</main>

<?php
include("../views/partials/footer.php");
ob_end_flush(); // Send the buffered output
?>