<?php
require_once '../models/Repository_class.php';
require_once '../models/User_class.php';
include("../views/partials/header.php");


// Validate and process registration form data

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        die("User name is required.");
    }
    $username = $_POST["username"];
    // Validate email
    if (empty($_POST["email"])) {
        die("Email is required.");
    }
    $email = $_POST["email"];
    // Ensure email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

        // Validate password
        if (empty($_POST["password"])) {
            die("Password is required.");
        }
        $password = $_POST["password"];
        // Ensure password meets requirements (at least 8 characters, including a special character)
        if (strlen($password) < 8 || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            die("Password must be at least 8 characters long and include at least one special character (!@#$%^&*()-_=+{};:,<.>).");
        }
        // Hash the password for security before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Confirm password
    if (empty($_POST["confirm_password"])) {
        die("Please confirm your password.");
    }
    $confirm_password = $_POST["confirm_password"];
    // Ensure password confirmation matches
    if ($password !== $confirm_password) {
        die("Passwords do not match. Try again please.");
    }

    // Other fields validation
    $first_name = $_POST["first_name"];
    if (empty($first_name)) {
        die("First Name is required.");
    }

    $last_name = $_POST["last_name"];
    if (empty($last_name)) {
        die("Last Name is required.");
    }

    // If all validations pass we got to create a User object and store it in the database using a Repository Function
    
    $new_user = new User($username, $hashed_password, $email, $first_name, $last_name);
    $repository = new Repository();

    $repository->createUser($new_user);
    session_start(); // Start the session
    $_SESSION['user_id'] = $repository->getUserId($email);
    $_SESSION['first_name'] = $first_name;
    
    // Successful registration message
    echo "Registration successful!";
    // Redirect to create_profile.php using header() function
    header('Location: ../views/users/create_profile.php?first_name=' . urlencode($first_name));
    exit;
} else {
    // If the form was not submitted via POST method, handle accordingly (redirect or error message)
    die("Form submission method not allowed.");
}


include("../views/partials/footer.php")
?>
