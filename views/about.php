<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    include("../views/partials/user_header.php");
    include("../views/partials/user_sidebar.html");
} else {
include("../views/partials/header.php");
}
?>
 <main>
        <div class="container mt-5">
            <div class="about-us-container mt-4">
                <h2 class="text-center">About</h2>
                <div class="row mt-4 ">
                    <div class="col-md-6">
                        <img src="../public/images/about_pic.jpg" class="img-fluid" alt="About Us Image">
                    </div>
                    <div class="col-md-6 whitebg">
                        <h3>Mission</h3>
                        <p>FitForm aims to empower individuals to take control of their health and fitness through precise nutritional tracking. The user-friendly tool helps you calculate your daily caloric and macronutrient needs, register your progress, and achieve your fitness goals.</p>
                        <h3>Story</h3>
                        <p>Founded in 2024, the journey began with a passion for health and wellness. I realized that understanding nutritional needs and tracking progress can be a game-changer for anyone looking to improve their fitness. Today, I am proud to offer a comprehensive tool that combines calorie and macronutrient calculation with progress tracking.</p>
                        <h3>Features</h3>
                        <ul>
                            <li>Calculate your Caloric daily needs</li>
                            <li>Calculate your Macronutrient daily needs</li>
                            <li>Create your profile</li>
                            <li>Log Your Stats</li>
                            <li>Track your Progress</li>
                        </ul>
                    </div>
                    
                </div>
                <br>
                <div class="row mt-5">
                    <div class="col text-center" >
                        <a href="register.php" class="btn btn-success btn-calculate" style="display : inline;">Get Started</a>
                        <span> or </span>
                        <a href="login.php" class="btn btn-success btn-calculate" style="display : inline;">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
include("partials/footer.php")
?>
