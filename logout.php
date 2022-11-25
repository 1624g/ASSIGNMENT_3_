<?php
// Starting the session
session_start();
// Destroying the session.
if (session_destroy()) {
 // redirecting to the login page
 header("Location: login.php");
 exit;
}
?>
