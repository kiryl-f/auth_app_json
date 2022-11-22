<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/auth_style.css">
    <title>Authentication</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="js/auth_ajax.js"></script>
</head>
<body>
<h1 id="header">Enter your data here</h1>

<form>
    <label for="login">Login</label>
    <input type="text" id="login" name="login" placeholder="Enter your login here" required><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password here" required><br>
    <input name="submit" type="submit" value="Log in">
</form>
</body>
