<?php
require 'is_set.php';
if(user_remembered()) {
    echo "Hello, " . $_COOKIE['name'] . "<br>";
}
