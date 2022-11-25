<?php
// start the session
session_start();
// Checking as if the user  is logged in or not and redirecting him back to the login page in that case.
if (!isset($_SESSION["account_holder_id"]) || $_SESSION["account_holder_id"] !== true) {
 header("location: login.php");
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="UTF-8">
 <title>Welcome <?php echo $_SESSION["name"]; ?></title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 </head>
 <body>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h1>Hello, <strong><?php echo $_SESSION["name"]; ?></strong>. Welcome to
my trial site page. Hope you liked it. I tried my best</h1>
 </div>
 <div class="col-md-12">
 <h1>My Bio <strong><?php echo $_SESSION["bio"]; ?></strong>.  Welcome to
my trial site page. Hope you liked it. I tried my best</h1>
 </div>
 <p>
 <a href="logout.php" class="btn btn-secondary btn-lg active"
role="button" aria-pressed="true">Log Out</a>
 </p>
 </div>
 </div>
 </body>
</html>
<?php
// Start the session
session_start();
// Destroy the session.
if (session_destroy()) {
 // redirect to the login page
 header("Location: login.php");
 exit;
}
?>