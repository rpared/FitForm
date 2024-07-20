<?php
include("../partials/user_header.php");
require_once '../../models/Repository_class.php';

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
} catch (Exception $e) {
    $errors[] = "An error occurred: " . $e->getMessage();
}

?>

<main>
    <br>
<h3 class="text-center">We are ready exterminate those extra calories <?php echo $first_name ?>! </h3>


<h5> &rarr; Objective: <?php echo htmlspecialchars($user_desired_objective); ?> </h5>

<div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">Progress Tracker</h2>
            <p>Your statistics so far:</p>
            <table class="progress-tracker">
                <tr>
                    <th>Date</th>
                    <th>Weight</th>
                    <th>Activity Level</th>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Carbs</th>
                    <th>Fats</th>
                </tr>
                <tr>
                    <td>2024-07-06</td>
                    <td>70 kg</td>
                    <td>Moderate</td>
                    <td>2500</td>
                    <td>150 g</td>
                    <td>300 g</td>
                    <td>80 g</td>
                </tr>
                <tr>
                    <td>2024-07-07</td>
                    <td>69.5 kg</td>
                    <td>High</td>
                    <td>NULL</td>
                    <td>NULL</td>
                    <td>NULL</td>
                    <td>NULL</td>
                </tr>
            </table>

        </div>
        <button class="btn btn-success btn-calculate"><a style="color:white; text-decoration:none;" href="add_progress.php">Add Progress</a></button>
    </div>



   
</main>




<?php
include("../partials/footer.php")
?>