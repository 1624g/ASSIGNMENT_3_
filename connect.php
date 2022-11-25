<?php
define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'root'); // Database username
define('DBPASSWORD', ''); // Database password
define('DBNAME', 'demo'); // Database name
define('DBBIO','');//Database bio
/* connect to MySQL database */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME, DBBIO);
// Check db connection
if($db === false){
 die("Error: connection error. " . mysqli_connect_error());
}
?>