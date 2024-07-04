<?php
include("public/header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">User Registration</h2>
            <form method="post" action="register_confirmation.php">
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
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                    <div class="invalid-feedback">First Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                    <div class="invalid-feedback">Last Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <select class="form-control" id="age" name="age" required>
                        <option value="">Select Age</option>
                        <?php for ($i = 16; $i <= 80; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="invalid-feedback">Age is required.</div>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <p><em>(If you define yourself as non-binary choose which body composition fits you best)</em></p>
                    </div>
                    <div class="invalid-feedback">Please select your gender.</div>
                </div>
                <button type="submit" class="btn btn-success btn-calculate">Register</button>
            </form>
        </div>
    </div>
</main>




<?php
include("public/footer.php")
?>