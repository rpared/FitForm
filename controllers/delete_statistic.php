<?php
require_once '../models/Repository_class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $repository = new Repository();

    if (isset($_POST['delete_statistic'])) {
        if (isset($_POST['stat_id'])) {
            $stat_id = $_POST['stat_id'];
            try {
                $repository->deleteStatistic($stat_id);
                header('Location: ../views/users/progress_tracker.php'); // Redirect to progress_tracker page
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
?>