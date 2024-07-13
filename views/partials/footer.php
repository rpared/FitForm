<footer>
    <p>FitForm Innovations - 2024</p>
</footer>
<script>
        // Array of text messages of the banner
        const messages = [
            "Calculate yourself into fitness!",
            "Track your progress!📈",
            "Get your macros!🥦",
            "Fitness simplified!💪"
        ];

        // Get the h1 element
        const claimElement = document.querySelector('.claim em');

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
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
