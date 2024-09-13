<?php
 require_once '../../models/Repository_class.php';

// Getting gender to change background img
$repository = new Repository();

$user = $repository->getUserProfile($user_id);
$user_gender = $user['gender'];

?>

 
    <script>
        const bodyBck = document.querySelector("body");

        const gender = "<?php echo $user_gender; ?>";

        if (gender === "Male") {
        bodyBck.classList.add("male-background");
        } else {
        bodyBck.classList.remove("male-background"); // Remove if male class exists
        };

    </script>
