<?php
ob_start(); // Start output buffering
session_start(); // Start the session

// Destroy the session
session_destroy();

// Redirect to the homepage
header('Location: ../index.php');
exit();
ob_end_flush(); // Send the buffered output
?>
