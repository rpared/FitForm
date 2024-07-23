<?php
require_once '../models/Repository_class.php';
include("../views/partials/user_header.php");

// This check is needed because the user_header.php starts session too
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}
$user_id = $_SESSION['user_id']; // Retrieve from the _Session superglobal
$first_name = $_SESSION['first_name'];


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $calorie_intake = $_POST['calorie_intake'] ?? null;
    $carbs = $_POST['carbs'] ?? null;
    $protein = $_POST['protein'] ?? null;
    $fats = $_POST['fats'] ?? null;

    // Validate inputs (example validation)
    $errors = [];

    if (empty($date)) {
        $errors[] = "Date is required.";
    }

    if (empty($weight) || !is_numeric($weight)) {
        $errors[] = "Valid weight is required.";
    }

    // If no errors, proceed to add the progress info
    if (empty($errors)) {
        $progressData = [
            'date' => $date,
            'weight' => $weight,
            'calorie_intake' => $calorie_intake,
            'protein' => $protein,
            'carbs' => $carbs,
            'fats' => $fats,
        ];

        // Initialize the repository
        $repository = new Repository();

        try {
            if ($repository->addProgress($user_id, $progressData)) {
                // Progress info added successfully
                $successMessage = "Progress info added successfully!";
                header('Location: ../views/users/user_home.php');
                exit;
            } else {
                // Progress info addition failed for an unknown reason
                $errors[] = "Failed to add progress info.";
            }
        } catch (Exception $e) {
            // Handle the exception and store the error message
            $errors[] = "Failed to add progress info: " . $e->getMessage();
        }
    }
}
?>

<main>
    <div class="container mt-5">
        <h3>Progress Confirmation</h3>

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
            <a href="../views/users/add_progress.php" class="btn btn-warning">Go Back</a>
        <?php endif; ?>
    </div>
</main>

<?php
include("../views/partials/footer.php");
?>