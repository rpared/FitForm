<?php
session_start(); // Start the session
require_once '../models/Repository_class.php';
include("../views/partials/header.php");


// Initialize variables
$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST values
    $login_credential = $_POST['login_credential'];
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validate input
    if (empty($login_credential) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        // Initialize the repository
        $repository = new Repository();

        // Try to log the user in
        try {
            $user = $repository->getUserByCredential($login_credential);

            if ($user && password_verify($password, $user['password'])) { #This is an inbuilt function to check passwords
                // User is authenticated
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['first_name'] = $user['first_name'];
                $user_id = $user['user_id'];
                // Fetch user's profile
                $profile = $repository->getUserProfile($user_id);

                if ($profile) {
                    // $_SESSION['user_id'] = $profile['user_id'];
                    $_SESSION['user_id'] = $user_id;
                    // Redirect to the user's profile page
                    header('Location: ../views/users/user_home.php');
                    exit();
                } else {
                    // Redirect to create profile page if no profile exists
                    header('Location: ../views/users/create_profile.php');
                    exit();
                }
            } else {
                $errors[] = "Invalid login credential or password.";
            }
        } catch (Exception $e) {
            $errors[] = "An error occurred: " . $e->getMessage();
        }
    }
}
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php

include("../views/partials/footer.php")
?>
