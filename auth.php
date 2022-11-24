<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/auth_style.css">
    <title>Authentication</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="js/auth_ajax.js"></script>
    <noscript>JS is disabled. Enable js to continue</noscript>
</head>
<body>
<h1 id="header">Enter your data here</h1>

<?php
require_once 'check_logged_in.php';
echo getMessage();
$log_out_style = getLogOutFormStyle();
?>


<form>
    <label for="login">Login</label>
    <input type="text" id="login" name="login" placeholder="Enter your login here" required><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password here" required><br>
    <input name="submit" type="submit" value="Log in">
</form>

<form action="log_out.php" method="post" <?php echo $log_out_style?>>
    <button type="submit">Log out</button>
</form>
</body>
