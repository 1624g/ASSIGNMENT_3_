<?php
// Start the session
session_start();
// if the user is already logged in then redirect user to welcome page
if (isset($_SESSION["account_holder_id"]) && $_SESSION["account_holder_id"] === true) {
 header("location: welcome.php");
 exit;
}
?>