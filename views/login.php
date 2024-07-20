<?php
include("partials/header.php")
?>

<main>
    <div class="container mt-5">
        <div class="form-container mt-4">
            <h2 class="text-center">User Login</h2>
            <form method="post" action="../controllers/login_process.php">
                <div class="form-group">
                    <label for="login_credential">login_credential or Email:</label>
                    <input type="text" class="form-control" id="login_credential" name="login_credential" required>
                    <div class="invalid-feedback">Username or Email is required.</div>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">Password is required.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-calculate">Login</button>
            </form>
        </div>
    </div>
</main>

<?php
include("partials/footer.php")
?>