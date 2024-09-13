<?php
ob_start(); // Start output buffering
require_once '../models/Repository_class.php';
include("../views/partials/header.php");

// Initialize the repository
$repository = new Repository();

// Load user info
$user_id = $_SESSION['user_id'];
$user = $repository->getUser($user_id);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $_SESSION['error_message'] = "User name is required.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
    $username = $_POST["username"];
    
    // Validate email
    if (empty($_POST["email"])) {
        $_SESSION['error_message'] = "Email is required.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
    $email = $_POST["email"];
    // Ensure email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }

    // Validate password
    if (empty($_POST["password"])) {
        $_SESSION['error_message'] = "Password is required.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
    $password = $_POST["password"];
    // Ensure password meets requirements
    if (strlen($password) < 8 || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
        $_SESSION['error_message'] = "Password must be at least 8 characters long and include at least one special character.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Confirm password
    if (empty($_POST["confirm_password"])) {
        $_SESSION['error_message'] = "Please confirm your password.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
    $confirm_password = $_POST["confirm_password"];
    // Ensure passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }

    // Other fields validation
    $first_name = $_POST["first_name"];
    if (empty($first_name)) {
        $_SESSION['error_message'] = "First Name is required.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }

    $last_name = $_POST["last_name"];
    if (empty($last_name)) {
        $_SESSION['error_message'] = "Last Name is required.";
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }

    // Prepare updated data
    $updated_data = [
        'username' => $username,
        'email' => $email,
        'password' => $hashed_password,
        'first_name' => $first_name,
        'last_name' => $last_name
    ];

    try {
        // Update user
        if ($repository->updateUser($email, $updated_data)) {
            $_SESSION['first_name'] = $first_name;
            // $_SESSION['user_id'] = $user_id;
            // $_SESSION['flash_message'] = "Info updated successfully!";
            header('Location: ../views/users/user_home.php?updated');
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to update info.";
            header('Location: ../views/users/edit_user_form.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Failed to update info: " . $e->getMessage();
        header('Location: ../views/users/edit_user_form.php');
        exit;
    }
}

include("../views/partials/footer.php");
ob_end_flush(); // Send the buffered output
?>
