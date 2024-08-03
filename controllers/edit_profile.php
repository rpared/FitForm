<?php
// Update Profile
require_once '../models/Repository_class.php';
include("../views/partials/header.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

// Initialize the repository
$repository = new Repository();

// Load profile info
$user_id = $_SESSION['user_id'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $age = trim($_POST['age']);
    $gender = trim($_POST['gender']);
    $height = trim($_POST['height']);
    $weight = trim($_POST['weight']);
    $activity_level = trim($_POST['activity_level']);
    $desired_objective = trim($_POST['desired_objective']);

    // Validate inputs
    $errors = [];

    if (empty($age)) {
        $errors[] = "Age is required.";
    }
    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }
    if (empty($height) || !is_numeric($height)) {
        $errors[] = "Valid height is required.";
    }
    if (empty($weight) || !is_numeric($weight)) {
        $errors[] = "Valid weight is required.";
    }
    if (empty($activity_level)) {
        $errors[] = "Activity level is required.";
    }
    if (empty($desired_objective)) {
        $errors[] = "Desired objective is required.";
    }

     // If no errors, proceed to update the profile

        if (empty($errors)) {
            $updated_data = [
                'age' => $age,
                'gender' => $gender,
                'height' => $height,
                'weight' => $weight,
                'activity_level' => $activity_level,
                'desired_objective' => $desired_objective
            ];
    };

    try {
        // Update Profile
        if ($repository->updateProfile($user_id, $updated_data)) {
            // $_SESSION['first_name'] = $first_name;
            // $_SESSION['user_id'] = $user_id;
            // $_SESSION['flash_message'] = "Info updated successfully!";
            header('Location: ../views/users/user_home.php?updated');
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to update info.";
            header('Location: ../views/users/edit_profile_form.php?failed');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Failed to update info: " . $e->getMessage();
        header('Location: ../views/users/edit_profile_form.php?failed');
        exit;
    }
}

include("../views/partials/footer.php");
?>
