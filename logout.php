<?php
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect to the home page or sign-in page
header("Location: index.php");
exit();
?>