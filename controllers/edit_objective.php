<?php
// Update Desired Objective
require_once '../models/Repository_class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

// Initialize the repository
$repository = new Repository();
$user_id = $_SESSION['user_id'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate inputs
    $desired_objective = trim($_POST['desired_objective']);

    if (empty($desired_objective)) {
        $_SESSION['error_message'] = "Desired objective is required.";
        header('Location: ../views/users/edit_objective_form.php?failed');
        exit;
    }

    // Update the profile
    try {
        if ($repository->updateObjective($user_id, $desired_objective)) {
            $_SESSION['flash_message'] = "Objective updated successfully!";
            header('Location: ../views/users/user_home.php?updated');
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to update objective.";
            header('Location: ../views/users/edit_objective_form.php?failed');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Failed to update objective: " . $e->getMessage();
        header('Location: ../views/users/edit_objective_form.php?failed');
        exit;
    }
}
?>
