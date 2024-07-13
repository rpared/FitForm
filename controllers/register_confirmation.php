<?php
// Validate and process registration form data

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate email (username)
    if (empty($_POST["email"])) {
        die("Email (Username) is required.");
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
        die("Passwords do not match.");
    }

    // Other fields validation
    $firstname = $_POST["firstname"];
    if (empty($firstname)) {
        die("First Name is required.");
    }

    $lastname = $_POST["lastname"];
    if (empty($lastname)) {
        die("Last Name is required.");
    }

    $age = $_POST["age"];
    if (empty($age)) {
        die("Age is required.");
    }

    $gender = $_POST["gender"];
    if (empty($gender)) {
        die("Gender is required.");
    }

    // If all validations pass we got to store user data in database

    
    // Successful registration message
    echo "Registration successful!";
} else {
    // If the form was not submitted via POST method, handle accordingly (redirect or error message)
    die("Form submission method not allowed.");
}
?>
