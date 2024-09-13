<?php
ob_start(); // Start output buffering
require_once '../models/Repository_class.php';
include("../views/partials/header.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}
// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];

// Initialize the repository
$repository = new Repository();


try {
    $result = $repository->deleteUser($user_id);
    if ($result) {
        $_SESSION['flash_message'] = "Account deleted successfully.";
        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to delete account.";
        header('Location: ../views/users/user_home.php');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = "Error: " . $e->getMessage();
    header('Location: ../views/users/user_home.php');
    exit;
}


include("../views/partials/footer.php");
ob_end_flush(); // Send the buffered output
?>