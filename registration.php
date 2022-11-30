<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/auth_style.css">
    <title>Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="js/reg_ajax.js"> </script>
    <noscript>JS is disabled. Enable js to continue</noscript>
</head>
<body>
<h1 id="header">Enter your data here</h1>

<?php
require 'check_logged_in.php';
echo getMessage();
$log_out_style = getLogOutFormStyle();
$main_style = getMainMenuButtonsStyle();
?>

<form <?php echo $main_style?>>
    <label for="login">Login</label>
    <input type="text" id="login" name="login" placeholder="Enter your login here" required><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password here" required><br>
    <label for="confirm_password">Confirm</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required><br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="email@example.com" required><br>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your name" required><br>
    <input type="hidden" value="reg">
    <input type="submit" value="Next">
</form>

<button onclick="window.location.href='log_out.php';" <?php echo $log_out_style?>>Log out</button>
</body>
</html>