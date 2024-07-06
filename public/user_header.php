<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritional Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/styles.css">
</head>
<body>
    <!-- Navbar  this will be included in other files-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light custom-navbar-bg">
        <a class="navbar-brand" href="index.php">
            <img src=".\public\images\FitFormLogoFinal.png" height="65" class="d-inline-block align-top" alt="Fit Form Innovations Logo">
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
                        <a class="dropdown-item" href="index.php">Calories</a>
                        <a class="dropdown-item" href="macros.php">Macros</a>
                    </div>
                </li>

                <li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                </li>
                
                <li class="nav-item tracker">
                    <a class="nav-link" href="progress_tracker.php">Progress Tracker</a>
                </li>
                <li class="nav-item tracker">
                    <a class="nav-link" href="progress_log.php">Log Progress</a>
                </li>
                
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link login" href="login.php">"user_name"'s Profile</a>
                </li>
            </ul>
        </div>
    </nav>
