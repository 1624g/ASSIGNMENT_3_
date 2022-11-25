<?php
require_once "connect.php";
require_once "First_session.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 $name = trim($_POST['name']);
 $email = trim($_POST['email']);
 $password = trim($_POST['password']);
 $confirm_password = trim($_POST["confirm_password"]);
 $bio = trim($_POST["bio"]);
 $password_en = password_hash($password, PASSWORD_BCRYPT);
 if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
 $error = '';
 // Binded parameters (s = string, i = int, b = blob, etc), in our case the username is
a string so we use "s"
// I am not sure about them that these are to be included but i am just practising using
// them i saw it somewhere.Hope any deduction would not be made
 $query->bind_param('s', $email);
 $query->execute();
 // Storing the result by which we can check if the account exists in the database or not.
 $query->store_result();
 if ($query->num_rows > 0) {
 $error .= '<p class="error">We are already registered with this email address. Try another one!</p>';
 } else {
 // Validate password
 if (strlen($password ) < 6) {
 $error .= '<p class="error">The password cannot be less than 6 characters.</p>';
 }
 // Validate confirm password
 if (empty($confirm_password)) {
 $error .= '<p class="error">Confirm your choosen password.</p>';
 } else {
 if (empty($error) && ($password != $confirm_password)) {
 $error .= '<p class="error">while selecting a password your password is not matching the confirmed password.</p>';
 }
 }
 if (empty($error) ) {
 $insertQuery = $db->prepare("INSERT INTO users (name, email, password,bio) VALUES
(?, ?, ?,?);");
 $insertQuery->bind_param("sss", $name, $email, $password_en,$bio);
 $result = $insertQuery->execute();
 if ($result) {
 $error .= '<p class="success">Congratulation! You are now registered with us.</p>';
 } else {
 $error .= '<p class="error">OOPS!!!Something went wrong! Please try again later</p>';
 }
 }
 }
 }
 $query->close();
 $insertQuery->close();
 // Closing DB connection
 mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="UTF-8">
 <title>Sign Up</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 </head>
 <body>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h2>Sign up with us to create new profile</h2>
 <p>Fill in the Details to create a new account.</p>
 <?php echo $success; ?>
 <?php echo $error; ?>
 <form action="" method="post">
 <div class="form-group">
 <label>Full Name</label>
 <input type="text" name="name" class="form-control" required>
 </div>
<div class="form-group">
 <label>Email Address</label>
<input type="email" name="email" class="form-control" required>
</div>
<div class="form-group">
 <label>Password</label>
 <input type="password" name="password" class="form-control"
required>
 </div>
<div class="form-group">
 <label>Confirm Password</label>
 <input type="password" name="confirm_password" class="formcontrol" required>
 </div>
 <div class="form-group">
 <label>Fill in your bio</label>
 <input type="text" name="bio" class="formcontrol" required>
 </div>
<div class="form-group">
 <input type="submit" name="submit" class="btn btn-primary"
value="Submit">
 </div>
<p>You Already have an account with us? <a href="login.php">Login here</a>.</p>
 </form>
 </div>
 </div>
 </div>
 </body>
</html>
