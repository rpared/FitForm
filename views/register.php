<?php
include("partials/header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">User Registration</h2>
            <form method="post" action=".././controllers/register_confirmation.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <div class="invalid-feedback">Username is required.</div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                    <div class="invalid-feedback">First Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                    <div class="invalid-feedback">Last Name is required.</div>
                </div>
                <button type="submit" class="btn btn-success btn-calculate">Register</button>
            </form>
        </div>
    </div>
</main>




<?php
include("partials/footer.php")
?>