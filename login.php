<?php
require_once "connect.php";
require_once "First_session.php";
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 $email = trim($_POST['email']);
 $password = trim($_POST['password']);
 // Doing some validation if email is empty
 if (empty($email)) {
 $error .= '<p class="error">Enter your email id before proceeding onto the next step.</p>';
 }
 // Doing some validation if password is empty
 if (empty($password)) {
 $error .= '<p class="error">Enter your password before proceeding onto the next step.</p>';
 }
 if (empty($error)) {
 if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
 $query->bind_param('s', $email);
 $query->execute();
 $row = $query->fetch();
 if ($row) {
 if (password_verify($password, $row['password'])) {
 $_SESSION["account_holder_id"] = $row['id'];

 $_SESSION["account_holder"] = $row;
 // Redirecting the user to welcome page
 header("location: welcome.php");
 exit;
 } else {
 $error .= '<p class="error">The password is not valid.</p>';
 }
 } else {
 $error .= '<p class="error">No User exist with that email address.</p>';
 }
 }
 $query->close();
 }
 // Close connection
 mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="UTF-8">
 <title>Login</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 </head>
 <body>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h2>Login to Open your Profile</h2>
 <p>You can Fill in your details Here.</p>
 <?php echo $error; ?>
 <form action="" method="post">
 <div class="form-group">
 <label>Email Address</label>
 <input type="email" name="email" class="form-control" required />
 </div>
<div class="form-group">
 <label>Password</label>
 <input type="password" name="password" class="form-control"
required>
 </div>
<div class="form-group">
 <input type="submit" name="submit" class="btn btn-primary"
value="Submit">
 </div>
<p>Don't have an account with us? <a href="Form.php">Register here</a>.
</p>
 </form>
 </div>
 </div>