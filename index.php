<?php
include("views/partials/header.php")
?>

    <section class="banner">
    <em><h1 class="claim">  Calculate yourself into fitness! </h1></em>

    </section>

    <!-- Main Content -->

    
    <div class="cta-wrapper mt-4">
            <div class="cta-section">
                <h3>Get your Calories</h3>
                <img src="public\images\calories.png" alt="Calculate calories">
                <p>Discover your daily caloric needs based on your personal data. Understand how many calories you need to maintain your weight, lose fat, or gain muscle effectively.</p>
                <a href="controllers/calculate_calories.php" class="btn btn-info">Calculate</a>
            </div>
            <div class="cta-section">
                <h3>Get your Macros</h3>
                <img src="public\images\macros.png" alt="Calculate macros">
                <p>Calculate the optimal distribution of macronutrients (carbohydrates, proteins, fats) tailored to your specific fitness goals. Learn how to fuel your body the right way!</p>
                <a href="controllers/calculate_macros.php" class="btn btn-info">Calculate</a>
            </div>
            <div class="cta-section">
                <h3>Register for Free</h3>
                <img src="public\images\sign-in.png" alt="Calculate sign-in">
                <p>Join our community today! Sign up for free and start tracking your progress, setting goals, and accessing personalized content. No fees, just results.</p>
                <a href="views/register.php" class="btn btn-info">Register</a>
            </div>
    </div>

    <script>
        // Array of text messages of the banner
        const messages = [
            "Calculate yourself into fitness!",
            "Track your progress!📈",
            "Get your macros!🥦",
            "Fitness simplified!💪"
        ];

        // Get the h1 element
        const claimElement = document.querySelector('.claim');

        // Initialize message index
        let messageIndex = 0;

        // Function to change the Claim  text
        function changeText() {
            // Update the text content
            claimElement.textContent = messages[messageIndex];

            // Update the message index for the next iteration
            messageIndex = (messageIndex + 1) % messages.length;
        }

        // Set an interval to change the text every 3 seconds (3000 milliseconds)
        setInterval(changeText, 3000);
    </script>


    
<?php
include("views/partials/footer.php")
?>

