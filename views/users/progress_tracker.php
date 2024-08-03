
<?php
include("../partials/user_header.php");
require_once '../../models/Repository_class.php';

//Here we should implement some library to get a chart or graph!!

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

// Initialize the repository
$repository = new Repository();
$errors=[];
// Load the profile
try {
    $user = $repository->getUserProfile($user_id);

    $user_desired_objective = $user['desired_objective'];

    if($user_desired_objective == "Weight Loss"){
        $greeting = "Let's crush those extra calories together, <b>" . $first_name . "</b>!";
    }
    if($user_desired_objective == "Muscle Gain"){
        $greeting = "Time to build those muscles, <b>" . $first_name . "</b>! Let's get those gains!";
    }
    if($user_desired_objective == "Maintain Weight"){
        $greeting = "You're doing great, <b>" . $first_name . "</b>! Keep up the fantastic work!";
    }


} catch (Exception $e) {
    $errors[] = "An error occurred: " . $e->getMessage();
}

// Fetching from the statistics table 
try {
    $statistics = $repository->getUserStatistics($user_id); // Ensure user_id to fetch statistics
} catch (PDOException $e) {
    $errors[] = "Error connecting to database: " . $e->getMessage();
}


?>

<div class="sidebar">
    <a href="user_home.php">User Dashboard</a>
    <a href="add_progress.php">Add Progress</a>
    <a href="edit_profile.php">Edit Objective</a>
    <a href="edit_profile.php">Edit Profile</a>
    <a href="\FitForm/views/users/edit_user_form.php">Edit Account</a>
    <a href="#" id="delete-account-link">Delete Account</a>
    <a href="../../controllers/logout.php">Logout</a>
</div>

<div class="main-content">
    <main>
        <br>
        <h3 class="text-center"><?php echo $greeting; ?>!</h3>

        <h5> &rarr; Objective: <?php echo htmlspecialchars($user_desired_objective); ?></h5>

        <div class="container mt-5">
            <div class="form-container mt-4">
                <h2 class="text-center">Progress Tracker</h2>
                <p>Your statistics so far:</p>
                <table class="progress-tracker">
                    <tr>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Calories</th>
                        <th>Protein</th>
                        <th>Carbs</th>
                        <th>Fats</th>
                    </tr>
                    <?php if (!empty($statistics)): ?>
                        <?php foreach ($statistics as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['weight']) . ' kg'; ?></td>
                                <td><?php echo htmlspecialchars($row['calorie_intake'] ?? 'NULL'); ?></td>
                                <td><?php echo htmlspecialchars($row['protein'] ?? 'NULL') . ' g'; ?></td>
                                <td><?php echo htmlspecialchars($row['carbs'] ?? 'NULL') . ' g'; ?></td>
                                <td><?php echo htmlspecialchars($row['fats'] ?? 'NULL') . ' g'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No statistics found.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <button class="btn btn-success btn-calculate">
                <a style="color: white; text-decoration: none;" href="add_progress.php">Add Progress</a>
            </button>
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
$_SESSION['user_id'] = $user_id;
$_SESSION['first_name'] = $first_name;

include("../partials/footer.php")
?>