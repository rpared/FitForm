<?php
ob_start(); // Start output buffering
require_once '../models/Repository_class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $repository = new Repository();

    // Check which delete button was pressed
    if (isset($_POST['delete_user'])) {
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            try {
                $repository->deleteUser($user_id);
                header('Location: admin.php'); // Redirect to admin page
                exit;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                die("Error deleting user: $error_message");
            }
        }
    }

    if (isset($_POST['delete_profile'])) {
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            try {
                $repository->deleteProfile($user_id);
                header('Location: admin.php'); // Redirect to admin page
                exit;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                die("Error deleting profile: $error_message");
            }
        }
    }

    if (isset($_POST['delete_statistic'])) {
        if (isset($_POST['stat_id'])) {
            $stat_id = $_POST['stat_id'];
            try {
                $repository->deleteStatistic($stat_id);
                header('Location: admin.php'); // Redirect to admin page
                exit;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                die("Error deleting statistic: $error_message");
            }
        }
    }
} else {
    die("Invalid request.");
}
ob_end_flush(); // Send the buffered output
?>
