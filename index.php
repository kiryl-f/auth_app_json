<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main page!</title>
    <link rel="stylesheet" href="css/auth_style.css">
</head>
<body>

<?php
require 'check_logged_in.php';
echo getMessage();
$log_out_style = getLogOutFormStyle();
?>


<a href="auth.php">Login</a>
<br>
<a href="registration.php" >Create an account</a>
<br>
<form action="log_out.php" method="post" <?php echo $log_out_style?>>
    <button type="submit">Log out</button>
</form>

</body>