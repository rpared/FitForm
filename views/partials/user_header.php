<?php
 require_once '../../models/Repository_class.php';

// Start the session if it has not been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];

// Getting gender to change background img
$repository = new Repository();

$user = $repository->getUserProfile($user_id);
$user_gender = $user['gender'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritional Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FitForm/public/css/styles.css">
    <link rel="shortcut icon" href="/FitForm/public/images/favicon.png " type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</head>
<body>
    <!-- Navbar  this will be included in other files-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top custom-navbar-bg">
        <a class="navbar-brand" href="/FitForm/views/users/user_home.php">
            <img src="/FitForm/public/images/FitFormLogoFinal.png" height="65" class="d-inline-block align-top" alt="Fit Form Innovations Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="calculateDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Calculate
                    </a>
                    <div class="dropdown-menu" aria-labelledby="calculateDropdown">
                    <a class="dropdown-item" href="/FitForm/controllers/calculate_calories.php">Calories</a>
                    <a class="dropdown-item" href="/FitForm/controllers/calculate_macros.php">Macros</a>
                    </div>
                </li>

                <li>
                <li class="nav-item">
                    <a class="nav-link" href="/FitForm/views/about.php">About</a>
                </li>
                </li>
                
                <!-- <li class="nav-item tracker">
                    <a class="nav-link" href="progress_tracker.php">Progress Tracker</a>
                </li>
                <li class="nav-item tracker">
                    <a class="nav-link" href="add_progress.php">Add Progress</a>
                </li> -->
                
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link login" href="/FitForm/views/users/display_profile.php"><?php echo $first_name. "'s Profile";?> </a>               
                </li>
                <li class="nav-item tracker">
                    <a class="nav-link" href="/FitForm/controllers/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        const bodyBck = document.querySelector("body");

        const gender = "<?php echo $user_gender; ?>";

        if (gender === "Male") {
        bodyBck.classList.add("male-background");
        } else {
        bodyBck.classList.remove("male-background"); // Remove if male class exists
        };

    </script>
