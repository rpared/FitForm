<?php
include("../partials/user_header.php");
include("../../controllers/backgroundImage.php");
require_once '../../models/Repository_class.php';

//This check is needed beacuse the user_header.php starts session too
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
$user = $repository->getUser($user_id);

// Ensure $user is not empty
if (!empty($user) && isset($user[0])) {
    $user = $user[0]; // Get the first element of the array

    // Safely assign user data
    $username = htmlspecialchars($user['username']);
    $email = htmlspecialchars($user['email']);
    $first_name = htmlspecialchars($user['first_name']);
    $last_name = htmlspecialchars($user['last_name']);
} else {
    // Handle case where user data is not found
    $username = '';
    $email = '';
    $first_name = '';
    $last_name = '';
}

?>
<div class="sidebar">
    <a href="/FitForm/views/users/user_home.php">User Dashboard</a>
    <a href="/FitForm/views/users/add_progress.php">Add Progress</a>
    <a href="/FitForm/views/users/edit_objective_form.php">Edit Objective</a>
    <a href="/FitForm/views/users/edit_profile_form.php">Edit Profile</a>
    <a href="/FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="/FitForm/controllers/logout.php">Logout</a>
</div>

<main>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo htmlspecialchars($_SESSION['error_message']);
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo htmlspecialchars($_SESSION['flash_message']);
                        unset($_SESSION['flash_message']);
                        ?>
                    </div>
                <?php endif; ?>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Edit Your Account Information</h2>
            <form method="post" action="\FitForm/controllers/edit_user.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value='<?php echo $username; ?>' required>
                    <div class="invalid-feedback">Username is required.</div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value='<?php echo $email; ?>' required>
                    <div class="invalid-feedback">Valid email is required.</div>
                </div>
                <div class="form-group">
                    <label for="password">Password <em>(at least 8 characters, including at least one special character)</em>:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">Password is required and must be at least 8 characters long, including at least one special character (!@#$%^&*()-_=+{};:,<.>).</div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <div class="invalid-feedback">Please confirm your password.</div>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value='<?php echo $first_name; ?>' required>
                    <div class="invalid-feedback">First Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value='<?php echo $last_name; ?>' required>
                    <div class="invalid-feedback">Last Name is required.</div>
                </div>
                <button type="submit" class="btn btn-success btn-calculate">Update</button>
            </form>
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
